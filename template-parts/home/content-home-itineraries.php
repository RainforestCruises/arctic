<?php
$itineraries = get_field('itineraries');
$itineraries_title_subtext = get_field('itineraries_title_subtext')

?>


<section class="grid-block" id="section-itineraries">
    <div class="grid-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <div class="title-group__title">
                    Itineraries
                </div>
                <div class="title-group__sub">
                    <?php echo $itineraries_title_subtext; ?>
                </div>
            </div>

        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid4">
            <?php foreach ($itineraries as $itinerary) :
                $images =  get_field('hero_gallery', $itinerary);
                $itineraries =  get_field('itineraries', $itinerary);
                $title = get_field('display_name', $itinerary);
                $days = get_field('itinerary', $itinerary);
                $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';
                $embarkation_point = get_field('embarkation_point', $itinerary);
                $embarkation = get_the_title($embarkation_point);
                $shipsDisplay = getItineraryShips($itinerary);
                $destinations = getItineraryDestinations($itinerary);
                $itineraryDisplay = itineraryRange($itineraries, "-") . " Days, " . count($itineraries) . ' Itineraries';
                $guestsDisplay = get_field('vessel_capacity', $itinerary) . ' Guests, ' . 'Luxury';
                $departures = getDepartureList($itinerary);
                $lowestPrice = getLowestDepartureListPrice($departures);

            ?>

                <!-- Itinerary Card -->
                <div class="resource-card">

                    <!-- Images Slider -->
                    <div class="resource-card__image-area swiper itinerary-card-image-area">
                        <div class="swiper-wrapper">
                            <?php foreach ($images as $image) : ?>
                                <a class="resource-card__image-area__item swiper-slide" href="<?php echo get_permalink($itinerary) ?>">
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
                        <a class="resource-card__content__title" href="<?php echo get_permalink($itinerary) ?>">
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
                                    Length: <?php echo $length; ?>
                                </div>
                            </div>
                            <!-- Ships -->
                            <div class="resource-card__content__specs__item">
                                <div class="resource-card__content__specs__item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat"></use>
                                    </svg>
                                </div>
                                <div class="resource-card__content__specs__item__text">
                                    Ships: <?php echo $shipsDisplay; ?>
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