<?php
$queryArgs = array(
    'post_type' => get_post_type(),
    'posts_per_page' => -1,
    'post__not_in' => array($post->ID),
    'meta_key' => 'search_rank',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',

);


//build meta query criteria
$queryArgsDestination = array();
$queryArgsDestination['relation'] = 'OR';

$destinations = get_field('destinations');
if ($destinations) {
    foreach ($destinations as $d) {
        if (get_field('is_country', $d) == true) {
            $queryArgsDestination[] = array(
                'key'     => 'destinations',
                'value'   => serialize(strval($d->ID)),
                'compare' => 'LIKE'
            );
        }
    }
    $queryArgs['meta_query'][] = $queryArgsDestination;
}


$itineraries = get_posts($queryArgs);

?>






<section class="slider-block narrow product-related">
    <div class="slider-block__content product-related__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-group__title">
                    Related Itineraries
                </div>
                <div class="title-group__sub">
                    Explore these <?php echo count($itineraries) ?> related itineraries
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


                    <?php foreach ($itineraries as $itinerary) :
                        $images =  get_field('hero_gallery', $itinerary);
                        $itineraries =  get_field('itineraries', $itinerary);
                        $title = get_field('display_name', $itinerary);
                        $static_price = get_field('static_price', $itinerary);
                        $days = get_field('itinerary', $itinerary);
                        $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';
                        $embarkation_point = get_field('embarkation_point', $itinerary);
                        $embarkation = get_the_title($embarkation_point);
                        $shipsDisplay = getItineraryShips($itinerary);
                        $destinations = getItineraryDestinations($itinerary);

                        $itineraryDisplay = itineraryRange($itineraries, "-") . " Days, " . count($itineraries) . ' Itineraries';
                        $guestsDisplay = get_field('vessel_capacity', $itinerary) . ' Guests, ' . 'Luxury';
                    ?>

                        <!-- Itinerary Card -->
                        <div class="resource-card swiper-slide">

                            <!-- Images Slider -->
                            <div class="resource-card__image-area swiper related-card-image-area">
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
                                        <?php echo "$ " . number_format($static_price, 0);  ?>

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



        </div>
    </div>
</section>