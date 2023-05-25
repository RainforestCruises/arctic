<?php
$topics = get_field('topics');

?>



<section class="grid-block" id="section-about">
    <?php $count = 1;
    foreach ($topics as $topic) : ?>
        <div class="grid-block__content block-top-divider">

            <!-- Grid Area -->
            <div class="grid-block__content__grid">
                
                <div class="full-card <?php echo ($count % 2 != 0) ? "reverse" : ""; ?>">
                    <div class="full-card__image-area">
                        <img <?php afloat_image_markup($topic['image']['id'], 'landscape-medium', array('landscape-medium', 'landscape-small')); ?>>
                    </div>
                    <div class="full-card__content">
                        <h2 class="full-card__content__title">
                            <?php echo $topic['title'] ?>
                        </h2>
                        <div class="full-card__content__text">
                            <?php echo $topic['text'] ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    <?php $count++; endforeach; ?>
</section>
