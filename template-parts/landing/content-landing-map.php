<?php
wp_enqueue_script('page-product-itinerary-map', get_template_directory_uri() . '/js/page-product-itinerary-map.js', array('jquery'), false, true);

$destinations = get_field('destinations');
$latitude_start_point = get_field('latitude_start_point');
$longitude_start_point = get_field('longitude_start_point');
$zoom_level_start_point = get_field('zoom_level_start_point');
$map_title_subtext = get_field('map_title_subtext');
$map_title = get_field('map_title');

$itineraryObjects[] = getItineraryObjectFromDestinations($destinations, $latitude_start_point, $longitude_start_point, $zoom_level_start_point);

wp_localize_script(
    'page-product-itinerary-map',
    'page_vars_product_itinerary_map',
    array(
        'itineraryObjects' =>  $itineraryObjects,
    )
);
?>

<!-- Itinerary Map (landing page variant) -->
<section class="itinerary-map landing-variant" id="section-map">
    <div class="itinerary-map__content block-top-divider">

        <!-- Title -->
        <div class="title-group">
            <h2 class="title-group__title">
                <?php echo $map_title ?>
            </h2>
            <div class="title-group__sub">
                <?php echo $map_title_subtext ?>
            </div>
        </div>

        <!-- Map -->
        <div class="itinerary-map__content__map-area">
            <div class="full-component" id="itinerary-map"></div>
        </div>

    </div>
</section>