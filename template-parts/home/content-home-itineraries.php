<?php
$itineraries = get_field('itineraries');
$itineraries_title = get_field('itineraries_title');
$itineraries_title_subtext = get_field('itineraries_title_subtext');

?>


<section class="slider-block" id="section-itineraries">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <div class="title-group__title">
                    <?php echo $itineraries_title; ?>
                </div>
                <div class="title-group__sub">
                    <?php echo $itineraries_title_subtext; ?>
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">
                <div class="swiper-button-prev swiper-button-prev--white-border itineraries-best-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border itineraries-best-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>

        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">


            <div class="swiper" id="itineraries-best-slider">
                <div class="swiper-wrapper">

                    <?php foreach ($itineraries as $itinerary) :
                        $images =  get_field('hero_gallery', $itinerary);
                        $image = $images[0];
                        $itineraries =  get_field('itineraries', $itinerary);
                        $title = get_field('display_name', $itinerary);
                        $days = get_field('itinerary', $itinerary);
                        $length_in_nights = get_field('length_in_nights', $itinerary);
                        $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';
                        $embarkation_point = get_field('embarkation_point', $itinerary);
                        $embarkation = get_the_title($embarkation_point);
                        $shipsDisplay = getItineraryShips($itinerary);
                        $destinations = getItineraryDestinations($itinerary);
                        $itineraryDisplay = itineraryRange($itineraries, "-") . " Days, " . count($itineraries) . ' Itineraries';
                        $guestsDisplay = get_field('vessel_capacity', $itinerary) . ' Guests, ' . 'Luxury';
                        $departures = getDepartureList($itinerary);
                        $lowestPrice = getLowestDepartureListPrice($departures);
                        $highestPrice = getHighestDepartureListPrice($departures);
                        $bestOverallDiscount = getBestDepartureListDiscount($departures);
                    ?>

                        <!-- Itinerary Card -->
                        <div class="resource-card swiper-slide">

                            <!-- Tag -->
                            <?php if ($bestOverallDiscount) : ?>
                                <div class="resource-card__tag">
                                    Up to <span class="green-text"><?php echo $bestOverallDiscount; ?>%</span> savings
                                </div>
                            <?php endif; ?>


                            <!-- Images Slider -->
                            <div class="resource-card__image-area">
                                <a class="resource-card__image-area__item" href="<?php echo get_permalink($itinerary) ?>">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                                </a>
                            </div>

                            <!-- Content -->
                            <div class="resource-card__content">

                                <!-- Title -->
                                <a class="resource-card__content__title" href="<?php echo get_permalink($itinerary) ?>">
                                    <?php echo $title; ?>
                                </a>

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
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat"></use>
                                            </svg>
                                        </div>
                                        <div class="specs-item__text">
                                            Ships: <?php echo $shipsDisplay; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="resource-card__content__bottom">
                                    <!-- Price Group -->
                                    <div class="resource-card__content__bottom__price-group">
                                        <div class="resource-card__content__bottom__price-group__amount">
                                            <?php priceFormat($lowestPrice);  ?> - <?php priceFormat($highestPrice); ?>
                                        </div>
                                        <div class="resource-card__content__bottom__price-group__text">
                                            Per Person
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>
</section>