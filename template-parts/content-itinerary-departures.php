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
                $departureStartDate = strtotime($d['DepartureDate']);
            ?>

                <div class="departure-card">
                    <div class="departure-card__content">
                        <div class="departure-card__content__date-group">
                            
                            <div class="departure-card__content__date-group__date">
                                <?php echo  date("F j", $departureStartDate); ?>
                            </div>
                            <div class="departure-card__content__date-group__year">
                                <?php echo date("Y", $departureStartDate); ?>
                            </div>
                        </div>
                        <div class="departure-card__content__price-group">
                            <div class="departure-card__content__price-group__price">
                                <?php echo "$ " . number_format($d['LowestPrice'], 0);  ?> 
                            </div>
                            <div class="departure-card__content__price-group__details">
                                Per Person
                            </div>

                        </div>
                    </div>
                    <div class="departure-card__cta">
                        <button class="cta-square-icon">
                            Inquire
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </button>
                    </div>

                </div>

            <?php endforeach; ?>
        </div>

    </div>
</section>