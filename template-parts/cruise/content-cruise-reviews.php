<?php

$reviews = get_field('reviews');

?>
<section class="product-reviews" id="reviews">
    <div class="product-reviews__content">

        <div class="title-group">
            <div class="title-group__title">
                Recent Reviews
            </div>
            <div class="title-group__sub">
                4.97 (765 reviews)
            </div>
        </div>

        <div class="product-reviews__content__grid">
            <?php foreach ($reviews as $r) :
                $image = $r['image'];
                $title = $r['title'];
                $date = $r['date'];
                $text = $r['text'];
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

        <!-- CTA -->
        <div class="cruise-overview__content__cta">

            <button class="cta-round-icon" id="deckplan-button">
                See All Reviews
            </button>

        </div>


    </div>
</section>