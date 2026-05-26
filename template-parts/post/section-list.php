<?php

if (function_exists('get_field')) { // check for ACF plugin

// ACF vars
$list = get_field('slist');
$outro = get_field('slist_outro_txt');
$table_of_contents_check = get_field('toc_check');

}

?>

<section id="<?php esc_html_e( 'sekcja-listy', 'wg-blank' ); ?>" class="dlist-wrapper">
    <div class="container">
        <article>

            <?php if ($table_of_contents_check && $list) :
                get_template_part(
                    'template-parts/post/block',
                    'toc',
                    array(
                        'post_id' => get_the_ID(), // required
                        'wrapper_class' => 'dlist-wrapper',
                        'list_field_id' => 'slist',
                        'title_subfield_id' => 'slist_single_title',
                    )
                );
            endif; ?>

            <?php if ($list) : ?>
            <ul id="<?php esc_html_e( 'lista', 'wg-blank' ); ?>" class="dlist dlist--no-styling list-reset">

                <?php foreach ($list as $entry) :

                // vars
                $title = $entry['slist_single_title'];
                $url = $entry['slist_single_url'];
                $img_id = $entry['slist_single_img_id'];
                $desc = $entry['slist_single_desc'];

                $img_output = wp_get_attachment_image( $img_id, 'full-image', false, ['class'=>'dlist__img'] );
                $sanitized_title = sanitize_title($title);

                ?>

                <li id="<?php echo $sanitized_title; ?>" class="dlist__single">

                    <h3 class="dlist__title"><a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer external"><?php echo esc_html($title); ?></a></h3>
                    <?php if ($img_id) : echo '<picture>'.$img_output.'</picture>'; endif; ?>
                    <?php if ($desc) : echo '<div class="dlist__description">'.$desc.'</div>'; endif; ?>

                </li>

                <?php endforeach; ?>

            </ul>
            <?php endif; ?>

            <?php if ($outro) :
                echo '<div class="dlist-wrapper__outro">'.$outro.'</div>';
            endif; ?>

        </article>
    </div>
</section>