<?php
$cruise_data = $args['cruiseData'];
?>


<!-- Cabins -->
<div class="product-cabins">

    <h3 class="xsub-divider xsub-divider--dark u-margin-bottom-small">
        Suites & Cabins
    </h3>
    <!-- Cabins -->
    <?php
    $cabins = $cruise_data['CabinDTOs'];

    

    $cabinCount = 0;
    if ($cabins) : ?>

        <?php foreach ($cabins as $cabin) : ?>
            <?php

            //Occupancy Display
            $primaryOccupancy = $cabins[$cabinCount]['PrimaryOccupancy'];
            $secondaryOccupancy = 0;
            if ($cabins[$cabinCount]['SecondaryEnabled'] == true) {
                $secondaryOccupancy = $cabins[$cabinCount]['SecondaryOccupancy'];
            }
            $totalOccupancy = $primaryOccupancy + $secondaryOccupancy;
            $occupancyDisplay = '';
            if($totalOccupancy != $primaryOccupancy){
                $occupancyDisplay = $primaryOccupancy . ' - ' . $totalOccupancy;
            }else {
                $occupancyDisplay = $primaryOccupancy;
            }

            if (array_key_exists('CabinCapacityLabel', $cabins[$cabinCount])) {

                if($cabins[$cabinCount]['CabinCapacityLabel'] != null){
                    $occupancyDisplay = $cabins[$cabinCount]['CabinCapacityLabel'];
                }
            }
            
            $cabinCountLabel = null;
            if (array_key_exists('CabinCountLabel', $cabins[$cabinCount])) {
                //check if lodge for naming? 
                if($cabins[$cabinCount]['CabinCountLabel'] != null){
                    if($cabins[$cabinCount]['CabinCountLabel'] == 1){
                        $cabinCountLabel = $cabins[$cabinCount]['CabinCountLabel'] . ' Cabin';
                    } else {
                        $cabinCountLabel = $cabins[$cabinCount]['CabinCountLabel'] . ' Cabins';
                    }
                    
                }
            }
            ?>
            <div class="product-cabins__cabin ">
                <div class="product-cabins__cabin__image-area dfproperty">
                    <!-- Image from DF -->
                    <?php $cabinImages = $cabins[$cabinCount]['ImageDTOs'];      
                    foreach($cabinImages as $cabinImage) :

                        ?> 
                            <img data-flickity-lazyload-src="<?php echo afloat_dfcloud_image($cabinImage['ImageUrl']); ?>" alt="<?php echo esc_html($cabinImage['AltText']); ?>">
                        <?php
                        endforeach;       
                    ?>
                    
                </div>
                <div class="product-cabins__cabin__content">
                    <div class="product-cabins__cabin__content__title">
                        <?php if ($cabinCountLabel != null) : ?>
                        <div class="product-cabins__cabin__content__title__cabin-count">
                            <?php echo ($cabinCountLabel); ?>
                        </div>
                        <?php endif; ?>
                        <h4><?php echo ($cabins[$cabinCount]['Name']); ?></h4>
                    </div>
                    <div class="product-cabins__cabin__content__feature-grid">
                        <div class="product-cabins__cabin__content__feature-item">
                            <div class="product-cabins__cabin__content__feature-item__title">
                                Guests
                            </div>
                            <span><?php echo $occupancyDisplay; ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <div class="product-cabins__cabin__content__feature-item__title">
                                Size
                            </div>
                            <span><?php echo ($cabins[$cabinCount]['Size']); ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <div class="product-cabins__cabin__content__feature-item__title">
                                Beds
                            </div>
                            <span><?php echo ($cabins[$cabinCount]['Beds']); ?></span>
                        </div>
                    </div>
                    <?php echo ($cabins[$cabinCount]['Features']); ?>

                </div>
            </div>
            <?php
            $cabinCount++;
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

