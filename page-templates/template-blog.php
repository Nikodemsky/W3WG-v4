<?php get_header(); 

/* Template name: Blog listing */

// ACF vars
$tax_id = get_field('tax_id');

// Globals
$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;

// Blog query
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 9,
    'paged'  => $paged,
);

if (!empty($tax_id)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'web-lang',
            'field'    => 'term_id',
            'terms'    => $tax_id,
        ),
    );
}

$loop = new WP_Query($args);

?>

	<main class="site__main <?php print_r($tax_id); ?>">
		<section id="<?php esc_html_e( 'wpisy-blogowe', 'wg-blank' ); ?>" class="blogposts">
			<div class="container">

				<?php if ( $loop->have_posts() ) : ?>

				<!-- Posts grid / Siatka wpisow -->
				<ul
				id="<?php esc_html_e( 'lista-wpisow', 'wg-blank' ); ?>" 
				class="blogposts__grid" 
				aria-label="<?php esc_html_e( 'Główna lista wpisów blogowych', 'wg-blank' ); ?>">

					<?php while ( $loop->have_posts() ) : $loop->the_post();
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
				endif; wp_reset_postdata(); ?>

			</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
