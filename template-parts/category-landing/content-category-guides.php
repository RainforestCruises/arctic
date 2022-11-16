<?php
$travel_guide_posts = get_field('travel_guide_posts');
$travel_guide_title_subtext = get_field('travel_guide_title_subtext');
$view_all_guide_link = get_field('view_all_guide_link');

?>

<!-- Travel Guide -->
<section class="grid-block" id="section-guide">
    <div class="grid-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <div class="title-group__title">
                    Travel Guide
                </div>
                <div class="title-group__sub">
                    <?php echo $travel_guide_title_subtext; ?>
                </div>
            </div>

        </div>

        <!-- Grid Area -->
        <div class="category-guides">
            <?php
            $guideCount = 1;
            foreach ($travel_guide_posts as $travel_guide) :
                $image = get_field('featured_image', $travel_guide);
                $categories = get_field('categories', $travel_guide);
                $displayCategory = "Travel Guide";
                $displayTitle = get_field('navigation_title', $travel_guide);

                if ($categories) {
                    $first = $categories[0];
                    $displayCategory = get_the_title($first);
                }
            ?>

                <!-- Overlay Card -->
                <div class="overlay-card <?php echo ($guideCount < 3 ? "large" : ""); ?>">
                    <div class="overlay-card__image-area">
                        <div class="overlay-card__image-area__item">
                            <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                        </div>
                    </div>
                    <a class="overlay-card__content" href="<?php echo get_permalink($travel_guide) ?>">
                        <div class="overlay-card__content__title-section">
                            <div class="overlay-card__content__title-section__sub">
                                <?php echo $displayCategory; ?>
                            </div>
                            <div class="overlay-card__content__title-section__title">
                                <?php echo $displayTitle; ?>
                            </div>
                        </div>
                        <div class="overlay-card__content__cta">

                        </div>
                    </a>
                </div>


            <?php $guideCount++;
            endforeach; ?>




        </div>

        <div class="grid-block__content__cta">
            <a class="cta-primary cta-primary--inverse" id="all-guides-link" href="<?php echo $view_all_guide_link ?>">
                Read All Travel Guide
            </a>
        </div>
    </div>
</section>