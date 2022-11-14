<?php
//$itinerary_data = $args['itinerary_data'];
$days = get_field('itinerary');
$ships = get_field('ships');
$length_in_nights = get_field('length_in_nights');
$length_in_days = $length_in_nights + 1;

//console_log($ship);

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

<section class="itinerary-days" id="section-itinerary">

    <div class="itinerary-days__content">

        <div class="itinerary-days__content__layout">

            <!-- Nav Slider -->
            <div class="itinerary-days__content__layout__side-nav">

                <div class="title-group">
                    <div class="title-group__title">
                        Itinerary
                    </div>
                    <div class="title-group__sub">
                        <?php echo $length_in_days . ' Days / ' . $length_in_nights . ' Nights in total' ?>
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

                    <?php
                    $dayCount = 1;
                    foreach ($days as $day) :
                        $image =  $day['image'];
                        $text = $day['text'];
                        $expand = strlen($day['text']) > 750 ? true : false;
                        $text_limited = substr($text, 0, 750);
                        if ($expand) {
                            $text_limited .= '...';
                        }
                    ?>

                        <!-- Day Slide -->
                        <div class="day-slide">

                            <div class="day-slide__title">
                                <?php echo dayCountMarkup($day['day_count']) . ": " . $day['title'] ?>
                            </div>


                            <!-- Content -->
                            <div class="day-slide__content">
                                <div class="day-slide__content__image">
                                    <img <?php afloat_image_markup($image['id'], 'vertical-small', 'featured-small'); ?>>
                                </div>
                                <div class="day-slide__content__text">
                                    <?php echo $text_limited; ?>
                                </div>
                                <div class="day-slide__content__expand">
                                    <?php if ($expand) : ?>
                                        <button class="btn-text-icon itinerary-day-expand" day-section="<?php echo 'day-section-' . $dayCount; ?>">
                                            Read More
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                        </button>
                                    <?php endif; ?>
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


<div class="modal" id="itineraryDaysModal">
    <div class="modal__content"">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    Itinerary Schedule
                </div>
            </div>
            <button class="btn-text-icon close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

    <!-- Main Modal Content -->
        <div class="modal__content__main" id="itineraryDaysModalMainContent">

            <div class="days-modal">
                <div class="days-modal__filters">

                </div>
                <div class="days-modal__content">
                    <?php
                    $dayCount = 1;
                    foreach ($days as $day) :
                        $image =  $day['image'];
                        $text = $day['text'];
                        $title = $day['title'];
                    ?>

                        <div class="days-item" id="<?php echo 'day-section-' . $dayCount; ?>">
                            <div class="days-item__title-group">
                                <div class="days-item__title-group__title">
                                    <?php echo $title; ?>
                                </div>
                                <div class="days-item__title-group__sub">
                                    <?php echo dayCountMarkup($day['day_count']); ?>
                                </div>
                            </div>
                            <div class="days-item__image">
                                <img <?php afloat_image_markup($image['id'], 'featured-large', array('featured-large', 'featured-medium','featured-small')); ?>>
                            </div>

                            <div class="days-item__text">
                                <?php echo $text; ?>
                            </div>
                        </div>
                    <?php $dayCount++;
                    endforeach; ?>
                </div>

            </div>

        </div>
    </div>
</div>