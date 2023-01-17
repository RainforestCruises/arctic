<?php
/*Template Name: Home*/

wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home.js', array('jquery'), false, true);
wp_enqueue_script('page-product-cruise-itineraries', get_template_directory_uri() . '/js/page-product-cruise-itineraries.js', array('jquery'), false, true);


$routes = get_field('routes');
//Itinerary JS Array
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


get_header();


?>


<main class="home-page">

    <!-- Hero -->
    <?php
    get_template_part('template-parts/home/content', 'home-hero');
    ?>

    <!-- Cruises  -->
    <?php
    get_template_part('template-parts/home/content', 'home-cruises');
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

    <!-- Newsletter  -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-newsletter');
    ?>

</main>





<?php get_footer(); ?>