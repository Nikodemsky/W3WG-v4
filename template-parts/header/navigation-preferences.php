<nav 
id="<?php esc_html_e( 'preferencje', 'wg-blank' ); ?>" 
class="preferences-navi"
aria-expanded="true">

    <button
    tabindex="-1"
    class="pref-menu-toggle"
    title="<?php esc_html_e( 'Chowanie podręcznego menu', 'wg-blank' ); ?>">
    </button>

    <?php
        get_template_part('template-parts/header/navigation/block', 'socialmedia'); // Social media
        get_template_part('template-parts/header/navigation/block', 'langswitch'); // Language switcher
        get_template_part('template-parts/header/navigation/block', 'visualmode'); // Visual mode - dark & light
        get_template_part('template-parts/header/navigation/block', 'cookiesettings'); // Settings for cookie handling
        get_template_part('template-parts/header/navigation/block', 'fontsettings'); // Global font size setting for accessibility
    ?>

</nav>