<?php

// Globals
$theme_dir = get_stylesheet_directory_uri();

?>

<div class="footer__top-grid">

    <!-- Share on / Podziel sie na -->
    <div class="footer__share-on">
        <span><?php esc_html_e( 'Podziel się na: ', 'wg-blank' ); ?></span>
        <ul aria-label="<?php esc_html_e( 'Lista serwisów, na których można się podzielić wpisem - dzielenie się dwoma kliknięciami', 'wg-blank' ); ?>">

            <?php

            // Facebook
            get_template_part( 'template-parts/footer/block', 'share',
                array( // All required
                    'label' => 'Facebook',
                    'icon' => 'fb2.svg',
                    'width' => 13,
                    'height' => 23,
                    'data-sharer' => 'facebook'
                )
            );

            // Linkedin
            get_template_part( 'template-parts/footer/block', 'share',
                array( // All required
                    'label' => 'Linkedin',
                    'icon' => 'lin.svg',
                    'width' => 23,
                    'height' => 23,
                    'data-sharer' => 'linkedin'
                )
            );

            // X
            get_template_part( 'template-parts/footer/block', 'share',
                array( // All required
                    'label' => 'X / Twitter',
                    'icon' => 'x.svg',
                    'width' => 22,
                    'height' => 21,
                    'data-sharer' => 'twitter'
                )
            );

            // Bluesky
            get_template_part( 'template-parts/footer/block', 'share',
                array( // All required
                    'label' => 'Bluesky',
                    'icon' => 'bluesky.svg',
                    'width' => 25,
                    'height' => 22,
                    'data-sharer' => 'bluesky'
                )
            );

            // Threads
            get_template_part( 'template-parts/footer/block', 'share',
                array( // All required
                    'label' => 'Threads',
                    'icon' => 'threads.svg',
                    'width' => 22,
                    'height' => 25,
                    'data-sharer' => 'threads'
                )
            );

            // Reddit
            get_template_part( 'template-parts/footer/block', 'share',
                array( // All required
                    'label' => 'Reddit',
                    'icon' => 'reddit.svg',
                    'width' => 25,
                    'height' => 21,
                    'data-sharer' => 'reddit'
                )
            );

            ?>

        </ul>
    </div>

    <!-- Go up / Na gore -->
    <a href="#page" class="footer__go-up" rel="nofollow" title="<?php esc_html_e( 'Szybki powrót na górę strony', 'wg-blank' ); ?><">
        <svg 
            data-src="<?php echo $theme_dir; ?>/assets/svg/go-up.svg" 
            width="30" 
            height="30" 
            aria-hidden>
        </svg>
    </a>

    <div class="footer__update-time">
        <?php if ( get_the_modified_time( 'U' ) > get_the_time( 'U' ) ) : ?>
            <span><?php esc_html_e( 'Aktualizacja: ', 'wg-blank' ); ?></span>
            <time datetime="<?php the_modified_date('Y m d'); ?>"><?php the_modified_date('j F Y'); ?></time>
        <?php else : ?>
            <span><?php esc_html_e( 'Opublikowano: ', 'wg-blank' ); ?></span>
            <time datetime="<?php echo get_the_time('Y m d'); ?>"><?php echo get_the_time('j F Y'); ?></time>
        <?php endif; ?>
    </div>

</div>