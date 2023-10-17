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
$show_reviews = get_field('show_reviews');

?>


<main class="home-page">

    <!-- Hero -->
    <?php
    get_template_part('template-parts/home/content', 'home-hero');
    ?>

   

</main>





<?php get_footer(); ?>