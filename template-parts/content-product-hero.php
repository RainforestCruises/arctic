<?php
$hero_image = get_field('hero_image');
$productTitle = get_the_title();
$breadcrumb = get_field('breadcrumb');

$showOverview = true;
if (get_post_type() == 'rfc_tours') {
    $productTitle = get_field('tour_name');
    $showOverview  = get_field('show_overview');
};

$charter_view = false;
$charter_available = false;
$charter_only = false;
if ($args['productType'] == 'Cruise') {
    $charter_view = $args['charter_view'];
    $charter_available = $args['charter_available'];
    $charter_only = $args['charter_only'];
}


$itineraryCount = 0;

if (get_post_type() != 'rfc_tours') {
    $itineraryCount = count($args['cruiseData']['Itineraries']);
}


$images = get_field('highlight_gallery');
?>

<div class="product-hero">

    <!-- Top Section -->
    <div class="product-hero__top">
        <div class="product-hero__top__bg" id="top">
            <img <?php afloat_image_markup($hero_image['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall')); ?>>

        </div>

        <!-- Title / Navigation -->
        <div class="product-hero__top__content">

            <!-- Breadcrumb -->
            <ol class="product-hero__top__content__breadcrumb">
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
            <div>
                <!-- H1 Title / Subtitle -->
                <div class="product-hero__top__content__title-group">
                    <?php if ($charter_view) : ?>
                        <div class="product-hero__top__content__title-group__badge-area">
                            <span>
                                Private Charter
                            </span>
                        </div>
                    <?php endif; ?>


                    <h1 class="product-hero__top__content__title-group__title" id="template-nav-title">
                        <div>
                            <?php echo $productTitle ?>
                        </div>
                        <?php if ($args['hasDeals'] == true) : ?>
                            <button class="btn-cta-round btn-cta-round--small btn-cta-round--green deal-modal-cta-button" style="height: 2.5rem;">
                                Deals
                            </button>
                        <?php endif; ?>
                    </h1>
                    <div class="product-hero__top__content__title-group__subtitle"><?php echo get_field('top_snippet') ?></div>
                </div>

                <!-- Navigation Wrapper -->
                <nav class="product-hero__top__content__nav" id="template-nav">

                    <!-- nav list -->
                    <ul class="product-hero__top__content__nav__list">
                        <?php if ($showOverview) : ?>
                            <li class="product-hero__top__content__nav__list__item">
                                <a href="#overview" class="product-hero__top__content__nav__list__item__link page-nav-template">Overview</a>
                            </li>
                        <?php endif; ?>
                        <li class="product-hero__top__content__nav__list__item <?php echo ($showOverview ? '' : 'current') ?>">
                            <a href="#itineraries" class="product-hero__top__content__nav__list__item__link page-nav-template"><?php echo (get_post_type() != 'rfc_tours') ? ('Itineraries & Prices') : ('Itinerary & Prices'); ?></a>
                        </li>
                        <li class="product-hero__top__content__nav__list__item ">
                            <a href="#accommodations" class="product-hero__top__content__nav__list__item__link page-nav-template">Accommodations</a>
                        </li>

                    </ul>
                </nav>

                <!-- Mobile scroll down CTA -->
                <div class="product-hero__top__content__cta">
                    <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="<?php echo (get_post_type() != 'rfc_tours') ? '#overview' : '#itineraries'; ?>">
                        <svg class="btn-circle--arrow-main">
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                        </svg>
                        <svg class="btn-circle--arrow-animate">
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                        </svg></button>
                </div>
            </div>


            <!-- Mobile - Expand Gallery Button-->
            <?php if ($images) : ?>
                <div class="product-hero__top__content__gallery-expand" id="gallery-expand-button">
                    Photos
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Gallery  -->
    <div class="product-hero__gallery">

        <div class="product-hero__gallery__slick" id="product-gallery">
            <?php

            if ($images) : ?>
                <?php foreach ($images as $image) : ?>
                    <div class="product-hero__gallery__slick__item">
                        <a href="<?php echo esc_url($image['url']); ?>">
                            <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>


    <!-- Bottom Section -->
    <div class="product-hero__bottom">

        <!-- Info Area -->
        <div class="product-hero__bottom__content">
            <div class="product-hero__bottom__content__info-group">

                <!-- Starting Price / CTA -->
                <div class="product-hero__bottom__content__info-group__info" id="page-title">
                    <?php if ($charter_view == false) : ?>
                        <div class="product-hero__bottom__content__info-group__info__starting-price">
                            <div class="product-hero__bottom__content__info-group__info__starting-price__title-area">
                                <?php if ($charter_available == true) : ?>

                                    <div class="product-hero__bottom__content__info-group__info__starting-price__title-area__tabs">
                                        <div class="product-hero__bottom__content__info-group__info__starting-price__title-area__tabs__tab">
                                            Cabins
                                        </div>
                                        <a href="<?php echo get_permalink() . '?charter=true' ?>" class="product-hero__bottom__content__info-group__info__starting-price__title-area__tabs__tab switch-link">
                                            / Charter
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="product-hero__bottom__content__info-group__info__starting-price__title-area__text">
                                    Starting at:
                                </div>
                            </div>
                            <div class="product-hero__bottom__content__info-group__info__starting-price__amount">
                                <?php
                                echo "$" . number_format($args['lowestPrice'], 0); ?>
                                <span class="u-small-text"> / Person</span>
                            </div>
                            <div class="product-hero__bottom__content__info-group__info__starting-price__description">
                                <?php if ($args['productType'] == 'Tour') {
                                    echo 'Customizable private tour with flexible start date';
                                } else if ($args['productType'] == 'Cruise') {
                                    echo 'Shared, small group cruise based on DBL occupancy';
                                } else if ($args['productType'] == 'Lodge') {
                                    echo 'Lodge stay with flexible excursions and start date';
                                } ?>

                            </div>
                        </div>

                    <?php else : ?>
                        <div class="product-hero__bottom__content__info-group__info__starting-price">
                            <div class="product-hero__bottom__content__info-group__info__starting-price__title-area">
                                <?php if ($charter_only != true) : ?>
                                    <div class="product-hero__bottom__content__info-group__info__starting-price__title-area__tabs">
                                        <div class="product-hero__bottom__content__info-group__info__starting-price__title-area__tabs__tab">
                                            Charter
                                        </div>
                                        <a href="<?php echo get_permalink() ?>" class="product-hero__bottom__content__info-group__info__starting-price__title-area__tabs__tab switch-link">
                                            / Cabins
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="product-hero__bottom__content__info-group__info__starting-price__title-area__text">
                                    Starting at:
                                </div>
                            </div>
                            <div class="product-hero__bottom__content__info-group__info__starting-price__amount">
                                <?php echo "$" . number_format($args['charter_daily_price'], 0); ?>
                                <span class="u-small-text"> / Day</span>
                            </div>
                            <div class="product-hero__bottom__content__info-group__info__starting-price__description">
                                <?php $overrideText =  get_field('charter_header_text_override');
                                echo ($overrideText == '') ? 'Exclusive, private cruise based on full occupancy' : $overrideText;
                                ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="product-hero__bottom__content__info-group__info__cta">
                        <button class="btn-cta-round  btn-cta-round--medium " id="nav-page-cta">Inquire</button>
                    </div>
                </div>

                <!-- KSPs -->
                <div class="product-hero__bottom__content__info-group__attributes">

                    <!-- Itineraries -->
                    <div class="product-hero__bottom__content__info-group__attributes__item <?php echo (get_post_type($p) == 'rfc_tours' ? "nomargin-attributes" : "") ?>">
                        <div class="product-hero__bottom__content__info-group__attributes__item__data">
                            <div class="product-hero__bottom__content__info-group__attributes__item__data__icon">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                </svg>
                            </div>
                            <div class="product-hero__bottom__content__info-group__attributes__item__data__text">
                                <?php if ($charter_view == false) :
                                    echo (get_post_type($p) == 'rfc_tours') ? get_field('length') . " Days / " . (get_field('length') - 1) . " Nights" : itineraryRange($args['cruiseData'], " - ") . " Days";
                                else :
                                    echo get_field('charter_min_days') . " Days +";
                                endif; ?>
                                <?php if ($itineraryCount > 0 && $charter_view == false) : ?>
                                    <div class="sub-attribute">
                                        <?php echo $itineraryCount ?> Itineraries
                                    </div>
                                <?php endif; ?>
                                <?php if ($charter_view == true) : ?>
                                    <div class="sub-attribute">
                                        Flexible Length
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                    <?php if (get_post_type($p) != 'rfc_tours') : ?>
                        <!-- Capacity -->
                        <div class="product-hero__bottom__content__info-group__attributes__item nomargin-attributes">

                            <div class="product-hero__bottom__content__info-group__attributes__item__data">

                                <div class="product-hero__bottom__content__info-group__attributes__item__data__icon">
                                    <?php if (get_post_type($p) != 'rfc_lodges') : ?>
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                        </svg>
                                    <?php else : ?>
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-bed-23"></use>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div class="product-hero__bottom__content__info-group__attributes__item__data__text">
                                    <?php echo get_field('vessel_capacity') . ' Guests'; ?>
                                    <div class="sub-attribute">
                                        <?php echo get_field('number_of_cabins') . ' Cabins'; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Experiences -->
                    <div class="product-hero__bottom__content__info-group__attributes__item experience-attributes">
                        <div class="product-hero__bottom__content__info-group__attributes__item__data">
                            <?php $experiences = get_field('experiences');
                            if ($experiences) : ?>
                                <ul>
                                    <?php foreach ($experiences as $e) : ?>
                                        <li>

                                            <div class="experience-icon">
                                                <?php echo get_field('icon', $e); ?>
                                                <span class="tooltiptext"><?php echo get_the_title($e); ?></span>
                                            </div>

                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>



</div>