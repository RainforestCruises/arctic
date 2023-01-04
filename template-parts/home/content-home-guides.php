<?php
$guides = get_field('guides');
$guides_title_subtext = get_field('guides_title_subtext')

?>


<section class="grid-block" id="section-guides">
    <div class="grid-block__content  block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <div class="title-group__title">
                    Helpful Exploration Guides
                </div>
                <div class="title-group__sub">
                    <?php echo $guides_title_subtext; ?>
                </div>
            </div>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid-3x4">
            <?php
            $count = 0;
            foreach ($guides as $guide) :
                $image = get_field('featured_image', $guide);
                $minutes_to_read = get_field('minutes_to_read', $guide);

                $title = get_the_title($guide);
                $text = get_the_excerpt($guide);
                $lastUpdate = get_the_modified_time( 'F jS, Y', $guide);

            ?>
                <div class="resource-card">
                    <a class="resource-card__image-area" href="<?php echo get_permalink($guide) ?>">
                        <img <?php afloat_image_markup($image['id'], 'portrait-large', array('portrait-large')); ?>>
                    </a>
                    <div class="resource-card__content">
                        <a class="resource-card__content__title" href="<?php echo get_permalink($guide) ?>">
                            <?php echo $title; ?>
                        </a>
                        <div class="resource-card__content__description">
                            <?php echo $lastUpdate; ?>
                        </div>
                      
                    </div>
             

                </div>

            <?php $count++;
            endforeach; ?>

        </div>
        <div class="grid-block__content__cta">
            <a class="cta-primary cta-primary--inverse" id="all-guides-link">
                Read All Guides
            </a>
        </div>
    </div>
</section>