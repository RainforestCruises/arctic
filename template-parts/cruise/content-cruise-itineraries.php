<?php
$itineraries = get_field('itineraries');
$curentYear = date("Y");
?>

<!-- Itineraries -->
<section class="cruise-itineraries" id="section-itineraries">
    <div class="cruise-itineraries__content">

        <div class="cruise-itineraries__content__top">
            <div class="title-group">
                <div class="title-group__title">
                    Itineraries
                </div>
                <div class="title-group__sub">
                    There are <?php echo count($itineraries); ?> itineraries available
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
                            $embarkation = get_the_title($embarkation_point);
                            $days = get_field('itinerary', $itinerary);
                            $static_price = get_field('static_price', $itinerary);

                            $destinations = getItineraryDestinations($itinerary);
                    
                            //build list of unique, with embarkations removed
                            $title = get_field('display_name',$itinerary);
                            $length_in_nights = get_field('length_in_nights',$itinerary);
                            $top_snippet = get_field('top_snippet', $itinerary);
                            $link = get_the_permalink($itinerary);
                            $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';
                        ?>

                            <!-- Itinerary Card -->
                            <div class="cruise-itineraries__content__main__detail-area__slider__slide swiper-slide" slideIndex="<?php echo $count ?>" postId="<?php echo $id ?>">
                                <div class="resource-card small encapsulated ">

                                    <!-- Images Slider -->
                                    <div class="resource-card__image-area">
                                        <img <?php afloat_image_markup($hero_image['id'], 'landscape-small', array('landscape-small', 'portrait-small')); ?>>
                                    </div>

                                    <!-- Content -->
                                    <div class="resource-card__content">

                                        <!-- Title -->
                                        <div class="resource-card__content__title-group">
                                            <div class="resource-card__content__title-group__title">
                                                <?php echo $title; ?>
                                            </div>
                                            <div class="resource-card__content__title-group__sub">

                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="resource-card__content__description divider">
                                            <?php echo $top_snippet; ?>
                                        </div>

                                        <!-- Specs -->
                                        <div class="resource-card__content__specs bottom-margin">

                                            <!-- Length -->
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

                                            <!-- Embark -->
                                            <div class="resource-card__content__specs__item">
                                                <div class="resource-card__content__specs__item__icon">
                                                    <svg>
                                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-in"></use>
                                                    </svg>
                                                </div>
                                                <div class="resource-card__content__specs__item__text">
                                                    Embarkation: <?php echo $embarkation; ?>
                                                </div>
                                            </div>

                                            <!-- Destinations -->
                                            <div class="resource-card__content__specs__item">
                                                <div class="resource-card__content__specs__item__icon">
                                                    <svg>
                                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-e"></use>
                                                    </svg>
                                                </div>
                                                <div class="resource-card__content__specs__item__text">
                                                    <?php echo $destinations; ?>
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

                                        <!-- CTA -->
                                        <div class="resource-card__content__cta">
                                            <a class="cta-square-icon" href="<?php echo $link; ?>">
                                                Explore
                                                <svg>
                                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                                </svg>
                                            </a>
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
            <!-- Nav Area -->
            <div class="cruise-itineraries__content__main__nav-area">
                <div class="cruise-itineraries__content__main__nav-area__slider swiper" id="itineraries-slider-nav">
                    <div class="swiper-wrapper">
                        <?php $count = 0;
                        foreach ($itineraries as $itinerary) :
                            $id = $itinerary->ID;
                            $title = get_field('display_name',$itinerary);
                            $length = get_field('length_in_nights',$itinerary) + 1 . ' Days';

                        ?>
                            <div class="cruise-itineraries__content__main__nav-area__slider__item swiper-slide" slideIndex="<?php echo $count ?>" postId="<?php echo $id ?>">
                                <button class="cruise-itineraries__content__main__nav-area__slider__item__button">
                                    <div class="cruise-itineraries__content__main__nav-area__slider__item__button__title">
                                        <?php echo $title; ?>
                                    </div>
                                    <div class="cruise-itineraries__content__main__nav-area__slider__item__button__length">
                                        <?php echo $length; ?>
                                    </div>

                                </button>
                            </div>

                        <?php $count++;
                        endforeach; ?>
                    </div>
        
                </div>
            </div>
            <!-- Map Area -->
            <div class="cruise-itineraries__content__main__map-area">
                <div class="cruise-itineraries__content__main__map-area__map" id="map-01"></div>
            </div>

            <?php  ?>
        </div>


    </div>
</section>