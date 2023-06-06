<?php
$cabins = $args['cabins'];
$curentYear = $args['curentYear'];
?>

<section class="slider-block narrow" id="section-cabins">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-group">
                    <h2 class="title-group__title">
                        Cabins
                    </h2>
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
                        $id = $cabinPost->ID;
                        $title =  get_field('display_name', $cabinPost);
                        $dimensions =  get_field('dimensions', $cabinPost);
                        $is_single =  get_field('is_single', $cabinPost);
                        $capacity =  get_field('capacity', $cabinPost);
                        $quantity =  get_field('quantity', $cabinPost);
                        $beds =  get_field('beds', $cabinPost);
                        $hero_gallery = get_field('images', $cabinPost);
                        $image = $hero_gallery[0];
                    ?>

                        <!-- Cabin Card -->
                        <div class="resource-card swiper-slide">

                            <!-- Images Slider -->
                            <div class="resource-card__image-area swiper cabin-card-image-area">
                                <img class="cabin-image-slide" style="cursor: pointer" cabinId="<?php echo $id; ?>" imageId="<?php echo $image['id']; ?>" <?php afloat_image_markup($image['id'], 'portrait-small', array('portrait-small')); ?>>
                            </div>

                            <!-- Content -->
                            <div class="resource-card__content">

                                <!-- Title -->
                                <h3 class="resource-card__content__title">
                                    <?php echo $title ?>

                                </h3>

                                <!-- Specs -->
                                <div class="resource-card__content__specs">

                                    <div class="specs-item">
                                        <div class="specs-item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-profile"></use>
                                            </svg>
                                        </div>
                                        <div class="specs-item__text">
                                            <div class="specs-item__text__main">
                                                <?php echo $capacity . ', ' . $beds ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="specs-item">
                                        <div class="specs-item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-zoom-square"></use>
                                            </svg>
                                        </div>
                                        <div class="specs-item__text">
                                            <div class="specs-item__text__main">
                                                <?php echo $dimensions; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($quantity) : ?>
                                        <div class="specs-item">
                                            <div class="specs-item__icon">
                                                <svg>
                                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-door-3"></use>
                                                </svg>
                                            </div>
                                            <div class="specs-item__text">
                                                <div class="specs-item__text__main">
                                                    <?php echo $quantity; ?> <?php echo $quantity == 1 ? "Cabin" : "Cabins"; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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