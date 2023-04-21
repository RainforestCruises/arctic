<?php
$hero_images = get_field('hero_images');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$show_faq = get_field('show_faq');

$itineraries = get_field('itineraries');
$lowestOverallPrice = getLowestPriceFromListOfItineraries($itineraries);
?>

<!-- Hero section -->
<section class="landing-hero" id="section-top">

    <!-- Desktop BG Image -->
    <div class="landing-hero__bg-image">
        <img <?php afloat_image_markup($hero_images[0]['id'], 'wide-full', array('wide-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?>>
    </div>

    <div class="landing-hero__content">

        <div class="landing-hero__content__title-group">
            <div class="landing-hero__content__title-group__title">
                <?php echo $hero_title ?>
            </div>
            <div class="landing-hero__content__title-group__sub">
                <?php echo $hero_subtitle ?>
            </div>
        </div>

    </div>
</section>


<!-- Nav section -->
<section class="landing-nav" id="section-nav">
    <div class="landing-nav__content">

        <!-- Nav Links -->
        <div class="landing-nav__content__links">
            <a href="#section-itineraries" class="landing-nav__content__links__link">Itineraries</a>
            <a href="#section-about" class="landing-nav__content__links__link">About</a>
            <?php if ($show_faq) : ?>
                <a href="#section-faq" class="landing-nav__content__links__link">FAQ</a>
            <?php endif; ?>
            <a href="#section-ships" class="landing-nav__content__links__link">Ships</a>
            <a href="#section-guide" class="landing-nav__content__links__link">Travel Guide</a>

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
                <button class="cta-primary generic-inquire-cta">
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
        <button class="cta-primary generic-inquire-cta">
            Inquire
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
            </svg>
        </button>
    </div>
</div>