<?php

$title = get_the_title();
$snippet = get_field('top_snippet');
$itineraryCount = count($args['cruise_data']['Itineraries']);
$images = get_field('hero_gallery');
$desktopImages = array_slice($images, 1);

?>

<!-- Cruise Hero -->
<section class="cruise-hero" id="top">
    <!-- Desktop BG Image -->
    <div class="cruise-hero__bg-image">
        <img <?php afloat_image_markup($images[0]['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
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
                foreach ($desktopImages as $image) : ?>
                    <div class="cruise-hero__gallery__slider__item swiper-slide" imageId="<?php echo $image['id']; ?>">
                        <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <!-- Mobile Slider BG -->
    <div class="cruise-hero__bg-slider swiper" id="hero-mobile-slider">
        <div class="swiper-wrapper">
            <!-- Gallery Images -->
            <?php foreach ($images as $image) : ?>
                <div class="cruise-hero__bg-slider__slide swiper-slide" imageId="<?php echo $image['id']; ?>">
                    <img <?php afloat_image_markup($image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-prev cruise-hero__bg-slider__button-prev"></div>
        <div class="swiper-button-next cruise-hero__bg-slider__button-next"></div>
        <div class="cruise-hero__bg-slider__count">
            <?php echo '1 / ' . (count($images) + 1) ?>
        </div>
    </div>


    <!-- Hero Content -->
    <div class="cruise-hero__content">
        <div class="cruise-hero__content__main">
            <!-- Primary (Title + Description) -->
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

            <!-- Secondary (Info + Attributes) -->
            <div class="cruise-hero__content__main__secondary">

                <!-- Info -->
                <div class="cruise-hero__content__main__secondary__info">

                    <!-- Starting Price -->
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
                        <button class="cta-primary inquire-cta">
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
                            <?php echo get_field('vessel_capacity') . ' Guests'; ?>
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



<!-- Mobile Info -->
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
        <button class="cta-primary inquire-cta">
            Inquire
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
            </svg>
        </button>
    </div>
</div>


<!-- Cruise Gallery Modal -->
<div class="modal modal--gallery" id="cruiseGalleryModal">
    <div class="modal__content cruise-gallery">

        <!-- Top Section -->
        <div class="cruise-gallery__top">
            <button class="btn-text-icon close-modal-button">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
            <span id="cruiseGalleryModalTitle">Title</span>
            <span id="cruiseGalleryModalCount">Count</span>
        </div>

        <!-- Main Slider -->
        <div class="cruise-gallery__main">
            <div class="cruise-gallery__main__slider swiper noselect" id="modal-gallery-main">
                <div class="swiper-wrapper">

                    <?php
                    $count = 1;
                    foreach ($images as $image) : ?>
                        <div class="cruise-gallery__main__slider__item swiper-slide" slideIndex="<?php echo $count; ?>" imageId="<?php echo $image['id']; ?>" title="<?php echo $image['title']; ?>">
                            <img <?php afloat_image_markup($image['id'], 'landscape-medium', array('landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
                        </div>
                    <?php $count++;
                    endforeach; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <!-- Nav Slider -->
        <div class="cruise-gallery__nav">

            <div class="cruise-gallery__nav__slider swiper noselect" id="modal-gallery-nav">
                <div class="swiper-wrapper">
                    <?php foreach ($images as $image) : ?>
                        <div class="cruise-gallery__nav__slider__item swiper-slide">
                            <img <?php afloat_image_markup($image['id'], 'landscape-small', array('landscape-small')); ?>>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>
</div>