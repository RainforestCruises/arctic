<?php
$hero_images = get_field('hero_images');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$show_faq = get_field('show_faq');
$show_topics = get_field('show_topics');
$show_map = get_field('show_map');

$itineraries = $args['itineraries'];
$region = $args['region'];

$lowestOverallPrice = 0;
?>

<!-- Hero section -->
<section class="landing-hero" id="top">

    <!-- Desktop BG Image -->
    <div class="landing-hero__bg-image">
        <img <?php afloat_image_markup($hero_images[0]['id'], 'wide-full', array('wide-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?>>
    </div>

    <div class="landing-hero__content">

        <div class="landing-hero__content__title-group">
            <h1 class="landing-hero__content__title-group__title">
                <?php echo $hero_title ?>
            </h1>
            <div class="landing-hero__content__title-group__sub">
                <?php echo $hero_subtitle ?>
            </div>
        </div>

    </div>
</section>


<!-- Nav section -->
<section class="landing-nav" id="nav">
    <div class="landing-nav__content">

        <!-- Nav Links -->
        <div class="landing-nav__content__links">
            <a href="#highlights" class="landing-nav__content__links__link">
                Highlights
            </a>
            <a href="#itineraries" class="landing-nav__content__links__link">
                Itineraries
            </a>
            <?php if ($show_topics) : ?>
                <a href="#about" class="landing-nav__content__links__link">About</a>
            <?php endif; ?>
            <?php if ($show_map) : ?>
                <a href="#map" class="landing-nav__content__links__link">Map</a>
            <?php endif; ?>
            <?php if ($show_faq) : ?>
                <a href="#faq" class="landing-nav__content__links__link">FAQ</a>
            <?php endif; ?>
            <a href="#ships" class="landing-nav__content__links__link">Ships</a>
            <a href="#guide" class="landing-nav__content__links__link">Guide</a>

        </div>

        <div class="landing-nav__content__info">

            <!-- Starting Price -->
            <div class="landing-nav__content__info__starting-price">
                <div class="landing-nav__content__info__starting-price__title-area">
                    <div class="landing-nav__content__info__starting-price__title-area__text">
                        Starting at:
                    </div>
                    <div class="landing-nav__content__info__starting-price__title-area__subtext">
                        Per Person
                    </div>
                </div>

                <div class="landing-nav__content__info__starting-price__amount">
                    <div class="landing-nav__content__info__starting-price__amount__text">
                        <?php priceFormat($lowestOverallPrice); ?>
                    </div>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="landing-nav__content__info__cta">
                <button class="btn-primary btn-primary--icon generic-inquire-cta">
                    Inquire
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
                    </svg>
                </button>
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
            <?php priceFormat($lowestOverallPrice); ?>
        </div>

    </div>

    <!-- Inquire CTA Button -->
    <div class="mobile-info__cta">
        <button class="btn-primary btn-primary--icon generic-inquire-cta">
            Inquire
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
            </svg>
        </button>
    </div>
</div>