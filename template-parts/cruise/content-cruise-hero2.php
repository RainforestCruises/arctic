<?php

$title = get_the_title();
$snippet = get_field('top_snippet');

$itineraryCount = count($args['cruise_data']['Itineraries']);

$hero_image = get_field('hero_image');
$images = get_field('hero_gallery');

?>

<!-- Cruise Hero -->
<section class="cruise-hero" id="top">
    <!-- Desktop BG Image -->
    <div class="cruise-hero__bg-image">
        <img <?php afloat_image_markup($hero_image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
    </div>

    <!-- Desktop Gallery -->
    <div class="cruise-hero__gallery">

        <!-- Nav -->
        <div class="cruise-hero__gallery__nav">
            <!-- Prev -->
            <div class="hero-gallery-slider-prev btn-swiper-blur btn-swiper-blur__prev">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </div>
            <!-- Next -->
            <div class="hero-gallery-slider-next btn-swiper-blur btn-swiper-blur__next">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </div>
        </div>

        <!-- Desktop Slider -->
        <div class="cruise-hero__gallery__slider swiper" id="hero-desktop-slider">
            <div class="swiper-wrapper">
                <?php
                if ($images) :
                    foreach ($images as $image) : ?>
                        <div class="cruise-hero__gallery__slider__item swiper-slide">
                            <a href="<?php echo esc_url($image['url']); ?>" title="test title" class="cruise-hero__gallery__slider__item__link">
                                <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                            </a>
                        </div>
                <?php endforeach;
                endif; ?>
            </div>
        </div>
    </div>



    <!-- Mobile Slider BG -->
    <div class="cruise-hero__bg-slider swiper" id="hero-mobile-slider">
        <div class="swiper-wrapper">
            <!-- First Image -->
            <a class="cruise-hero__bg-slider__slide swiper-slide" href="<?php echo esc_url($hero_image['url']); ?>" title="test title">
                <img <?php afloat_image_markup($hero_image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
            </a>
            <!-- Gallery Images -->
            <?php
            if ($images) :
                foreach ($images as $image) : ?>
                    <a class="cruise-hero__bg-slider__slide swiper-slide" href="<?php echo esc_url($image['url']); ?>" title="test title">
                        <img <?php afloat_image_markup($image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
                    </a>
            <?php endforeach;
            endif; ?>
        </div>
        <div class="swiper-button-prev cruise-hero__bg-slider__button-prev"></div>
        <div class="swiper-button-next cruise-hero__bg-slider__button-next"></div>
        <div class="cruise-hero__bg-slider__count">
            <?php echo '1 / ' . (count($images) + 1)?>
        </div>
    </div>



    <div class="cruise-hero__content">
        <div class="cruise-hero__content__main">
            <div class="cruise-hero__content__main__primary">
                <div class="cruise-hero__content__main__primary__title">
                    <?php echo $title ?>
                </div>
                <div class="cruise-hero__content__main__primary__snippet">
                    <?php echo $snippet; ?>
                </div>
                <div class="cruise-hero__content__main__primary__nav">
                    <a href="#overview" class="cruise-hero__content__main__primary__nav__link">Cabins</a>
                    <a href="#overview" class="cruise-hero__content__main__primary__nav__link">Itineraries</a>
                    <a href="#overview" class="cruise-hero__content__main__primary__nav__link">Dates</a>
                    <a href="#overview" class="cruise-hero__content__main__primary__nav__link">Reviews</a>
                </div>
            </div>
            <div class="cruise-hero__content__main__secondary">

                <!-- Starting Price -->
                <div class="cruise-hero__content__main__secondary__info">

                    <div class="cruise-hero__content__main__secondary__info__starting-price">
                        <div class="cruise-hero__content__main__secondary__info__starting-price__title-area">

                            <div class="cruise-hero__content__main__secondary__info__starting-price__title-area__text">
                                Starting at:
                            </div>
                            <div class="cruise-hero__content__main__secondary__info__starting-price__title-area__subtext">
                                Per Person
                            </div>
                        </div>
                        <div class="cruise-hero__content__main__secondary__info__starting-price__amount">
                            <?php echo "$" . number_format($args['lowestPrice'], 0); ?>
                            <span class="u-small-text">USD</span>
                        </div>

                    </div>

                    <!-- Inquire CTA Button -->
                    <div class="cruise-hero__content__main__secondary__info__cta">
                        <button class="cta-primary  " id="nav-page-cta">
                            Inquire
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Attributes -->
                <div class="cruise-hero__content__main__secondary__attributes">

                    <!-- Itineraries -->
                    <div class="cruise-hero__content__main__secondary__attributes__item">
                        <div class="cruise-hero__content__main__secondary__attributes__item__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                            </svg>
                        </div>
                        <div class="cruise-hero__content__main__secondary__attributes__item__text">
                            <div class="sub-attribute">
                                <?php echo $itineraryCount ?> Itineraries
                            </div>

                            <?php echo itineraryRange($args['cruise_data'], " - ") . " Days"; ?>

                        </div>

                    </div>

                    <!-- Capacity -->
                    <div class="cruise-hero__content__main__secondary__attributes__item">

                        <div class="cruise-hero__content__main__secondary__attributes__item__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                            </svg>
                        </div>
                        <div class="cruise-hero__content__main__secondary__attributes__item__text">
                            <div class="sub-attribute">
                                Ship Size
                            </div>
                            <?php echo get_field('vessel_capacity', $cruisePost) . ' Guests'; ?>
                        </div>


                    </div>
                    <!-- Service Level -->
                    <div class="cruise-hero__content__main__secondary__attributes__item">


                        <div class="cruise-hero__content__main__secondary__attributes__item__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-3"></use>
                            </svg>
                        </div>
                        <div class="cruise-hero__content__main__secondary__attributes__item__text">
                            <div class="sub-attribute">
                                Service Level
                            </div>
                            Luxury
                        </div>

                    </div>




                </div>

            </div>
        </div>



    </div>
</section>


<div class="mobile-info">

    <div class="mobile-info__starting-price">
        <div class="mobile-info__starting-price__title-area">

            <div class="mobile-info__starting-price__title-area__text">
                Starting at:
            </div>
            <div class="mobile-info__starting-price__title-area__subtext">
                Per Person
            </div>
        </div>
        <div class="mobile-info__starting-price__amount">
            <?php echo "$" . number_format($args['lowestPrice'], 0); ?>
            <span class="u-small-text">USD</span>
        </div>

    </div>

    <!-- Inquire CTA Button -->
    <div class="mobile-info__cta">
        <button class="cta-primary  " id="nav-page-cta">
            Inquire
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
            </svg>
        </button>
    </div>
</div>