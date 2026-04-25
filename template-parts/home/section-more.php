<?php

## LEGACY VERSION OF SECTION

// ACF vars
$workscope_header = get_field_escaped('home_workscope_header');
$workscope_content = get_field('home_workscope_txt');
$worklocation_header = get_field_escaped('home_where_header');
$worklocation_content = get_field('home_where_txt');

?>

<!-- More info / Wiecej informacji -->
<?php if ($workscope_header && $workscope_content || $worklocation_header && $worklocation_content) : ?>
<section id="<?php esc_html_e( 'wiecej-informacji', 'wg-blank' ); ?>" class="more-info">
    <div class="container container--mid">

        <?php 
        
        // Work scope
        if ($workscope_header && $workscope_content) {
            get_template_part(
                'template-parts/home/block',
                'accordion',
                array(
                    'a_id' => 'jak-dzialam',
                    'a_type' => 'article', // required
                    'a_type_class' => 'accordion--moreinfo',
                    'a_title' => $workscope_header, // required
                    'a_content' => $workscope_content  // required
                )
            );
        }

        // Work location
        if ($worklocation_header && $worklocation_content) {
            get_template_part(
                'template-parts/home/block',
                'accordion',
                array(
                    'a_id' => 'gdzie-operuje',
                    'a_type' => 'article', // required
                    'a_type_class' => 'accordion--moreinfo',
                    'a_title' => $worklocation_header, // required
                    'a_content' => $worklocation_content  // required
                )
            );
        }
            
        ?>

    </div>
</section>
<?php endif; ?>