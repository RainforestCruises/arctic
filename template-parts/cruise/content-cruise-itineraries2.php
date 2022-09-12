<?php
$itinerary_data = $args['itinerary_data'];
$departures = $itinerary_data['Departures'];
$itineraries = get_field('itineraries');

$curentYear = date("Y");

?>
<section class="cruise-itineraries" id="itineraries">
    <div class="cruise-itineraries__content">

        <div class="title-group">
            <div class="title-group__title">
                Itineraries
            </div>
            <div class="title-group__sub">
                There are <?php echo count($itineraries); ?> itineraries available
            </div>
        </div>
        <div class="cruise-itineraries__content__slider" id="itineraries-slider">
            <?php
            $hero_image = get_field('hero_image', $itineraries[0]);
            $title = get_the_title($itineraries[0]);
            $top_snippet = get_field('top_snippet', $itineraries[0]);
            ?>
            <div class="cruise-itineraries__content__slider__slide">

                <!-- Detail Area -->
                <div class="cruise-itineraries__content__slider__slide__detail-area">

                    <!-- Itinerary Card -->
                    <div class="resource-card encapsulated">

                        <!-- Images Slider -->
                        <div class="resource-card__image-area">
                        <img <?php afloat_image_markup($hero_image['id'], 'landscape-small', array('landscape-small', 'portrait-small')); ?>>

                        </div>

                        <!-- Content -->
                        <div class="resource-card__content">

                            <!-- Title -->
                            <div class="resource-card__content__title-group">
                                <div class="resource-card__content__title-group__title">
                                    <?php echo $title; ?>
                                </div>
                                <div class="resource-card__content__title-group__sub">

                                </div>
                            </div>

                            <!-- Specs -->
                            <div class="resource-card__content__description">

                            <?php echo $top_snippet; ?>

                            </div>


                            <!-- Price Group -->
                            <div class="resource-card__content__price-group">
                                <div class="resource-card__content__price-group__amount">
                                    $2,955
                                </div>
                                <div class="resource-card__content__price-group__text">
                                    Per Person
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- End Itinerary Card -->

                </div>

                <!-- Map Area -->
                <div class="cruise-itineraries__content__slider__slide__map-area">
                    <div class="cruise-itineraries__content__slider__slide__map-area__map" id="map-01"></div>
                </div>
            </div>

            <?php  ?>
        </div>


    </div>
</section>