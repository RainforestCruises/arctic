<?php
$accommodation = $args['extra_activities'];

?>

<section class="slider-block narrow" id="accommodations">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <h2 class="title-single">
                    Accommodations
                </h2>
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
                    foreach ($accommodation as $item) :
                        $image = $item['image'][0];
                        $title = $item['title'];
                        $description = $item['description'];
                        $service_level = $item['service_level'];
                    ?>
                        <div class="overlay-card swiper-slide extras-view-details" section="extras-section-<?php echo $count; ?>">
                            <div class="overlay-card__image-area">
                                <img <?php afloat_image_markup($image['id'], 'landscape-small', array('landscape-small', 'portrait-small')); ?>>
                            </div>
                            <div class="overlay-card__content">
                                <div class="overlay-card__content__title-section">
                                    <div class="overlay-card__content__title-section__sub">
                                        <?php echo $service_level; ?>
                                    </div>
                                    <h3 class="overlay-card__content__title-section__title">
                                        <?php echo $title ?>
                                    </h3>
                                </div>
                                <div class="overlay-card__content__cta">
                                    <div class="btn-primary btn-primary--inverse">
                                        View Details
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $count++;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal" id="extrasModal">
    <div class="modal__content">

        <!-- Top Modal Content -->
        <div class="modal__content__top">
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    Accommodation
                </div>
            </div>
            <button class="btn-text btn-text--bg close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main" id="extrasModalMainContent">
            <?php
            $count = 0;
            foreach ($accommodation as $item) :
                $image = $item['image'];
                $title = $item['title'];
                $description = $item['description'];
                $service_level = $item['service_level'];
                $amenities = $item['cabin_amenity'];

            ?>
                <div class="cruise-cabins-modal-item" id="<?php echo 'extras-section-' . $count; ?>">
                    <div class="cruise-cabins-modal-item__image-area">
                        <div class="swiper-wrapper">
                            <?php foreach ($image as $i) : ?>
                                <div class="cruise-cabins-modal-item__image-area__item swiper-slide">
                                    <img <?php afloat_image_markup($i['id'], 'landscape-medium'); ?>>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev swiper-button-prev--overlay"></div>
                        <div class="swiper-button-next swiper-button-prev--overlay"></div>
                    </div>

                    <!-- Title -->
                    <h2 class="cruise-cabins-modal-item__title">
                        <?php echo $title; ?>
                        <span class="badge">
                            <?php echo $service_level; ?>
                        </span>
                    </h2>


                    <!-- Subtitle -->
                    <h3 class="cruise-cabins-modal-item__subtitle">
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


                    <!-- Subtitle -->
                    <h3 class="cruise-cabins-modal-item__subtitle">
                        Description
                    </h3>

                    <div class="cruise-cabins-modal-item__description">
                        <?php echo $description; ?>
                    </div>
                </div>
            <?php $count++; endforeach; ?>
        </div>
    </div>
</div>