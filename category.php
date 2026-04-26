<?php get_header(); ?>

	<main class="site__main">
		<section id="<?php esc_html_e( 'wpisy-blogowe', 'wg-blank' ); ?>" class="blogposts">
			<div class="container">

				<?php if ( have_posts() ) : ?>

				<!-- Posts grid / Siatka wpisow -->
				<ul
				id="<?php esc_html_e( 'lista-wpisow', 'wg-blank' ); ?>" 
				class="blogposts__grid" 
				aria-label="<?php esc_html_e( 'Główna lista wpisów blogowych', 'wg-blank' ); ?>">

					<?php while ( have_posts() ) : the_post();
						get_template_part('template-parts/blog/block', 'blogpost');
					endwhile; ?>

				</ul>
				
				<!-- Pagination / Paginacja -->
				<?php
				the_posts_pagination( array(
					'mid_size'  => 2,
					'type' => 'list',
					'prev_text' => __( 'Poprzednia', 'wg-blank' ),
					'next_text' => __( 'Następna', 'wg-blank' ),
				));
				?>

				<?php else :
					echo '<h3 class="blogposts__no-posts">'.esc_html(__('Nie znaleziono żadnych wpisów blogowych.','wg-blank')).'</h3>';
				endif; ?>

			</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
