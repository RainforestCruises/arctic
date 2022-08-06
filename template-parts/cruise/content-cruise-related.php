<?php
$queryArgs = array(
    'post_type' => get_post_type(),
    'posts_per_page' => -1,
    'post__not_in' => array($post->ID),
    'meta_key' => 'search_rank',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',

);


//build meta query criteria
$queryArgsDestination = array();
$queryArgsDestination['relation'] = 'OR';

$destinations = get_field('destinations');
if ($destinations) {
    foreach ($destinations as $d) {
        if (get_field('is_country', $d) == true) {
            $queryArgsDestination[] = array(
                'key'     => 'destinations',
                'value'   => serialize(strval($d->ID)),
                'compare' => 'LIKE'
            );
        }
    }
    $queryArgs['meta_query'][] = $queryArgsDestination;
}


$ships = get_posts($queryArgs);

?>
<section class="product-related" id="related">
 
    <div class="product-related__content">

        <div class="title-group">
            <div class="title-group__title">
                Related Cruises
            </div>
            <div class="title-group__sub">
                Explore from <?php echo count($ships) ?> ships sailing the Antarctic
            </div>
        </div>

        <div class="product-related__content__slider" id="related-slider">
            <?php foreach ($ships as $ship) :
                $image = get_field('featured_image', $ship);
                $title = get_the_title($ship);
                $cruise_data = get_field('cruise_data', $ship);
                $itineraryDisplay = itineraryRange($cruise_data, "-") . " Days, " . count($cruise_data['Itineraries']) . ' Itineraries';
                $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests, ' . 'Luxury';
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

            <?php endforeach; ?>
        </div>


    </div>
</section>