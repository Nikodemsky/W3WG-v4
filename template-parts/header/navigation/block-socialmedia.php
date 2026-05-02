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