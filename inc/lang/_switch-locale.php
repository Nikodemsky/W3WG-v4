<?php

function get_current_post_iso_code() {
    $terms = get_the_terms( get_the_ID(), 'web-lang' );

    if ( $terms && ! is_wp_error( $terms ) ) {
        $iso_code = get_term_meta( $terms[0]->term_id, 'iso-code', true );
        if ( $iso_code ) {
            return $iso_code;
        }
    }

    return null;
}

function web_lang_resolve_locale( int $queried_id ): ?string {

    // ── Term archive (category, tag, custom taxonomy) ──────────────────────────
    if ( is_tax() || is_category() || is_tag() ) {
        $term = get_queried_object();

        if ( $term instanceof WP_Term ) {
            $tl_id = get_field( 'cat_tl_id_pl', 'term_' . $term->term_id );

            // Translation ID present → English content
            if ( ! empty( $tl_id ) ) {
                return 'en_US';
            }

            // No translation ID → Polish content
            return 'pl_PL';
        }

        return null;
    }

    // ── Post / Page ────────────────────────────────────────────────────────────
    $terms = get_the_terms( $queried_id, 'web-lang' );

    if ( $terms && ! is_wp_error( $terms ) ) {
        $iso_code = get_term_meta( $terms[0]->term_id, 'iso-code', true );
        if ( $iso_code ) {
            return $iso_code;
        }
    }

    return null;
}

add_action( 'wp', function() {

    if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
        return;
    }

    $queried_id = get_queried_object_id();

    if ( ! $queried_id && ! is_tax() && ! is_category() && ! is_tag() ) {
        return;
    }

    $resolved = web_lang_resolve_locale( $queried_id );

    if ( $resolved ) {
        switch_to_locale( $resolved );
    }
} );