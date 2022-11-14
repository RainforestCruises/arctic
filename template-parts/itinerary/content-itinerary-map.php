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
            <div class="itinerary-map__content__map-area__map" id="itinerary-map">

            </div>
        </div>
    </div>
</section>