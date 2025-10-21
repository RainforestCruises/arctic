<?php
/*Template Name: Bio*/
wp_enqueue_script('page-bio', get_template_directory_uri() . '/js/page-bio.js', array('jquery'), false, true);

get_header();

$hide_reviews = get_field('hide_reviews')
?>

<main class="main-content">

    <!-- Hero -->
    <?php get_template_part('template-parts/bio/content', 'bio-hero'); ?>

    <!-- Introduction -->
    <?php get_template_part('template-parts/bio/content', 'bio-introduction'); ?>

    <!-- Destination -->
    <?php get_template_part('template-parts/bio/content', 'bio-destination'); ?>

    <!-- Tips -->
    <?php get_template_part('template-parts/bio/content', 'bio-cruise-picks'); ?>


    <!-- Destination -->
    <?php get_template_part('template-parts/bio/content', 'bio-destination-part2'); ?>


    <?php if(!$hide_reviews) : get_template_part('template-parts/bio/content', 'bio-reviews-embed'); endif?>

    <!-- Articles -->
    <?php get_template_part('template-parts/bio/content', 'bio-schedule'); ?>
</main>



<?php get_footer(); ?>