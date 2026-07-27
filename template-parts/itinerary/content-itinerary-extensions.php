<?php
$region = getItineraryRegionId(get_post(), true);
$extensions = getExtensionsInRegion($region);
?>

<section class="slider-block narrow" id="extensions">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <h2 class="title-group__title">
                    Extensions
                </h2>
                <div class="title-group__sub">
                    Complement your itinerary with one of our extensions.
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">
                <div class="swiper-button-prev swiper-button-prev--white-border extensions-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border extensions-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>

        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">
            <div class="swiper" id="extensions-slider">
                <div class="swiper-wrapper">
                    <?php
                    $count = 0;
                    foreach ($extensions as $extension) :
                        if ($count > 12) break; // Limit to 12 itineraries per region

                        $lengthDisplay = get_field('length_in_nights', $extension) + 1 . ' Days';
                        $lowestPrice = get_field('price', $extension);
                        $highestPrice = get_field('price_superior', $extension);
                        $images =  get_field('hero_gallery', $extension);
                        $image = $images[0];
                        $title = get_field('display_name', $extension);
                        $count++;
                    ?>
                        <!-- Extension Card -->
                        <div class="resource-card swiper-slide">
                            <!-- Images Slider -->
                            <div class="resource-card__image-area">
                                <a class="resource-card__image-area__item" href="<?php echo get_permalink($extension) ?>">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                                </a>
                            </div>
                            <!-- Content -->
                            <div class="resource-card__content">
                                <!-- Title -->
                                <h3 class="resource-card__content__title">
                                    <a href="<?php echo get_permalink($extension) ?>"><?php echo $title; ?></a>
                                </h3>
                                <!-- Specs -->
                                <div class="resource-card__content__specs">
                                    <!-- Itinerary -->
                                    <div class="specs-item">
                                        <div class="specs-item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-time-clock"></use>
                                            </svg>
                                        </div>
                                        <div class="specs-item__text">
                                            Length: <?php echo $lengthDisplay; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="resource-card__content__bottom">
                                    <!-- Price Group -->
                                    <div class="resource-card__content__bottom__price-group">
                                        <div class="resource-card__content__bottom__price-group__amount">
                                            <?php priceFormat($lowestPrice, $highestPrice); ?>
                                        </div>
                                        <div class="resource-card__content__bottom__price-group__text">
                                            <?php echo ($lowestPrice) ? "Per Person" : ""; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>