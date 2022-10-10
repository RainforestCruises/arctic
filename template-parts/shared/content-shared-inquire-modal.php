<?php
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');
$productName = $args['productName'];
$departures = $args['departures'];
$currentYear = $args['curentYear'];
$yearSelections = $args['yearSelections'];
$cabins = $args['cabins'];
$itineraryDataList = $args['itineraryDataList'];

?>

<div class="modal" id="inquireModal">
    <div class="modal__content"">
        <div class=" modal__content__top">

        <!-- Top Modal Content -->
        <div class="modal__content__top__nav">
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
    <div class="modal__content__main">

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
                    $itineraryPost = $d['ItineraryPost'];
                    $itineraryPostId = $d['ItineraryPostId'];
                    $departureStartDate = strtotime($d['DepartureDate']);
                    $departureReturnDate = strtotime($d['ReturnDate']);
                    $title = $itineraryPost ? get_the_title($itineraryPost) : "Missing WP Itinerary";
                    $image = get_field('hero_image', $itineraryPost);
                    $embarkationPost = get_field('embarkation_point', $itineraryPost);
                    $embarkationName = get_the_title($embarkationPost) . ', ' . get_field('country_name', $embarkationPost);
                ?>

                    <div class="information-card information-card--horizontal info-departure-card" data-filter-date="<?php echo date("Y", $departureStartDate); ?>" data-filter-itinerary="<?php echo $itineraryPostId; ?>">
                        <!-- Title Group -->
                        <div class="information-card__section">
                            <div class="avatar-title-group">
                                <div class="avatar-title-group__avatar">
                                    <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>

                                </div>
                                <div class="avatar-title-group__text">
                                    <div class="avatar-title-group__text__title">
                                        <?php echo  $title; ?>

                                    </div>
                                    <div class="avatar-title-group__text__sub">
                                        <?php echo $d['LengthInDays'] . ' Days / ' . $d['LengthInNights'] . ' Nights'; ?>
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
                            </div>
                        </div>


                        <div class="information-card__bottom">
                            <!-- Price Group -->
                            <div class="information-card__bottom__price-group">
                                <button class="price-group-button" year="<?php echo date("Y", $departureStartDate); ?>" departureDate="<?php echo date("M d, Y", $departureStartDate); ?>" itinerary="<?php echo $itineraryPostId; ?>" itineraryTitle="<?php echo $title; ?>">
                                    <div class="price-group-button__text">
                                        From
                                    </div>
                                    <div class="price-group-button__amount">
                                        <?php echo "$ " . number_format($d['LowestPrice'], 0);  ?>
                                    </div>
                                    <div class="price-group-button__view">View Prices</div>
                                </button>
                            </div>

                            <!-- CTA -->
                            <div class="information-card__bottom__cta">
                                <button class="cta-square-icon departure-inquire-cta" departureDate="<?php echo date("M d, Y", $departureStartDate); ?>" itinerary="<?php echo $itineraryPostId; ?>" itineraryTitle="<?php echo $title; ?>">
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
                <?php foreach ($itineraryDataList as $itineraryData) :
                    $itineraryPostId = $itineraryData['postId'];
                    $rateYears = $itineraryData['rateYears'];

                    foreach ($rateYears as $rateYear) :
                        $cabinRates = $rateYear['Rates'];
                        //if($cabinRates) -- check for no rates
                        foreach ($cabinRates as $cabinRate) :
                            $title = $cabinRate['Cabin'];
                            $isSingle = $cabinRate['IsSingle'];
                            $amount = $cabinRate['WebAmount'];
                            $singleAmount = !$isSingle ? $cabinRate['SingleWebAmount'] : $amount;
                            $year = $cabinRate['Year'];
                            $cabinDto = $cabinRate['CabinDTO'];
                            $imageUrl = $cabinRate['ImageUrl'];

                ?>


                            <div class="information-card information-card--horizontal modal-cabin-card" year="<?php echo $year; ?>" itinerary="<?php echo $itineraryPostId; ?>">
                                <!-- Title Group -->
                                <div class="information-card__section">
                                    <div class="avatar-title-group" style="max-width: 100%;">
                                        <div class="avatar-title-group__avatar">
                                            <img src="<?php echo afloat_dfcloud_image($imageUrl, 80, 80); ?>">
                                        </div>
                                        <div class="avatar-title-group__text">
                                            <div class="avatar-title-group__text__title">
                                                <?php echo  $title; ?> - <?php echo  $year; ?>- <?php echo  $itineraryPostId; ?>
                                            </div>
                                            <div class="avatar-title-group__text__sub">
                                                <?php echo getOccupancyDisplay($cabinDto); ?> Guests, <?php echo ($cabinDto['Beds']); ?> Bed
                                            </div>
                                            <div class="avatar-title-group__text__sub">
                                                <?php echo ($cabinDto['Size']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="information-card__bottom">
                                    <?php if (!$isSingle) : ?>
                                        <!-- Price Group -->
                                        <div class="information-card__bottom__price-group">
                                            <div class="information-card__bottom__price-group__large-text">
                                                Double
                                            </div>
                                            <div class="information-card__bottom__price-group__amount">
                                                <?php echo "$ " . number_format($amount, 0);  ?>
                                            </div>
                                            <div class="information-card__bottom__price-group__text">
                                                Per Person
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Price Group -->
                                    <div class="information-card__bottom__price-group">
                                        <div class="information-card__bottom__price-group__large-text">
                                            Single
                                        </div>
                                        <div class="information-card__bottom__price-group__amount">
                                            <?php echo "$ " . number_format($singleAmount, 0);  ?>
                                        </div>
                                        <div class="information-card__bottom__price-group__text">
                                            Per Person
                                        </div>
                                    </div>

                                    <!-- CTA -->
                                    <div class="information-card__bottom__cta">
                                        <button class="cta-square-icon cabin-inquire-cta" cabinTitle="<?php echo $title; ?>">
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
                endforeach; ?>
            </div>
        </div>

    </div>
</div>
</div>