<?php
$deal = get_post();
$itinerariesWithDeal = getItinerariesWithDeal($deal);

$subtitleDisplay = "";
if (count($itinerariesWithDeal) > 1) {
    $subtitleDisplay = "Choose from the following " . count($itinerariesWithDeal) . " cruises with this special offer";
} else {
    $subtitleDisplay = "Choose from the following " . count($itinerariesWithDeal) . " cruise with this special offer";
}


?>


<section class="grid-block" id="section-deals">
    <div class="grid-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">
            <div class="title-group">
                <h2 class="title-group__title">
                    Find Your Journey
                </h2>
                <div class="title-group__sub">
                    <?php echo $subtitleDisplay; ?>
                </div>
            </div>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid3">
            <?php
            foreach ($itinerariesWithDeal as $itinerary) :
                $images =  get_field('hero_gallery', $itinerary);
                $image = $images[0];
                $title = get_field('display_name', $itinerary);
                $days = get_field('itinerary', $itinerary);
                $length_in_nights = get_field('length_in_nights', $itinerary);
                $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';
                $embarkation_point = get_field('embarkation_point', $itinerary);
                $embarkation = get_the_title($embarkation_point);
                $shipsDisplay = getShipsFromItineraryList($itinerary, true);
                $destinations = getItineraryDestinations($itinerary, true, 4);
                $guestsDisplay = get_field('vessel_capacity', $itinerary) . ' Guests, ' . 'Luxury';
                $departures = getDepartureList($itinerary);
                $lowestPrice = getLowestDepartureListPrice($departures);
                $highestPrice = getHighestDepartureListPrice($departures);
                $bestOverallDiscount = getBestDepartureListDiscount($departures);
                $departuresWithDealList = getDeparturesWithDeal($departures, $deal);

            ?>

                <!-- Itinerary Card -->
                <div class="resource-card">

                    <!-- Tag -->
                    <?php if ($bestOverallDiscount) : ?>
                        <div class="resource-card__tag">
                            Up to <span class="green-text"><?php echo $bestOverallDiscount; ?>%</span> savings
                        </div>
                    <?php endif; ?>

                    <!-- Image -->
                    <div class="resource-card__image-area">
                        <a class="resource-card__image-area__item" href="<?php echo get_permalink($itinerary) ?>">
                            <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                        </a>
                    </div>

                    <!-- Content -->
                    <div class="resource-card__content">

                        <!-- Title -->
                        <h3 class="resource-card__content__title">
                            <a href="<?php echo get_permalink($itinerary) ?>"><?php echo $title; ?></a>
                        </h3>

                        <!-- Specs -->
                        <div class="resource-card__content__specs">

                            <!-- Itinerary -->
                            <div class="specs-item">
                                <div class="specs-item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-time-clock"></use>
                                    </svg>
                                </div>
                                <div class="specs-item__text">
                                    Length: <?php echo $length; ?>
                                </div>
                            </div>
                            <!-- Ships -->
                            <div class="specs-item">
                                <div class="specs-item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-16"></use>
                                    </svg>
                                </div>
                                <div class="specs-item__text">
                                    Ships: <?php echo $shipsDisplay; ?>
                                </div>
                            </div>
                            <!-- Departures -->
                            <div class="specs-item">
                                <div class="specs-item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-in"></use>
                                    </svg>
                                </div>
                                <div class="specs-item__text">
                                    Dates:
                                    <?php echo getDateListDisplay($departuresWithDealList, 3); ?>
                                </div>
                            </div>
                        </div>

                        <div class="resource-card__content__bottom">
                            <!-- Price Group -->
                            <div class="resource-card__content__bottom__price-group">
                                <div class="resource-card__content__bottom__price-group__amount">
                                    <?php priceFormat($lowestPrice, $highestPrice); ?>
                                </div>
                                <div class="resource-card__content__bottom__price-group__text">
                                    <?php echo ($lowestPrice) ? "Per Person" : ""; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    </div>
</section>