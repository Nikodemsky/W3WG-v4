<?php

// Custom scripts
function loadk_scripts() {

    // Globals
    $theme_dir = get_stylesheet_directory_uri();
    $q_id = get_queried_object_id();

    // Inits and imports
    wp_enqueue_script( 'main', $theme_dir.'/assets/js/main.min.js', array(), '1.0', array('strategy' =>'defer','in-footer'=>true));

    // Smoothscroll - only as fallback/alternative to browser's native scroll-behaviour:smooth
    //wp_enqueue_script( 'scroll-to-id', $theme_dir . '/assets/js/scrolltoid.js', array(), '', true );
    /* use as: onclick="smoothScrollToId('your-section-id', 500, 30); return false;" on <a> elements;
    first parameter is ID, second is duration and third is offset */

    // Splide - Home
    /*if (is_home()) {
        wp_enqueue_script( 'splide-js', $theme_dir . '/assets/splide/splide.min.js', array(), '', false );
        wp_enqueue_style( 'splide-css', $theme_dir . '/assets/splide/splide.min.css' );
        wp_enqueue_style( 'splide-theme-css', $theme_dir . '/assets/splide/splide-default.min.css' );
        wp_enqueue_script( 'splide-tm', $theme_dir . '/assets/js/splide-home.js', array(), '', true );
    }*/

    // Prism JS
    if (is_singular('post') && get_field('prismjs_check', $q_id)) {
        wp_enqueue_script( 'prism', $theme_dir . '/assets/js/libs/prism.js', array(), '1.30.0', array('strategy' =>'defer','in-footer'=>true));
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