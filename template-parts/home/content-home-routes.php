<?php
$routes = get_field('routes');
$routes_title = get_field('routes_title');
$routes_title_subtext = get_field('routes_title_subtext');

?>

<!-- Routes (home variant) -->
<section class="cruise-itineraries home-variant" id="section-routes">


    <div class="cruise-itineraries__content">

        <div class="cruise-itineraries__content__top">

            <!-- Title -->
            <div class="cruise-itineraries__content__top__title">
                <div class="title-group">
                    <h2 class="title-group__title">
                        <?php echo $routes_title; ?>
                    </h2>
                    <div class="title-group__sub">
                        <?php echo $routes_title_subtext; ?>
                    </div>
                </div>
            </div>

            <!-- Nav Area -->
            <div class="cruise-itineraries__content__top__nav-area">
                <div class="cruise-itineraries__content__top__nav-area__slider swiper" id="itineraries-slider-nav">
                    <div class="swiper-wrapper">
                        <?php $count = 0;
                        foreach ($routes as $route) :
                            $id = $route->ID;
                            $short_title = get_field('short_title', $route);
                            $hasFlight = false;
                        ?>
                            <div class="cruise-itineraries__content__top__nav-area__slider__item swiper-slide" slideIndex="<?php echo $count ?>" postId="<?php echo $id ?>">
                                <button class="cruise-itineraries__content__top__nav-area__slider__item__button">
                                    <?php echo $short_title; ?>
                                    <?php echo $hasFlight ? '<span class="badge-fly">Fly</span>' : ''; ?>
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
                        foreach ($routes as $route) :
                            $id = $route->ID;
                            $image = get_field('image', $route);

                            $title = get_field('title', $route);
                            $description = get_field('description', $route);
                            $landing_page = get_field('landing_page', $route);
                            $price_low = get_field('price_low', $route);
                            $price_high = get_field('price_high', $route);

                            $sample_itinerary = get_field('sample_itinerary', $route);
                            $length_in_nights = get_field('length_in_nights', $sample_itinerary);
                            $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';

                            $ports = get_field('ports', $route);
                            $portsDisplay = comma_separate_list($ports);
                            $destinations = getItineraryDestinationsDisplay($sample_itinerary, 4); //build list of unique, with embarkations removed

                        ?>

                            <!-- Itinerary Card -->
                            <div class="cruise-itineraries__content__main__detail-area__slider__slide swiper-slide" slideIndex="<?php echo $count ?>" postId="<?php echo $id ?>">

                                <!-- Mobile -->
                                <div class="tiny-card">
                                    <!-- Title Group -->
                                    <div class="tiny-card__section">
                                        <div class="avatar avatar--small">
                                            <div class="avatar__image-area">
                                                <img <?php afloat_image_markup($image['id'], 'portrait-small', array('portrait-small')); ?>>
                                            </div>
                                            <div class="avatar__title-group">
                                                <div class="avatar__title-group__title">
                                                    <?php echo $title; ?>
                                                </div>
                                                <div class="avatar__title-group__sub">
                                                    Avg Length: <?php echo $length; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tiny-card__section">

                                        <!-- CTA -->
                                        <a class="cta-square-icon" href="<?php echo $landing_page; ?>">
                                            Explore
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>


                                <!-- Desktop -->
                                <div class="resource-card medium encapsulated ">
                                    <!-- Images Slider -->
                                    <a class="resource-card__image-area" href="<?php echo $landing_page; ?>">
                                        <img <?php afloat_image_markup($image['id'], 'landscape-small', array('landscape-small', 'portrait-small')); ?>>
                                    </a>

                                    <!-- Content -->
                                    <div class="resource-card__content">

                                        <!-- Title -->
                                        <h3 class="resource-card__content__title">
                                            <a href="<?php echo $landing_page; ?>">
                                                <?php echo $title; ?>
                                            </a>
                                        </h3>

                                        <!-- Description -->
                                        <div class="resource-card__content__description divider">
                                            <?php echo $description; ?>
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
                                                    Avg Length: <?php echo $length; ?>
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
                                                    Embarkation Ports: <?php echo $portsDisplay; ?>
                                                </div>
                                            </div>


                                            <!-- Destinations -->
                                            <div class="specs-item">
                                                <div class="specs-item__icon">
                                                    <svg>
                                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-e"></use>
                                                    </svg>
                                                </div>
                                                <div class="specs-item__text">
                                                    Sites: <?php echo $destinations; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Price Group -->
                                        <div class="resource-card__content__bottom">
                                            <div class="resource-card__content__bottom__price-group">
                                                <div class="resource-card__content__bottom__price-group__amount">
                                                    <?php priceFormat($price_low);  ?> - <?php priceFormat($price_high); ?>
                                                </div>
                                                <div class="resource-card__content__bottom__price-group__text">
                                                    Per Person
                                                </div>
                                            </div>

                                            <!-- CTA -->
                                            <div class="resource-card__content__bottom__cta">
                                                <a class="cta-square-icon" href="<?php echo $landing_page; ?>">
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
                    <!-- Sample Item -->
                    <div class="map-legend__sample">
                        Sample
                    </div>
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