<nav id="<?php esc_html_e( 'preferencje', 'wg-blank' ); ?>" class="preferences-navi">

    <?php
        get_template_part('template-parts/header/navigation/block', 'socialmedia'); // Social media
        get_template_part('template-parts/header/navigation/block', 'langswitch'); // Language switcher
        get_template_part('template-parts/header/navigation/block', 'visualmode'); // Visual mode - dark & light
        get_template_part('template-parts/header/navigation/block', 'cookiesettings'); // Settings for cookie handling
        get_template_part('template-parts/header/navigation/block', 'fontsettings'); // Global font size setting for accessibility
    ?>

</nav>