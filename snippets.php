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