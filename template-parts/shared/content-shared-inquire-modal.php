<?php
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');
$productName = $args['productName'];
$departures = $args['departures'];

?>

<div class="modal" id="inquireModal">
    <div class="modal__content"">
        <div class=" modal__content__top">

        <div class="modal__content__top__nav">
            <button class="btn-pill tablink modal-tab-link" tab-panel="dates">Date Selection</button>
            <button class="btn-pill tablink modal-tab-link" tab-panel="inquire">Inquire</button>
        </div>
        <button class="btn-text-icon close-modal-button ">
            Close
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        </button>
    </div>
    <div class="modal__content__main">

        <!-- Inquire Form -->
        <div class="inquire-form tabpanel modal-tab-panel" tab-panel="inquire">
            <div class="inquire-form__intro">
                <div class="inquire-form__intro__title">
                    Interested in the <?php echo $productName; ?>?
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
        <div class="departures-modal  tabpanel modal-tab-panel"  tab-panel="dates">
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

                    <div class="departure-card departure-card--horizontal" data-filter-date="<?php echo date("Y", $departureStartDate); ?>" data-filter-itinerary="<?php echo $itineraryPostId; ?>">
                        <!-- Title Group -->
                        <div class="departure-card__title-group">
                            <div class="departure-card__title-group__avatar">
                                <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>

                            </div>
                            <div class="departure-card__title-group__text">
                                <div class="departure-card__title-group__text__title">
                                    <?php echo  $title; ?>

                                </div>
                                <div class="departure-card__title-group__text__sub">
                                    <?php echo $d['LengthInDays'] . ' Days / ' . $d['LengthInNights'] . ' Nights'; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Specs -->
                        <div class="departure-card__specs">

                            <!-- Dates -->
                            <div class="departure-card__specs__item">
                                <div class="departure-card__specs__item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-in"></use>
                                    </svg>
                                </div>
                                <div class="departure-card__specs__item__text">
                                    <div class="departure-card__specs__item__text__main">
                                        <span style="font-weight: 700;"><?php echo  date("F j", $departureStartDate); ?></span> - <?php echo  date("M j, Y", $departureReturnDate); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Ports -->
                            <div class="departure-card__specs__item">
                                <div class="departure-card__specs__item__icon">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-e"></use>
                                    </svg>
                                </div>
                                <div class="departure-card__specs__item__text">
                                    <div class="departure-card__specs__item__text__main">
                                        <?php echo $embarkationName ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="departure-card__bottom">

                            <!-- Price Group -->
                            <div class="departure-card__bottom__price-group">
                                <div class="departure-card__bottom__price-group__text">
                                    From
                                </div>
                                <div class="departure-card__bottom__price-group__amount">
                                    <?php echo "$ " . number_format($d['LowestPrice'], 0);  ?>
                                </div>
                                <div class="departure-card__bottom__price-group__text">
                                    Per Person
                                </div>
                            </div>

                            <!-- CTA -->
                            <div class="departure-card__bottom__cta">
                                <button class="cta-square-icon inquire-cta">
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

        <!-- Rooms Per Itinerary (Year + Season) -->

    </div>
</div>
</div>