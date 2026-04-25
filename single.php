<?php get_header(); ?>

<main id="primary" class="site__main">

	<?php

	// Intro
	get_template_part('template-parts/post/section', 'default');
	
	// Plugins list
	if (has_term(3, 'typ-wpisu')) {
		get_template_part('template-parts/post/section', 'plugins');
	}

	// Standard list
	if (has_term(4, 'typ-wpisu')) {
		get_template_part('template-parts/post/section', 'list');
	}

	?>

</main><!-- #main -->

<?php
get_footer();