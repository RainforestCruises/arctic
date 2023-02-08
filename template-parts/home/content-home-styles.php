<?php
$styles = get_field('styles');
$styles_title = get_field('styles_title');
$styles_title_subtext = get_field('styles_title_subtext');

?>


<section class="slider-block" id="section-styles">
    <div class="slider-block__content  block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <div class="title-group__title">
                    <?php echo $styles_title; ?>
                </div>
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

        <!-- slider Area -->
        <div class="slider-block__content__slider">
            <div class="swiper" id="styles-slider">
                <div class="swiper-wrapper">

                    <?php foreach ($styles as $style) :
                        $image =  get_field('image', $style);
                        $title = get_the_title($style);
                    ?>
                        <!-- Overlay Card -->
                        <div class="overlay-card swiper-slide">
                            <div class="overlay-card__image-area">
                                <div class="overlay-card__image-area__item">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                                </div>
                            </div>
                            <a class="overlay-card__content" href="<?php echo get_permalink($travel_guide) ?>">
                                <div class="overlay-card__content__title-section">
                                    <div class="overlay-card__content__title-section__title">
                                        <?php echo $title; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>



    </div>
</section>