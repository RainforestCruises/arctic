<?php
$currentYear = date('Y');
$yearSelections = $args['yearSelections'];
$ships = $args['ships'];
$departures = $args['departures'];
$itineraryInfoObject = $args['itineraryInfoObject'];


?>

<section class="slider-block narrow" id="dates">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <h2 class="title-group__title">
                    Departure Dates
                </h2>
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
                        $ship = $d['Ship'];
                        $variantIndex = $d['VariantIndex'];
                        $shipId = $ship->ID;
                        $itineraryPost = $d['ItineraryPost'];
                        $itineraryPostId = $d['ItineraryPostId'];
                        $departureStartDate = strtotime($d['DepartureDate']);
                        $departureReturnDate = strtotime($d['ReturnDate']);
                        $differentYears = date("Y", $departureStartDate) == date("Y", $departureReturnDate)  ? false : true;

                        $title = get_the_title($ship);
                        $hero_gallery = get_field('hero_gallery', $ship);
                        $vessel_capacity = get_field('vessel_capacity', $ship);
                        $service_level = get_field('service_level', $ship);
                        $image = $hero_gallery[0];
                        $embarkationDisplay = $d['EmbarkationDisplay'];
                        $bestDiscount = $d['BestDiscount'];
                        $highestPrice = $d['HighestPrice'];
                        $lowestPrice = $d['LowestPrice'];
                        $lengthDisplay = $d['LengthInDays'] . ' Days';
                        $variantTitle = $d['VariantTitle'];
                        $deals = $d['Deals'];
                        $specialDepartures = $d['SpecialDepartures'];
                        $combinedDeals = array_merge($deals, $specialDepartures);

                    ?>

                        <div class="information-card info-departure-card swiper-slide" data-filter-date="<?php echo date("Y", $departureStartDate); ?>" data-filter-secondary="<?php echo $shipId; ?>" data-filter-variant="<?php echo $variantIndex; ?>" data-filter-discount=<?php echo ($bestDiscount) ? true : false ?>>
                            <!-- Title Group -->
                            <div class="information-card__section">
                                <a class="avatar avatar--small" href="<?php echo get_permalink($ship); ?>" target="_blank">
                                    <div class="avatar__image-area">
                                        <img <?php afloat_image_markup($image['id'], 'square-thumb', array('square-thumb')); ?>>
                                    </div>
                                    <div class="avatar__title-group">
                                        <div class="avatar__title-group__title">
                                            <?php echo  $title; ?>
                                        </div>
                                        <div class="avatar__title-group__sub">
                                            <?php echo get_the_title($service_level) . ", " . $vessel_capacity . ' Guests'; ?>
                                        </div>
                                    </div>
                                </a>
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
                                            <span style="font-weight: 700;"><?php echo date(($differentYears ? "F j, Y" : "F j"), $departureStartDate); ?></span> - <?php echo  date("M j, Y", $departureReturnDate); ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Time -->
                                <div class="specs-item">
                                    <div class="specs-item__icon">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-time-clock"></use>
                                        </svg>
                                    </div>
                                    <div class="specs-item__text">
                                        <div class="specs-item__text__main">
                                            <?php echo $lengthDisplay ?>
                                            <?php echo $variantTitle != null ?  " (" . $variantTitle . ")" : "" ?>
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
                                            <?php echo $embarkationDisplay ?>
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
                                            <?php priceFormat($lowestPrice, $highestPrice);  ?>
                                        </div>
                                        <?php if ($bestDiscount) : ?>
                                            <div class="specs-item__text__sub">
                                                Up to <span class="green-text"><?php echo $bestDiscount; ?>%</span> savings
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Deals -->
                                <?php if ($combinedDeals) :
                                    foreach ($combinedDeals as $deal) :
                                        $dealId = $deal->ID;
                                        $short_title = get_field('short_title', $deal);
                                        $is_special_departure = get_field('is_special_departure', $deal);
                                ?>
                                        <div class="specs-deal <?php echo $is_special_departure ? "specs-deal--special special-departure-cta" : "" ?> deal-cta " dealId="<?php echo $dealId ?>">
                                            <?php echo $short_title; ?>
                                        </div>
                                <?php endforeach;
                                endif; ?>

                            </div>

                            <div class="information-card__bottom">

                                <!-- Price Group -->
                                <div class="information-card__bottom__price-group">


                                    <button class="btn-primary btn-primary--small btn-primary--inverse departure-price-group-button" departureId="<?php echo $departureId; ?>" year="<?php echo date("Y", $departureStartDate); ?>" departureDate="<?php echo date("M d, Y", $departureStartDate); ?>" itinerary="<?php echo $itineraryPostId; ?>" itineraryTitle="<?php echo $title; ?>">
                                        View Prices
                                    </button>
                                </div>

                                <!-- CTA -->
                                <div class="information-card__bottom__cta">
                                    <button class="btn-primary btn-primary--icon btn-primary--small departure-inquire-cta" departureDate="<?php echo date("M d, Y", $departureStartDate); ?>" itinerary="<?php echo $itineraryPostId; ?>" itineraryTitle="<?php echo $title; ?>">
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
                        <button class="btn-pill btn-pill--inverse" id="date-filter-search-button">
                            Search
                        </button>
                    </div>
                    <div id="arrow" data-popper-arrow></div>
                </div>

                <!-- Ship Filter -->
                <button class="btn-pill cruise-dates-departure-filter" data-filter="all" id="itinerary-filter-button">
                    Ships
                </button>
                <div class="popper-tooltip" id="itinerary-filter-tooltip" role="tooltip">
                    <div class="popper-tooltip__selection" id="itinerary-filter-selection">
                        <ul class="popper-tooltip__selection__list">

                            <?php
                            $count = 1;
                            foreach ($ships as $ship) :
                                $title = get_the_title($ship);
                                $id = $ship->ID;
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
                        <button class="btn-pill btn-pill--inverse" id="itinerary-filter-search-button">
                            Search
                        </button>
                    </div>
                    <div id="arrow" data-popper-arrow></div>
                </div>


                <!-- Variants Filter -->
                <button class="btn-pill" data-filter="all" id="variant-filter-button" style="display: <?php echo $itineraryInfoObject->hasVariants ? '' : 'none' ?>">
                    Variants
                </button>
                <div class="popper-tooltip" id="variant-filter-tooltip" role="tooltip">
                    <div class="popper-tooltip__selection" id="variant-filter-selection">
                        <ul class="popper-tooltip__selection__list">
                            <?php
                            $count = 1;
                            foreach ($itineraryInfoObject->itineraryObjects as $itineraryObject) : ?>
                                <li class="popper-tooltip__selection__list__item">
                                    <input class="checkbox variant-checkbox" id="variant-check-<?php echo $count; ?>" type="checkbox" value="<?php echo $itineraryObject->index ?>">
                                    <label for="variant-check-<?php echo $count; ?>"><?php echo $itineraryObject->length_in_days; ?> Day <?php echo $itineraryObject->departureDisplay; ?></label>
                                </li>
                            <?php $count++;
                            endforeach; ?>
                        </ul>
                    </div>
                    <div class="popper-tooltip__controls">
                        <button class="btn-pill" id="variant-filter-clear-button">
                            Clear
                        </button>
                        <button class="btn-pill btn-pill--inverse" id="variant-filter-search-button">
                            Search
                        </button>
                    </div>
                    <div id="arrow" data-popper-arrow></div>
                </div>


                <button class="btn-pill cruise-dates-departure-filter" id="view-discounted-button">
                    Discounted
                </button>
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