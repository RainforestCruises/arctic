<?php

$reviews = get_field('reviews');

?>
<section class="product-reviews" id="section-reviews">
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
            <button class="cta-primary cta-primary--inverse" id="read-all-reviews">
                Read All Reviews
            </button>
        </div>


    </div>
</section>



<div class="modal" id="reviewsModal">
    <div class="modal__content"">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    All Reviews
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

            <div class="reviews-modal">
                <div class="reviews-modal__filters">

                </div>
                <div class="reviews-modal__content">
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

            </div>

        </div>
    </div>
</div>