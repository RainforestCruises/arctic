<?php
$itinerary_data = $args['itinerary_data'];

?>
<section class="itinerary-departures" id="departures">
    <div class="itinerary-departures__content">

        <div class="title-group">
            <div class="title-group__title">
                Departures
            </div>
            <div class="title-group__sub">
                There are 24 departures available in 2022/23
            </div>

        </div>
        <div class="itinerary-departures__content__slider" id="departures-slider">
            <?php
            $departures = $itinerary_data['Departures'];
            foreach ($departures as $d) :
            ?>

                <div class="itinerary-departures__content__slider__item">
                    <?php echo $d['DepartureDate'] ?>
                </div>

            <?php endforeach; ?>
        </div>

    </div>
</section>