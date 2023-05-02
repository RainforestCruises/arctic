<?php
/*Template Name: Travel Guides - Top Level*/
wp_enqueue_script('page-guides-toplevel', get_template_directory_uri() . '/js/page-guides-toplevel.js', array('jquery'), false, true);
get_header();

$args = array('footerCtaDivider' => true);

?>

<main>

    <!-- Hero / Search -->
    <?php
    get_template_part('template-parts/guides-toplevel/content', 'guides-toplevel-hero');
    ?>

    <!-- Main Content -->
    <?php
    get_template_part('template-parts/guides-toplevel/content', 'guides-toplevel-main');
    ?>


    <!-- Footer CTA  -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
    ?>

</main>



<?php get_footer(); ?>