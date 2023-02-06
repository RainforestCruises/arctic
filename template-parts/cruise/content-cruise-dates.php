<?php

$currentYear = $args['curentYear'];
$yearSelections = $args['yearSelections'];
$itineraries = $args['itineraries'];
$departures = $args['departures'];
?>

<section class="slider-block narrow cruise-dates" id="section-dates">
    <div class="slider-block__content cruise-dates__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-group__title">
                    Departure Dates
                </div>
                <div class="title-group__sub departure-date-subtitle">
                    Showing <?php echo count($departures); ?> scheduled departures
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
            <div class="slider-block__content__slider__no-results" id="dates-slider-no-results">
                No Results
                <button class="btn-pill clear-departure-filters">Clear Filters</button>
            </div>
            <!-- Swiper -->
            <div class="swiper" id="dates-slider">
                <div class="swiper-wrapper">

                    <?php foreach ($departures as $d) :
                        $departureId = $d['ID'];
                        $itineraryPost = $d['ItineraryPost'];
                        $itineraryPostId = $d['ItineraryPostId'];
                        $departureStartDate = strtotime($d['DepartureDate']);
                        $departureReturnDate = strtotime($d['ReturnDate']);
                        $title = get_field('display_name', $itineraryPost);
                        $hero_gallery = get_field('hero_gallery', $itineraryPost);
                        $image = $hero_gallery[0];
                        $embarkationPost = get_field('embarkation_point', $itineraryPost);
                        $embarkationName = get_the_title($embarkationPost) . ', ' . get_field('country_name', $embarkationPost);
                        $bestDiscount = $d['BestDiscount'];
                    ?>

                        <div class="information-card info-departure-card swiper-slide" data-filter-date="<?php echo date("Y", $departureStartDate); ?>" data-filter-secondary="<?php echo $itineraryPostId; ?>">
                            <!-- Title Group -->
                            <div class="information-card__section">


                                <div class="avatar avatar--small">
                                    <div class="avatar__image-area">
                                        <img <?php afloat_image_markup($image['id'], 'square-thumb', array('square-thumb')); ?>>
                                    </div>
                                    <div class="avatar__title-group">
                                        <div class="avatar__title-group__title">
                                            <?php echo  $title; ?>
                                        </div>
                                        <div class="avatar__title-group__sub">
                                            <?php echo $d['LengthInNights'] + 1 . ' Days / ' . $d['LengthInNights'] . ' Nights'; ?>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <!-- Specs -->
                            <div class="information-card__section">

                                <!-- Dates -->
                                <div class="specs-item">
                                    <div class="specs-item__icon">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-in"></use>
                                        </svg>
                                    </div>
                                    <div class="specs-item__text">
                                        <div class="specs-item__text__main">
                                            <span style="font-weight: 700;"><?php echo  date("F j", $departureStartDate); ?></span> - <?php echo  date("M j, Y", $departureReturnDate); ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ports -->
                                <div class="specs-item">
                                    <div class="specs-item__icon">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-e"></use>
                                        </svg>
                                    </div>
                                    <div class="specs-item__text">
                                        <div class="specs-item__text__main">
                                            <?php echo $embarkationName ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Prices -->
                                <div class="specs-item">
                                    <div class="specs-item__icon">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-shopping-tag"></use>
                                        </svg>
                                    </div>
                                    <div class="specs-item__text">
                                        <div class="specs-item__text__main">
                                            <?php echo "$ " . number_format($d['LowestPrice'], 0);  ?> - <?php echo "$ " . number_format($d['HighestPrice'], 0);  ?>
                                        </div>
                                        <?php if ($bestDiscount) : ?>
                                            <div class="specs-item__text__sub">
                                                Up to <span class="green-text"><?php echo $bestDiscount; ?>%</span> savings
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="information-card__bottom">

                                <!-- Price Group -->
                                <div class="information-card__bottom__price-group">
                                    <button class="cta-square-icon cta-square-icon--inverse departure-price-group-button" departureId="<?php echo $departureId; ?>" year="<?php echo date("Y", $departureStartDate); ?>" departureDate="<?php echo date("M d, Y", $departureStartDate); ?>" itinerary="<?php echo $itineraryPostId; ?>" itineraryTitle="<?php echo $title; ?>">
                                        View Prices
                                    </button>
                                </div>

                                <!-- CTA -->
                                <div class="information-card__bottom__cta">
                                    <button class="cta-square-icon departure-inquire-cta" departureDate="<?php echo date("M d, Y", $departureStartDate); ?>" itinerary="<?php echo $itineraryPostId; ?>" itineraryTitle="<?php echo $title; ?>">
                                        Inquire
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                    </button>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="slider-block__content__filters">

            <div class="slider-block__content__filters__left" id="date-filter-group">

                <!-- Dates Filter -->
                <button class="btn-pill" data-filter="all" id="date-filter-button">
                    Dates
                </button>
                <div class="popper-tooltip" id="date-filter-tooltip" role="tooltip">
                    <div class="popper-tooltip__selection" id="date-filter-selection">
                        <ul class="popper-tooltip__selection__list">
                            <?php
                            $count = 1;
                            foreach ($yearSelections as $yearValue) : ?>
                                <li class="popper-tooltip__selection__list__item">
                                    <input class="checkbox date-checkbox" id="date-check-<?php echo $count; ?>" type="checkbox" value="<?php echo $yearValue ?>">
                                    <label for="date-check-<?php echo $count; ?>"><?php echo $yearValue; ?> Departures</label>
                                </li>
                            <?php $count++;
                            endforeach; ?>
                        </ul>
                    </div>
                    <div class="popper-tooltip__controls">
                        <button class="btn-pill" id="date-filter-clear-button">
                            Clear
                        </button>
                        <button class="btn-pill btn-pill--dark" id="date-filter-search-button">
                            Search
                        </button>
                    </div>
                    <div id="arrow" data-popper-arrow></div>
                </div>

                <!-- Itinerary Filter -->
                <button class="btn-pill cruise-dates-departure-filter" data-filter="all" id="itinerary-filter-button">
                    Itineraries
                </button>
                <div class="popper-tooltip" id="itinerary-filter-tooltip" role="tooltip">
                    <div class="popper-tooltip__selection" id="itinerary-filter-selection">
                        <ul class="popper-tooltip__selection__list">

                            <?php
                            $count = 1;
                            foreach ($itineraries as $itinerary) :
                                $title = get_field('display_name', $itinerary);
                                $id = $itinerary->ID;
                            ?>
                                <li class="popper-tooltip__selection__list__item">
                                    <input class="checkbox itinerary-checkbox" id="itinerary-check-<?php echo $count; ?>" type="checkbox" value="<?php echo $id ?>">
                                    <label for="itinerary-check-<?php echo $count; ?>"><?php echo $title; ?></label>
                                </li>
                            <?php $count++;
                            endforeach; ?>
                        </ul>
                    </div>
                    <div class="popper-tooltip__controls">
                        <button class="btn-pill" id="itinerary-filter-clear-button">
                            Clear
                        </button>
                        <button class="btn-pill btn-pill--dark" id="itinerary-filter-search-button">
                            Search
                        </button>
                    </div>
                    <div id="arrow" data-popper-arrow></div>
                </div>

                <button class="btn-pill clear-departure-filters" style="display: none;">Clear Filters</button>

            </div>

            <!-- View All -->
            <div class="slider-block__content__filters__right">
                <button class="btn-pill cruise-dates-departure-filter" data-filter="all" id="view-all-dates-button">
                    View All
                </button>
            </div>

        </div>
    </div>
</section>