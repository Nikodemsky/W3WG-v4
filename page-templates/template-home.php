<?php

/* Template name: Home */

// Header
get_header();

?>

<main id="primary" class="site-main">

    <?php 
        get_template_part('template-parts/home/section', 'claim');
        get_template_part('template-parts/home/section', 'whoiam');
        get_template_part('template-parts/home/section', 'bottomnav');
    ?>

</main>

<?php
get_footer();