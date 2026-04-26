<nav id="<?php esc_html_e( 'preferencje', 'wg-blank' ); ?>" class="preferences-navi">

    <!-- Social media -->
    <ul 
    id="social-media-nav" 
    class="preferences-navi__social-media preferences-navi__social-media--margin-plus" 
    aria-label="<?php esc_html_e( 'Lista profilów Social Media', 'wg-blank' ); ?>">

        <?php

        $priv_sm = [
            ['smh_url' => 'https://github.com/Nikodemsky','smh_title' => 'Przekierowanie do profilu Github','smh_icon' => 'smhref-github.svg',],
            ['smh_url' => 'https://www.linkedin.com/in/wg-w3wg/','smh_title' => 'Przekierowanie do profilu Linkedin','smh_icon' => 'smhref-linkedin.svg',],
        ];

        foreach ($priv_sm as $sm) {
            get_template_part('template-parts/header/block', 'sm-href', $sm);
        }

        ?>

    </ul>

    <!-- Language switch / Przelacznik jezykowy -->
    <?php if ( class_exists( 'Sublanguage_site' ) ) {
        do_action('sublanguage_print_language_switch');
    } ?>

    <!-- Visual mode switch / Przelacznik trybu wizualnego -->
    <ul 
    id="visual-nav" 
    class="preferences-navi__visual" 
    aria-label="<?php esc_html_e( 'Przełącznik trybu wizualnego - lista dostepnych trybów', 'wg-blank' ); ?>">
        <li class="vm-light" data-current-visual-mode="0"><button><?php esc_html_e( 'Jasny', 'wg-blank' ); ?></button></li>
        <li class="vm-dark" data-current-visual-mode="1"><button><?php esc_html_e( 'Ciemny', 'wg-blank' ); ?></button></li>
    </ul>

    <!-- Accesibility - font size / Przelacznik wielkosci fonta -->
    <ul 
    id="font-nav" 
    class="preferences-navi__font">
        <li data-current-font-size="1.0"><button id="site-font-resize" aria-label="<?php esc_html_e( 'Powiększanie wielkości fonta na witrynie - opcje 125%, 150% oraz 200%.', 'wg-blank' ); ?>">A&#43; <span class="scale" tabindex="-1">100</span></button></li>
    </ul>

</nav>