<?php
$itinerary_data = $args['itinerary_data'];
$days = get_field('itinerary');

function dayCountMarkup($string, $exclude_number = false)
{

    if ($exclude_number == true) {
        if (str_contains($string, '-')) {
            echo 'Days';
        } else {
            echo 'Day';
        }
    } else {
        if (str_contains($string, '-')) {
            echo 'Days ' . $string;
        } else {
            echo 'Day ' . $string;
        }
    }
}

?>

<section class="itinerary-days" id="itinerary">

    <div class="itinerary-days__content">




        <div class="itinerary-days__content__layout">

            <!-- Nav Slider -->
            <div class="itinerary-days__content__layout__side-nav">

                <div class="title-group">
                    <div class="title-group__title">
                        Itinerary
                    </div>
                    <div class="title-group__sub">
                        <?php echo $itinerary_data['LengthInDays'] . ' Days / ' . $itinerary_data['LengthInNights'] . ' Nights in total'?>
                    </div>
                </div>

                <div class="itinerary-days__content__layout__side-nav__slider" id="itinerary-nav-slider">

                    <?php foreach ($days as $day) : ?>

                        <div class="day-slide-nav">
                            <div class="day-slide-nav__circle">
                            </div>
                            <div class="day-slide-nav__line">
                            </div>

                            <div class="day-slide-nav__title-group">
                                <div class="day-slide-nav__title-group__sub">
                                    <?php echo dayCountMarkup($day['day_count']); ?>
                                </div>
                                <div class="day-slide-nav__title-group__title">
                                    <?php echo $day['title']; ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <!-- Main Slider -->
            <div class="itinerary-days__content__layout__main">

                <div class="itinerary-days__content__layout__main__slider" id="itinerary-main-slider">

                    <?php foreach ($days as $day) :
                        $image =  $day['image'];
                    ?>

                        <!-- Day Slide -->
                        <div class="day-slide">

                            <div class="day-slide__title">
                                <?php echo dayCountMarkup($day['day_count']) . ": " . $day['title'] ?>


                            </div>


                            <!-- Content -->
                            <div class="day-slide__content">

                                <img <?php afloat_image_markup($image['id'], 'vertical-small', 'featured-small'); ?>>
                                <?php echo $day['text'] ?>
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