<?php
/*Template Name: Home*/

wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home.js', array('jquery'), false, true);
wp_enqueue_script('page-product-cruise-itineraries', get_template_directory_uri() . '/js/page-product-cruise-itineraries.js', array('jquery'), false, true);

get_header();

$use_development_sections = get_field('use_development_sections', 'options');

$regionsArgs = array(
    'post_type' => 'rfc_regions',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
);
$regions = get_posts($regionsArgs);
$selectedRegion = get_field('region');
$isMultiRegion = true;
if ($selectedRegion != null) {
    $regions = array($selectedRegion);
    $isMultiRegion = false;
}


// Get routes that match the regions
$routes = getRoutesFromRegionList($regions);

$itineraryObjects = [];
foreach ($routes as $route) {
    $sample_itinerary = get_field('sample_itinerary', $route);
    $itineraryInfoObject = createItineraryInfoObject($sample_itinerary);
    $itineraryMapObjects[] = getItineraryMapObject($itineraryInfoObject->itineraryObjects[0]);
}


wp_localize_script(
    'page-product-cruise-itineraries',
    'page_vars',
    array(
        'itineraryMapObjects' =>  $itineraryMapObjects
    )
);


$args = array(
    'footerCtaDivider' => true,
    'regions' => $regions,
    'routes' => $routes,
    'isMultiRegion' => $isMultiRegion,
);
$show_reviews = get_field('show_reviews');

?>


<main class="home-page">
    <!--  -->
    <!-- Hero -->
    <?php
    $isMultiRegion ? get_template_part('template-parts/home/content', 'home-hero-regional', $args) : get_template_part('template-parts/home/content', 'home-hero-specific', $args);
    ?>

    <!-- Routes  -->
    <?php
    get_template_part('template-parts/home/content', 'home-routes', $args);
    ?>

    <!-- Region Sections -->
    <?php
    $isMultiRegion ? get_template_part('template-parts/home/content', 'home-regions') : null;
    ?>

    <!-- Itineraries  -->
    <?php
    get_template_part('template-parts/home/content', 'home-itineraries', $args);
    ?>

    <!-- Styles  -->
    <?php
    $isMultiRegion == false ? get_template_part('template-parts/home/content', 'home-styles', $args) : null;
    ?>

    <!-- Quote  -->
    <?php
    get_template_part('template-parts/home/content', 'home-quote', $args);
    ?>

    <!-- Experiences  -->
    <?php
    get_template_part('template-parts/home/content', 'home-experiences', $args);
    ?>

    <!-- Cruises  -->
    <?php
    get_template_part('template-parts/home/content', 'home-ships', $args);
    ?>

    <!-- Reviews  -->
    <?php
    if ($show_reviews) :
        get_template_part('template-parts/home/content', 'home-reviews', $args);
    endif;
    ?>

    <!-- Guides  -->
    <?php
    get_template_part('template-parts/home/content', 'home-guides', $args);
    ?>

    <!-- Footer CTA  -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
    ?>

</main>


<?php get_footer(); ?>