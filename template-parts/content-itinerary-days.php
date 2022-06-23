<?php
$itinerary_data = $args['itinerary_data'];
?>

<div class="itinerary-days">
    <div class="itinerary-days__title">
        Itinerary
    </div>
    <!-- Slider -->
    <div class="itinerary-days__slider" id="itinerary-days-slider">

        <?php
        $days = $itinerary_data['ItineraryDays'];
        $dayImages = $itinerary_data['DayImageDTOs'];
        $dayCount = 1;


        if ($days) :
            usort($days, "sortDays");
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
                <div class="itinerary-days__slider__item">

                    <!-- Side / Image -->
                    <div class="itinerary-days__slider__item__image-area">
                        <?php if ($img != null) : ?>
                            <img src="<?php echo afloat_dfcloud_image($img['ImageUrl']); ?>" alt="<?php echo $img['AltText'] ?>">
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div class="itinerary-days__slider__item__content">

                        <div class="itinerary-days__slider__item__content__text">
                            <?php echo $day['Excerpt'] ?>
                        </div>
                    </div>



                </div>


        <?php
                $dayCount++;
            endforeach;
        endif; ?>
    </div>
    <span class="product-itinerary-slide__bottom__counter">1 / <?php echo ($dayCount - 1); ?></span>
</div>