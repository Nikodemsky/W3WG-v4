<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Article",
"headline": "<?php echo single_post_title(); ?>",
"description": "<?php echo the_seo_framework()->get_description(); ?>",
"image": "<?php echo get_the_post_thumbnail_url( '', 'full' ); ?>",  
"author": {
    "@type": "Organization",
    "name": " Wojciech Górski",
    "url": "https://www.linkedin.com/in/wg-w3wg/"
},  
"publisher": {
    "@type": "Organization",
    "name": "W3WG Wojciech Górski",
    "logo": {
    "@type": "ImageObject",
    "url": "https://w3wg.com/wp-content/uploads/2023/11/w3wgfav2.png"
    }
},
"datePublished": "<?php echo get_the_date('d.m.Y'); ?>",
"dateModified": "<?php echo the_modified_date('d.m.Y'); ?>"
}
</script>
