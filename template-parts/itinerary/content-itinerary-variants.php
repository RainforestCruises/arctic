<?php
$itineraryInfoObject = $args['itineraryInfoObject'];
$show_itinerary_note = get_field('show_itinerary_note');
$itinerary_note = get_field('itinerary_note');

?>

<!-- Itinerary Daily -->
<section class="itinerary-variants" id="itinerary">
    <div class="itinerary-variants__content">

        <!-- Title -->
        <div class="itinerary-variants__content__title">
            <div class="title-group">
                <h2 class="title-group__title">
                    <?php echo $itineraryInfoObject->hasVariants ? 'Itineraries' : 'Itinerary'; ?>
                </h2>
                <?php if ($itineraryInfoObject->hasVariants) : ?>
                    <div class="title-group__sub">
                        This itinerary has multiple variants. Select a different option below to see details.
                    </div>
                <?php endif; ?>
            </div>
        </div>


        <div class="itinerary-variants__content__itinerary <?php echo $itineraryInfoObject->hasVariants ? "" : "single-variant" ?>">
            <div class="itinerary-variants__content__itinerary__nav">
                <?php foreach ($itineraryInfoObject->itineraryObjects as $itineraryObject) :
                    $flightOption = getFlightOption($itineraryObject->fly_category);
                    console_log($flightOption);
                ?>
                    <button class="variant-button <?php echo $itineraryObject->index == 0 ? "active" : ""; ?>" data-variant-index="<?php echo $itineraryObject->index; ?>">

                        <div class="variant-button__title">
                            <?php echo $itineraryObject->length_in_days . '-Day'; ?>
                            <?php if ($itineraryInfoObject->hasDifferentTransport) :
                                echo $flightOption ? '<span class="badge">' . $flightOption . '</span>' : '';
                            endif; ?>
                        </div>
                        <span class="variant-button__sub"><?php echo $itineraryObject->departureDisplay ?></span>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="itinerary-variants__content__itinerary__main">

                <!-- Map section -->
                <div class="itinerary-variants__content__itinerary__main__map-area">
                    <!-- Map -->
                    <div class="full-component" id="itinerary-map"></div>
                    <!-- Map Legend -->
                    <div class="map-legend">
                        <!-- Item 1 -->
                        <div class="map-legend__item">
                            <div class="map-legend__item__marker-area">
                                <span class="map-legend__item__marker-area__mark--fly"></span>
                            </div>
                            <div class="map-legend__item__text">
                                Fly
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="map-legend__item">
                            <div class="map-legend__item__marker-area">
                                <span class="map-legend__item__marker-area__mark--cruise"></span>
                            </div>
                            <div class="map-legend__item__text">
                                Cruise
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($show_itinerary_note) : ?>
                    <div class="special-note">
                        <?php echo $itinerary_note; ?>

                    </div>
                <?php endif; ?>

                <!-- Days section -->
                <div class="itinerary-variants__content__itinerary__main__days-area">
                    <?php foreach ($itineraryInfoObject->itineraryObjects as $itineraryObject) : ?>

                        <!-- Day List -->
                        <div class="day-list <?php echo $itineraryObject->index == 0 ? "active" : ""; ?>" data-variant-index="<?php echo $itineraryObject->index; ?>">
                            <?php
                            $count = 0;
                            $days = $itineraryObject->days;
                            $embarkation_point = $itineraryObject->embarkation_point;
                            $disembarkation_point = $itineraryObject->disembarkation_point;

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

                    <?php endforeach; ?>

                </div>
            </div>
        </div>


    </div>
</section>