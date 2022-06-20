<?php

//$cruises_image = get_field('cruises_image');
//$lodges_image = get_field('lodges_image');
//$cruises_snippet = get_field('cruises_snippet');
//$lodges_snippet = get_field('lodges_snippet');
$title = $args['title'];

$lodges = $args['lodges'];
$currentYear = date("Y");


?>


<div class="destination-secondary">
    <div class="destination-secondary__header">
        <h2 class="destination-secondary__header__title page-divider">
            <?php echo $args['accommodationDisplayText'] ?>
        </h2>
        <div class="destination-secondary__header__sub-text">
            <?php echo get_field('accommodations_title_subtext') ?>
        </div>
    </div>

    <div class="destination-secondary__best-selling">

        <div class="destination-secondary__best-selling__slider" id="lodges-slider">
            <?php foreach ($lodges as $lodge) : ?>
                <?php
                $featured_image = get_field('featured_image', $lodge);
                $cruise_data = get_field('cruise_data', $lodge);
                $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear);
                ?>
                <!-- Card -->

                <a class="product-card" href="<?php echo get_permalink($lodge); ?>">
                    <div class="product-card__image-area">
                        <?php if ($featured_image) : ?>
                            <img <?php afloat_image_markup($featured_image['id'], 'featured-medium'); ?>>
                        <?php endif; ?>
                        <ul class="product-card__image-area__destinations">
                            <?php
                            $destinations = $lodge->destinations;
                            if ($destinations) :
                                foreach ($destinations as $d) :
                                    echo '<li>' . get_field('navigation_title', $d) . '</li>';
                                endforeach;
                            endif; ?>
                        </ul>
                    </div>

                    <div class="product-card__bottom">
                        <div class="product-card__bottom__title-group">
                            <h3 class="product-card__bottom__title-group__product-name">
                                <?php echo get_the_title($lodge) ?>
                            </h3>

                        </div>
                        <div class="product-card__bottom__text">
                            <?php echo get_field('top_snippet', $lodge) ?>
                        </div>
                        <div class="product-card__bottom__info">


                            <div class="product-card__bottom__info__length-group">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                </svg>
                                <div class="product-card__bottom__info__length-group__length">

                                    <?php echo itineraryRange($cruise_data, " - ") . ' Days'; ?>
                                </div>
                            </div>
                            <div class="product-card__bottom__info__price-group">

                                <div class="product-card__bottom__info__price-group__from">From</div>
                                <div class="product-card__bottom__info__price-group__data"><?php echo "$" . number_format($lowestPrice, 0);  ?> <span>USD</span></div>

                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    $allLodgesLink = get_field('lodge_accommodation_search_link');
    ?>

    <div class="destination-secondary__btn ">
        <a class="btn-outline btn-outline--dark  btn-outline--small" href="<?php echo $allLodgesLink; ?>">View All <?php echo $args['accommodationDisplayText'] ?></a>
    </div>

</div>