<?php
$styles = get_field('styles');
$styles_title = get_field('styles_title');
$styles_title_subtext = get_field('styles_title_subtext');
?>

<!-- Styles -->
<section class="slider-block" id="styles">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <h2 class="title-group__title">
                    <?php echo $styles_title; ?>
                </h2>
                <div class="title-group__sub">
                    <?php echo $styles_title_subtext; ?>
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">
                <div class="swiper-button-prev swiper-button-prev--white-border styles-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border styles-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>

        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">
            <div class="swiper" id="styles-slider">
                <div class="swiper-wrapper">

                    <?php foreach ($styles as $style) :
                        $image =  get_field('image', $style);
                        $landing_page =  get_field('landing_page', $style);
                        $title = get_field('display_title', $style) ? get_field('display_title', $style) : get_the_title($style);
                    ?>
                        <!-- Overlay Card -->
                        <div class="overlay-card swiper-slide">
                            <div class="overlay-card__image-area">
                                <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                            </div>
                            <a class="overlay-card__content" href="<?php echo $landing_page; ?>">
                                <div class="overlay-card__content__title-section">
                                    <h3 class="overlay-card__content__title-section__title">
                                        <?php echo $title; ?>
                                    </h3>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</section>