<?php
/*Template Name: Bio*/
wp_enqueue_script('page-bio', get_template_directory_uri() . '/js/page-bio.js', array('jquery'), false, true);

get_header();

?>

<main class="main-content">

    <!-- Hero -->
    <?php get_template_part('template-parts/bio/content', 'bio-hero'); ?>

    <!-- Introduction -->
    <?php get_template_part('template-parts/bio/content', 'bio-introduction'); ?>

    <!-- Destination -->
    <?php get_template_part('template-parts/bio/content', 'bio-destination'); ?>

    <!-- Reviews -->
    <?php get_template_part('template-parts/bio/content', 'bio-reviews'); ?>

    <!-- Destination -->
    <?php get_template_part('template-parts/bio/content', 'bio-destination-part2'); ?>

    <!-- Tips -->
    <?php get_template_part('template-parts/bio/content', 'bio-tips'); ?>

    <!-- Articles -->
    <?php get_template_part('template-parts/bio/content', 'bio-articles'); ?>
</main>



<?php get_footer(); ?>