<header id="masthead" class="site__header">
    <div class="container">

        <!-- Logo and main menu / Logo i menu glowne -->
        <div class="row row--wrap row--justify-between row--align-middle row--bottom-line row--header-top">

            <?php the_custom_logo(); ?>

            <?php // checks for lang

            $q_id = get_queried_object_id();

            if (str_contains($_SERVER['REQUEST_URI'], '/en/')) {
                $menu_id = 15;
            } else {
                $menu_id = 7;
            }

            ?>

            <nav class="top-navigation">
                <?php wp_nav_menu( array(
                    //'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu-header',
                    'menu' => $menu_id,
                )); ?>
            </nav><!-- #site-navigation -->

        </div>

        <!-- Categories and blog title / Lista kategorii i nazwa bloga -->
        <div class="row row--wrap row--justify-between row--align-middle row--header-bottom row--mobile row--mobile-col-reverse row--mobile-align-start">

            <?php 
            
            // Category navigation
            if (is_category() || is_home() || is_page_template('page-templates/template-blog.php')) : ?>

                <ul 
                class="categories-list" 
                role="navigation" 
                aria-label="<?php esc_html_e( 'Lista kategorii bloga', 'wg-blank' ); ?>">
                    <?php 

                        $categorized = web_lang_get_categorized_ids();
                        $q_id = get_queried_object_id();
                        $is_en = str_contains($_SERVER['REQUEST_URI'], '/en/');

                        if ($is_en) {
                            $cats_to_exclude = $categorized['has_en'];
                        } else {
                            $cats_to_exclude = $categorized['has_pl'];
                        }

                        wp_list_categories(
                            array(
                                'title_li' => '',
                                'order' => 'DESC',
                                'exclude' => $cats_to_exclude,
                                'use_desc_for_title' => 1
                            )
                        ); 
                    ?>
                </ul>

            <?php 
            
            endif;


            // checks for title
            $noblog_check = match(true) {
                is_page() && !is_page_template() => 'blog-title--to-right',
                default => ''
            };

            $title = match(true) {
                is_page() && !is_page_template() => get_the_title(),
                is_home() => esc_html(__('Blog','wg-blank')),
                is_page_template('page-templates/template-blog.php') => esc_html(__('Blog','wg-blank')),
                is_category() => get_the_archive_title(),
                default => ''
            };

            // title output
            echo '<h1 class="blog-title '.$noblog_check.'">'.$title.'</h1>';

            // category description
            $cat_desc = get_the_archive_description();
            
            if (!empty($cat_desc)) : echo '<div class="site__cat-desc">'.$cat_desc.'</div>'; endif;

            ?>

        </div>

    </div>
</header><!-- #masthead -->