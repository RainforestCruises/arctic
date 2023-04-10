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
                        $id = $cabinPost->ID;
                        $title =  get_field('display_name', $cabinPost);
                        $dimensions =  get_field('dimensions', $cabinPost);
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
                                <img class="cabin-image-slide" style="cursor: pointer" cabinId="<?php echo $id; ?>" imageId="<?php echo $image['id']; ?>" <?php afloat_image_markup($image['id'], 'portrait-small', array('portrait-small')); ?>>
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

<div class="modal" id="cabinModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title" id="cabinModalTitle">
                    Cabin Details
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
        <div class="modal__content__main">

            <?php
            foreach ($cabins as $c) :
                $id = $c->ID;
                $title =  get_field('display_name', $c);
                $dimensions =  get_field('dimensions', $c);
                $description =  get_field('description', $c);

                $is_single =  get_field('is_single', $c);
                $capacity =  get_field('capacity', $c);
                $amenities =  get_field('amenities', $c);
                $beds =  get_field('beds', $c);
                $images = get_field('images', $c);
                $image = $hero_gallery[0];
            ?>

                <div class="cruise-cabins-modal-item" cabinId="<?php echo $id; ?>">
                    <div class="cruise-cabins-modal-item__image-area">
                        <div class="swiper-wrapper">
                            <?php foreach ($images as $image) : ?>
                                <div class="cruise-cabins-modal-item__image-area__item swiper-slide">
                                    <img <?php afloat_image_markup($image['id'], 'landscape-medium'); ?>>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev swiper-button-prev--overlay"></div>
                        <div class="swiper-button-next swiper-button-prev--overlay"></div>
                    </div>
                    <h2>
                        <?php echo $title; ?>
                    </h2>
                    <div class="cruise-cabins-modal-item__specification">
                        <span>Beds:</span> <?php echo $beds; ?>
                    </div>
                    <div class="cruise-cabins-modal-item__specification" style="margin-bottom: 1.5rem">
                        <span>Capacity:</span> <?php echo $capacity; ?>
                    </div>
                    <h3>
                        Features
                    </h3>
                    <div class="cruise-cabins-modal-item__features">
                        <?php
                        if ($amenities) :
                            foreach ($amenities as $a) : 
                            $icon = get_field('icon', $a);
                            ?>
                                <div class="icon-item ">
                                    <?php echo $icon ?>
                                    <div class="icon-item__title-group">
                                        <div class="icon-item__title-group__title">
                                            <?php echo get_the_title($a); ?>
                                        </div>
                                    </div>

                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>

                    <h3>
                        Description
                    </h3>
                    <div class="cruise-cabins-modal-item__description">
                        <?php echo $description; ?>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>