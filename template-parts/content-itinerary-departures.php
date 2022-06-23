<?php
$itinerary_data = $args['itinerary_data'];

?>

<div class="itinerary-departures">

    <div class="itinerary-departures__title">
        Departures
    </div>
    <div class="itinerary-departures__slider">
        <?php
        $departures = $itinerary_data['Departures'];
        foreach ($departures as $d) :
        ?>

            <div class="itinerary-departures__slider__item">
                <?php echo $d['DepartureDate'] ?>
            </div>



        <?php endforeach; ?>
    </div>

</div>