<?php
$articles = get_field('articles');
$firstArticles = array_slice($articles, 0, 7);


?>

<section class="grid-block narrow" style="padding-bottom: 6rem;">
    <div class="grid-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">
            <!-- Title -->
            <h2 class="title-single center">
                My Travel Guides
            </h2>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid-3x4">
            <?php
            $count = 0;
            foreach ($firstArticles as $guide) :
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

    </div>
</section>