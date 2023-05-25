<?php
$guides = get_field('guides');
$firstGuides = array_slice($guides, 0, 7);
$guides_title = get_field('guides_title');
$guides_title_subtext = get_field('guides_title_subtext');
$top_level_guides_page = get_field('top_level_guides_page', 'options');
?>

<section class="grid-block" id="section-guide">
    <div class="grid-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">
            <!-- Title -->
            <div class="title-group">
                <h2 class="title-group__title">
                    <?php echo $guides_title; ?>
                </h2>
                <div class="title-group__sub">
                    <?php echo $guides_title_subtext; ?>
                </div>
            </div>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid-3x4">
            <?php
            $count = 0;
            foreach ($firstGuides as $guide) :
                $image = get_field('featured_image', $guide);
                $minutes_to_read = get_field('minutes_to_read', $guide);

                $title = get_the_title($guide);
                $text = get_the_excerpt($guide);
                $lastUpdate = get_the_modified_time('F jS, Y', $guide);
            ?>
                <div class="resource-card">
                    <a class="resource-card__image-area" href="<?php echo get_permalink($guide) ?>">
                        <img <?php afloat_image_markup($image['id'], 'portrait-small', array('portrait-small')); ?>>
                    </a>
                    <div class="resource-card__content">
                        <h3 class="resource-card__content__title">
                            <a href="<?php echo get_permalink($guide) ?>"><?php echo $title; ?></a>
                        </h3>
                        <div class="resource-card__content__description">
                            <?php echo $lastUpdate; ?>
                        </div>
                    </div>
                </div>

            <?php $count++;
            endforeach; ?>

        </div>
        <div class="grid-block__content__cta">
            <a class="cta-primary cta-primary--inverse" id="all-guides-link" href="<?php echo $top_level_guides_page; ?>">
                View The Guide
            </a>
        </div>
    </div>
</section>