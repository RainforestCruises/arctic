<?php

$title = get_field('display_name');
$snippet = get_field('top_snippet');
$length = get_field('length_in_nights') + 1;
$lowestOverallPrice = $args['lowestOverallPrice'];
$bestOverallDiscount = $args['bestOverallDiscount'];
$shipSizeRange = $args['shipSizeRange'];
$deals = $args['deals'];
$specialDepartures = $args['specialDepartures'];
$images = get_field('hero_gallery');
$desktopImages = array_slice($images, 1); //for gallery desktop slider
$fly_category = getFlightOption(get_post());



?>

<!-- Itinerary Hero -->
<section class="product-hero" id="top">
    <!-- Desktop BG Image -->
    <div class="product-hero__bg-image">
        <img <?php afloat_image_markup($images[0]['id'], 'landscape-full', array('landscape-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?> class="optimole-initial">
    </div>

    <!-- Desktop Gallery -->
    <div class="product-hero__gallery">

        <!-- Nav -->
        <div class="product-hero__gallery__nav">
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
        <div class="product-hero__gallery__slider swiper" id="hero-desktop-slider">
            <div class="swiper-wrapper">
                <?php
                foreach ($desktopImages as $image) : ?>
                    <div class="product-hero__gallery__slider__item swiper-slide" imageId="<?php echo $image['id']; ?>">
                        <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Mobile Slider BG -->
    <div class="product-hero__bg-slider swiper" id="hero-mobile-slider">
        <div class="swiper-wrapper">

            <!-- Gallery Images -->
            <?php
            $count = 0;
            foreach ($images as $image) : ?>
                <div class="product-hero__bg-slider__slide swiper-slide " imageId="<?php echo $image['id']; ?>">
                    <img <?php afloat_image_markup($image['id'], 'landscape-full', array('landscape-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?> class="<?php echo $count == 0 ? "optimole-initial" : ""; ?>">
                </div>
            <?php $count++;
            endforeach; ?>

        </div>
        <div class="swiper-pagination"></div>
        <div class="product-hero__bg-slider__count">
            <?php echo '1 / ' . (count($images)) ?>
        </div>
    </div>

    <!-- Hero Content -->
    <div class="product-hero__content">
        <div class="product-hero__content__main">
            <!-- Primary (Title + Description) -->
            <div class="product-hero__content__main__primary">



                <div class="product-hero__content__main__primary__badge-area">
                    <?php if ($fly_category) : ?>
                        <span class="product-hero-badge product-hero-badge--fly">
                            <?php echo $fly_category; ?>
                        </span>
                    <?php endif; ?>
                    <?php if ($deals) : ?>
                        <a class="product-hero-badge product-hero-badge--deal" href="#deals">
                            <?php echo getDealsDisplay($deals); ?> Available
                        </a>
                    <?php endif; ?>
                    <?php if ($specialDepartures) : ?>
                        <a class="product-hero-badge product-hero-badge--special" href="#deals">
                            <?php echo getDealsDisplay($specialDepartures, true); ?> Available
                        </a>
                    <?php endif; ?>
                </div>


                <h1 class="product-hero__content__main__primary__title">
                    <?php echo $title ?>
                </h1>
                <div class="product-hero__content__main__primary__snippet">
                    <?php echo $snippet; ?>
                </div>
                <div class="product-hero__content__main__primary__nav">
                    <a href="#highlights" class="product-hero__content__main__primary__nav__link">Highlights</a>
                    <a href="#itinerary" class="product-hero__content__main__primary__nav__link">Itinerary</a>
                    <a href="#map" class="product-hero__content__main__primary__nav__link">Map</a>
                    <a href="#dates" class="product-hero__content__main__primary__nav__link">Dates</a>
                    <a href="#extras" class="product-hero__content__main__primary__nav__link">Extras</a>
                </div>
            </div>

            <!-- Secondary (Info + Attributes) -->
            <div class="product-hero__content__main__secondary">

                <!-- Info -->
                <div class="product-hero__content__main__secondary__info">

                    <!-- Starting Price -->
                    <div class="product-hero__content__main__secondary__info__starting-price">
                        <div class="product-hero__content__main__secondary__info__starting-price__title-area">
                            <div class="product-hero__content__main__secondary__info__starting-price__title-area__text">
                                Starting at:
                            </div>
                            <div class="product-hero__content__main__secondary__info__starting-price__title-area__subtext">
                                Per Person
                            </div>
                        </div>
                        <div class="product-hero__content__main__secondary__info__starting-price__amount">
                            <div class="product-hero__content__main__secondary__info__starting-price__amount__text">
                                <?php priceFormat($lowestOverallPrice); ?>
                            </div>
                            <?php if ($bestOverallDiscount) : ?>
                                <div class="product-hero__content__main__secondary__info__starting-price__amount__discount">
                                    Up to <span class="green-text"><?php echo $bestOverallDiscount; ?>%</span> savings
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Inquire CTA Button -->
                    <div class="product-hero__content__main__secondary__info__cta">
                        <button class="cta-primary generic-inquire-cta">
                            Inquire
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
                            </svg>
                        </button>
                    </div>

                </div>

                <!-- Attributes -->
                <div class="product-hero__content__main__secondary__attributes">

                    <!-- Length -->
                    <div class="product-hero__content__main__secondary__attributes__item">
                        <div class="product-hero__content__main__secondary__attributes__item__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-stopwatch"></use>
                            </svg>
                        </div>
                        <div class="product-hero__content__main__secondary__attributes__item__text">
                            <div class="sub-attribute">
                                Length
                            </div>
                            <?php echo $length . " Days"; ?>

                        </div>
                    </div>


                    <!-- Embarkation -->
                    <?php $embarkation_is_flight = get_field('embarkation_is_flight', $itinerary); ?>
                    <div class="product-hero__content__main__secondary__attributes__item">
                        <div class="product-hero__content__main__secondary__attributes__item__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-<?php echo  $embarkation_is_flight ? 'plane' : 'boat'; ?>"></use>
                            </svg>
                        </div>
                        <div class="product-hero__content__main__secondary__attributes__item__text">
                            <div class="sub-attribute">
                                Embark
                            </div>
                            <?php
                            $embarkation_point = get_field('embarkation_point', $itinerary);
                            echo get_the_title($embarkation_point);
                            ?>
                        </div>
                    </div>

                    <!-- DisEmbarkation -->
                    <?php $disembarkation_is_flight = get_field('disembarkation_is_flight', $itinerary); ?>
                    <div class="product-hero__content__main__secondary__attributes__item">
                        <div class="product-hero__content__main__secondary__attributes__item__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-<?php echo  $disembarkation_is_flight ? 'plane' : 'boat'; ?>"></use>
                            </svg>
                        </div>
                        <div class="product-hero__content__main__secondary__attributes__item__text">
                            <div class="sub-attribute">
                                Disembark
                            </div>

                            <?php
                            $disembarkation_point = get_field('disembarkation_point', $itinerary) ?: $embarkation_point;
                            echo get_the_title($disembarkation_point);
                            ?>

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
            <div class="mobile-info__starting-price__amount__text">
                <?php priceFormat($lowestOverallPrice); ?>

            </div>


            <?php if ($bestOverallDiscount) : ?>
                <div class="mobile-info__starting-price__amount__discount">
                    Up to <span class="green-text"><?php echo $bestOverallDiscount; ?>%</span> savings
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Inquire CTA Button -->
    <div class="mobile-info__cta">
        <button class="cta-primary generic-inquire-cta">
            Inquire
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
            </svg>
        </button>
    </div>
</div>