<?php

// Globals
$theme_dir = get_stylesheet_directory_uri();

// vars
$label = $args['label'];
$icon = $args['icon'];
$width = $args['width'];
$height = $args['height'];
$sharer_id = $args['data-sharer'];

?>

<li>
    <button 
    <?php 
        if ($label) : echo 'aria-label="'.esc_html(__($label,'wg-blank')).'"'; endif;
        if ($sharer_id) : 
            echo 'data-sharer="'.$sharer_id.'"';
            echo 'data-url="'.esc_url(get_the_permalink()).'"';
        endif;
    ?>>
        <svg 
            data-src="<?php echo $theme_dir; ?>/assets/svg/share/<?php echo $icon; ?>" 
            width="<?php echo $width; ?>" 
            height="<?php echo $height; ?>" 
            aria-hidden>
        </svg>
    </button>
</li>