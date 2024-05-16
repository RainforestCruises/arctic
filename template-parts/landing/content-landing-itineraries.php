<?php
$itineraries_title_subtext = get_field('itineraries_title_subtext');
$itineraries_title = get_field('itineraries_title');
$itineraries = $args['itineraries'];
$region = $args['region'];

?>


<!-- Itineraries -->
<section class="slider-block" id="itineraries">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
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
                        $departures = getDepartureList($itinerary, null, true, $region);
                        if(!$departures){
                            continue;
                        } else {
                            $count++;
                        }
                        if($count > 15){
                            break;
                        }
                        $images =  get_field('hero_gallery', $itinerary);
                        $image =  $images[0];
                        $title = get_field('display_name', $itinerary);
                        $shipsDisplay = getShipsFromItineraryList($itinerary, true);
                        $length_in_nights = get_field('length_in_nights', $itinerary);
                        $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';

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

                    <?php 
                    endforeach; ?>
                </div>
            </div>


        </div>
    </div>
</section>