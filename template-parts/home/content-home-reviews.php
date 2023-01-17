<?php
$reviews = get_field('reviews');
$reviews_title_subtext = get_field('reviews_title_subtext')

?>


<section class="grid-block" id="section-reviews">
    <div class="grid-block__content">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">

            <!-- Title -->
            <div class="title-single">
                Antarctica Cruises’ Reviews
            </div>

        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid3">
            <?php foreach ($reviews as $review) :
                $image = $review['image'];
                $title = $review['title'];
                $date = $review['date'];
                $text = $review['text'];
            ?>


                <div class="review-item">
                    <div class="review-item__profile">
                        <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>
                        <div class="review-item__profile__title-group">
                            <div class="review-item__profile__title-group__title">
                                <?php echo $title; ?>
                            </div>
                            <div class="review-item__profile__title-group__date">
                                <?php echo $date; ?>
                            </div>
                        </div>
                    </div>

                    <div class="review-item__text">
                        <?php echo $text; ?>
                    </div>
                </div>


            <?php endforeach; ?>




        </div>
        <div class="grid-block__content__cta">
            <a class="cta-primary cta-primary--inverse" id="all-guides-link">
                Read All Reviews
            </a>
        </div>

    </div>
</section>