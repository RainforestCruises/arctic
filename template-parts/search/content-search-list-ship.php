<!-- Itinerary Result -->
<a class="search-card-itinerary" href="<?php echo $args->ResourceLink; ?>">
    <!-- Tag -->
    <?php if ($args->BestOverallDiscount) : ?>
        <div class="search-card-itinerary__tag">
            Up to <span class="green-text"><?php echo $args->BestOverallDiscount ?>%</span> savings
        </div>
    <?php endif; ?>

    <!-- Image Area -->
    <div class="search-card-itinerary__image-area">
        <img <?php afloat_image_markup($args->ShipHeroImage['id'], 'portrait-small', array('portrait-small')); ?>>
    </div>

    <!-- Content -->
    <div class="search-card-itinerary__content">

        <!-- Title -->
        <h3 class="search-card-itinerary__content__title">
            <?php echo $args->DisplayName; ?>
        </h3>

        <!-- Specs -->
        <div class="search-card-itinerary__content__specs">

            <!-- Length -->
            <div class="specs-item">
                <div class="specs-item__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-time-clock"></use>
                    </svg>
                </div>
                <div class="specs-item__text">
                    <div class="specs-item__text__main">
                        <?php echo $args->ItineraryDisplay; ?>
                    </div>
                </div>
            </div>

            <!-- Size -->
            <div class="specs-item">
                <div class="specs-item__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-profile"></use>
                    </svg>
                </div>
                <div class="specs-item__text">
                    <?php echo $args->GuestsDisplay; ?>
                </div>
            </div>


            <!-- Departures -->
            <div class="specs-item">
                <div class="specs-item__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-calendar-date-2"></use>
                    </svg>
                </div>
                <div class="specs-item__text">
                    Dates:
                    <?php echo $args->DatesDisplay; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="search-card-itinerary__bottom">
        <!-- Price Group -->
        <div class="search-card-itinerary__bottom__price-group">
            <span class="search-card-itinerary__bottom__price-group__amount">
                <?php priceFormat($args->LowestPrice, $args->HighestPrice); ?>
            </span>
            <span class="search-card-itinerary__bottom__price-group__text">
                <?php echo ($args->LowestPrice) ? "Per Person" : ""; ?>
            </span>
        </div>
    </div>
</a>