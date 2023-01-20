<?php

$reviews = get_field('reviews');
$firstReviews = array_slice($reviews, 0, 4);
$displayLimit = 250;

?>
<section class="grid-block narrow" id="section-reviews">
    <div class="grid-block__content block-top-divider">

        <div class="title-group">
            <div class="title-group__title">
                Recent Reviews
            </div>
            <div class="title-group__sub">
                4.97 (765 reviews)
            </div>
        </div>

        <div class="grid-block__content__grid grid2">
            <?php 
            $count = 0;
            foreach ($firstReviews as $r) :
                $image = $r['image'];
                $title = $r['title'];
                $date = $r['date'];
                $text = $r['text'];

                $expand = strlen($text) > $displayLimit ? true : false;
                $text_limited = substr($text, 0, $displayLimit) . ($expand ? '...' : '');
            ?>

                <div class="text-card">
                    <div class="text-card__avatar">
                        <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>
                        <div class="text-card__avatar__title-group">
                            <div class="text-card__avatar__title-group__title">
                                <?php echo $title; ?>
                            </div>
                            <div class="text-card__avatar__title-group__sub">
                                <?php echo $date; ?>
                            </div>
                        </div>
                    </div>

                    <div class="text-card__text">
                        <?php echo $text_limited; ?>
                    </div>

                    <?php if ($expand) : ?>
                        <div class="text-card__expand">
                            <button class="btn-text-plain read-all-reviews" section="reviews-section-<?php echo $count; ?>">
                                Read More
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php $count++; endforeach; ?>
        </div>

        <!-- CTA -->
        <div class="grid-block__content__cta">
            <button class="cta-primary cta-primary--inverse read-all-reviews" section="reviews-section-0">
                Read All Reviews
            </button>
        </div>


    </div>
</section>



<div class="modal" id="reviewsModal">
    <div class="modal__content">
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
        <div class="modal__content__main" id="reviewsModalMainContent">

            <div class="reviews-modal">
                <div class="reviews-modal__filters">

                </div>
                <div class="reviews-modal__content">
                    <?php 
                    $count = 0;
                    foreach ($reviews as $r) :
                        $image = $r['image'];
                        $title = $r['title'];
                        $date = $r['date'];
                        $text = $r['text'];
                    ?>

                        <div class="text-card" id="reviews-section-<?php echo $count; ?>">
                            <div class="text-card__avatar">
                                <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>
                                <div class="text-card__avatar__title-group">
                                    <div class="text-card__avatar__title-group__title">
                                        <?php echo $title; ?>
                                    </div>
                                    <div class="text-card__avatar__title-group__sub">
                                        <?php echo $date; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="text-card__text">
                                <?php echo $text; ?>
                            </div>
                        </div>
                    <?php $count++; endforeach; ?>
                </div>

            </div>

        </div>
    </div>
</div>