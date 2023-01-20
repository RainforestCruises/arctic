<?php
$hero_images = get_field('hero_images');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');


?>

<!-- Hero section -->
<section class="landing-hero" id="section-hero">

    <!-- Desktop BG Image -->
    <div class="landing-hero__bg-image">
        <img <?php afloat_image_markup($hero_images[0]['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
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
        <div class="landing-nav__content__links">
            <a href="#section-itineraries" class="landing-nav__content__links__link">Itineraries</a>
            <a href="#section-about" class="landing-nav__content__links__link">About</a>
            <a href="#section-faq" class="landing-nav__content__links__link">FAQ</a>
            <a href="#section-faq" class="landing-nav__content__links__link">Reviews</a>
            <a href="#section-ships" class="landing-nav__content__links__link">Ships</a>
        </div>
        <div class="landing-nav__content__cta">
            <button class="cta-primary generic-inquire-cta">
                Inquire
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
                </svg>
            </button>
        </div>
    </div>
</section>