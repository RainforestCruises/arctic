<?php
$region_sections = get_field('region_sections');
?>

<section class="grid-block" id="about">
    <?php $count = 1;
    foreach ($region_sections as $section) : ?>
        <div class="grid-block__content block-top-divider">
            <!-- Grid Area -->
            <div class="grid-block__content__grid">
                <div class="full-card <?php echo ($count % 2 != 0) ? "reverse" : ""; ?>">

                    <div class="full-card__image-area">
                        <img <?php afloat_image_markup($section['image']['id'], 'landscape-medium', array('landscape-medium', 'landscape-small')); ?>>
                    </div>

                    <div class="full-card__content">
                        <h2 class="full-card__content__title">
                            <?php echo $section['title'] ?>
                        </h2>
                        <div class="full-card__content__text">
                            <?php echo $section['text'] ?>
                        </div>
                        <div class="full-card__content__cta">
                            <a class="btn-primary btn-primary--inverse-outline" href="<?php echo $section['link']; ?>">
                                View All <?php echo $section['title']; ?>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    <?php $count++;
    endforeach; ?>
</section>