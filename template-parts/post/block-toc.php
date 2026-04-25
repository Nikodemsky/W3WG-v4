<?php

// vars
$passed_post_id = $args['post_id'];
$wrapper_class = $args['wrapper_class'];
$list_field_id = $args['list_field_id'];
$title_subfield_id = $args['title_subfield_id'];

// ACF vars
$list = get_field($list_field_id, $passed_post_id);

?>

<details class="<?php if ($wrapper_class) {echo $wrapper_class;} ?>__toc" data-nosnippet>
    <summary><?php esc_html_e( 'Spis treści', 'wg-blank' ); ?></summary>
    <div class="details-content">
        <ol>
            <?php foreach ($list as $p) :

                // vars
                $title = $p[$title_subfield_id];
                $sanitized_title = sanitize_title($title);

                // output
                echo '<li><a href="#'.$sanitized_title.'" rel="nofollow">'.$title.'</a></li>';

            endforeach; ?>
        </ol>
    </div>
</details>