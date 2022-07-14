<div class="product-reviews">
    <h2 class="xsub-divider u-margin-top-medium">
        Guest Reviews
    </h2>
    <?php $reviews_background = get_field('reviews_background'); ?>

    <div class="product-reviews__bg" style="background-image:url(<?php echo $reviews_background['url'] ?>)">
        <!-- Parallax -->
    </div>
    <div class="product-reviews__slider" id="reviews-slider">
        <?php
        $testimonials = get_field('testimonials');
        if ($testimonials) :
            $t_count = 0;
            foreach ($testimonials as $t) :
                $t_person_name = $t['guest_name'];
                $t_snippet = $t['guest_review'];
                $t_location = $t['guest_location'];
                $review_date = $t['review_date'];

        ?>
                <!-- Testimonial -->
                <div class="product-reviews__slider__item">
                    <div class="product-reviews__slider__item__detail">
                        <?php echo $t_person_name ?>
                    </div>
                    <div class="product-reviews__slider__item__snippet">
                        <?php echo $t_snippet ?>
                    </div>
                    <div class="product-reviews__slider__item__detail">
                        <div>
                            <?php echo $review_date ?>
                        </div>
                        <div>
                            <?php echo $t_location ?>
                        </div>
                    </div>
                </div>

        <?php $t_count++;
            endforeach;
        endif; ?>
    </div>
</div>