<?php
$itineraries = get_field('itineraries');
$itineraries_title = get_field('itineraries_title');
$itineraries_title_subtext = get_field('itineraries_title_subtext');
$regions = $args['regions'];
$isMultiRegion = $args['isMultiRegion'];
?>

<section class="slider-block" id="itineraries">
    <div class="slider-block__content block-top-divider">
        <?php if ($isMultiRegion) : ?>
            <!-- General Top -->
            <div class="slider-block__content__top">
                <!-- Title -->
                <div class="title-group">
                    <h2 class="title-group__title">
                        <?php echo $itineraries_title; ?>
                    </h2>
                    <div class="title-group__sub">
                        <?php echo $itineraries_title_subtext; ?>
                    </div>
                </div>
            </div>
        <?php
        endif;

        $regionCount = 0;
        foreach ($regions as $region) :
            $regionName = get_the_title($region);
            $regionItineraries = getItinerariesFromRegion($region);
        ?>
            <!-- Title/Nav -->
            <div class="slider-block__content__top <?php echo $regionCount == 0 ? '' : 'slider-top-divider' ?>  itineraries-slider-block">

                <?php if ($isMultiRegion) : ?>
                    <h3 class="title-single">
                        <?php echo $regionName; ?> Cruises
                    </h3>
                <?php else : ?>
                    <div class="slider-block__content__top">
                        <!-- Title -->
                        <div class="title-group">
                            <h2 class="title-group__title">
                                <?php echo $itineraries_title; ?>
                            </h2>
                            <div class="title-group__sub">
                                <?php echo $itineraries_title_subtext; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Nav Buttons -->
                <div class="slider-block__content__top__nav">
                    <div class="swiper-button-prev swiper-button-prev--white-border itineraries-slider-btn-prev-<?php echo $regionCount; ?>">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                        </svg>
                    </div>
                    <div class="swiper-button-next swiper-button-next--white-border itineraries-slider-btn-next-<?php echo $regionCount; ?>">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                        </svg>
                    </div>
                </div>

            </div>

            <!-- Slider Area -->
            <div class="slider-block__content__slider">
                <div class="swiper" id="itineraries-slider-<?php echo $regionCount; ?>">
                    <div class="swiper-wrapper">
                        <?php 
                        $count = 0;
                        foreach ($regionItineraries as $itinerary) :
                            $count++;
                            if( $count > 24 ) break; // Limit to 12 itineraries per region
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
            </div>
        <?php $regionCount++;
        endforeach; ?>


        <div class="slider-block__content__cta">

            <?php foreach ($regions as $region) :
                $regionName = get_the_title($region);
                $top_level_search_page = get_permalink(get_field('top_level_search_page', $region));
            ?>
                <a class="btn-primary btn-primary--inverse-outline" href="<?php echo $top_level_search_page; ?>?viewType=search-itineraries">
                    Explore <?php echo $regionName; ?>
                </a>
            <?php
            endforeach; ?>
        </div>
    </div>
</section>