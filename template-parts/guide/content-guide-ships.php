<?php

$ships = get_field('ships');
$ships_subtext = get_field('ships_subtext');

?>


<section class="slider-block narrow">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-group__title">
                    Antarctica Cruise Ships
                </div>
                <div class="title-group__sub">
                    <?php echo $ships_subtext; ?> 
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">

                <div class="swiper-button-prev swiper-button-prev--white-border ships-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border ships-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>

            </div>
        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <!-- Swiper -->
            <div class="swiper" id="ships-slider">
                <div class="swiper-wrapper">


                    <?php foreach ($ships as $ship) :
                        $images =  get_field('hero_gallery', $ship);
                        $image = $images[0];
                        $itineraries =  get_field('itineraries', $ship);
                        $title = get_the_title($ship);
                        $itineraryDisplay = itineraryRange($itineraries, "-") . " Days, " . count($itineraries) . ' Itineraries';
                        $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests, ' . 'Luxury';
                        $departures = getDepartureList($ship);
                        $lowestPrice = getLowestDepartureListPrice($departures);
                    ?>

                        <!-- Cabin Card -->
                        <div class="resource-card swiper-slide">

                            <!-- Images Slider -->
                            <div class="resource-card__image-area swiper related-card-image-area">
                                <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                            </div>

                            <!-- Content -->
                            <div class="resource-card__content">

                                <!-- Title -->
                                <a class="resource-card__content__title" href="<?php echo get_permalink($ship) ?>">
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
                                <div class="resource-card__content__bottom">
                                    <!-- Price Group -->
                                    <div class="resource-card__content__bottom__price-group">
                                        <div class="resource-card__content__bottom__price-group__amount">
                                            <?php echo "$ " . number_format($lowestPrice, 0);  ?>
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