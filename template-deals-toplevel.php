<?php
/*Template Name: Deals - Top Level*/
wp_enqueue_script('page-deals-toplevel', get_template_directory_uri() . '/js/page-deals-toplevel.js', array('jquery'), false, true);
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);

get_header();

$args = array('footerCtaDivider' => false);


?>


<main class="deals-toplevel-page">

    <!-- Hero -->
    <?php
    get_template_part('template-parts/deals-toplevel/content', 'deals-toplevel-hero');
    ?>

    <!-- Intro -->
    <?php
    get_template_part('template-parts/deals-toplevel/content', 'deals-toplevel-intro');
    ?>

    <!-- Categories -->
    <?php
    get_template_part('template-parts/deals-toplevel/content', 'deals-toplevel-categories');
    ?>

    <!-- Topics -->
    <?php
    get_template_part('template-parts/deals-toplevel/content', 'deals-toplevel-topics');
    ?>

    <!-- Newsletter -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-newsletter');
    ?>

    <!-- Footer CTA  -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
    ?>

</main>

<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'shared-basic-inquiry-modal', $args);
?>


<?php get_footer(); ?>