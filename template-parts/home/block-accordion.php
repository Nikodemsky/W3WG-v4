<?php

// vars
$id = $args['a_id'];
$type = $args['a_type']; // required
$type_class = $args['a_type_class'];
$header = $args['a_title']; // required
$content = $args['a_content']; // required

?>

<<?php echo $type; if ($id) {echo ' id="'.esc_html(__(''.$id.'','wg-blank')).'"';} ?> class="accordion <?php if ($type_class) {echo $type_class;} ?>">
    <div class="accordion__intro"><?php echo $header; ?></div>
    <div class="accordion__content"><?php echo $content; ?></div>
</<?php echo $type; ?>>