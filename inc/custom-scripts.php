<?php

// Custom scripts
function loadk_scripts() {

    // Globals
    $theme_dir = get_stylesheet_directory_uri();
    $q_id = get_queried_object_id();

    // Inits and imports
    wp_enqueue_script( 'main', $theme_dir.'/assets/js/main.min.js', array(), '1.0', array('strategy' =>'defer','in-footer'=>true));

    // Prism JS
    if (is_singular('post') && get_field('prismjs_check', $q_id)) {
        wp_enqueue_script( 'prism', $theme_dir . '/assets/js/libs/prism.js', array(), '1.30.0', array('strategy' =>'defer','in-footer'=>true));
    }

    // Matrix
    if (is_404()) {
        wp_enqueue_script( 'matrix-dark', $theme_dir . '/assets/js/libs/matrix.js', array(), '', array('strategy' =>'defer','in-footer'=>true));
    }
    
}
add_action( 'wp_enqueue_scripts', 'loadk_scripts' );

// Styles to load in footer
function footer_style() {

    // Globals
    $theme_dir = get_stylesheet_directory_uri();
    $q_id = get_queried_object_id();

    // Prism JS
    if (is_singular('post') && get_field('prismjs_check', $q_id)) {
        wp_enqueue_style( 'prism-css-dark', $theme_dir . '/assets/css/libs/prism-dark.min.css', array(), '1.30.0' );
        wp_enqueue_style( 'prism-css-light', $theme_dir . '/assets/css/libs/prism-light.min.css', array(), '1.30.0' );
    }

    // Lightbox - Nanobox
    if (is_singular('post') && get_field('nanobox_css_check', $q_id)) {
        wp_enqueue_style( 'nanobox-css', $theme_dir . '/assets/css/libs/nanobox.min.css', array(), '1.0.0' );
    }

    // CookieConsent
    wp_enqueue_script_module('cookieconsent-config', $theme_dir . '/assets/js/configs/cookieconsent-config.js', );

};
add_action( 'get_footer', 'footer_style' );

function stylesheets_handler( $html, $handle ) {
    $q_id = get_queried_object_id();

    if ( ! is_singular( 'post' ) || ! get_field( 'prismjs_check', $q_id ) ) {
        return $html;
    }

    $is_light_mode   = isset( $_COOKIE['vm-mode'] ) && $_COOKIE['vm-mode'] === 'light';
    $handle_to_disable = $is_light_mode ? 'prism-css-dark' : 'prism-css-light';

    if ( $handle === $handle_to_disable ) {
        return str_replace( "media='all'", "media='all' disabled", $html );
    }

    return $html;
}
add_filter( 'style_loader_tag', 'stylesheets_handler', 10, 2 );

// Custom handling for Consent logs
add_action('rest_api_init', function () {
    register_rest_route('cookieconsent/v1', '/log', [
        'methods'             => 'POST',
        'callback'            => 'cookieconsent_log_consent',
        'permission_callback' => '__return_true', // Public endpoint — nonce handles security
    ]);
});

function cookieconsent_anonymize_ip(string $ip): string {
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        // IPv4: zero out last two octets → 192.168.1.100 becomes 192.168.0.0
        $parts = explode('.', $ip);
        $parts[2] = '0';
        $parts[3] = '0';
        return implode('.', $parts);
    }

    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        // IPv6: expand, then zero out last 80 bits (5 groups)
        $full = inet_ntop(inet_pton($ip));
        $parts = explode(':', $full);
        foreach ([3, 4, 5, 6, 7] as $i) {
            $parts[$i] = '0000';
        }
        return implode(':', $parts);
    }

    return ''; // invalid IP — store nothing
}

function cookieconsent_log_consent(WP_REST_Request $request) {
    // 1. Verify nonce
    $nonce = $request->get_header('X-WP-Nonce');
    if (!wp_verify_nonce($nonce, 'wp_rest')) {
        return new WP_Error('forbidden', 'Invalid nonce', ['status' => 403]);
    }

    // 2. Sanitize inputs
    $params           = $request->get_json_params();
    $consent_id       = sanitize_text_field($params['consentId'] ?? '');
    $accept_type      = sanitize_text_field($params['acceptType'] ?? '');
    $accepted         = array_map('sanitize_text_field', (array)($params['acceptedCategories'] ?? []));
    $rejected         = array_map('sanitize_text_field', (array)($params['rejectedCategories'] ?? []));

    if (empty($consent_id) || empty($accept_type)) {
        return new WP_Error('bad_request', 'Missing required fields', ['status' => 400]);
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $transient_key = 'cc_ratelimit_' . md5($ip);
    if (get_transient($transient_key)) {
        return new WP_Error('rate_limited', 'Too many requests', ['status' => 429]);
    }
    set_transient($transient_key, true, 15); // 1 request per IP per 60 seconds

    // 3. Insert using prepared statements (via $wpdb->insert which handles this automatically)
    global $wpdb;
    $table_name = $wpdb->prefix . 'cookie_consents';

    $result = $wpdb->insert($table_name, [
        'consent_id'          => $consent_id,
        'accept_type'         => $accept_type,
        'accepted_categories' => wp_json_encode($accepted),
        'rejected_categories' => wp_json_encode($rejected),
        'ip_address' => cookieconsent_anonymize_ip($_SERVER['REMOTE_ADDR'] ?? ''),
        'user_agent'          => $_SERVER['HTTP_USER_AGENT'] ?? '',
    ]);

    if ($result === false) {
        return new WP_Error('db_error', 'Could not save consent', ['status' => 500]);
    }

    return rest_ensure_response(['success' => true]);
}

add_action('wp_head', function () {
    $json = wp_json_encode([
        'apiUrl' => rest_url('cookieconsent/v1/log'),
        'nonce'  => wp_create_nonce('wp_rest'),
    ], JSON_HEX_TAG | JSON_HEX_AMP);

    echo "<script>window.wpConsent = $json;</script>\n";
});

// removes rich text editor for blog listing template
function remove_pages_editor() {
    $post_id = $_GET['post'] ?? $_POST['post_ID'] ?? 0;

    if (!$post_id) return;

    if (get_page_template_slug($post_id) === 'page-templates/template-blog.php') {
        remove_post_type_support('page', 'editor');
    }
}
add_action('admin_init', 'remove_pages_editor');

// Modifies main query, to load only posts from one taxonomy term
function filter_blog_posts_by_lang( $query ) {
    if ( !is_admin() && $query->is_main_query() && ( $query->is_home() || $query->is_archive() ) ) {
        $query->set( 'tax_query', array(
            array(
                'taxonomy' => 'web-lang',
                'field'    => 'slug',
                'terms'    => 'pl',
            ),
        ) );
    }
}
add_action( 'pre_get_posts', 'filter_blog_posts_by_lang' );