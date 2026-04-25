<?php 

if (function_exists('get_field')) { // check for ACF plugin

// ACF vars
$claim_header_content = get_field_escaped('home_claim_txt', '', true, null);

}

?>

<!-- Intro section / Intro -->
<?php if ($claim_header_content) : ?>
<section id="<?php esc_html_e( 'sekcja-wstepu', 'wg-blank' ); ?>" class="claim">
    <div class="container container--small container--grid">
        <article class="claim__intro"><?php echo $claim_header_content; ?></article>
        <aside class="claim__learnmore">
            <a 
            href="#<?php esc_html_e( 'wiecej-informacji', 'wg-blank' ); ?>" 
            rel="nofollow" 
            class="simple-btn">
                <?php esc_html_e( 'Dowiedz się więcej', 'wg-blank' ); ?>
            </a>
        </aside>
    </div>
</section>
<?php endif; ?>