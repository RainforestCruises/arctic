<?php
$itineraries = get_field('itineraries');
?>


<div class="slider-block">
    <div class="slider-block__content">


        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-single">
                    Popular Itineraries
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">

                <!-- Prev -->
                <div class="itineraries-slider-btn-prev btn-swiper btn-swiper__prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
                <!-- Next -->
                <div class="itineraries-slider-btn-next btn-swiper btn-swiper__next">
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

                    <?php foreach ($itineraries as $itinerary) :
                        $image =  get_field('hero_image_portrait', $itinerary);
                        $title = get_the_title($itinerary);
                        $link = get_the_permalink($itinerary);
                    ?>

                        <!-- Overlay Card -->
                        <a class="overlay-card swiper-slide" href="<?php echo $link; ?>">
                            <div class="overlay-card__image-area">
                                <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                            </div>
                            <div class="overlay-card__content">
                                <div class="overlay-card__content__title-section">
                                    <div class="overlay-card__content__title-section__sub">
                                        $2995 Per Person
                                    </div>
                                    <div class="overlay-card__content__title-section__title">
                                        <?php echo $title ?>
                                    </div>
                                </div>
                               
                            </div>
                        </a>

                    <?php endforeach; ?>
                </div>
            </div>



        </div>
    </div>