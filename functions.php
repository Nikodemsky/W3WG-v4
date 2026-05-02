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
require get_template_directory() . '/inc/lang-handling.php'; // Languages handling - no plugins

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