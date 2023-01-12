<?php
$itineraries = get_field('itineraries');
$itineraries_title_subtext = get_field('travel_guide_title_subtext')

?>

<!-- Itineraries -->
<section class="slider-block" id="section-itineraries">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <div class="title-group__title">
                    Itineraries
                </div>
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
                    $index = 0;
                    foreach ($itineraries as $itinerary) :
                        $images =  get_field('hero_gallery', $itinerary);
                        $image =  $images[0];
                        $title = get_field('display_name', $itinerary);
                        $shipsDisplay = getItineraryShips($itinerary);
                        $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';
                        $departures = getDepartureList($itinerary);
                        $lowestPrice = getLowestDepartureListPrice($departures)
                    ?>

                        <!-- Itinerary Card -->
                        <div class="resource-card swiper-slide">

                            <!-- Images Slider -->
                            <div class="resource-card__image-area">
                                <a class="resource-card__image-area__item" href="<?php echo get_permalink($itinerary) ?>">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
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
                                            <?php echo "$ " . number_format($lowestPrice, 0);  ?>
                                        </div>
                                        <div class="resource-card__content__bottom__price-group__text">
                                            Per Person
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    <?php $index++;
                    endforeach; ?>
                </div>
            </div>


        </div>
    </div>
</section>