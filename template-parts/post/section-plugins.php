<?php

if (function_exists('get_field')) { // check for ACF plugin

// ACF vars
$plugins_list = get_field('plugins_list');
$plugins_outro = get_field('plugins_txt_summary');
$table_of_contents_check = get_field('toc_check');

}

?>

<section id="<?php esc_html_e( 'wtyczki', 'wg-blank' ); ?>" class="plugins-wrapper">
    <div class="container">
        <article>

            <?php if ($table_of_contents_check && $plugins_list) :
                get_template_part(
                    'template-parts/post/block',
                    'toc',
                    array(
                        'post_id' => get_the_ID(), // required
                        'wrapper_class' => 'plugins-wrapper',
                        'list_field_id' => 'plugins_list',
                        'title_subfield_id' => 'sp_title',
                    )
                );
            endif; ?>

            <?php if ($plugins_list) : ?>
            <ul id="<?php esc_html_e( 'lista-wtyczek', 'wg-blank' ); ?>" class="plugins-list plugins-list--no-styling list-reset">

                <?php foreach ($plugins_list as $plugin) :

                // vars
                $title = $plugin['sp_title'];
                $url = $plugin['sp_url'];
                $img_id = $plugin['sp_img'];
                $desc = $plugin['sp_desc'];
                $extension = $plugin['sp_extension_check'];

                $img_output = wp_get_attachment_image( $img_id, 'plugin-image', false, ['class'=>'plugins-list__img'] );
                $sanitized_title = sanitize_title($title);

                ?>

                <li id="<?php echo $sanitized_title; ?>" class="plugins-list__single">

                    <?php if ($img_id) : echo '<picture>'.$img_output.'</picture>'; endif; ?>
                    <h3 class="plugins-list__title"><a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer external"><?php echo esc_html($title); ?></a></h3>
                    <?php
                        if ($extension) : echo '<small>'.esc_html(__('* Rozszerzenie wtyczki','wg-blank')).'</small>'; endif;
                        if ($desc) : echo '<div class="plugins-list__description">'.$desc.'</div>'; endif; 
                    ?>

                </li>

                <?php endforeach; ?>

            </ul>
            <?php endif; ?>

            <?php if ($plugins_outro) :
                echo '<div class="plugins-wrapper__outro">'.$plugins_outro.'</div>';
            endif; ?>

        </article>
    </div>
</section>