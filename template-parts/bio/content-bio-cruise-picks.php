<?php 
$cruises_title = get_field('cruises_title');
$cruises_text = get_field('cruises_text');
$cruises = get_field('cruises');
console_log($cruises);
?>


<section class="slider-block narrow">
    <div class="slider-block__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="title-single">
                <h2 class="title-group__title">
                    <?php echo $cruises_title; ?>
                </h2>
                <div class="title-group__sub">
                    <?php echo $cruises_text; ?>
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">

                <div class="swiper-button-prev swiper-button-prev--white-border cruises-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border cruises-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>

            </div>
        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider" style="margin-bottom: 3rem;">

            <!-- Swiper -->
            <div class="swiper" id="cruises-slider">
                <div class="swiper-wrapper">
                    <?php
                    $count = 0;
                    foreach ($cruises as $ship) :
                        console_log($ship);
                        if ($count > 11) {
                            continue;
                        }
                        $departures = getDepartureList($ship);
                        //if( !$departures ) continue; // Skip if sold out
                        
                        $lowestPrice = getLowestDepartureListPrice($departures);
                        $highestPrice = getHighestDepartureListPrice($departures);
                        $bestOverallDiscount = getBestDepartureListDiscount($departures);
                        $images =  get_field('hero_gallery', $ship);
                        $image = $images[0];
                        $itineraries = getShipItineraries($ship);
                        $title = get_the_title($ship);
                        $itineraryDisplay = itineraryRange($itineraries, "-") . " Days, " . count($itineraries) . ' Itineraries';
                        $service_level =  get_field('service_level', $ship);
                        $serviceLevelDisplay = ($service_level) ? get_the_title($service_level) : "N/A";
                        $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests, ' . $serviceLevelDisplay;

                    ?>
                        <!-- Cabin Card -->
                        <div class="resource-card swiper-slide">

                            <!-- Tag -->
                            <?php if ($bestOverallDiscount) : ?>
                                <div class="resource-card__tag">
                                    Up to <span class="green-text"><?php echo $bestOverallDiscount; ?>%</span> savings
                                </div>
                            <?php endif; ?>

                            <!-- Images Slider -->
                            <a class="resource-card__image-area swiper ship-card-image-area" href="<?php echo get_permalink($ship) ?>">
                                <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                            </a>

                            <!-- Content -->
                            <div class="resource-card__content">

                                <!-- Title -->
                                <h3 class="resource-card__content__title">
                                    <a href="<?php echo get_permalink($ship) ?>"><?php echo $title; ?></a>
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
                                            <?php echo $itineraryDisplay; ?>
                                        </div>
                                    </div>

                                    <!-- Size -->
                                    <div class="specs-item">
                                        <div class="specs-item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-profile"></use>
                                            </svg>
                                        </div>
                                        <div class="specs-item__text">
                                            <?php echo $guestsDisplay; ?>
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