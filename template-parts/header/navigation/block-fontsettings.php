<!-- Accesibility - font size / Przelacznik wielkosci fonta -->
<?php if (!wp_is_mobile()) : ?>
<ul 
id="font-nav" 
class="preferences-navi__font">
    <li data-current-font-size="1.0">
        <button 
        id="site-font-resize" 
        aria-label="<?php esc_html_e( 'Powiększanie wielkości fonta na witrynie - opcje 125%, 150% oraz 200%.', 'wg-blank' ); ?>">
            A&#43; <span class="scale" tabindex="-1">100</span>
        </button>
    </li>
</ul>
<?php endif; ?>