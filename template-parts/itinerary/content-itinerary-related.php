<?php
$queryArgs = array(
    'post_type' => get_post_type(),
    'posts_per_page' => -1,
    'post__not_in' => array($post->ID),
    'meta_key' => 'search_rank',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
);

$queryArgsRoute = array();
$queryArgsRoute['relation'] = 'OR';

$routes = get_field('route');
if ($routes) {
    foreach ($routes as $route) {
        $queryArgsRoute[] = array(
            'key'     => 'route',
            'value'   => serialize(strval($route->ID)),
            'compare' => 'LIKE'
        );
    }
    $queryArgs['meta_query'][] = $queryArgsRoute;
}

$itineraries = get_posts($queryArgs);
?>


<section class="slider-block narrow product-related">
    <div class="slider-block__content product-related__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <h2 class="title-group__title">
                    Related Itineraries
                </h2>
                <div class="title-group__sub">
                    Explore these similar Antarctica itineraries
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">

                <div class="swiper-button-prev swiper-button-prev--white-border related-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border related-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>

            </div>
        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <!-- Swiper -->
            <div class="swiper" id="related-slider">
                <div class="swiper-wrapper">


                    <?php
                    $count = 0;
                    foreach ($itineraries as $itinerary) :
                        if ($count > 11) {
                            continue;
                        }
                        $departures = getDepartureList($itinerary);
                        $lowestPrice = getLowestDepartureListPrice($departures);
                        $highestPrice = getHighestDepartureListPrice($departures);
                        $bestOverallDiscount = getBestDepartureListDiscount($departures);
                        if (!$lowestPrice) {
                            continue;
                        }
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
                        console_log($shipsDisplay);
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
                            <a class="resource-card__image-area swiper related-card-image-area" href="<?php echo get_permalink($itinerary) ?>">
                                <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                            </a>

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