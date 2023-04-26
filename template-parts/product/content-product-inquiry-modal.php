<?php
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');
$productName = $args['productName'];
$departures = $args['departures'];
$currentYear = $args['curentYear'];
$yearSelections = $args['yearSelections'];
$itineraryDataList = $args['itineraryDataList'];
$itineraryPosts = $args['itineraryPosts'];
$ships = $args['ships'];
?>

<div class="modal" id="inquireModal">
    <div class="modal__content">
        <div class=" modal__content__top">

            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title" id="departure-modal-title">
                    Departure Dates
                </div>
                <button class="btn-pill modal-tab-link" tab-panel="dates">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                    Date Selection
                </button>
                <button class="btn-pill modal-tab-link" tab-panel="cabins">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                    Cabin Prices
                </button>
            </div>

            <button class="btn-text-icon close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main" id="inquireModalMainContent">

            <!-- Inquire Form -->
            <div class="inquire-form tabpanel modal-tab-panel" tab-panel="inquire">
                <div class="inquire-form__intro">
                    <div class="inquire-form__intro__title">
                        Interested in the <?php echo $productName; ?>?
                    </div>
                    <div class="inquire-form__intro__selection">
                        <div class="inquire-form__intro__selection__item" id="departure-selection-display"></div>
                        <div class="inquire-form__intro__selection__item" id="cabin-selection-display"></div>
                    </div>
                    <div class="inquire-form__intro__subtext">
                        Please fill in the form and we’ll get back to you ASAP.
                    </div>
                </div>

                <div class="inquire-form__form">
                    <?php
                    if (is_plugin_active('wpforms/wpforms.php')) {
                        wpforms_display($primary_contact_form_id);
                    } else {
                        echo 'Forms Plugin Missing';
                    }
                    ?>
                </div>
                <!-- Outro -->
                <div class="inquire-form__outro">
                    You can also send us a message directly at <a href="mailto:cruise@antarcticacruises.com">cruise@antarcticacruises.com</a>
                </div>
            </div>

            <!-- Departures -->
            <div class="departures-modal  tabpanel modal-tab-panel" tab-panel="dates">
                <div class="departures-modal__filters">
                    <div class="departure-date-subtitle" style="font-size: 12px;">Showing <?php echo count($departures); ?> scheduled departures</div>
                    <button class="btn-pill clear-departure-filters" style="display: none;">Clear Filters</button>
                </div>
                <div class="departures-modal__content">
                    <?php foreach ($departures as $d) :
                        $departureId = $d['ID'];
                        $itineraryPost = $d['ItineraryPost'];
                        $itineraryPostId = $d['ItineraryPostId'];
                        $departureStartDate = strtotime($d['DepartureDate']);
                        $departureReturnDate = strtotime($d['ReturnDate']);
                        $title = get_field('display_name', $itineraryPost);
                        $hero_gallery = get_field('hero_gallery', $itineraryPost);
                        $embarkationPost = get_field('embarkation_point', $itineraryPost);
                        $embarkationName = get_the_title($embarkationPost) . ', ' . get_field('country_name', $embarkationPost);
                        $secondaryFilterId = $itineraryPostId;
                        $subtitleDisplay = $d['LengthInNights'] + 1 . ' Days / ' . $d['LengthInNights'] . ' Nights';
                        $bestDiscount = $d['BestDiscount'];
                        $deals = $d['Deals'];

                        if (get_post_type() == 'rfc_itineraries') {
                            $ship = $d['Ship'];
                            $shipId = $d['ShipId'];
                            $secondaryFilterId = $shipId;
                            $title = get_the_title($ship);
                            $hero_gallery = get_field('hero_gallery', $ship);
                            $service_level = get_field('service_level', $ship);
                            $subtitleDisplay = get_the_title($service_level) . ", " . get_field('vessel_capacity', $ship) . ' Guests';
                        }
                        $image = $hero_gallery[0];
                    ?>

                        <div class="information-card information-card--horizontal info-departure-card" data-filter-date="<?php echo date("Y", $departureStartDate); ?>" data-filter-secondary="<?php echo $secondaryFilterId; ?>" data-filter-discount=<?php echo ($bestDiscount) ? true : false ?>>
                            <!-- Title Group -->
                            <div class="information-card__section">
                                <div class="avatar ">
                                    <div class="avatar__image-area">
                                        <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>
                                    </div>
                                    <div class="avatar__title-group">
                                        <div class="avatar__title-group__title">
                                            <?php echo  $title; ?>
                                        </div>
                                        <div class="avatar__title-group__sub">
                                            <?php echo $subtitleDisplay; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Specs -->
                            <div class="information-card__section">
                                <div class="information-card__section__specs">
                                    <!-- Dates -->
                                    <div class="specs-item">
                                        <div class="specs-item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-in"></use>
                                            </svg>
                                        </div>
                                        <div class="specs-item__text">
                                            <div class="specs-item__text__main">
                                                <span style="font-weight: 700;"><?php echo  date("F j", $departureStartDate); ?></span> - <?php echo  date("M j, Y", $departureReturnDate); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Ports -->
                                    <div class="specs-item">
                                        <div class="specs-item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-e"></use>
                                            </svg>
                                        </div>
                                        <div class="specs-item__text">
                                            <div class="specs-item__text__main">
                                                <?php echo $embarkationName ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Prices -->
                                    <div class="specs-item">
                                        <div class="specs-item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-shopping-tag"></use>
                                            </svg>
                                        </div>
                                        <div class="specs-item__text">
                                            <div class="specs-item__text__main">
                                                <?php priceFormat($d['LowestPrice']);  ?> - <?php priceFormat($d['HighestPrice']);  ?>
                                            </div>
                                            <?php if ($bestDiscount) : ?>
                                                <div class="specs-item__text__sub">
                                                    Up to <span class="green-text"><?php echo $bestDiscount; ?>%</span> savings
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- Deals -->
                                    <?php if ($deals) :
                                        foreach ($deals as $deal) :
                                            $dealId = $deal->ID;
                                            $short_title = get_field('short_title', $deal);
                                            $is_special_departure = get_field('is_special_departure', $deal);
                                    ?>
                                            <div class="specs-deal <?php echo $is_special_departure ? "specs-deal--special special-departure-cta" : ""; ?> modal-deal-card" dealId="<?php echo $dealId ?>">
                                                <?php echo $short_title; ?>
                                            </div>
                                    <?php endforeach;
                                    endif; ?>
                                </div>
                            </div>

                            <div class="information-card__bottom">
                                <!-- Price Group -->
                                <div class="information-card__bottom__price-group">
                                    <button class="cta-square-icon cta-square-icon--inverse departure-price-group-button" departureId="<?php echo $departureId; ?>" year="<?php echo date("Y", $departureStartDate); ?>" departureDate="<?php echo date("M d, Y", $departureStartDate); ?>" itineraryTitle="<?php echo $title; ?>">
                                        View Prices
                                    </button>
                                </div>

                                <!-- CTA -->
                                <div class="information-card__bottom__cta">
                                    <button class="cta-square-icon departure-inquire-cta" departureDate="<?php echo date("M d, Y", $departureStartDate); ?>" itineraryTitle="<?php echo $title; ?>">
                                        Inquire
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Cabins Per Itinerary (Year + Season) -->
            <!-- Create horizonal room (with inquire button) -->
            <div class="cabins-modal tabpanel modal-tab-panel" tab-panel="cabins">
                <div class="cabins-modal__filters">
                    <div id="cabin-departure-subtitle"></div>
                </div>
                <div class="cabins-modal__content">
                    <?php foreach ($departures  as $d) :
                        $departureId = $d['ID'];
                        $cabins = $d['Cabins'];
                        $deals = $d['Deals']; ?>

                        <!-- Deals -->
                        <?php if ($deals) :
                            foreach ($deals as $deal) :
                                $dealImage = get_field('featured_image', $deal);
                                $dealTitle = get_field('navigation_title', $deal);
                                $dealId = $deal->ID;
                        ?>
                                <div class="deal-card-inline modal-deal-card" departureId="<?php echo $departureId; ?>" dealId="<?php echo $dealId ?>">
                                    <div class="deal-card-inline__title">
                                        <?php echo $dealTitle; ?>
                                    </div>

                                    <div class="deal-card-inline__cta">
                                        <!-- CTA -->
                                        <button class="btn-text-plain">
                                            Details
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                        <!-- End Deals -->

                        <!-- Cabins -->
                        <?php foreach ($cabins as $cabin) :
                            $cabinPost = $cabin['cabin'];
                            $cabinId = $cabinPost->ID;
                            $title =  get_field('display_name', $cabinPost);
                            $dimensions =  get_field('dimensions', $cabinPost);
                            $is_single =  get_field('is_single', $cabinPost);
                            $is_sharable =  get_field('is_sharable', $cabinPost);
                            $capacity =  get_field('capacity', $cabinPost);
                            $quantity =  get_field('quantity', $cabinPost);
                            $beds =  get_field('beds', $cabinPost);
                            $hero_gallery = get_field('images', $cabinPost);
                            $image = $hero_gallery[0];
                            $price = $cabin['price'];
                            $hasDiscount = $cabin['discounted_price'] ? true : false;
                            $discounted_price = $cabin['discounted_price'];
                            $sold_out = $cabin['sold_out'];
                        ?>

                            <div class="information-card information-card--horizontal modal-cabin-card" departureId="<?php echo $departureId; ?>">
                                <!-- Title Group -->
                                <div class="information-card__section">
                                    <div class="avatar " style="max-width: 100%;">
                                        <div class="avatar__image-area cabin-avatar-image" cabinId="<?php echo $cabinId; ?>" style="cursor: pointer">
                                            <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>
                                        </div>
                                        <div class="avatar__title-group">
                                            <div class="avatar__title-group__title">
                                                <?php echo  $title; ?>
                                            </div>
                                            <div class="avatar__title-group__sub">
                                                <?php echo $capacity; ?>, <?php echo $beds; ?>
                                            </div>
                                            <div class="avatar__title-group__sub">
                                                <?php echo $quantity; ?> <?php echo $quantity == 1 ? "Cabin" : "Cabins"; ?> Total
                                            </div>
                                            <?php if ($is_sharable) : ?>
                                                <div class="avatar__title-group__sub" style="font-style: italic;">
                                                    Option to Share
                                                </div>
                                            <?php endif; ?>
                                            <div class="avatar__title-group__sub">
                                                <?php echo $dimensions; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="information-card__section">
                                    <!-- Price Group -->
                                    <div class="price-display-group">
                                        <div class="price-display-group__text">
                                            <?php echo !$is_single ? 'Full Occupancy Price' : 'Single Price'; ?>
                                        </div>
                                        <div class="price-display-group__amount">
                                            <div class="price-display-group__amount__main <?php echo (($hasDiscount || $sold_out) ? 'discounted' : '') ?>">
                                                <?php priceFormat($price);  ?>
                                            </div>

                                            <?php if ($hasDiscount && !$sold_out) : ?>
                                                <div class="price-display-group__amount__discount">
                                                    <?php priceFormat($discounted_price);  ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($sold_out) : ?>
                                                <div class="price-display-group__amount__sold-out">
                                                    Sold Out
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                        <div class="price-display-group__sub">
                                            <div class="price-display-group__sub__main">
                                                Per Person
                                            </div>
                                            <?php if ($hasDiscount && !$sold_out) :
                                                $difference = $price - $discounted_price;
                                                $percentage = ceil(($difference / $price) * 100);
                                            ?>
                                                <div class="price-display-group__sub__discount">
                                                    <?php echo $percentage; ?>% Savings
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="information-card__bottom">

                                    <!-- CTA -->
                                    <div class="information-card__bottom__cta">
                                        <button class="cta-square-icon cabin-inquire-cta" cabinTitle="<?php echo $title; ?>" <?php echo ($sold_out) ? "disabled" : "" ?>>
                                            Inquire
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>

                    <?php endforeach;
                    endforeach;
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>