<?php

$extension = get_post();
$queryArgs = array(
    'post_type'      => 'rfc_extensions',
    'posts_per_page' => 18,
    'post__not_in'   => array($extension->ID),
    'meta_key'       => 'search_rank',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
);

$extensions = get_posts($queryArgs);
$count = 0;
?>


<section class="slider-block narrow product-related">
    <div class="slider-block__content product-related__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <h2 class="title-group__title">
                    Alternate Extensions
                </h2>
                <div class="title-group__sub">
                    Explore some other example extensions available in the region.
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">

                <div class="swiper-button-prev swiper-button-prev--white-border related-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border related-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>

            </div>
        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <!-- Swiper -->
            <div class="swiper" id="related-slider">
                <div class="swiper-wrapper">


                    <?php

                    foreach ($extensions as $extension) :
                        if ($count > 11) continue; // hard limit of 12 related itineraries for performance and design reasons, TODO: implement true pagination for related itineraries if needed

                        $lengthDisplay = get_field('length_in_nights', $extension) + 1 . ' Days';
                        $lowestPrice = get_field('price', $extension);
                        $highestPrice = get_field('price_superior', $extension);
                        $images =  get_field('hero_gallery', $extension);
                        $image = $images[0];
                        $title = get_field('display_name', $extension);
                    ?>

                        <!-- Itinerary Card -->
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

                    <?php $count++;
                    endforeach; ?>
                </div>
            </div>
            <?php if ($count == 0) : ?>
                <div class="not-found-text">
                    There are no other example extensions available currently. Please contact our polar specialists for alternatives. </div>
            <?php endif; ?>
        </div>
    </div>
</section>