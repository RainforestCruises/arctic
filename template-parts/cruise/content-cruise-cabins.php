<?php
$cruise_data = $args['cruise_data'];
$cabins = $cruise_data['CabinDTOs'];

$curentYear = date("Y");

?>
<section class="cruise-cabins" id="amenities">
    <div class="cruise-cabins__content">

        <!-- Title -->
        <div class="title-group">
            <div class="title-group__title">
                Cabins
            </div>
            <div class="title-group__sub">
                There are <?php echo count($cabins); ?> cabin types available
            </div>
        </div>

        <!-- Cabins slider -->
        <div class="cruise-cabins__content__slider" id="cabins-slider">
            <?php
            $cabinCount = 0;
            foreach ($cabins as $cabin) :
            ?>

                <!-- Cabin Card -->
                <a class="resource-card">

                    <!-- Images Slider -->
                    <div class="resource-card__image-area">

                        <!-- Image from DF -->
                        <?php
                        $cabinImages = $cabin['ImageDTOs'];
                        foreach ($cabinImages as $cabinImage) : ?>

                            <img src="<?php echo afloat_dfcloud_image($cabinImage['ImageUrl']); ?>" alt="<?php echo esc_html($cabinImage['AltText']); ?>">

                        <?php endforeach; ?>

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
                </a>



            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php
function checkDeparturesInYear($year, $departureList)
{
    $match = false;
    foreach ($departureList as $d) {
        if (str_contains($d['DepartureDate'], strval($year))) {
            $match = true;
        }
    }
    return $match;
}

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