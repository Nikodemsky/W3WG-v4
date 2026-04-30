<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<!--  Schema markup for posts / Zapis schema dla wpisow blogowych -->
	<?php if (is_singular('post') && function_exists('tsf')) :
		get_template_part( 'template-parts/schema/schema', 'post' );
	endif; ?>

	<!-- Schema for homepage - LocalBusiness / Zapis schema dla strony glownej - typ Localbusiness -->
	<?php if (is_front_page() && function_exists('tsf')) :
		get_template_part( 'template-parts/schema/schema', 'business' );
	endif; ?>

</head>

<body <?php
    $classes = [];

    if (isset($_COOKIE['vm-mode']) && $_COOKIE['vm-mode'] === 'light') {
        $classes[] = 'lightmode';
    }

    if (isset($_COOKIE['w3wg_a-fz']) && !wp_is_mobile()) {
        match ($_COOKIE['w3wg_a-fz']) {
            '1.25' => $classes[] = 'a-font-large',
            '1.50' => $classes[] = 'a-font-xlarge',
            default => null,
        };
    }

    body_class($classes);
?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Przejdź do zawartości', 'wg-blank' ); ?></a>

	<?php 
	
	// Blog header
	if (!is_front_page()) {
		get_template_part('template-parts/header/navigation', 'blog');
	} 
	
	// Navigation for Social media, language, visual mode and accesibility
	get_template_part('template-parts/header/navigation', 'preferences');
	
	?>