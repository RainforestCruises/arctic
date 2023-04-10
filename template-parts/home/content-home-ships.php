<?php
$ships = get_field('ships');
$firstShips = array_slice($ships, 0, 6);
$expandedShips = array_slice($ships, 6, 99);

$ships_title = get_field('ships_title');
$ships_title_subtext = get_field('ships_title_subtext');

?>


<section class="grid-block" id="section-ships">
    <div class="grid-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">

            <!-- Title -->
            <div class="title-single">
                <div class="title-group__title">
                    <?php echo $ships_title; ?>
                </div>
                <div class="title-group__sub">
                    <?php echo $ships_title_subtext; ?>
                </div>
            </div>

        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid3">
            <?php
            foreach ($firstShips as $ship) :
                $images =  get_field('hero_gallery', $ship);
                $itineraries =  get_field('itineraries', $ship);
                $title = get_the_title($ship);
                $itineraryDisplay = itineraryRange($itineraries, "-") . " Days, " . count($itineraries) . ' Itineraries';
                $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests, ' . 'Luxury';
                $departures = getDepartureList($ship);
                $lowestPrice = getLowestDepartureListPrice($departures);
                $highestPrice = getHighestDepartureListPrice($departures);
                $bestOverallDiscount = getBestDepartureListDiscount($departures);
            ?>
                <!-- Ship Card -->
                <div class="resource-card">

                    <!-- Images Slider -->
                    <div class="resource-card__image-area swiper ship-card-image-area">
                        <div class="swiper-wrapper">
                            <?php foreach ($images as $image) : ?>
                                <a class="resource-card__image-area__item swiper-slide" href="<?php echo get_permalink($ship) ?>">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev swiper-button-prev--overlay"></div>
                        <div class="swiper-button-next swiper-button-prev--overlay"></div>
                    </div>

                    <!-- Content -->
                    <div class="resource-card__content">
                        <!-- Tag -->
                        <?php if ($bestOverallDiscount) : ?>
                            <div class="resource-card__tag">
                                Up to <span class="green-text"><?php echo $bestOverallDiscount; ?>%</span> savings
                            </div>
                        <?php endif; ?>

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

        <!-- Extra Ships -->
        <!-- Grid Area -->
        <div class="grid-block__content__grid grid3 expand-content" style="margin-top: 2rem;" id="expanded-ships">
            <?php
            foreach ($expandedShips as $ship) :
                $images =  get_field('hero_gallery', $ship);
                $itineraries =  get_field('itineraries', $ship);
                $title = get_the_title($ship);
                $itineraryDisplay = itineraryRange($itineraries, "-") . " Days, " . count($itineraries) . ' Itineraries';
                $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests, ' . 'Luxury';
                $departures = getDepartureList($ship);
                $lowestPrice = getLowestDepartureListPrice($departures);
                $highestPrice = getHighestDepartureListPrice($departures);
                $bestOverallDiscount = getBestDepartureListDiscount($departures);
            ?>

                <!-- Ship Card -->
                <div class="resource-card">

                    <!-- Images Slider -->
                    <div class="resource-card__image-area swiper ship-card-image-area">
                        <div class="swiper-wrapper">
                            <?php foreach ($images as $image) : ?>
                                <a class="resource-card__image-area__item swiper-slide" href="<?php echo get_permalink($ship) ?>">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev swiper-button-prev--overlay"></div>
                        <div class="swiper-button-next swiper-button-prev--overlay"></div>
                    </div>

                    <!-- Content -->
                    <div class="resource-card__content">
                        <!-- Tag -->
                        <?php if ($bestOverallDiscount) : ?>
                            <div class="resource-card__tag">
                                Up to <span class="green-text"><?php echo $bestOverallDiscount; ?>%</span> savings
                            </div>
                        <?php endif; ?>

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
        <div class="grid-block__content__cta">
            <button class="cta-primary cta-primary--inverse" id="all-ships-button">
                View All Ships
            </button>
        </div>

    </div>
</section>