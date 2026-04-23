<?php

/*********** CORE DIRECTIVES - DO NOT MODIFY ***********/

if(!defined('_S_VERSION')){define('_S_VERSION','1.0.0');}

require get_template_directory() . '/inc/template-tags.php'; // Helpers, wp_body_open
require get_template_directory() . '/inc/customizer.php'; // Customizer support
require get_template_directory() . '/inc/theme-support.php'; // add_theme_support
require get_template_directory() . '/inc/security-hardening.php'; // Security - hardening
require get_template_directory() . '/inc/image-sizes.php'; // Image sizes handling
require get_template_directory() . '/inc/optimisations.php'; // Additional optimisations comments-handler
require get_template_directory() . '/inc/comments-handler.php'; // Disables comment system
require get_template_directory() . '/inc/custom-scripts.php'; // Custom scripts handler
// require get_template_directory() . '/inc/exists-checks.php'; // Custom, cached checks for post existence
if (function_exists('get_field')) { require get_template_directory() . '/inc/acf-sanitization.php'; } // ACF sanitization helper functions

/*********** HELPERS - LOGIN PAGE AND EDITOR ADDONS ***********/

// Custom login page 
function login_stylesheet() {
  wp_enqueue_style( 'custom-login', get_template_directory() . '/assets/login/login.css' );
}
add_action( 'login_enqueue_scripts', 'login_stylesheet' );

/*********** CUSTOM STYLING ***********/

// Template styles
function wg_styles() {

    // Globals
    $theme_dir = get_stylesheet_directory_uri();

    // Load compiled styles
    wp_register_style( 'main-css', $theme_dir . '/assets/css/main.min.css', array(), '1.00' );
    wp_enqueue_style( 'main-css' );

}
add_action( 'wp_enqueue_scripts', 'wg_styles' );

/*********** CUSTOM FUNCTIONS ***********/

// Removes categories and tags from blogposts
/*function unregister_default_categories_taxonomy() {
    unregister_taxonomy_for_object_type('category', 'post');
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'unregister_default_categories_taxonomy');*/

// Remove "no taxonomy" for radio taxonomy plugin
/*add_filter( 'radio_buttons_for_taxonomies_no_term_grupa', '__return_false' );*/

// Register custom nav menus
/*function add_nav_menus() {
    register_nav_menus( array(
        'header-helpers'=> __( 'Helper menu - header', 'wg-blank' ),
        'footer-menu'=> __( 'Footer menu', 'wg-blank' ),
    ));
}
add_action('init', 'add_nav_menus');*/

// Remove <p> and <br/> from Contact Form 7
//add_filter('wpcf7_autop_or_not', '__return_false');

// Custom Sublanguage lang switcher
add_action('sublanguage_custom_switch', 'sl_custom_switch', 10, 2);

function sl_custom_switch($languages, $sublanguage) {

?>
<ul id="languages-nav" class="preferences-navi__languages" aria-label="<?php esc_html_e( 'Przełącznik językowy - lista dostępnych języków', 'wg-blank' ); ?>">
<?php foreach ($languages as $language) { ?>
    <li class="<?php echo $language->post_name; ?> <?php if ($sublanguage->current_language->ID == $language->ID) echo 'current'; ?>">
        <a href="<?php echo $sublanguage->get_translation_link($language); ?>"><?php echo $language->post_title; ?></a>
    </li>
<?php } ?>
</ul>
<?php

}