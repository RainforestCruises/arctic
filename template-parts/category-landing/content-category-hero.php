<?php

$sliderContent = get_field('hero_slider');
$title = get_the_title();

?>


<!-- Category Landing Hero -->
<section class="category-hero" id="section-top">
    <div class="category-hero__bg-slider" id="category-hero__bg-slider">
        <?php foreach ($sliderContent as $s) :
            $sliderImage = $s['image'];
        ?>
            <div class="category-hero__bg-slider__slide">
                <?php if ($sliderImage) : ?>
                    <div class="category-hero__bg-slider__slide__image-area">
                        <img <?php afloat_image_markup($sliderImage['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall'), true); ?>>
                    </div>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>
    </div>

    <div class="category-hero__content">

        <!-- Breadcrumb -->
        <ol class="category-hero__content__breadcrumb">
          
        </ol>


        <!-- Title -->
        <div class="category-hero__content__title-group">
            <h1 class="category-hero__content__title-group__title" id="page-title">
                <?php echo get_the_title(); ?>
            </h1>
        </div>

        <!-- Nav -->
        <div class="category-hero__content__page-nav">
            <ul class="category-hero__content__page-nav__list">
                <li class="category-hero__content__page-nav__list__item">
                    <a href="#section-ships" class="category-hero__content__page-nav__list__item__link">Ships</a>
                </li>
                <li class="category-hero__content__page-nav__list__item">
                    <a href="#section-itineraries" class="category-hero__content__page-nav__list__item__link">Itineraries</a>
                </li>
                <li class="category-hero__content__page-nav__list__item">
                    <a href="#section-guide" class="category-hero__content__page-nav__list__item__link">Travel Guide</a>
                </li>
                <li class="category-hero__content__page-nav__list__item">
                    <a href="#section-faq" class="category-hero__content__page-nav__list__item__link">FAQ</a>
                </li>

            </ul>


        </div>





        <div class="category-hero__content__arrow">
            <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#intro">
                <svg class="btn-circle--arrow-main">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                </svg>
                <svg class="btn-circle--arrow-animate">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                </svg>
            </button>
        </div>

        <div class="category-hero__content__location">
            <?php
            $slideCount = 0;
            if ($sliderContent) : ?>
                <div class="category-hero__content__location__slider" id="category-hero__content__location__slider">

                    <?php foreach ($sliderContent as $s) : ?>
                        <div class="category-hero__content__location__slider__item">
                            <div class="category-hero__content__location__slider__item__title">
                                <?php echo $s['title'];; ?>
                            </div>
                            <div class="category-hero__content__location__slider__item__text">
                                <?php echo $s['caption']; ?>
                            </div>
                        </div>
                    <?php
                        $slideCount++;
                    endforeach;
                    ?>

                </div>
                <div class="category-hero__content__location__progress">
                    <div class="category-hero__content__location__progress__odometer " id="odometer">01</div>
                    <div class="category-hero__content__location__progress__bar">
                        <div class="progress"></div>
                    </div>

                    <div class="category-hero__content__location__progress__odometer-top"><?php echo str_pad($slideCount, 2, "0", STR_PAD_LEFT); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</section>