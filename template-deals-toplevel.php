<?php
/*Template Name: Deals - Top Level*/
wp_enqueue_script('page-deals-toplevel', get_template_directory_uri() . '/js/page-deals-toplevel.js', array('jquery'), false, true);
get_header();


?>


<main class="deals-toplevel-page">

    <!-- Hero -->
    <?php
    get_template_part('template-parts/deals-toplevel/content', 'deals-toplevel-hero');
    ?>


    <!-- Categories -->
    <?php
    get_template_part('template-parts/deals-toplevel/content', 'deals-toplevel-categories', $args);
    ?>

    <!-- Footer CTA  -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-footer-cta');
    ?>

</main>



<?php get_footer(); ?>