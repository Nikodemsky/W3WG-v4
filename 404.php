<?php get_header(); ?>

<main id="primary" class="site__main">

	<section class="default-page-wrapper default-page-wrapper--marginoff">
		<div class="container">

			<!-- Matrix script is not mine! / Nie moj kod matrixa! Codepen: https://codepen.io/yaclive/pen/EayLYO -->
			<canvas id="matrix-light" class="matrix matrix--light"></canvas>
			<canvas id="matrix-dark" class="matrix matrix--dark"></canvas>

			<aside class="error-wrap">
				<h1 class="error-wrap__title"><?php esc_html_e( 'Błąd 404: Nie znaleziono', 'wg-blank' ); ?></h1>
				<div class="error-wrap__addon">
					<p><?php esc_html_e( 'Strona, której szukasz została usunięta, przeniesiono ją lub jest tymczasowo niedostępna.', 'wg-blank' ); ?></p>
				</div>
				<a href="https://w3wg.com" rel="nofollow" class="simple-btn simple-btn--bigger-font simple-btn--transparent-bg" title="<?php esc_html_e( 'Powrót do bloga', 'wg-blank' ); ?>"><?php esc_html_e('Wróć do strony głównej','w3wg3'); ?></a>
			</aside>

		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();