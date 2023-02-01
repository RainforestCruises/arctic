<?php

$queryArgs = array(
    'post_type' => 'rfc_travel_guides',
    'posts_per_page' => 9,
    'post__not_in' => array($post->ID)
);

$relatedGuidePosts = get_posts($queryArgs);
?>



<section class="slider-block narrow">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-single">
                    You May Also Be Intereted In
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
                    foreach ($relatedGuidePosts as $relatedPost) :
                        $post_featured_image = get_field('featured_image', $relatedPost);
                        $imageId = $post_featured_image['id'];

                    ?>

                        <!-- Card -->
                        <div class="resource-card small swiper-slide">

                            <!-- Images Slider -->
                            <a class="resource-card__image-area" href="<?php echo get_permalink($relatedPost); ?>">
                                <img <?php afloat_image_markup($imageId, 'portrait-medium', array('portrait-medium', 'portrait-small')); ?>>
                            </a>

                            <!-- Content -->
                            <div class="resource-card__content">

                                <!-- Title -->
                                <div class="resource-card__content__title-group">
                                    <div class="resource-card__content__title-group__title">
                                        <?php echo get_the_title($relatedPost); ?>
                                    </div>
                                </div>

                                <div class="resource-card__content__description">
                                    <?php echo get_the_excerpt($relatedPost); ?>
                                </div>
                                <div class="resource-card__content__bottom">
                                    <div class="resource-card__content__bottom__cta">
                                        <a class="cta-square-icon " href="<?php echo get_permalink($relatedPost); ?>">
                                            Read More
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->

                    <?php
                    endforeach;
                    ?>





                </div>
            </div>



        </div>
    </div>
</section>