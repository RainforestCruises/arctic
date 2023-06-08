<?php
$days = get_field('itinerary');
$length_in_nights = get_field('length_in_nights');
$length_in_days = $length_in_nights + 1;
$embarkation_point = get_field('embarkation_point');
$disembarkation_point = get_field('disembarkation_point');

?>

<!-- Itinerary Daily -->
<section class="grid-block narrow" id="itinerary">
    <div class="grid-block__content">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">
            <!-- Title -->
            <h2 class="title-single">
                Itinerary Day to Day
            </h2>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid1">

            <!-- Day List -->
            <div class="day-list">
                <?php
                $count = 0;
                $totalDays = count($days) - 1;
                foreach ($days as $day) :
                    $destinations = $day['destination']; // multiple destinations
                    $text = $day['text'];

                ?>
                    <div class="accordion-panel">

                        <!-- Panel Heading -->
                        <div class="accordion-panel__heading <?php echo $count == 0 ? "" : "closed"; ?>">
                            <div class="day-list__title">
                                <div class="day-list__title__pre">
                                    <?php echo dayCountMarkup($day['day_count']); ?>
                                </div>
                                <h3 class="day-list__title__text">
                                    <?php echo $day['title']; ?>
                                </h3>
                            </div>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                            </svg>
                        </div>

                        <!-- Panel Content -->
                        <div class="accordion-panel__content day-list__content" <?php echo $count == 0 ? "" : "style='display:none;'"; ?>>

                            <div class="day-list__content__text">
                                <?php echo $text; ?>
                            </div>
                            <div class="day-list__content__destinations">

                                <?php foreach ($destinations as $destination) :
                                    $image =  get_field('image', $destination);
                                    $title = get_the_title($destination);
                                ?>
                                    <div class="avatar avatar--small">
                                        <div class="avatar__image-area">
                                            <img <?php afloat_image_markup($image['id'], 'square-thumb'); ?>>
                                        </div>
                                        <div class="avatar__title-group">
                                            <div class="avatar__title-group__title">
                                                <?php echo $title; ?>
                                            </div>

                                            <?php if ($count == 0 && $destination == $embarkation_point) : ?>
                                                <div class="avatar__title-group__sub">
                                                    Embarkation Point
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($count == $totalDays && $destination == $disembarkation_point) : ?>
                                                <div class="avatar__title-group__sub">
                                                    Disembarkation Point
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>



                        </div>
                    </div>

                <?php $count++;
                endforeach; ?>
            </div>
        </div>
    </div>
</section>