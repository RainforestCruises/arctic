<?php
$itineraries = $args['itineraries'];
?>

<!-- Itineraries -->
<section class="cruise-itineraries" id="itineraries">

    <div class="cruise-itineraries__content">

        <div class="cruise-itineraries__content__top">

            <!-- Title -->
            <div class="cruise-itineraries__content__top__title">
                <div class="title-group">
                    <h2 class="title-group__title">
                        Itineraries
                    </h2>
                    <div class="title-group__sub">
                        There are <?php echo count($itineraries); ?> itineraries available
                    </div>
                </div>
            </div>

            <!-- Nav Area -->
            <div class="cruise-itineraries__content__top__nav-area">
                <div class="cruise-itineraries__content__top__nav-area__slider swiper" id="itineraries-slider-nav">
                    <div class="swiper-wrapper">
                        <?php $count = 0;
                        foreach ($itineraries as $itinerary) :
                            $id = $itinerary->ID;
                            $title = get_field('display_name', $itinerary);
                            $length = get_field('length_in_nights', $itinerary) + 1 . ' Days';
                            $hasFlight = getFlightOption($itinerary);

                        ?>
                            <div class="cruise-itineraries__content__top__nav-area__slider__item swiper-slide" slideIndex="<?php echo $count ?>" postId="<?php echo $id ?>">
                                <button class="cruise-itineraries__content__top__nav-area__slider__item__button">
                                    <?php echo $length; ?>
                                    <?php echo $hasFlight ? '<span class="badge">Fly</span>' : ''; ?>
                                </button>
                            </div>

                        <?php $count++;
                        endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- Nav Buttons -->
            <div class="cruise-itineraries__content__top__nav">
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

        <!-- Main -->
        <div class="cruise-itineraries__content__main">

            <!-- Detail Area -->
            <div class="cruise-itineraries__content__main__detail-area">
                <!-- Itineraries Slider -->
                <div class="cruise-itineraries__content__main__detail-area__slider swiper" id="itineraries-slider">
                    <div class="swiper-wrapper">

                        <?php
                        $count = 0;
                        foreach ($itineraries as $itinerary) :
                            $id = $itinerary->ID;
                            $hero_gallery = get_field('hero_gallery', $itinerary);
                            $hero_image = $hero_gallery[0];
                            $embarkation_point = get_field('embarkation_point', $itinerary);
                            $embarkation_country = get_field('embarkation_country', $embarkation_point);
                            $embarkation = get_the_title($embarkation_point) . ", " . get_the_title($embarkation_country);
                            $disembarkation_point = get_field('disembarkation_point', $itinerary);
                            $disembarkation_country = get_field('embarkation_country', $disembarkation_point);
                            $disembarkation = get_the_title($disembarkation_point) . ", " . get_the_title($disembarkation_country);
                            $hasDifferentPorts = $disembarkation_point != null && ($disembarkation_point != $embarkation_point);
                            $days = get_field('itinerary', $itinerary);
                            $departures = getDepartureList($itinerary, get_post()); // need to restrict to specific ship to obtain correct prices and dates
                            $lowestPrice = getLowestDepartureListPrice($departures);
                            $highestPrice = getHighestDepartureListPrice($departures);
                            $bestOverallDiscount = getBestDepartureListDiscount($departures);
                            $destinations = getItineraryDestinations($itinerary, true, 4); //build list of unique destinations within an itinerary, with embarkations removed
                            $title = get_field('display_name', $itinerary);
                            $length_in_nights = get_field('length_in_nights', $itinerary);
                            $top_snippet = get_field('top_snippet', $itinerary);
                            $link = get_the_permalink($itinerary);
                            $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';
                            $flightOption = getFlightOption($itinerary);
                        ?>

                            <!-- Itinerary Card -->
                            <div class="cruise-itineraries__content__main__detail-area__slider__slide swiper-slide" slideIndex="<?php echo $count ?>" postId="<?php echo $id ?>">

                                <!-- Mobile -->
                                <div class="tiny-card">
                                    <!-- Title Group -->
                                    <div class="tiny-card__section">
                                        <div class="avatar avatar--small">
                                            <div class="avatar__image-area">
                                                <img <?php afloat_image_markup($hero_image['id'], 'square-thumb', array('square-thumb')); ?>>
                                            </div>
                                            <div class="avatar__title-group">
                                                <div class="avatar__title-group__title">
                                                    <?php echo $title; ?>
                                                    <?php echo $flightOption ? '<span class="badge">' . $flightOption . '</span>' : ''; ?>
                                                </div>

                                                <div class="avatar__title-group__sub">
                                                    <?php echo $length; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tiny-card__section">
                                        <!-- CTA -->
                                        <a class="btn-primary btn-primary--icon btn-primary--small" href="<?php echo $link; ?>">
                                            Explore
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>


                                <!-- Desktop -->
                                <div class="resource-card small encapsulated ">

                                    <!-- Tag -->
                                    <?php if ($bestOverallDiscount) : ?>
                                        <div class="resource-card__tag">
                                            Up to <span class="green-text"><?php echo $bestOverallDiscount; ?>%</span> savings
                                        </div>
                                    <?php endif; ?>

                                    <!-- Images Slider -->
                                    <a class="resource-card__image-area" href="<?php echo $link; ?>">
                                        <img <?php afloat_image_markup($hero_image['id'], 'portrait-small', array('portrait-small')); ?>>
                                    </a>

                                    <!-- Content -->
                                    <div class="resource-card__content">

                                        <!-- Title -->
                                        <h3 class="resource-card__content__title">
                                            <a href="<?php echo $link; ?>">
                                                <?php echo $title; ?>
                                                <?php echo $flightOption ? '<span class="badge">' . $flightOption . '</span>' : ''; ?>
                                            </a>
                                        </h3>

                                        <!-- Description -->
                                        <div class="resource-card__content__description divider">
                                            <?php echo $top_snippet; ?>
                                        </div>

                                        <!-- Specs -->
                                        <div class="resource-card__content__specs divider">

                                            <!-- Length -->
                                            <div class="specs-item">
                                                <div class="specs-item__icon">
                                                    <svg>
                                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-time-clock"></use>
                                                    </svg>
                                                </div>
                                                <div class="specs-item__text">
                                                    <div class="specs-item__text__main">
                                                        Length: <?php echo $length; ?>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Embark -->
                                            <div class="specs-item">
                                                <div class="specs-item__icon">
                                                    <svg>
                                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-in"></use>
                                                    </svg>
                                                </div>
                                                <div class="specs-item__text">
                                                    <div class="specs-item__text__main">
                                                        Embarkation: <?php echo $embarkation; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Disembark -->
                                            <?php if ($hasDifferentPorts) : ?>
                                                <div class="specs-item">
                                                    <div class="specs-item__icon">
                                                        <svg>
                                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-out"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="specs-item__text">
                                                        <div class="specs-item__text__main">
                                                            Disembarkation: <?php echo $disembarkation; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Destinations -->
                                            <div class="specs-item">
                                                <div class="specs-item__icon">
                                                    <svg>
                                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-e"></use>
                                                    </svg>
                                                </div>
                                                <div class="specs-item__text">
                                                    <div class="specs-item__text__main">
                                                        Sites: <?php echo $destinations; ?>
                                                    </div>
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

                                            <!-- CTA -->
                                            <div class="resource-card__content__bottom__cta">
                                                <a class="btn-primary btn-primary--icon btn-primary--small" href="<?php echo $link; ?>">
                                                    Explore
                                                    <svg>
                                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- End Itinerary Card -->

                        <?php $count++;
                        endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Map Area -->
            <div class="cruise-itineraries__content__main__map-area">
                <div class="cruise-itineraries__content__main__map-area__map" id="itinerary-map"></div>
                <!-- Map Legend -->
                <div class="map-legend right-align">
                    <!-- Item 1 -->
                    <div class="map-legend__item">
                        <div class="map-legend__item__marker-area">
                            <span class="map-legend__item__marker-area__mark--fly"></span>
                        </div>
                        <div class="map-legend__item__text">
                            Fly
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="map-legend__item">
                        <div class="map-legend__item__marker-area">
                            <span class="map-legend__item__marker-area__mark--cruise"></span>
                        </div>
                        <div class="map-legend__item__text">
                            Cruise
                        </div>
                    </div>
                </div>
            </div>

            <?php  ?>
        </div>


    </div>
</section>