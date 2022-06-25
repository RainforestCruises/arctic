<?php
$itinerary_data = $args['itinerary_data'];

$days = $itinerary_data['ItineraryDays'];
usort($days, "sortDays");

$dayImages = $itinerary_data['DayImageDTOs'];
?>

<section class="itinerary-days" id="days">

    <div class="itinerary-days__content">
        <div class="title-group">
            <div class="title-group__title">
                Itinerary
            </div>
            <div class="title-group__sub">
                15 Days / 14 Night in total
            </div>
        </div>

        <div class="itinerary-days__content__layout">
            <div class="itinerary-days__content__layout__nav-slider" id="itinerary-days-nav-slider">
                <?php
                $dayCount = 1;
                foreach ($days as $day) : ?>


                    <div class="day-slide-nav">
                        <div class="day-slide-nav__day">
                            Day <?php echo $dayCount; ?>
                        </div>
                        <div class="day-slide-nav__line">
                           
                        </div>
                        <div class="day-slide-nav__info">
                            <div class="day-slide-nav__info__name">
                                <div class="day-slide-nav__info__name__title">
                                    <?php echo $day['Title'] ?>
                                </div>
                                <div class="day-slide-nav__info__name__sub">
                                    Locations visited on activity
                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                    $dayCount++;
                endforeach;
                ?>
            </div>
            <div class="itinerary-days__content__layout__slider">
                <!-- Slider -->
                <div class="itinerary-days__content__layout__slider" id="itinerary-days-slider">



                    <?php
                    $dayCount = 1;
                    foreach ($days as $day) : ?>
                        <?php
                        $img = null;
                        foreach ($dayImages as $dayImage) {
                            if ($dayCount == $dayImage['DayNumber']) {
                                $img = $dayImage;
                                break;
                            }
                        }
                        ?>

                        <!-- Day Slide -->
                        <div class="day-slide">

                            <div class="day-slide__top">

                                <div class="day-slide__top__meta">
                                    <div class="day-slide__top__meta__day">
                                        Day <?php echo $dayCount; ?>
                                    </div>
                                    <div class="day-slide__top__meta__title">
                                        <?php echo $day['Title'] ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Content -->
                            <div class="day-slide__bottom">

                                <div class="day-slide__bottom__text">
                                    <img src="<?php echo afloat_dfcloud_image($img['ImageUrl']); ?>" alt="<?php echo $img['AltText'] ?>">
                                    <?php echo $day['Excerpt'] ?>
                                </div>
                            </div>

                        </div>


                    <?php
                        $dayCount++;
                    endforeach;
                    ?>

                </div>
            </div>

        </div>


    </div>

</section>