<?php
$experiences = get_field('experiences');

?>


<section class="slider-block inverse" id="section-experiences" style="margin-bottom: 4rem;">
    <div class="slider-block__content">
        <div class="slider-block__content__top title-divider">
            <!-- Title -->
            <div class="title-single">
                The Antarctica Expedition Experience
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">
                <div class="swiper-button-prev swiper-button-prev--inverse experiences-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--inverse experiences-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Grid Area -->
        <div class="slider-block__content__grid">
            <!-- Swiper -->
            <div class="swiper" id="experiences-slider">
                <div class="swiper-wrapper">

                    <?php foreach ($experiences as $experience) :
                        $image = $experience['image'];
                        $title = $experience['title'];
                        $description = $experience['description'];
                    ?>

                        <!-- Card -->
                        <div class="resource-card small swiper-slide">

                            <!-- Images Slider -->
                            <div class="resource-card__image-area">
                                <img <?php afloat_image_markup($image['id'], 'portrait-medium', array('portrait-medium', 'portrait-small')); ?>>
                            </div>

                            <!-- Content -->
                            <div class="resource-card__content">

                                <!-- Title -->
                                <div class="resource-card__content__title-group">
                                    <div class="resource-card__content__title-group__title">
                                        <?php echo $title ?>
                                    </div>
                                </div>

                                <div class="resource-card__content__description">
                                    <?php echo $description ?>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->

                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>

            </div>
        </div>
    </div>
</section>