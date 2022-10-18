<?php
$cabins = $args['cabins'];
$curentYear = $args['curentYear'];



?>

<section class="slider-block narrow cruise-cabins" id="section-cabins">
    <div class="slider-block__content cruise-cabins__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-single">
                    Cabins
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">
                <div class="swiper-button-prev swiper-button-prev--white-border cabins-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border cabins-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>
            
        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <!-- Swiper -->
            <div class="swiper" id="cabins-slider">
                <div class="swiper-wrapper">

                    <?php
                    $index = 0;
                    foreach ($cabins as $cabin) : ?>

                        <!-- Cabin Card -->
                        <div class="resource-card swiper-slide">

                            <!-- Images Slider -->
                            <div class="resource-card__image-area swiper cabin-card-image-area">
                                <div class="swiper-wrapper">
                                    <!-- Image from DF -->
                                    <?php
                                    $cabinImages = $cabin['ImageDTOs'];
                                    foreach ($cabinImages as $cabinImage) : ?>
                                        <div class="resource-card__image-area__item cabin-image-slide swiper-slide" imageId="df-<?php echo $cabinImage['Id']; ?>">
                                            <img src="<?php echo afloat_dfcloud_image($cabinImage['ImageUrl'], 640, 480); ?>"  alt="<?php echo esc_html($cabinImage['AltText']); ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev swiper-button-prev--overlay"></div>
                                <div class="swiper-button-next swiper-button-prev--overlay"></div>

                            </div>

                            <!-- Content -->
                            <div class="resource-card__content">

                                <!-- Title -->
                                <div class="resource-card__content__title-group">
                                    <div class="resource-card__content__title-group__title">
                                        <?php echo $cabin['Name']; ?>
                                    </div>
                                    <div class="resource-card__content__title-group__sub">
                                        <?php echo getCabinCountDisplay($cabin) ?>
                                    </div>
                                </div>

                                <!-- Specs -->
                                <div class="resource-card__content__specs">

                                    <!-- Guests -->
                                    <div class="resource-card__content__specs__item">
                                        <div class="resource-card__content__specs__item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-profile"></use>
                                            </svg>
                                        </div>
                                        <div class="resource-card__content__specs__item__text">
                                            <?php echo getOccupancyDisplay($cabin); ?> Guests, <?php echo ($cabin['Beds']); ?> Bed
                                        </div>
                                    </div>

                                    <!-- Size -->
                                    <div class="resource-card__content__specs__item">
                                        <div class="resource-card__content__specs__item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-zoom-square"></use>
                                            </svg>
                                        </div>
                                        <div class="resource-card__content__specs__item__text">
                                            <?php echo ($cabin['Size']); ?>
                                        </div>
                                    </div>

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
                        <!-- End Cabin Card -->

                    <?php $index++;
                    endforeach; ?>

                </div>
            </div>

        </div>
    </div>
</section>






























<?php


//cabin count plurality
function getCabinCountDisplay($cabin)
{
    $cabinCountLabel = '';
    if ($cabin['CabinCountLabel'] != null) {
        if ($cabin['CabinCountLabel'] == 1) {
            $cabinCountLabel = $cabin['CabinCountLabel'] . ' Cabin';
        } else {
            $cabinCountLabel = $cabin['CabinCountLabel'] . ' Cabins';
        }
    }
    return $cabinCountLabel;
}

//occupancy in cabin display from DF cabinDTO
function getOccupancyDisplay($cabin)
{
    $primaryOccupancy = $cabin['PrimaryOccupancy'];
    $secondaryOccupancy = 0;
    if ($cabin['SecondaryEnabled'] == true) {
        $secondaryOccupancy = $cabin['SecondaryOccupancy'];
    }
    $totalOccupancy = $primaryOccupancy + $secondaryOccupancy;
    $occupancyDisplay = '';
    if ($totalOccupancy != $primaryOccupancy) {
        $occupancyDisplay = $primaryOccupancy . ' - ' . $totalOccupancy;
    } else {
        $occupancyDisplay = $primaryOccupancy;
    }


    if ($cabin['CabinCapacityLabel'] != null) {
        $occupancyDisplay = $cabin['CabinCapacityLabel'];
    }
    return $occupancyDisplay;
}

?>