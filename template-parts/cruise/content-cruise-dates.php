<?php
$cruise_data = $args['cruise_data'];
$itineraries =  $cruise_data['Itineraries'];
$curentYear = date("Y");
$itineraryPosts = get_field('itineraries');

$departures = [];
foreach ($itineraries as $i) {

    $matchingPost = null;
    foreach ($itineraryPosts as $ip) {
        if (get_field('itinerary_id', $ip) == $i['Id']) {
            $matchingPost = $ip;
        }
    }

    foreach ($i['Departures'] as $d) {

        $returnDate = date('Y-m-d', strtotime($d['DepartureDate'] . ' + ' . $i['LengthInNights'] . ' days'));

        $departure = [
            'Id' => $i['Id'],
            'DepartureDate' => $d['DepartureDate'],
            'ReturnDate' => $returnDate,
            'HasPromo' => $d['HasPromo'],
            'PromoName' => $d['PromoName'],
            'IsHighSeason' => $d['IsHighSeason'],
            'IsLowSeason' => $d['IsLowSeason'],

            'ItineraryPost' => $matchingPost,

            'Name' => $i['Name'],
            'LengthInNights' => $i['LengthInNights'],
            'LengthInDays' => $i['LengthInDays'],
            'LowestPrice' => $i['LowestPrice'],
        ];
        $departures[] = $departure;
    }
}


usort($departures, function ($a, $b) {
    return strtotime($a['DepartureDate']) - strtotime($b['DepartureDate']);
});

console_log($departures);

?>

<section class="slider-block narrow cruise-dates">
    <div class="slider-block__content cruise-dates__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-single">
                    Departures Dates
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">
                <div class="swiper-button-prev swiper-button-prev--white-border dates-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border dates-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>

        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <!-- Swiper -->
            <div class="swiper" id="dates-slider">
                <div class="swiper-wrapper">

                    <?php foreach ($departures as $d) :
                        $departureStartDate = strtotime($d['DepartureDate']);
                        $departureReturnDate = strtotime($d['ReturnDate']);
                        $itineraryImage = get_field('hero_image', $d['ItineraryPost']);
                        $itineraryEmbarkation = get_field('embarkation_point', $d['ItineraryPost']);
                        $itineraryDisembarkation = get_field('disembarkation_point', $d['ItineraryPost']) == null ? get_field('embarkation_point', $d['ItineraryPost']) : get_field('disembarkation_point', $d['ItineraryPost']);

                    ?>

                        <div class="departure-card swiper-slide" year="<?php echo date("Y", $departureStartDate); ?>">
                            <!-- Title Group -->
                            <div class="departure-card__title-group">
                                <div class="departure-card__title-group__avatar">
                                    <img <?php afloat_image_markup($itineraryImage['id'], 'square-small', array('square-small')); ?>>

                                </div>
                                <div class="departure-card__title-group__text">
                                    <div class="departure-card__title-group__text__title">
                                        <?php echo $d['Name']; ?>

                                    </div>
                                    <div class="departure-card__title-group__text__sub">
                                        <?php echo $d['LengthInDays'] . ' Days / ' . $d['LengthInNights'] . ' Nights'; ?>
                                    </div>
                                </div>



                            </div>

                            <!-- Specs -->
                            <div class="departure-card__specs">

                                <!-- Start -->
                                <div class="departure-card__specs__item">
                                    <div class="departure-card__specs__item__icon">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-in"></use>
                                        </svg>
                                    </div>
                                    <div class="departure-card__specs__item__text">

                                        <div class="departure-card__specs__item__text__date">
                                            <?php echo  date("F j, Y", $departureStartDate); ?>
                                        </div>
                                        <div class="departure-card__specs__item__text__location">
                                            <?php echo get_the_title($itineraryEmbarkation) ?>
                                        </div>

                                    </div>
                                </div>

                                <!-- End -->
                                <div class="departure-card__specs__item">
                                    <div class="departure-card__specs__item__icon">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-out"></use>
                                        </svg>
                                    </div>
                                    <div class="departure-card__specs__item__text">

                                        <div class="departure-card__specs__item__text__date">
                                            <?php echo  date("F j, Y", $departureReturnDate); ?>
                                        </div>
                                        <div class="departure-card__specs__item__text__location">
                                            <?php echo get_the_title($itineraryDisembarkation) ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Price Group -->
                            <div class="departure-card__price-group">
                                <div class="departure-card__price-group__amount">
                                    <?php echo "$ " . number_format($d['LowestPrice'], 0);  ?>
                                </div>
                                <div class="departure-card__price-group__text">
                                    Per Person
                                </div>
                            </div>

                            <!-- CTA -->
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
        </div>

        <!-- Filters -->
        <div class="slider-block__content__filters">

            <div class="slider-block__content__filters__left">
                <button class="btn-pill cruise-dates-departure-filter" data-filter="all">
                    Dates
                </button>
                <button class="btn-pill cruise-dates-departure-filter" data-filter="all">
                    Itineraries
                </button>
            </div>
            <div class="slider-block__content__filters__right">
                <button class="btn-pill cruise-dates-departure-filter" data-filter="all">
                    View All
                </button>

            </div>


        </div>
    </div>
</section>