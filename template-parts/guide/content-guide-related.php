<?php

//related posts
$queryArgs = array(
    'post_type' => 'rfc_travel_guides',
    'posts_per_page' => 9,
    'post__not_in' => array($post->ID)
);

$queryArgsCategories = array();
$queryArgsCategories['relation'] = 'OR';
$categories = get_field('categories');
if ($categories) {
  foreach ($categories as $c) {
    $queryArgsCategories[] = array(
      'key'     => 'categories',
      'value'   =>  '"' . $c->ID . '"',
      'compare' => 'LIKE'
    );
  }
};

$queryArgs['meta_query'][] = $queryArgsCategories; // match any category

// TODO: filter on region also


$relatedGuidePosts = get_posts($queryArgs);
?>



<section class="slider-block narrow">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <h2 class="title-single">
                    You May Also Be Interested In
                </h2>
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
                        <div class="resource-card swiper-slide">

                            <!-- Image -->
                            <a class="resource-card__image-area" href="<?php echo get_permalink($relatedPost); ?>">
                                <img <?php afloat_image_markup($imageId, 'portrait-small', array('portrait-small')); ?>>
                            </a>

                            <!-- Content -->
                            <div class="resource-card__content">

                                <!-- Title -->
                                <h3 class="resource-card__content__title-group"  >
                                    <a class="resource-card__content__title-group__title" href="<?php echo get_permalink($relatedPost); ?>" >
                                        <?php echo get_the_title($relatedPost); ?>
                                    </a>
                                </h3>

                                <!-- Description -->
                                <div class="resource-card__content__description">
                                    <?php echo get_the_excerpt($relatedPost); ?>
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