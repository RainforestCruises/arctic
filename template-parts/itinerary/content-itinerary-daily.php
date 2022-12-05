<?php
$days = get_field('itinerary');
$length_in_nights = get_field('length_in_nights');
$length_in_days = $length_in_nights + 1;
?>

<!-- Itinerary Daily -->
<section class="grid-block narrow" id="section-itinerary">
    <div class="grid-block__content ">

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid1">

            <!-- Day List -->
            <div class="day-list">
                <?php
                $count = 0;
                foreach ($days as $day) :
                    $image =  $day['image'];
                    $text = $day['text'];
                    $destination = $day['destination'];

                ?>
                    <div class="accordion-panel">

                        <!-- Panel Heading -->
                        <div class="accordion-panel__heading <?php echo $count == 0 ? "": "closed" ; ?>" >
                            <div class="day-list__title">
                                <div class="day-list__title__day-indication">
                                    <?php echo dayCountMarkup($day['day_count']); ?>
                                </div>
                                <div class="day-list__title__text">
                                    <?php echo $day['title']; ?>
                                </div>
                            </div>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                            </svg>
                        </div>

                        <!-- Panel Content -->
                        <div class="accordion-panel__content day-list__content" <?php echo $count == 0 ? "": "style='display:none;'" ; ?>>

                     
                            <div class="day-list__content__text">
                                <?php echo $text; ?>
                            </div>
                            <div class="day-list__content__image-area">

                                <!-- Overlay Card -->
                                <div class="overlay-card">
                                    <div class="overlay-card__image-area">
                                        <div class="overlay-card__image-area__item">
                                            <img <?php afloat_image_markup($image['id'], 'portrait-medium'); ?>>
                                        </div>
                                    </div>
                                    <div class="overlay-card__content">
                                        <div class="overlay-card__content__title-section">
                                            <div class="overlay-card__content__title-section__title">
                                                <?php echo get_the_title($destination); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <?php $count++;
                endforeach; ?>
            </div>
        </div>
    </div>
</section>