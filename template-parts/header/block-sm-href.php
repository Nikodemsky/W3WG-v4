<?php

// Globals
$theme_dir = get_stylesheet_directory_uri();

// vars
$url = $args['smh_url']; // required
$title = $args['smh_title'];
$icon = $args['smh_icon']; // required

?>

<li>
    <a 
    href="<?php echo esc_url($url); ?>" 
    rel="me" 
    target="_blank"
    <?php if ($title) : echo 'title="'.esc_html(__($title,'wg-blank')).'"'; endif; ?>
    >
        <svg data-src="<?php echo $theme_dir; ?>/assets/svg/<?php echo $icon; ?>" width="20" height="20" aria-hidden></svg>
    </a>
</li>