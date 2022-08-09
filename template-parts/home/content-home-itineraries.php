<?php
$itineraries = get_field('itineraries');
?>


<div class="home-itineraries">
    <div class="home-itineraries__content">

        <!-- Title Group -->
        <div class="title-single">
            Popular Itineraries
        </div>

        <div class="home-itineraries__content__slider swiper" id="itineraries-slider">

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
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    </div>
</div>