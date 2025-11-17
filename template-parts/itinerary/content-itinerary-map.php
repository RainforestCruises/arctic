<?php

$destinationCount = $args['destinationCount'];
$show_itinerary_note = get_field('show_itinerary_note');
$itinerary_note = get_field('itinerary_note');

?>
<section class="itinerary-map" id="map">
    
    <div class="itinerary-map__content">
        <div class="title-group">
            <h2 class="title-group__title">
                Route Map
            </h2>
            <div class="title-group__sub">
                There are <?php echo $destinationCount ?> main destinations visited
            </div>
        </div>

        <div class="itinerary-map__content__map-area">

            <!-- Map -->
            <div class="full-component" id="itinerary-map"></div>

            <!-- Map Legend -->
            <div class="map-legend">
                <!-- Item 1 -->
                <div class="map-legend__item">
                    <div class="map-legend__item__marker-area">
                        <span class="map-legend__item__marker-area__mark--fly"></span>
                    </div>
                    <div class="map-legend__item__text">
                        Fly
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="map-legend__item">
                    <div class="map-legend__item__marker-area">
                        <span class="map-legend__item__marker-area__mark--cruise"></span>
                    </div>
                    <div class="map-legend__item__text">
                        Cruise
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php if ($show_itinerary_note) : ?>
    <div class="itinerary-note">
        <div class="itinerary-note__content">
            <div class="special-note">
                <?php echo $itinerary_note; ?>

            </div>
        </div>
    </div>
<?php endif; ?>