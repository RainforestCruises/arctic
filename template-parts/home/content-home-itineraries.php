<?php
$itineraries = get_field('itineraries');
?>


<div class="home-itineraries">
    <div class="home-itineraries__content">


        <div class="home-itineraries__content__top">

            <div class="home-itineraries__content__top__title">
                <div class="title-single">
                    Popular Itineraries
                </div>
            </div>

            <div class="home-itineraries__content__top__nav">
                <!-- navigation buttons -->
                <div class="swiper-button-custom swiper-button-custom__prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
                <div class="swiper-button-custom swiper-button-custom__next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>
        </div>

        <div class="home-itineraries__content__slider">

            <!-- Swiper -->
            <div class="swiper" id="itineraries-slider">
                <div class="swiper-wrapper">

                    <?php foreach ($itineraries as $itinerary) :
                        $image =  get_field('hero_image_portrait', $itinerary);
                        $title = get_the_title($itinerary);
                        $link = get_the_permalink($itinerary);
                    ?>

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
                                <div class="overlay-card__content__cta">
                                    <button class="cta-primary cta-primary--white">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </a>

                    <?php endforeach; ?>
                </div>
            </div>



        </div>
    </div>