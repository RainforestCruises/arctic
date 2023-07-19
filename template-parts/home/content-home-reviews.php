<?php
$reviews = get_field('reviews');
$reviews_title = get_field('reviews_title');
$maxlength = 320;
?>


<section class="grid-block" id="reviews">
    <div class="grid-block__content">
        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">
            <!-- Title -->
            <h2 class="title-single">
                <?php echo $reviews_title; ?>
            </h2>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid3">
            <?php foreach ($reviews as $review) :
                $image = $review['image'];
                $title = $review['title'];
                $date = $review['date'];
                $text = $review['text'];
                $expand = strlen($text) > $maxlength ? true : false;
                $text_limited = substr($text, 0, $maxlength) . ($expand ? '...' : '');
            ?>
               <div class="text-card ">
                    <div class="text-card__avatar">
                        <div class="text-card__avatar__image-area" style="background-color: <?php echo generateBgColor(); ?>;">
                            <?php echo generateInitials($title); ?>
                            <?php if ($image) : ?>
                                <img <?php afloat_image_markup($image['id'], 'square-thumb', array('square-thumb')); ?>>
                            <?php endif; ?>
                        </div>
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
                            <button class="btn-text" id="expand-content">
                                Read More
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="grid-block__content__cta">
            <a class="btn-primary btn-primary--inverse-outline" id="all-guides-link">
                Read All Reviews
            </a>
        </div>
    </div>
</section>