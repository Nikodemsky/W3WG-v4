<?php

// Alternate links handling in head section of each page

function hreflang_link(string $hreflang, string $href): string {
    return '<link rel="alternate" hreflang="' . $hreflang . '" href="' . $href . '" />' . "\n";
}

function create_alternate() {

    $home_url = get_home_url();
    $is_en = str_contains($_SERVER['REQUEST_URI'], '/en/');

    // Homepage
    if (is_page_template('page-templates/template-home.php')) {
        echo hreflang_link('pl', $home_url);
        echo hreflang_link('en', $home_url . '/en/');
        echo hreflang_link('x-default', $home_url . '/en/');
    }

    // Blog page
    if (is_home() || is_page_template('page-templates/template-blog.php')) {
        echo hreflang_link('pl', $home_url . '/blog/');
        echo hreflang_link('en', $home_url . '/en/news-and-tips/');
        echo hreflang_link('x-default', $home_url . '/blog/');
    }

    // Category
    if (is_category()) {

        $q_id = get_queried_object_id();
        $cat_url = get_category_link($q_id);

        // translation eq. via acf - id's
        $en_tl_id = get_field('cat_tl_id_en', 'category_' .$q_id);
        $pl_tl_id = get_field('cat_tl_id_pl', 'category_' .$q_id);

        echo hreflang_link(str_contains($cat_url, '/en/') ? 'en' : 'pl', $cat_url);

        if ($en_tl_id) {
            echo hreflang_link('en', get_category_link($en_tl_id));
        }

        if ($pl_tl_id) {
            echo hreflang_link('pl', get_category_link($pl_tl_id));
        }

        // X-default
        $xdefault_id = $pl_tl_id ? $pl_tl_id : $q_id;

        echo hreflang_link('x-default', get_category_link($xdefault_id));

    }

    // Blogpost
    if (is_single()) {

        $p_id = get_the_ID();
        $p_url = get_the_permalink($p_id);

        // translation eq. via acf - id's
        $en_tl = get_field('tl_en');
        $pl_tl = get_field('tl_pl');

        echo hreflang_link(str_contains($p_url, '/en/') ? 'en' : 'pl', $p_url);

        if ($en_tl) {
            echo hreflang_link('en', get_the_permalink($en_tl));
        }

        if ($pl_tl) {
            echo hreflang_link('pl', get_the_permalink($pl_tl));
        }

        // X-default - off for now, there will be no direct translations for posts for the moment

    }

}
add_action('wp_head', 'create_alternate');