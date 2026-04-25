<?php

// Globals
$theme_dir = get_stylesheet_directory_uri();
$policy_page_id = get_option( 'wp_page_for_privacy_policy' );

?>

<div class="footer__bottom-grid footer__bottom-grid--top-border">
    <div class="row row--wrap row--justify-between">

        <span class="footer__copyright">&#169; <?php esc_html_e( 'W3WG Wojciech Górski ', 'wg-blank' ); echo date("Y"); ?></span>

        <?php if ($policy_page_id) :
            echo '<a href="'.esc_url(get_permalink($policy_page_id)).'" rel="privacy-policy" class="footer__privacy-policy">'.get_the_title($policy_page_id).'</a>';
        endif; ?>

    </div>
</div>