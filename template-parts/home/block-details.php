<?php

// vars
$name = $args['details_name'];
$title = $args['details_title']; // required
$content = $args['details_content']; // required
$offset = $args['details_mhoffset'];

?>

<details 
  <?php 
    if ($name) {echo 'name="'.$name.'"';}
    if ($offset) {echo 'data-attribute-maxhoffset="'.$offset.'"';}
  ?>
>

  <summary><?php echo $title; ?></summary>
  <div class="details-content"><?php echo $content; ?></div>

</details>