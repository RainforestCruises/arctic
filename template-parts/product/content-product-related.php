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


$posts = get_posts($queryArgs);


// if(count($posts) == 0){
//     $queryArgs2 = array(
//         'post_type' => get_post_type(),
//         'posts_per_page' => -1,
//         'post__not_in' => array($post->ID),
//         'meta_key' => 'search_rank',
//         'orderby' => 'meta_value_num',
//         'order' => 'DESC',
//     );

//     $regions = get_field('regions');
// }
// console_log($posts);
$resultCount = 0;

?>

<div class="product-related">
    <h2 class="page-divider page-divider--padding u-margin-bottom-medium u-margin-top-small">
        Related <?php echo $args['productType'] . 's'; ?>
    </h2>
    <?php if ($posts) : ?>
        <div class="product-related__slider" id="related-slider">

            <?php
            foreach ($posts as $p) :
                $featured_image = get_field('featured_image', $p);
                $cruise_data = get_field('cruise_data', $p);

                $charterView = false;
                $isCharterOnly = false;
                $hasCharterAvailable = false;
                $charter_min_days = 0;
                $charter_daily_price = 0;
                $link = get_permalink($p);
                if (get_post_type() == 'rfc_cruises') {
                    $charterView = $args['charter_view'];
                    $isCharterOnly = get_field('charter_only', $p);
                    $hasCharterAvailable = get_field('charter_available', $p);
                    $charter_min_days = get_field('charter_min_days', $p);


                    if (array_key_exists("LowestCharterPrice", $cruise_data)) {
                        $charter_daily_price = $cruise_data['LowestCharterPrice'];
                    }
                }

                if (!$charterView) {
                    if ($isCharterOnly) {
                        continue;
                    }
                } else {
                    if (!$hasCharterAvailable) {
                        continue;
                    }

                    if (!$isCharterOnly) {
                        $link = $link . "?charter=true";
                    };
                }



                $relatedItemDestinations = get_field('destinations', $p);
                $top_snippet = get_field('top_snippet', $p);
                $currentYear = date('Y');
                $propertyDestinations  = get_field('destinations', $p);
                if (get_post_type($p) == 'rfc_tours') {

                    $tour_length = get_field('length', $p);
                    $price_packages = get_field('price_packages', $p);

                    $lowestPrice = lowest_tour_price($price_packages, $currentYear);
                } else {

                    $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear);
                }
                if ($resultCount <= 12) :
            ?>

                    <!-- Card -->
                    <a class="product-card" href="<?php echo $link;; ?>">
                        <div class="product-card__image-area">
                            <?php if ($featured_image) : ?>
                                <img <?php afloat_image_markup($featured_image['id'], 'featured-medium'); ?>>
                            <?php endif; ?>
                            <ul class="product-card__image-area__destinations">
                                <?php
                                if ($propertyDestinations) :
                                    foreach ($propertyDestinations as $d) :
                                        echo '<li>' . get_field('navigation_title', $d) . '</li>';
                                    endforeach;
                                endif; ?>
                            </ul>
                            <?php if ($charterView) : ?>
                                <div class="product-card__image-area__charter-text">
                                    Private Charter
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom__title-group">
                                <h3 class="product-card__bottom__title-group__product-name">
                                    <?php echo (get_post_type($p) == 'rfc_tours') ? get_field('tour_name', $p) : get_the_title($p) ?>
                                </h3>
                            </div>
                            <div class="product-card__bottom__text">
                                <?php echo $top_snippet ?>
                            </div>
                            <div class="product-card__bottom__info">
                                <div class="product-card__bottom__info__length-group">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                    </svg>
                                    <div class="product-card__bottom__info__length-group__length">
                                        <?php if ($charterView) :
                                            echo $charter_min_days . ' Days +';
                                        else :
                                            echo (get_post_type($p) == 'rfc_tours') ? $tour_length  . " Days" : itineraryRange($cruise_data, " - ") . " Days";
                                        endif; ?>

                                    </div>
                                </div>
                                <div class="product-card__bottom__info__price-group">

                                    <?php if ($charterView) : ?>


                                        <div class="product-card__bottom__info__price-group__from">Day</div>
                                        <div class="product-card__bottom__info__price-group__data"><?php echo priceFormat($charter_daily_price);  ?> <span>USD</span></div>

                                    <?php else : ?>
                                        <div class="product-card__bottom__info__price-group__from">From</div>
                                        <div class="product-card__bottom__info__price-group__data"><?php echo priceFormat($lowestPrice); ?> <span>USD</span></div>
                                    <?php endif; ?>

                                </div>


                            </div>
                        </div>
                    </a>

            <?php
                    $resultCount++;
                endif;
            endforeach;
            ?>
        </div>
    <?php endif; ?>
</div>