<?php

$destinationCount = $args['destinationCount'];

?>
<section class="itinerary-map" id="section-map">
    <div class="itinerary-map__content">

        <div class="title-group">
            <div class="title-group__title">
                Route Map
            </div>
            <div class="title-group__sub">
                There are <?php echo $destinationCount ?> main destinations visited
            </div>

        </div>

        <div class="itinerary-map__content__map-area">
            <div class="itinerary-map__content__map-area__map" id="itinerary-map"></div>
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