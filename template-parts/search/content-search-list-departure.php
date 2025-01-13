<!-- Departure Result -->
<a class="search-card-departure" href="<?php echo $args->ResourceLink; ?>">

    <!-- Itinerary -->
    <div class="search-card-departure__section search-card-departure__section--itinerary">
        <div class="avatar avatar--small">
            <div class="avatar__image-area">
                <img <?php afloat_image_markup($args->ItineraryHeroImage['id'], 'portrait-small', array('portrait-small')); ?>>
            </div>
            <div class="avatar__title-group">
                <div class="avatar__title-group__title">
                    <?php echo $args->DisplayName ?>
                    <?php echo $args->FlightOption ? '<span class="badge-fly">' . $args->FlightOption . '</span>' : ''; ?>
                </div>
                <div class="avatar__title-group__sub">
                    <?php echo $args->LengthDisplay ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Ship -->
    <?php
    $service_level = get_field('service_level', $args->Ship);
    $subtitleDisplay = get_the_title($service_level) . ", " . get_field('vessel_capacity', $args->Ship) . ' Guests';
    ?>
    <div class="search-card-departure__section search-card-departure__section--ship">
        <div class="avatar avatar--small">
            <div class="avatar__image-area">
                <img <?php afloat_image_markup($args->ShipHeroImage['id'], 'portrait-small', array('portrait-small')); ?>>
            </div>
            <div class="avatar__title-group">
                <div class="avatar__title-group__title">
                    <?php echo $args->ShipDisplayName ?>
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
                    <?php
                    $departureStartDate = strtotime($args->DepartureDate);
                    $departureReturnDate = strtotime($args->ReturnDate);
                    $differentYears = date("Y", $departureStartDate) == date("Y", $departureReturnDate)  ? false : true;
                    ?>
                    <span style="font-weight: 700;"><?php echo  date(($differentYears ? "F j, Y" : "F j"), $departureStartDate); ?></span> - <?php echo  date("M j, Y", $departureReturnDate); ?>
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
                Ship: <?php echo $args->ShipDisplayName; ?>
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
                    Embarkation: <?php echo $args->EmbarkationDisplay; ?>
                </div>
            </div>
        </div>
        <!-- Deals -->
        <?php if ($args->Deals) :
            foreach ($args->Deals as $deal) : ?>
                <div class="card-tag card-tag--deal">
                    <?php echo get_field('short_title', $deal) ?>
                </div>
        <?php endforeach;
        endif; ?>
        <!-- Deals -->
        <?php if ($args->SpecialDepartures) :
            foreach ($args->SpecialDepartures as $special) : ?>
                <div class="card-tag card-tag--special">
                    <?php echo get_field('short_title', $special) ?>
                </div>
        <?php endforeach;
        endif; ?>
    </div>

    <!-- Bottom -->
    <div class="search-card-departure__bottom">
        <?php if ($args->BestDiscount) : ?>
            <div class="search-card-departure__bottom__savings">
                Up to <span class="green-text"><?php echo $args->BestDiscount; ?>%</span> Savings
            </div>
        <?php endif; ?>
        <!-- Price Group -->
        <div class="search-card-departure__bottom__price-group">

            <span class="search-card-departure__bottom__price-group__amount">
                <?php priceFormat($args->LowestPrice, $args->HighestPrice); ?>
            </span>
            <span class="search-card-departure__bottom__price-group__text">
                <?php echo ($args->LowestPrice) ? "Per Person" : ""; ?>
            </span>

        </div>

    </div>



</a>