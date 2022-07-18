<?php
$cruise_data = $args['cruise_data'];
$itineraries =  $cruise_data['Itineraries'];
$curentYear = date("Y");

$departures = [];
foreach($itineraries as $i){
    foreach($i['Departures'] as $d){

        $departure = [
            'DepartureDate' => $d['DepartureDate'],
            'HasPromo' => $d['HasPromo'],
            'PromoName' => $d['PromoName'],
            'IsHighSeason' => $d['IsHighSeason'],
            'IsLowSeason' => $d['IsLowSeason'],
            'Id' => $i['Id'],
            'Name' => $i['Name'],
            'LengthInNights' => $i['LengthInNights'],
            'LengthInDays' => $i['LengthInDays'],
            'LowestPrice' => $i['LowestPrice'],

        ];
        $departures[] = $departure;
    }
}


usort($departures, function($a, $b) {
    return strtotime($a['DepartureDate']) - strtotime($b['DepartureDate']);
});

console_log($departures);

?>
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

                            <div class="departure-card__content__date-group__year">
                                <?php echo date("Y", $departureStartDate); ?>
                            </div>
                            <div class="departure-card__content__date-group__date">
                                <?php echo  date("F j", $departureStartDate); ?>
                            </div>
                            <div class="departure-card__content__date-group__length">
                                <?php echo $d['LengthInDays'] . ' Days / ' . $d['LengthInNights'] . ' Nights'; ?>
                            </div>
                            <div class="departure-card__content__date-group__name">
                                <?php echo $d['Name'] ?>
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


