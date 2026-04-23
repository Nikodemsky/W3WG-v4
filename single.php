<?php get_header(); ?>

<main id="primary" class="site__main">

	<?php

	// Intro
	get_template_part('template-parts/post/section', 'default');
	
	// Plugins list
	if( has_term( 3, 'typ-wpisu' ) ) {
		get_template_part('template-parts/post/section', 'plugins');
	}

	?>

</main><!-- #main -->

<?php
get_footer();