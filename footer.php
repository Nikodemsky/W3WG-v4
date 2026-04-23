<footer class="footer <?php if (!is_front_page()) : echo 'footer--on-blog'; endif; ?>">
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
