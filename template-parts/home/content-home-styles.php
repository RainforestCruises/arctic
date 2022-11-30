<?php
$styles = get_field('styles');
$styles_title_subtext = get_field('styles_title_subtext')

?>


<section class="grid-block" id="section-styles">
    <div class="grid-block__content  block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">

            <!-- Title -->
            <div class="title-group">
                <div class="title-group__title">
                    Antarctica Travel Styles
                </div>
                <div class="title-group__sub">
                    <?php echo $styles_title_subtext; ?>
                </div>
            </div>

        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid5">
            <?php foreach ($styles as $style) :
                $image =  get_field('image', $style);
                $title = get_the_title($style);
            ?>

           
                <!-- Overlay Card -->
                <div class="overlay-card">
                    <div class="overlay-card__image-area">
                        <div class="overlay-card__image-area__item">
                            <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                        </div>
                    </div>
                    <a class="overlay-card__content" href="<?php echo get_permalink($travel_guide) ?>">
                        <div class="overlay-card__content__title-section">
                            <div class="overlay-card__content__title-section__title">
                                <?php echo $title; ?>
                            </div>
                        </div>
                    </a>
                </div>


            <?php endforeach; ?>




        </div>
        <div class="grid-block__content__cta">
            <a class="cta-primary cta-primary--inverse" id="all-guides-link">
                View All Styles
            </a>
        </div>

    </div>
</section>