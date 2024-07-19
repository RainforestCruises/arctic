<!-- Itinerary Result -->
<a class="search-card-itinerary" href="<?php echo $args->ResourceLink; ?>">
    <!-- Tag Area -->
    <div class="search-card-itinerary__tag-area">
        <?php if ($args->Deals) :
            if (count($args->Deals) == 1) :
                foreach ($args->Deals as $deal) : ?>
                    <div class="card-tag card-tag--deal">
                        <?php echo get_field('short_title', $deal) ?>
                    </div>
                <?php endforeach;
            else : ?>
                <div class="card-tag card-tag--deal">
                    <?php echo count($args->Deals) ?> Deals
                </div>
        <?php endif;
        endif; ?>
        <?php if ($args->SpecialDepartures) :
            foreach ($args->SpecialDepartures as $special) : ?>
                <div class="card-tag card-tag--special">
                    <?php echo get_field('short_title', $special) ?>
                </div>
        <?php endforeach;
        endif; ?>
    </div>

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
        <?php if ($args->BestDiscount) : ?>
            <div class="search-card-itinerary__bottom__savings">
                Up to <span class="green-text"><?php echo $args->BestDiscount; ?>%</span> Savings
            </div>
        <?php endif; ?>
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