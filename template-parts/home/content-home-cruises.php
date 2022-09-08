<?php
$newest_ships = get_field('newest_ships');
?>


<section class="slider-block">
    <div class="slider-block__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-single">
                    Newest Cruises
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">

                <div class="swiper-button-prev swiper-button-prev--white-border cruises-slider-btn-prev"></div>
                <div class="swiper-button-next swiper-button-next--white-border cruises-slider-btn-next"></div>

            </div>
        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <!-- Swiper -->
            <div class="swiper" id="cruises-slider">
                <div class="swiper-wrapper">

                    <?php 
                    $index = 0;
                    foreach ($newest_ships as $ship) :
                        $images =  get_field('hero_gallery', $ship);
                        $title = get_the_title($ship);
                        $link = get_the_permalink($ship);
                    ?>

                        <!-- Overlay Card -->
                        <div class="overlay-card swiper-slide">
                            <div class="overlay-card__image-area swiper cruise-card-image-area cruise-card-image-area-<?php echo $index ?>">
                                <div class="swiper-wrapper">
                                    <?php foreach ($images as $image) : ?>
                                        <div class="overlay-card__image-area__item swiper-slide">
                                            <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                            <a class="overlay-card__content" href="<?php echo $link; ?>">
                                <div class="overlay-card__content__title-section">
                                    <div class="overlay-card__content__title-section__sub">
                                        $2995 Per Person
                                    </div>
                                    <div class="overlay-card__content__title-section__title">
                                        <?php echo $title ?>
                                    </div>
                                </div>
                                <div class="overlay-card__content__cta">
                                   
                                </div>
                            </a>
                            <div class="swiper-pagination cruise-card-image-area-pagination-<?php echo $index ?>"></div>
                            <div class="swiper-button-prev swiper-button-prev--white cruise-card-image-area-button-prev-<?php echo $index ?>"></div>
                            <div class="swiper-button-next swiper-button-next--white cruise-card-image-area-button-next-<?php echo $index ?>"></div>
                        </div>

                    <?php $index++; endforeach; ?>
                </div>
            </div>



        </div>
    </div>
</section>