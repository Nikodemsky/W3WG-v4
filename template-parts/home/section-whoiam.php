<?php 

// ACF vars
$projects_header = get_field_escaped('home_projects_header');
$projects_list = get_field('home_projects');
$whoiam = get_field('home_whoiam_txt');
$hobby = get_field('home_hobby_txt');
$addon_infos = get_field('home_addon_infos');

?>

<!-- About me, hobby and projects / O mnie, hobby oraz projekty -->
<?php if ($projects_list || $whoiam || $hobby) : ?>
<section id="<?php esc_html_e( 'wiecej-informacji', 'wg-blank' ); ?>" class="whoiam">

    <div class="container container--mid container--xxl-padded">
        <div class="row row--wrap row--dir-reverse row--justify-between row--align-middle">

            <?php if ($whoiam || $hobby) : ?>
            <div class="whoiam__col-half whoiam__col-text <?php if (!$projects_list) : echo 'whoiam__col-half--no-padding'; endif; ?>">

                <?php

                    if ($whoiam) : echo '<article class="whoiam__aboutme">'.$whoiam.'</article>'; endif;

                    if ($addon_infos) :
                        foreach ($addon_infos as $info) :
                            get_template_part(
                                'template-parts/home/block',
                                'details',
                                array(
                                    'details_name' => $info['addoninfo_single_name'],
                                    'details_title' => $info['addoninfo_single_title'], // required
                                    'details_content' => $info['addoninfo_single_content'], // required
                                    'details_mhoffset' => '-75',
                                )
                            );
                        endforeach;
                    endif;
                    
                ?>

            </div>
            <?php endif; ?>

            <?php if ($projects_list) : ?>
            <div class="whoiam__col-half whoiam__col-projects <?php if (!$whoiam && !$hobby) : echo 'whoiam__col-half--no-padding'; endif; ?>">
                <?php if ($projects_header) : echo '<h3 class="whoiam__projects-header">'.$projects_header.'</h3>'; endif; ?>
                <ul class="whoiam__projects-list">
                    <?php foreach ($projects_list as $post) : setup_postdata($post);

                    // vars
                    $p_title = get_the_title();
                    $p_desc = get_field('singleproject_desc');
                    $p_url_txt = get_field_escaped('singleproject_redirect_name');
                    $p_url = get_field_escaped('singleproject_redirect_url');

                    // Output
                    if ($p_url_txt && $p_url) : 
                        $p_url_output = '<a href="'.$p_url.'" target="_blank" rel="nofollow" title="'.esc_html(__('Przekierowanie na do zewnętrznej witryny www','wg-blank')).'">'.$p_url_txt.'</a>'; 
                    endif;

                    if ($p_desc) : 
                        $p_desc_output = '<aside class="project__description">'.$p_desc.'</aside>'; 
                    endif;

                    $p_combined_output = ($p_desc_output ?? '') . ($p_url_output ?? '');

                    if (!$p_combined_output) :
                        unset($p_combined_output);
                    endif;

                    ?>

                    <li>
                        <?php
                        get_template_part(
                            'template-parts/home/block',
                            'details',
                            array(
                                'details_title' => $p_title, // required
                                'details_content' => $p_combined_output, // required
                                'details_mhoffset' => '-25',
                            )
                        );
                        ?>
                    </li>

                    <?php endforeach; wp_reset_postdata(); ?>
                </ul>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <a href="#<?php esc_html_e( 'kontakt-lub-blog', 'wg-blank' ); ?>" class="simple-btn" rel="nofollow" title="<?php esc_html_e( 'Przekierowanie do nawigacji', 'wg-blank' ); ?>"><?php esc_html_e( 'Co dalej?', 'wg-blank' ); ?></a>

</section>
<?php endif; ?>