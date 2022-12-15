<?php
$ships = get_field('ships');
$ships_title_subtext = get_field('travel_guide_title_subtext')

?>


<section class="grid-block" id="section-ships">
    <div class="grid-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <div class="title-group__title">
                    Ships
                </div>
                <div class="title-group__sub">
                    <?php echo $ships_title_subtext; ?>
                </div>
            </div>

        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid3">
            <?php foreach ($ships as $ship) :
                $images =  get_field('hero_gallery', $ship);
                $itineraries =  get_field('itineraries', $ship);
                $title = get_the_title($ship);
                $itineraryDisplay = itineraryRange($itineraries, "-") . " Days, " . count($itineraries) . ' Itineraries';
                $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests, ' . 'Luxury';
                $departures = getDepartureList($ship);
                $lowestPrice = getLowestDepartureListPrice($departures)
            ?>

                <!-- Cabin Card -->
                <div class="resource-card">

                    <!-- Images Slider -->
                    <div class="resource-card__image-area swiper ship-card-image-area">
                        <div class="swiper-wrapper">
                            <?php foreach ($images as $image) : ?>
                                <a class="resource-card__image-area__item swiper-slide" href="<?php echo get_permalink($ship) ?>">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev swiper-button-prev--overlay"></div>
                        <div class="swiper-button-next swiper-button-prev--overlay"></div>
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
                            <div class="resource-card__content__specs__item">
                                <div class="resource-card__content__specs__item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-time-clock"></use>
                                    </svg>
                                </div>
                                <div class="resource-card__content__specs__item__text">
                                    <?php echo $itineraryDisplay; ?>
                                </div>
                            </div>

                            <!-- Size -->
                            <div class="resource-card__content__specs__item">
                                <div class="resource-card__content__specs__item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-profile"></use>
                                    </svg>
                                </div>
                                <div class="resource-card__content__specs__item__text">
                                    <?php echo $guestsDisplay; ?>
                                </div>
                            </div>

                        </div>

                        <!-- Price Group -->
                        <div class="resource-card__content__price-group">
                            <div class="resource-card__content__price-group__amount">
                                <?php echo "$ " . number_format($lowestPrice, 0);  ?>
                            </div>
                            <div class="resource-card__content__price-group__text">
                                Per Person
                            </div>
                        </div>
                    </div>
                </div>


            <?php endforeach; ?>




        </div>


    </div>
</section>