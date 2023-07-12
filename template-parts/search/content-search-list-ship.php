<!-- Itinerary Result -->
<a class="search-card-itinerary" href="<?php echo $args->resourceLink; ?>">
    <!-- Tag -->
    <?php if ($args->bestOverallDiscount) : ?>
        <div class="search-card-itinerary__tag">
            Up to <span class="green-text"><?php echo $args->bestOverallDiscount ?>%</span> savings
        </div>
    <?php endif; ?>

    <!-- Image Area -->
    <div class="search-card-itinerary__image-area">
        <img <?php afloat_image_markup($args->shipHeroImage['id'], 'portrait-small', array('portrait-small')); ?>>
    </div>

    <!-- Content -->
    <div class="search-card-itinerary__content">

        <!-- Title -->
        <h3 class="search-card-itinerary__content__title">
            <?php echo $args->displayName; ?>
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
                        <?php echo $args->itineraryDisplay; ?>
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
                    <?php echo $args->guestsDisplay; ?>
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
                    <?php echo $args->datesDisplay; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="search-card-itinerary__bottom">
        <!-- Price Group -->
        <div class="search-card-itinerary__bottom__price-group">
            <span class="search-card-itinerary__bottom__price-group__amount">
                <?php priceFormat($args->lowestPrice); ?> - <?php priceFormat($args->highestPrice);  ?>
            </span>
            <span class="search-card-itinerary__bottom__price-group__text">
                Per Person
            </span>
        </div>
    </div>
</a>