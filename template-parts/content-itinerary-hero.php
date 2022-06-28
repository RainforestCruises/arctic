<?php
$productTitle = get_the_title();
$breadcrumb = get_field('breadcrumb');
$cruisePost = get_field('ship');

$dayCount = 5;

$hero_image = get_field('hero_image');
?>

<section class="itinerary-hero" id="top">
    <div class="itinerary-hero__content">

        <!-- Top Section -->
        <div class="itinerary-hero__content__top">
            <div class="itinerary-hero__content__top__bg" id="top">
                <img <?php afloat_image_markup($hero_image['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall')); ?>>

            </div>

            <!-- Title / Navigation -->
            <div class="itinerary-hero__content__top__content">

                <!-- Breadcrumb -->
                <ol class="itinerary-hero__content__top__content__breadcrumb">
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
                    <div class="itinerary-hero__content__top__content__title-group">
                        <?php if ($charter_view) : ?>
                            <div class="itinerary-hero__content__top__content__title-group__badge-area">
                                <span>
                                    Private Charter
                                </span>
                            </div>
                        <?php endif; ?>


                        <h1 class="itinerary-hero__content__top__content__title-group__title" id="template-nav-title">
                            <div>
                                <?php echo $productTitle ?>
                            </div>
                            <?php if ($args['hasDeals'] == true) : ?>
                                <button class="btn-cta-round btn-cta-round--small btn-cta-round--green deal-modal-cta-button" style="height: 2.5rem;">
                                    Deals
                                </button>
                            <?php endif; ?>
                        </h1>
                        <div class="itinerary-hero__content__top__content__title-group__subtitle"><?php echo get_field('top_snippet') ?></div>
                    </div>

                    <!-- Navigation Wrapper -->
                    <nav class="itinerary-hero__content__top__content__nav" id="template-nav">

                        <!-- nav list -->
                        <ul class="itinerary-hero__content__top__content__nav__list">

                            <li class="itinerary-hero__content__top__content__nav__list__item current">
                                <a href="#overview" class="itinerary-hero__content__top__content__nav__list__item__link page-nav-template">Overview</a>
                            </li>

                            <li class="itinerary-hero__content__top__content__nav__list__item">
                                <a href="#itinerary" class="itinerary-hero__content__top__content__nav__list__item__link page-nav-template">Itinerary</a>
                            </li>
                            <li class="itinerary-hero__content__top__content__nav__list__item ">
                                <a href="#departures" class="itinerary-hero__content__top__content__nav__list__item__link page-nav-template">Departures</a>
                            </li>


                        </ul>
                    </nav>

                    <!-- Mobile scroll down CTA -->
                    <div class="itinerary-hero__content__top__content__cta">
                        <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="<?php echo (get_post_type() != 'rfc_tours') ? '#overview' : '#itineraries'; ?>">
                            <svg class="btn-circle--arrow-main">
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                            </svg>
                            <svg class="btn-circle--arrow-animate">
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                            </svg></button>
                    </div>
                </div>


            </div>
        </div>


        <!-- Bottom Section -->
        <div class="itinerary-hero__content__bottom">

            <!-- Info Area -->
            <div class="itinerary-hero__content__bottom__content">
                <div class="itinerary-hero__content__bottom__content__info-group">

                    <!-- Starting Price -->
                    <div class="itinerary-hero__content__bottom__content__info-group__info" id="page-title">

                        <div class="itinerary-hero__content__bottom__content__info-group__info__starting-price">
                            <div class="itinerary-hero__content__bottom__content__info-group__info__starting-price__title-area">

                                <div class="itinerary-hero__content__bottom__content__info-group__info__starting-price__title-area__text">
                                    Starting at:
                                </div>
                                <div class="itinerary-hero__content__bottom__content__info-group__info__starting-price__title-area__subtext">
                                    Per Person
                                </div>
                            </div>
                            <div class="itinerary-hero__content__bottom__content__info-group__info__starting-price__amount">
                                <?php echo "$" . number_format($args['lowestPrice'], 0); ?>
                                <span class="u-small-text">USD</span>
                            </div>

                        </div>

                        <div class="itinerary-hero__content__bottom__content__info-group__info__cta">

                            <button class="cta-round-icon " id="nav-page-cta">
                                Inquire
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Attributes -->
                    <div class="itinerary-hero__content__bottom__content__info-group__attributes">

                        <!-- Itineraries -->
                        <div class="itinerary-hero__content__bottom__content__info-group__attributes__item">
                            <div class="itinerary-hero__content__bottom__content__info-group__attributes__item__data">
                                <div class="itinerary-hero__content__bottom__content__info-group__attributes__item__data__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                    </svg>
                                </div>
                                <div class="itinerary-hero__content__bottom__content__info-group__attributes__item__data__text">
                                    <div class="sub-attribute">
                                        Duration
                                    </div>
                                    <?php echo get_field('charter_min_days') . " Days +"; ?>


                                </div>

                            </div>
                        </div>


                        <!-- Capacity icon-pin-3 -->
                        <div class="itinerary-hero__content__bottom__content__info-group__attributes__item nomargin-attributes">

                            <div class="itinerary-hero__content__bottom__content__info-group__attributes__item__data">

                                <div class="itinerary-hero__content__bottom__content__info-group__attributes__item__data__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                    </svg>
                                </div>
                                <div class="itinerary-hero__content__bottom__content__info-group__attributes__item__data__text">
                                    <div class="sub-attribute">
                                        Ship Size
                                    </div>
                                    <?php echo get_field('vessel_capacity') . ' Guests'; ?>
                                </div>

                            </div>
                        </div>
                        <!-- Departing From -->
                        <div class="itinerary-hero__content__bottom__content__info-group__attributes__item">

                            <div class="itinerary-hero__content__bottom__content__info-group__attributes__item__data">

                                <div class="itinerary-hero__content__bottom__content__info-group__attributes__item__data__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-3"></use>
                                    </svg>
                                </div>
                                <div class="itinerary-hero__content__bottom__content__info-group__attributes__item__data__text">
                                    <div class="sub-attribute">
                                        Departing From
                                    </div>
                                    Ushuaia, Ar
                                </div>

                            </div>
                        </div>




                    </div>


                </div>

            </div>
        </div>



    </div>
</section>