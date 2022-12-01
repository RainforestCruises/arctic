<?php
$extra_activities = get_field('extra_activities')
?>

<section class="slider-block narrow" id="section-extras">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-group__title">
                    Extra Activities
                </div>
                <div class="title-group__sub">
                    Explore these <?php echo count($extra_activities) ?> add on activities
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">
                <div class="swiper-button-prev swiper-button-prev--white-border extras-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border extras-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">
           <!-- Swiper -->
            <div class="swiper" id="extras-slider">
                <div class="swiper-wrapper">
                    <?php 
                    $count = 0;
                    foreach ($extra_activities as $activity) :
                        $image = $activity['image'];
                        $title = $activity['title'];
                        $description = $activity['description'];
                        $price = $activity['price'];
                    ?>
                        <div class="overlay-card swiper-slide">
                            <div class="overlay-card__image-area">
                                <img <?php afloat_image_markup($image['id'], 'wide-slider-medium'); ?>>
                            </div>
                            <div class="overlay-card__content">
                                <div class="overlay-card__content__title-section">
                                    <div class="overlay-card__content__title-section__sub">
                                        $<?php echo $price ?> Per Person
                                    </div>
                                    <div class="overlay-card__content__title-section__title">
                                        <?php echo $title ?>
                                    </div>
                                </div>
                                <div class="overlay-card__content__cta">
                                    <button class="cta-primary cta-primary--white extras-view-details" section="extras-section-<?php echo $count; ?>">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php $count++; endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal" id="extrasModal">
    <div class="modal__content">
        <div class="modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    Extra Activities
                </div>
            </div>
            <button class="btn-text-icon close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

    <!-- Main Modal Content -->
        <div class="modal__content__main" id="extrasModalMainContent">

            <div class="days-modal">
                <div class="days-modal__filters">

                </div>
                <div class="days-modal__content">
                    <?php 
                    $count = 0;
                    foreach ($extra_activities as $activity) :
                        $image = $activity['image'];
                        $title = $activity['title'];
                        $description = $activity['description'];
                        $price = $activity['price'];
                    ?>

                        <div class="days-item" id="<?php echo 'extras-section-' . $count; ?>">
                            <div class="days-item__title-group">
                                <div class="days-item__title-group__title">
                                    <?php echo $title; ?>
                                </div>
                                <div class="days-item__title-group__sub">
                                    $<?php echo $price ?> Per Person
                                </div>
                            </div>
                            <div class="days-item__image">
                                <img <?php afloat_image_markup($image['id'], 'featured-large', array('featured-large', 'featured-medium','featured-small')); ?>>
                            </div>

                            <div class="days-item__text">
                                <?php echo $description; ?>
                            </div>
                        </div>
                    <?php $count++;
                    endforeach; ?>
                </div>

            </div>

        </div>
    </div>
</div>