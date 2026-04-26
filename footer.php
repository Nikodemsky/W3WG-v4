<footer 
	class="footer 
	<?php
		echo match(true) {
			is_category(), is_home(), is_single() => 'footer--on-blog',
			is_404() => 'footer--on-error-page',
			is_page() && !is_page_template() => 'footer--on-page',
			default => ''
		};
	?>">
	<div class="container">

    <?php

	// Blog footer - top row
	if (is_single()) {
		get_template_part('template-parts/footer/row', 'top');
	}

	if (!is_front_page()) {
		get_template_part('template-parts/footer/row', 'bottom');
	}

    ?>

	</div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
