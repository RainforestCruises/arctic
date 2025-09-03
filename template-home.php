<?php
/*Template Name: Home*/

wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home.js', array('jquery'), false, true);
wp_enqueue_script('page-product-cruise-itineraries', get_template_directory_uri() . '/js/page-product-cruise-itineraries.js', array('jquery'), false, true);

get_header();

$routes = get_field('routes');
$use_development_sections = get_field('use_development_sections', 'options');

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
    $use_development_sections ? get_template_part('template-parts/home/content', 'home-hero-regional') : get_template_part('template-parts/home/content', 'home-hero');
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

    <!-- Cruises  -->
    <?php
    get_template_part('template-parts/home/content', 'home-ships');
    ?>

    <!-- Reviews  -->
    <?php
    if ($show_reviews) :
        get_template_part('template-parts/home/content', 'home-reviews');
    endif;
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