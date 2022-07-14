<?php

$currentPost = get_post($args['productId']); //needed because AJAX loading
$cruise_data = get_field('cruise_data', $currentPost);


$currentYear = date("Y");
$currentMonth = date("m");


$timePhrase = "";




$startDate = strtotime($args['selectedYear'] . '-' . $args['selectedMonth']);
$endDate = strtotime(($args['selectedYear'] . '-' . $args['selectedMonth']) . " +1 month");
$timePhrase = " in " . date('F Y', $startDate);


//filter itineraries if selection
$itineraries = $cruise_data['Itineraries'];
$selectedItinerary;


//Need ID of selected itinerary, will always be one itinerary loop not needed...
foreach ($itineraries as $itinerary) {
    if ($itinerary['Id'] == $args['selectedItinerary']) {
        $selectedItinerary = $itinerary;
    }
}


console_log($selectedItinerary);
$departures = $selectedItinerary['Departures'];
$filteredDepartures = [];

$hasPromo = false;
foreach ($departures as $departure) {
    $dateString = strtotime($departure['DepartureDate']);
    if ($dateString >= $startDate && $dateString <= $endDate) {
        $filteredDepartures[] = $departure;
        if ($departure['HasPromo'] == true) {
            $hasPromo = true;
        }
    }
}



?>

<div class="side-info-panel__departure-grid__grid">
    <div class="side-info-panel__departure-grid__grid__heading-title">
        Date
    </div>
    <div class="side-info-panel__departure-grid__grid__heading-title">
        Season
    </div>

    <div class="side-info-panel__departure-grid__grid__heading-title">
        Prices
    </div>
    <div class="side-info-panel__departure-grid__grid__heading-title">
    </div>
    <?php foreach ($filteredDepartures as $result) :

        $nights = $selectedItinerary['LengthInNights'];

        $departureStartDate = strtotime($result['DepartureDate']);

        $departureEndDate = strtotime($result['DepartureDate'] . " +" . $nights . " days");

    ?>

        <div class="side-info-panel__departure-grid__grid__date" data-no-translation>
            <div>
                <?php echo date("M j", $departureStartDate); ?> &mdash; &nbsp;
            </div>
            <div>
                <?php echo date("M j", $departureEndDate); ?>
            </div>


        </div>
        <div class="side-info-panel__departure-grid__grid__season">
            <div>
                <?php
                if ($result['IsHighSeason'] == true) { //SEASON
                    echo 'High';
                } else if ($result['IsLowSeason'] == true) {
                    echo 'Low';
                } else {
                    echo 'Regular';
                }
                ?>
            </div>
            <?php if ($result['HasPromo'] == true) : ?>
                <div class="promo-div">Deal
                    <span class="tooltiptext"><?php echo $result['PromoName']; ?></span>
                </div>

            <?php endif; ?>

        </div>

        <div class="side-info-panel__departure-grid__grid__price-range">
            <div>
                <?php echo "$ " . number_format($result['LowestPrice'], 0);  ?> &mdash; &nbsp;
            </div>
            <div>
                <?php echo " " . "$ " . number_format($result['HighestPrice'], 0);  ?>
            </div>

        </div>
        <div class="side-info-panel__departure-grid__grid__cta">
            <button class="btn-cta-round btn-cta-round--xsmall departure-cta-button" itineraryNights="<?php echo $selectedItinerary['LengthInNights'] ?>" departureDate="<?php echo $result['DepartureDate'] ?>">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
                </svg>
            </button>
        </div>
    <?php endforeach; ?>
</div>
<div class="side-info-panel__departure-grid__note">
    Prices are listed as per person in double occupancy
</div>
<?php if ($hasPromo) : ?>
    <div class="side-info-panel__departure-grid__note">
        Contact us for details
    </div>

<?php endif; ?>