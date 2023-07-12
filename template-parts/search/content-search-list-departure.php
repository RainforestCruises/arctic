<!-- Departure Result -->
<a class="search-card-departure" href="<?php echo $args->resourceLink; ?>">

    <!-- Itinerary -->
    <div class="search-card-departure__section search-card-departure__section--itinerary">
        <div class="avatar avatar--small">
            <div class="avatar__image-area">
                <img <?php afloat_image_markup($args->itineraryHeroImage['id'], 'portrait-small', array('portrait-small')); ?>>
            </div>
            <div class="avatar__title-group">
                <div class="avatar__title-group__title">
                    <?php echo $args->displayName ?>
                    <?php echo $args->flightOption ? '<span class="badge-fly">' . $args->flightOption . '</span>' : ''; ?>
                </div>
                <div class="avatar__title-group__sub">
                    <?php echo $args->lengthDisplay ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Ship -->
    <?php
    $service_level = get_field('service_level', $args->ship);
    $subtitleDisplay = get_the_title($service_level) . ", " . get_field('vessel_capacity', $args->ship) . ' Guests';
    ?>
    <div class="search-card-departure__section search-card-departure__section--ship">
        <div class="avatar avatar--small">
            <div class="avatar__image-area">
                <img <?php afloat_image_markup($args->shipHeroImage['id'], 'portrait-small', array('portrait-small')); ?>>
            </div>
            <div class="avatar__title-group">
                <div class="avatar__title-group__title">
                    <?php echo $args->shipDisplayName ?>
                </div>
                <div class="avatar__title-group__sub">
                    <?php echo $subtitleDisplay ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Specs -->
    <div class="search-card-departure__section">

        <!-- Dates -->
        <div class="specs-item">
            <div class="specs-item__icon">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-in"></use>
                </svg>
            </div>
            <div class="specs-item__text">
                <div class="specs-item__text__main">
                    <span style="font-weight: 700;"><?php echo  date("F j", strtotime($args->departureDate)); ?></span> - <?php echo  date("M j, Y", strtotime($args->returnDate)); ?>
                </div>
            </div>
        </div>
        <!-- Ships -->
        <div class="specs-item specs-mobile">
            <div class="specs-item__icon">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-16"></use>
                </svg>
            </div>
            <div class="specs-item__text">
                Ship: <?php echo $args->shipDisplayName; ?>
            </div>
        </div>
        <!-- Embark -->
        <div class="specs-item">
            <div class="specs-item__icon">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-e"></use>
                </svg>
            </div>
            <div class="specs-item__text">
                <div class="specs-item__text__main">
                    Embarkation: <?php echo $args->embarkationDisplay; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="search-card-departure__bottom">
        <!-- Price Group -->
        <div class="search-card-departure__bottom__price-group">
            <span class="search-card-departure__bottom__price-group__amount">
                <?php priceFormat($args->lowestPrice); ?> - <?php priceFormat($args->highestPrice);  ?>
            </span>
            <span class="search-card-departure__bottom__price-group__text">
                Per Person
            </span>
        </div>
    </div>



</a>