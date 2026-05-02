<!-- Language switch / Przelacznik jezykowy -->
<?php if (function_exists('get_field')) : 

// Globals
$q_id = get_queried_object_id();
$is_en = str_contains($_SERVER['REQUEST_URI'], '/en/');

if (is_category() || is_archive()) {

    // vars
    $en_tl_id = get_field('cat_tl_id_en', 'category_' .$q_id);
    $pl_tl_id = get_field('cat_tl_id_pl', 'category_' .$q_id);

    $cat_en = $en_tl_id ?: $q_id;
    $cat_pl = $pl_tl_id ?: $q_id;

    // URL output
    $en_url = get_term_link( $cat_en, 'category');
    $pl_url = get_term_link( $cat_pl, 'category');

} else {

    // Globals
    $current_id = get_the_ID();

    // vars
    if (is_home()) {

        $en_tl_id = get_field('tl_en', $q_id);
        $pl_tl_id = get_field('tl_pl', $q_id);

        $pp_en = $en_tl_id ?: $q_id;
        $pp_pl = $pl_tl_id ?: $q_id;

    } else if (is_single()) {

        $en_tl_id = get_field('tl_en');
        $pl_tl_id = get_field('tl_pl');

        $home_id = 364;
        $home_id_en = 742;

        [$pp_en, $pp_pl] = match(true) {
            (bool)$en_tl_id && !(bool)$pl_tl_id  => [$en_tl_id, $home_id],
            !(bool)$en_tl_id && (bool)$pl_tl_id  => [$home_id_en, $pl_tl_id],
            !(bool)$en_tl_id && !(bool)$pl_tl_id => [$is_en ? $current_id : $home_id_en, $is_en ? $home_id : $current_id],
            default => [$current_id, $current_id],
        };

    } else {

        $en_tl_id = get_field('tl_en');
        $pl_tl_id = get_field('tl_pl');

        $pp_en = $en_tl_id ?: $current_id;
        $pp_pl = $pl_tl_id ?: $current_id;

    }

    // URL output
    $en_url = get_the_permalink($pp_en);
    $pl_url = get_the_permalink($pp_pl);

}

// Set current lang visually
if ($is_en) {
    $current_check_en = 'preferences-navi__en--current';
    $aria_current_en = 'aria-current="true"';
} else {
    $current_check_pl = 'preferences-navi__pl--current';
    $aria_current_pl = 'aria-current="true"';
}

?>
<ul
id="languages-nav" 
class="preferences-navi__languages"
aria-label="<?php esc_html_e( 'Przełącznik językowy - lista dostępnych języków', 'wg-blank' ); ?>">
    <li class="preferences-navi__en <?php echo $current_check_en; ?>">
        <a
        <?php echo $aria_current_en; ?>
        hreflang="en-US"
        href="<?php echo esc_url($en_url); ?>">
            <?php esc_html_e( 'English', 'wg-blank' ); ?>
        </a>
    </li>
    <li class="preferences-navi__pl <?php echo $current_check_pl; ?>">
        <a
        <?php echo $aria_current_pl; ?>
        hreflang="pl-PL"
        href="<?php echo esc_url($pl_url); ?>">
            <?php esc_html_e( 'Polski', 'wg-blank' ); ?>
        </a>
    </li>
</ul>
<?php endif; ?>