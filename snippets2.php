<section class="product-departures" id="departures">
    <div class="product-departures__content">

        <div class="title-group">
            <div class="title-group__title">
                Departures
            </div>
            <div class="title-group__sub">
                There are  departures available
            </div>
        </div>
        <div class="product-departures__content__slider" id="departures-slider">
            <?php foreach ($departures as $d) :
                $departureStartDate = strtotime($d['DepartureDate']);
            ?>

                <div class="departure-card" year="<?php echo date("Y", $departureStartDate); ?>">
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

        <div class="product-departures__content__filters">
            <button class="btn-pill departure-filter active" data-filter="all">
                All
            </button>
            <?php for ($i = 0; $i < 3; $i++) :

                $yearToCheck = $curentYear + $i;
                if(checkDeparturesInYear($yearToCheck, $departures)) :
            ?>
                <button class="btn-pill btn-pill--grey departure-filter" data-filter="<?php echo $curentYear + $i ?>">
                    <?php echo $curentYear + $i ?>
                </button>
            <?php endif; endfor; ?>


        </div>
    </div>
</section>

<?php
function checkDeparturesInYear($year, $departureList)
{
    $match = false;
    foreach ($departureList as $d) {
        if (str_contains($d['DepartureDate'], strval($year))) {
            $match = true;
        }
    }
    return $match;
}

?>