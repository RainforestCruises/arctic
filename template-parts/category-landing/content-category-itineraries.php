<?php
$itineraries = get_field('itineraries');
?>


<section class="slider-block" section="section-itineraries">
    <div class="slider-block__content product-related__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <div class="title-group__title">
                    Itineraries
                </div>
                <div class="title-group__sub">
                    Explore from <?php echo count($itineraries) ?> itineraries
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
                        $link = get_the_permalink($itinerary);
                        $static_price = get_field('static_price', $itinerary);

                    ?>

                        <!-- Overlay Card -->
                        <div class="overlay-card swiper-slide">
                            <div class="overlay-card__image-area">
                                <div class="overlay-card__image-area__item ">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                                </div>
                            </div>
                            <a class="overlay-card__content" href="<?php echo $link; ?>">
                                <div class="overlay-card__content__title-section">
                                    <div class="overlay-card__content__title-section__sub">
                                        <?php echo "$ " . number_format($static_price, 0);  ?> Per Person
                                    </div>
                                    <div class="overlay-card__content__title-section__title">
                                        <?php echo $title ?>
                                    </div>
                                </div>
                                <div class="overlay-card__content__cta">

                                </div>
                            </a>
                        </div>

                    <?php $index++;
                    endforeach; ?>
                </div>
            </div>


        </div>
    </div>
</section>