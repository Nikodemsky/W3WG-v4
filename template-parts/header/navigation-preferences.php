<nav id="<?php esc_html_e( 'preferencje', 'wg-blank' ); ?>" class="preferences-navi">

    <?php
        get_template_part('template-parts/header/navigation/block', 'socialmedia');
        get_template_part('template-parts/header/navigation/block', 'langswitch');
        get_template_part('template-parts/header/navigation/block', 'visualmode');
        get_template_part('template-parts/header/navigation/block', 'cookiesettings');
        get_template_part('template-parts/header/navigation/block', 'fontsettings');
    ?>

</nav>