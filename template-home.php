<?php
/*Template Name: Home*/

wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home.js', array('jquery'), false, true);
wp_enqueue_script('page-product-cruise-itineraries', get_template_directory_uri() . '/js/page-product-cruise-itineraries.js', array('jquery'), false, true);
get_header();

$routes = get_field('routes');

$itineraryObjects = [];
foreach ($routes as $route) {
    $sample_itinerary = get_field('sample_itinerary', $route);
    $itineraryObjects[] = getItineraryObject($sample_itinerary);
}
wp_localize_script(
    'page-home',
    'page_vars',
    array(
        'itineraryObjects' =>  $itineraryObjects,
    )
);


$args = array('footerCtaDivider' => true);

?>


<main class="home-page">

    <!-- Hero -->
    <?php
    get_template_part('template-parts/home/content', 'home-hero');
    ?>

    <!-- Cruises  -->
    <?php
    get_template_part('template-parts/home/content', 'home-ships');
    ?>

    <!-- Routes  -->
    <?php
    get_template_part('template-parts/home/content', 'home-routes');
    ?>

    <!-- Itineraries  -->
    <?php
    get_template_part('template-parts/home/content', 'home-itineraries');
    ?>

    <!-- Styles  -->
    <?php
    get_template_part('template-parts/home/content', 'home-styles');
    ?>

    <!-- Quote  -->
    <?php
    get_template_part('template-parts/home/content', 'home-quote');
    ?>


    <!-- Experiences  -->
    <?php
    get_template_part('template-parts/home/content', 'home-experiences');
    ?>

    <!-- Reviews  -->
    <?php
    get_template_part('template-parts/home/content', 'home-reviews');
    ?>

    <!-- Guides  -->
    <?php
    get_template_part('template-parts/home/content', 'home-guides');
    ?>


    <!-- Footer CTA  -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
    ?>

</main>





<?php get_footer(); ?>