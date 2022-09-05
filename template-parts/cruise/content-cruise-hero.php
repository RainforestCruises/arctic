<?php
$hero_image = get_field('hero_image');
$productTitle = get_the_title();
$breadcrumb = get_field('breadcrumb');



$itineraryCount = count($args['cruise_data']['Itineraries']);
$images = get_field('hero_gallery');

?>

<!-- Cruise Hero -->
<section class="product-hero" id="top">
    <div class="product-hero__content">

        <!-- Top Section -->

        <div class="product-hero__content__top-slider swiper" id="hero-bg-slider">
            <div class="swiper-wrapper">
                <div class="product-hero__content__top-slider__item swiper-slide">
                    <a href="<?php echo esc_url($hero_image['url']); ?>" title="test title" class="product-hero__content__top-slider__item__link">
                        <img <?php afloat_image_markup($hero_image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
                    </a>
                </div>
                <?php
                if ($images) :
                    foreach ($images as $image) : ?>
                        <div class="product-hero__content__top-slider__item swiper-slide">
                            <a href="<?php echo esc_url($image['url']); ?>" title="test title" class="product-hero__content__top-slider__item__link">
                                <img <?php afloat_image_markup($image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
                            </a>
                        </div>
                <?php endforeach;
                endif; ?>

            </div>
        </div>

        <!-- Top Desktop -->
        <div class="product-hero__content__top">
            <div class="product-hero__content__top__bg" id="top">
                <img <?php afloat_image_markup($hero_image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
            </div>

            <!-- Title / Navigation -->
            <div class="product-hero__content__top__content">

                <!-- Breadcrumb -->
                <ol class="product-hero__content__top__content__breadcrumb">
                    <li>
                        <a href="<?php echo home_url() ?>">Home</a>
                    </li>
                    <?php
                    if ($breadcrumb) :
                        foreach ($breadcrumb as $b) :
                            if ($b['link'] != null) : ?>
                                <li>
                                    <a href=" <?php echo $b['link']  ?>"><?php echo $b['title'] ?></a>
                                </li>
                            <?php else : ?>
                                <li>
                                    <?php echo $b['title'] ?>
                                </li>
                    <?php endif;
                        endforeach;
                    endif; ?>

                </ol>

                <!-- Title and Navigation -->
                <div>
                    <!-- H1 Title / Subtitle -->
                    <div class="product-hero__content__top__content__title-group">

                        <h1 class="product-hero__content__top__content__title-group__title" id="template-nav-title">
                            <div>
                                <?php echo $productTitle ?>
                            </div>
                            <?php if ($args['hasDeals'] == true) : ?>
                                <button class="btn-cta-round btn-cta-round--small btn-cta-round--green deal-modal-cta-button" style="height: 2.5rem;">
                                    Deals
                                </button>
                            <?php endif; ?>
                        </h1>
                        <div class="product-hero__content__top__content__title-group__subtitle"><?php echo get_field('top_snippet') ?></div>
                    </div>

                    <!-- Navigation Wrapper -->
                    <nav class="product-hero__content__top__content__nav" id="template-nav">

                        <!-- nav list -->
                        <ul class="product-hero__content__top__content__nav__list">

                            <li class="product-hero__content__top__content__nav__list__item current">
                                <a href="#overview" class="product-hero__content__top__content__nav__list__item__link page-nav-template">Overview</a>
                            </li>
                            <li class="product-hero__content__top__content__nav__list__item">
                                <a href="#amenities" class="product-hero__content__top__content__nav__list__item__link page-nav-template">Amenities</a>
                            </li>
                            <li class="product-hero__content__top__content__nav__list__item">
                                <a href="#itineraries" class="product-hero__content__top__content__nav__list__item__link page-nav-template">Itineraries</a>
                            </li>

                            <li class="product-hero__content__top__content__nav__list__item ">
                                <a href="#reviews" class="product-hero__content__top__content__nav__list__item__link page-nav-template">Reviews</a>
                            </li>

                        </ul>
                    </nav>

                    <!-- Mobile scroll down CTA -->
                    <div class="product-hero__content__top__content__cta">
                        <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="<?php echo (get_post_type() != 'rfc_tours') ? '#overview' : '#itineraries'; ?>">
                            <svg class="btn-circle--arrow-main">
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                            </svg>
                            <svg class="btn-circle--arrow-animate">
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Gallery  -->
        <div class="product-hero__content__gallery">

            <div class="product-hero__content__gallery__nav">
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

            <div class="product-hero__content__gallery__slider swiper" id="hero-gallery">
                <div class="swiper-wrapper">
                    <?php
                    if ($images) :
                        foreach ($images as $image) : ?>
                            <div class="product-hero__content__gallery__slider__item swiper-slide">
                                <a href="<?php echo esc_url($image['url']); ?>" title="test title" class="product-hero__content__gallery__slider__item__link">
                                    <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                </a>
                            </div>
                    <?php endforeach;
                    endif; ?>
                </div>



            </div>
        </div>

        <!-- Bottom Section -->
        <div class="product-hero__content__bottom">

            <!-- Info Area -->
            <div class="product-hero__content__bottom__content">
                <div class="product-hero__content__bottom__content__info-group" id="info-group">

                    <!-- Starting Price -->
                    <div class="product-hero__content__bottom__content__info-group__info" id="page-title">

                        <div class="product-hero__content__bottom__content__info-group__info__starting-price">
                            <div class="product-hero__content__bottom__content__info-group__info__starting-price__title-area">

                                <div class="product-hero__content__bottom__content__info-group__info__starting-price__title-area__text">
                                    Starting at:
                                </div>
                                <div class="product-hero__content__bottom__content__info-group__info__starting-price__title-area__subtext">
                                    Per Person
                                </div>
                            </div>
                            <div class="product-hero__content__bottom__content__info-group__info__starting-price__amount">
                                <?php echo "$" . number_format($args['lowestPrice'], 0); ?>
                                <span class="u-small-text">USD</span>
                            </div>

                        </div>

                        <!-- Inquire CTA Button -->
                        <div class="product-hero__content__bottom__content__info-group__info__cta">
                            <button class="cta-primary  " id="nav-page-cta">
                                Inquire
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Attributes -->
                    <div class="product-hero__content__bottom__content__info-group__attributes">

                        <!-- Itineraries -->
                        <div class="product-hero__content__bottom__content__info-group__attributes__item">
                                <div class="product-hero__content__bottom__content__info-group__attributes__item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                    </svg>
                                </div>
                                <div class="product-hero__content__bottom__content__info-group__attributes__item__text">
                                    <div class="sub-attribute">
                                        <?php echo $itineraryCount ?> Itineraries
                                    </div>

                                    <?php echo itineraryRange($args['cruise_data'], " - ") . " Days"; ?>

                                </div>

                        </div>


                        <!-- Capacity icon-pin-3 -->
                        <div class="product-hero__content__bottom__content__info-group__attributes__item">

                                <div class="product-hero__content__bottom__content__info-group__attributes__item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                    </svg>
                                </div>
                                <div class="product-hero__content__bottom__content__info-group__attributes__item__text">
                                    <div class="sub-attribute">
                                        Ship Size
                                    </div>
                                    <?php echo get_field('vessel_capacity', $cruisePost) . ' Guests'; ?>
                                </div>

                           
                        </div>
                        <!-- Departing From -->
                        <div class="product-hero__content__bottom__content__info-group__attributes__item">


                                <div class="product-hero__content__bottom__content__info-group__attributes__item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-3"></use>
                                    </svg>
                                </div>
                                <div class="product-hero__content__bottom__content__info-group__attributes__item__text">
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