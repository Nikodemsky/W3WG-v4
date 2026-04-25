<header id="masthead" class="site__header">
    <div class="container">

        <!-- Logo and main menu / Logo i menu glowne -->
        <div class="row row--wrap row--justify-between row--align-middle row--bottom-line row--header-top">

            <?php the_custom_logo(); ?>

            <nav class="top-navigation">
                <?php wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu-header',
                )); ?>
            </nav><!-- #site-navigation -->

        </div>

        <!-- Categories and blog title / Lista kategorii i nazwa bloga -->
        <div class="row row--wrap row--justify-between row--align-middle row--header-bottom">

            <?php if (is_category() || is_home()) : ?>

                <ul class="categories-list" role="navigation" aria-label="<?php esc_html_e( 'Lista kategorii bloga', 'wg-blank' ); ?>">
                    <?php wp_list_categories(array('title_li' => '','order' => 'DESC', 'use_desc_for_title' => 1)); ?>	
                </ul>

                <h1 class="blog-title"><?php esc_html_e('Blog','wg-blank'); ?></h1>

            <?php elseif (is_page() && !is_page_template()) : ?>

                <h1 class="blog-title blog-title--to-right"><?php echo get_the_title(); ?></h1>

            <?php endif; ?>

        </div>

    </div>
</header><!-- #masthead -->