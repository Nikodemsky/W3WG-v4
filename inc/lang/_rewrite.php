<?php

function web_lang_rewrite_rules() {

    // Built-in taxonomies — added after so they sit higher in priority
    add_rewrite_rule(
        '^en/category/(.+?)/?$',
        'index.php?category_name=$matches[1]',
        'top'
    );

    add_rewrite_rule(
        '^en/tag/(.+?)/?$',
        'index.php?tag=$matches[1]',
        'top'
    );

    // General rules — added first so they sit lower in priority
    add_rewrite_rule(
        '^en/(.+?)/?$',
        'index.php?pagename=$matches[1]',
        'top'
    );

    add_rewrite_rule(
        '^en/([^/]+)/?$',
        'index.php?name=$matches[1]',
        'top'
    );

    // Custom public taxonomies — loop through and register each one explicitly
    $taxonomies = get_taxonomies( [ 'public' => true, '_builtin' => false ], 'objects' );

    foreach ( $taxonomies as $taxonomy ) {
        $tax_slug  = ! empty( $taxonomy->rewrite['slug'] ) ? $taxonomy->rewrite['slug'] : $taxonomy->name;
        $query_var = ! empty( $taxonomy->query_var ) ? $taxonomy->query_var : $taxonomy->name;

        add_rewrite_rule(
            '^en/' . $tax_slug . '/(.+?)/?$',
            'index.php?' . $query_var . '=$matches[1]',
            'top'
        );
    }
}
add_action( 'init', 'web_lang_rewrite_rules' );

// ─── Post / Page helpers ───────────────────────────────────────────────────────

function web_lang_is_english( int $post_id ): bool {

    if ( get_field( 'no-rewrite_check', $post_id ) ) {
        return false;
    }

    $terms = get_the_terms( $post_id, 'web-lang' );

    if ( ! $terms || is_wp_error( $terms ) ) {
        return false;
    }

    return in_array( 'en', wp_list_pluck( $terms, 'slug' ), true );
}

function web_lang_page_link( string $link, int $post_id ): string {
    if ( web_lang_is_english( $post_id ) ) {
        $link = trailingslashit( home_url( '/en/' . get_page_uri( $post_id ) ) );
    }

    return $link;
}
add_filter( 'page_link', 'web_lang_page_link', 10, 2 );

function web_lang_post_link( string $link, WP_Post $post ): string {
    if ( web_lang_is_english( $post->ID ) ) {
        $link = trailingslashit( home_url( '/en/' . $post->post_name ) );
    }

    return $link;
}
add_filter( 'post_link', 'web_lang_post_link', 10, 2 );

function web_lang_post_type_link( string $link, WP_Post $post ): string {
    if ( web_lang_is_english( $post->ID ) ) {
        $link = trailingslashit( home_url( '/en/' . $post->post_name ) );
    }

    return $link;
}
add_filter( 'post_type_link', 'web_lang_post_type_link', 10, 2 );

// ─── Taxonomy term helper ──────────────────────────────────────────────────────

function web_lang_is_english_term( int $term_id ): bool {

    // Opt-out field checked → skip
    if ( get_field( 'en-slug-check', 'term_' . $term_id ) ) {
        return false;
    }

    // No translation ID set → skip
    $tl_id = get_field( 'cat_tl_id_pl', 'term_' . $term_id );

    return ! empty( $tl_id );
}

function web_lang_term_link( string $link, WP_Term $term ): string {
    if ( ! web_lang_is_english_term( $term->term_id ) ) {
        return $link;
    }

    $taxonomy_obj = get_taxonomy( $term->taxonomy );

    // Use the taxonomy's rewrite slug if available, otherwise fall back to the taxonomy name
    $tax_slug = ( $taxonomy_obj && ! empty( $taxonomy_obj->rewrite['slug'] ) )
        ? $taxonomy_obj->rewrite['slug']
        : $term->taxonomy;

    $link = trailingslashit( home_url( '/en/' . $tax_slug . '/' . $term->slug ) );

    return $link;
}
add_filter( 'term_link', 'web_lang_term_link', 10, 2 );

// Modify query per language
function web_lang_filter_query( $query ) {

    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false ) {

        $tax_query = [
            [
                'taxonomy' => 'web-lang',
                'field' => 'slug',
                'terms' => 'en',
            ]
        ];

        $query->set( 'tax_query', $tax_query );
    }
}
add_action( 'pre_get_posts', 'web_lang_filter_query' );