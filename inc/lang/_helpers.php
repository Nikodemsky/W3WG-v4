<?php

// ─── Category ID arrays (cached) ──────────────────────────────────────────────

function web_lang_get_categorized_ids(): array {
    $cached = wp_cache_get( 'web_lang_categorized_ids' );

    if ( $cached !== false ) {
        return $cached;
    }

    $categories = get_categories( [
        'hide_empty' => false,
        'number'     => 0,
    ] );

    $has_pl = [];
    $has_en = [];

    foreach ( $categories as $category ) {
        $term_key = 'term_' . $category->term_id;

        if ( ! empty( get_field( 'cat_tl_id_pl', $term_key ) ) ) {
            $has_pl[] = $category->term_id;
        }

        if ( ! empty( get_field( 'cat_tl_id_en', $term_key ) ) ) {
            $has_en[] = $category->term_id;
        }
    }

    $result = [
        'has_pl' => $has_pl,
        'has_en' => $has_en,
    ];

    wp_cache_set( 'web_lang_categorized_ids', $result );

    return $result;
}

// ─── Current context language flags ───────────────────────────────────────────

function web_lang_get_current_flags(): array {
    $page_lang_en = false;
    $cat_lang_en  = false;

    if ( is_category() || is_tax() || is_tag() ) {
        $term = get_queried_object();

        if ( $term instanceof WP_Term ) {
            $cat_lang_en = ! empty( get_field( 'cat_tl_id_en', 'term_' . $term->term_id ) );
        }
    } elseif ( is_singular() ) {
        $post_id      = get_the_ID();
        $page_lang_en = ! empty( get_field( 'tl_en', $post_id ) );
    }

    return compact( 'page_lang_en', 'cat_lang_en' );
}

// ─── Extract flags into global template variables ─────────────────────────────

function web_lang_set_global_flags(): void {
    $flags = web_lang_get_current_flags();

    $GLOBALS['page_lang_en'] = $flags['page_lang_en'];
    $GLOBALS['cat_lang_en']  = $flags['cat_lang_en'];
}
add_action( 'wp', 'web_lang_set_global_flags' );

// Usage:

/* 

if ( $GLOBALS['page_lang_en'] ) { ... }
if ( $GLOBALS['cat_lang_en'] ) { ... }

$flags = web_lang_get_current_flags();
if ( $flags['page_lang_en'] ) { ... }
if ( $flags['cat_lang_en'] ) { ... } 

*/