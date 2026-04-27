<?php

// Disable oEmbed on the website but keep it enabled for external platforms
function disable_oembed_on_site() {
    if (!is_admin()) {
        remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );
        add_filter( 'embed_oembed_discover', '__return_false' );
        add_filter( 'embed_preview', '__return_false' );
    }
}
add_action( 'init', 'disable_oembed_on_site' );

// Remove Widgets
function remove_widget_support() {
    remove_theme_support( 'widgets-block-editor' );
    remove_theme_support( 'widgets' );
}
add_action( 'after_setup_theme', 'remove_widget_support' );

// Remove admin dashboard widgets
function remove_all_dashboard_widgets() {

    // Remove Welcome Panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );

    // Remove Widgets
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quick Draft
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress News
    remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' ); // Site Health
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // At a Glance
}
add_action( 'wp_dashboard_setup', 'remove_all_dashboard_widgets' );

// Remove REST API links from header
function remove_json_api () {
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
}
add_action( 'after_setup_theme', 'remove_json_api' );

// Disable self-pingbacks
function no_self_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

// Disable built-in sitemap
add_filter('wp_sitemaps_enabled', '__return_false');

// Disable Help tabs in admin
add_filter( 'contextual_help', 'mytheme_remove_help_tabs', 999, 3 );
function mytheme_remove_help_tabs($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}

// Modify heartbeat interval (in seconds)
add_filter( 'heartbeat_settings', 'modify_heartbeat_settings' );
function modify_heartbeat_settings( $settings ) {
    $settings['interval'] = 60; // 60 seconds instead of default 15
    return $settings;
}

// #09 Author archive pages
function bou_disable_author_archives() {
    if ( is_author() ) {
        wp_safe_redirect( home_url(), 301 );
        exit;
    }
}

function bou_remove_users_sitemap_provider( $providers ) {
    unset( $providers['users'] );
    return $providers;
}

add_action( 'template_redirect', 'bou_disable_author_archives', 1 );
add_filter( 'wp_sitemaps_register_providers', 'bou_remove_users_sitemap_provider' );
add_filter( 'author_link', '__return_empty_string' );
add_filter( 'the_author_posts_link', 'get_the_author', 99 );

// #11 WP logo submenu and thank you message, the function has been taken from: https://wordpress.org/plugins/remove-admin-bar-logo
function bu_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
    add_filter( 'admin_footer_text', fn () => '', 99, 0 );
}
add_action('wp_before_admin_bar_render','bu_admin_bar_remove_logo', 0 );

// Remove tags
function tax_removal() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action( 'init', 'tax_removal' );

// Disable jquery and migrate
function disable_jquery_and_migrate() {
    if ( ! is_admin() ) {
        wp_deregister_script( 'jquery-migrate' );
        wp_deregister_script( 'jquery' );
    }
}
add_action( 'wp_enqueue_scripts', 'disable_jquery_and_migrate', 100 );

// Disable Gravatar
function disable_gravatar_completely( $avatar_defaults ) {
    return array( 'blank' => 'Blank' );
}
add_filter( 'avatar_defaults', 'disable_gravatar_completely' );

add_filter( 'get_avatar_url', function( $url ) {
    return false;
});