<?php
$reviews = get_field('reviews');
?>

<section class="slider-block narrow section-padding">
    <div class="slider-block__content ">
        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">
            <!-- Title -->
            <h2 class="title-single center">
                What My Clients Say
            </h2>
        </div>
        <!-- Slider Area -->
        <div class="slider-block__content__slider">
            <!-- Swiper -->
            <div class="swiper" id="reviews-slider">
                <div class="swiper-wrapper">

                    <?php foreach ($reviews as $review) :
                        $description = $review['description'];
                        $person = $review['person'];
                        $date = $review['date'];
                    ?>

                        <!-- Testimonial -->
                        <div class="bio-review-item  swiper-slide">
                            <svg class="bio-review-item__quote">
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
                            </svg>

                            <div class="bio-review-item__snippet">
                                <?php echo $description ?>
                            </div>
                            <div class="bio-review-item__stars">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-star"></use>
                                </svg>
                            </div>
                            <div class="bio-review-item__person">
                                - <?php echo $person ?>, <?php echo $date ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border reviews-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
                <div class="swiper-button-prev swiper-button-prev--white-border reviews-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>