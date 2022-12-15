<?php
$cabins = $args['cabins'];
$curentYear = $args['curentYear'];
?>

<section class="slider-block narrow cruise-cabins" id="section-cabins">
    <div class="slider-block__content cruise-cabins__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-group">
                    <div class="title-group__title">
                        Cabins
                    </div>
                    <div class="title-group__sub">
                        There are <?php echo count($cabins); ?> cabin types available
                    </div>

                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">
                <div class="swiper-button-prev swiper-button-prev--white-border cabins-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border cabins-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>

        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <!-- Swiper -->
            <div class="swiper" id="cabins-slider">
                <div class="swiper-wrapper">

                    <?php
                    $index = 0;
                    foreach ($cabins as $cabinPost) :
                        $id = get_the_id($cabinPost);
                        $title =  get_field('display_name', $cabinPost);
                        $dimensions =  get_field('dimensions', $cabinPost);
                        $description =  get_field('description', $cabinPost);

                        if(strlen($description) > 230) {
                            $description = substr($description, 0, 230) . '...';
                        }

                        $is_single =  get_field('is_single', $cabinPost);
                        $capacity =  get_field('capacity', $cabinPost);
                        $beds =  get_field('beds', $cabinPost);
                        $hero_gallery = get_field('images', $cabinPost);
                        $image = $hero_gallery[0];
                    ?>

                        <!-- Cabin Card -->
                        <div class="resource-card swiper-slide">

                            <!-- Images Slider -->
                            <div class="resource-card__image-area swiper cabin-card-image-area">
                                <img class="cabin-image-slide" imageId="<?php echo $image['id']; ?>" <?php afloat_image_markup($image['id'], 'portrait-medium', array('portrait-medium', 'portrait-small')); ?>>
                            </div>

                            <!-- Content -->
                            <div class="resource-card__content">

                                <!-- Title -->
                                <div class="resource-card__content__title-group">
                                    <div class="resource-card__content__title-group__title">
                                        <?php echo $title ?>
                                    </div>

                                </div>

                    

                                <!-- Specs -->
                                <div class="resource-card__content__specs">

                                    <!-- Guests -->
                                    <div class="resource-card__content__specs__item">
                                        <div class="resource-card__content__specs__item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-profile"></use>
                                            </svg>
                                        </div>
                                        <div class="resource-card__content__specs__item__text">
                                            <?php echo $capacity . ', ' . $beds ?>
                                        </div>
                                    </div>

                                    <!-- Size -->
                                    <div class="resource-card__content__specs__item">
                                        <div class="resource-card__content__specs__item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-zoom-square"></use>
                                            </svg>
                                        </div>
                                        <div class="resource-card__content__specs__item__text">
                                            <?php echo $dimensions; ?>
                                        </div>
                                    </div>



                                </div>





                            </div>
                        </div>
                        <!-- End Cabin Card -->

                    <?php $index++;
                    endforeach; ?>

                </div>
            </div>

        </div>
    </div>
</section>