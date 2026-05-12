<?php
$itineraries = get_field('itineraries');
$itineraries_title = get_field('itineraries_title');
?>


<section class="slider-block narrow ">
    <div class="slider-block__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <h2 class="title-single" style="height:3rem;">
                    <?php echo $itineraries_title; ?>
                </h2>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">

                <div class="swiper-button-prev swiper-button-prev--white-border itineraries-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border itineraries-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>

            </div>
        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <!-- Swiper -->
            <div class="swiper" id="itineraries-slider">
                <div class="swiper-wrapper">


                    <?php
                    $count = 0;
                    foreach ($itineraries as $itinerary) :
                        if ($count > 11) continue; // hard limit of 12 related itineraries for performance and design reasons, TODO: implement true pagination for related itineraries if needed

                        $precalculated_departures = get_field('precalculated_departures', $itinerary);
                        $departures = $precalculated_departures ? $precalculated_departures : getDepartureListItinerary($itinerary);
                        if (!$departures) continue; // skip itineraries with no departures

                        $precalculated_price_low = get_field('precalculated_price_low', $itinerary);
                        $lowestPrice = $precalculated_price_low ? $precalculated_price_low : getLowestDepartureListPrice($departures);

                        $precalculated_price_high = get_field('precalculated_price_high', $itinerary);
                        $highestPrice = $precalculated_price_high ? $precalculated_price_high : getHighestDepartureListPrice($departures);

                        $precalculated_best_discount = get_field('precalculated_best_discount', $itinerary);
                        $bestOverallDiscount = $precalculated_best_discount ? $precalculated_best_discount : getBestDepartureListDiscount($departures);

                        $precalculated_ships = get_field('precalculated_ships', $itinerary);
                        $ships = $precalculated_ships ? $precalculated_ships : getShipsFromItineraries($itinerary);
                        $shipsDisplay = getShipsDisplay($ships);

                        $precalculated_lengths = get_field('precalculated_lengths', $itinerary);
                        $itineraryLengths = $precalculated_lengths ? $precalculated_lengths : getItineraryLengths($itinerary);
                        $lengthDisplay = formatLengthDisplay($itineraryLengths);

                        $images =  get_field('hero_gallery', $itinerary);
                        $image = $images[0];
                        $title = get_field('display_name', $itinerary);
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
                            <a class="resource-card__image-area swiper itineraries-card-image-area" href="<?php echo get_permalink($itinerary) ?>">
                                <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                            </a>

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
                                            Length: <?php echo $lengthDisplay; ?>
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
                                </div>

                                <!-- Price Group -->
                                <div class="resource-card__content__bottom">
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

                    <?php $count++;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>