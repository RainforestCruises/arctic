    <!-- Itineraries -->
    <?php
    get_template_part('template-parts/cruise/content', 'cruise-itineraries', $args);
    ?>

    <!-- Departures -->
    <?php
    get_template_part('template-parts/cruise/content', 'cruise-departures', $args);
    ?>

    <!-- Extras -->
    <?php
    get_template_part('template-parts/cruise/content', 'cruise-extras', $args);
    ?>
    <!-- Related -->
    <?php
    get_template_part('template-parts/cruise/content', 'cruise-related', $args);
    ?>


    <a class="resource-card small">
        <div class="resource-card__image-area">
            <img <?php afloat_image_markup($image['id'], 'vertical-small', array('featured=medium')); ?>>
        </div>
        <div class="resource-card__content">

            <!-- Title -->
            <div class="resource-card__content__title">
                <?php echo $title; ?>
            </div>

            <!-- Specs -->
            <div class="resource-card__content__specs">

                <!-- Itinerary -->
                <div class="resource-card__content__specs__item">
                    <div class="resource-card__content__specs__item__icon">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-time-clock"></use>
                        </svg>
                    </div>
                    <div class="resource-card__content__specs__item__text">
                        <?php echo $itineraryDisplay; ?>
                    </div>
                </div>

                <!-- Size -->
                <div class="resource-card__content__specs__item">
                    <div class="resource-card__content__specs__item__icon">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-profile"></use>
                        </svg>
                    </div>
                    <div class="resource-card__content__specs__item__text">
                        <?php echo $guestsDisplay; ?>
                    </div>
                </div>

            </div>

            <!-- Price Group -->
            <div class="resource-card__content__price-group">
                <div class="resource-card__content__price-group__amount">
                    $2,955
                </div>
                <div class="resource-card__content__price-group__text">
                    Per Person
                </div>
            </div>
        </div>

    </a>