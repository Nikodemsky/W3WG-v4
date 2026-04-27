<?php

// Globals
$url = get_the_permalink();
$title = get_the_title();
$categories = get_the_category();

?>

<li class="post-block">
    <a 
    rel="next" 
    class="post-block__href"
    title="<?php echo esc_html($title); ?>"
    aria-label="<?php esc_html_e('Link przekierowujący do wpisu z treścią','wg-blank'); ?>"
    href="<?php echo esc_url($url); ?>">

        <div class="post-block__wrap">

            <div class="post-block__top-meta">
                <span class="post-block__title"><?php echo esc_html($title); ?></span>
                <?php if (!empty($categories)) :
                    echo '<ul class="post-block__categories" aria-label="'.esc_html(__('Lista kategorii wpisu','wg-blank')).'">';
                    foreach ($categories as $cat) :
                        echo '<li>'.$cat->name.'</li>';
                    endforeach;
                    echo '</ul>';
                endif; ?>
            </div>

            <time 
            class="post-block__pubdate" 
            datetime="<?php the_modified_date('Y m d'); ?>">
                <?php 
                    esc_html_e( 'Aktualizowano dnia: ', 'wg-blank' );
                    if (wp_is_mobile()) {echo '<br>';}
                    the_modified_date('j F Y'); 
                ?>
            </time>

        </div>

    </a>
</li>