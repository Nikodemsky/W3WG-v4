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