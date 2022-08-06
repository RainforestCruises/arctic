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


$itineraries = get_posts($queryArgs);

?>
<section class="product-related" id="related">
 
    <div class="product-related__content">

        <div class="title-group">
            <div class="title-group__title">
                Related Itineraries
            </div>
            <div class="title-group__sub">
                There are <?php echo count($itineraries); ?> itineraries available
            </div>
        </div>

        <div class="product-related__content__slider" id="related-slider">
            <?php foreach ($itineraries as $itinerary) :
                $image = get_field('hero_image', $itinerary);
                $title = get_the_title($itinerary);
                $cruise_data = get_field('cruise_data', $itinerary);
                // $itinerary_id = get_field('itinerary_id', $itinerary);
                // $itinerary_data;
                // //Get Itinerary from cruise data
                // foreach ($itineraries as $i) {
                //   if ($i['Id'] == $itinerary_id) {
                //     $itinerary_data = $i;
                //   }
                // }

                $itineraryDisplay = '5 Days';
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