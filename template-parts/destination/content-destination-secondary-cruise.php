<?php

$tours = $args['tours'];
$currentYear = date("Y");

$destination = get_field('destination_post');
$tour_experiences = get_field('tour_experiences');
?>


<div class="destination-secondary">
    <div class="destination-secondary__header">
        <h2 class="destination-secondary__header__title page-divider" id="packages">
            Cruise Packages
        </h2>
        <div class="destination-secondary__header__sub-text">
            <?php echo get_field('tour_package_title_subtext') ?>
        </div>
    </div>
    <div class="destination-main__packages">
        <div class="destination-main__packages__best-selling">

            <div class="destination-main__packages__best-selling__slider" id="main-slider">
                <?php foreach ($tours as $t) : ?>
                    <?php
                    $best_selling = get_field('best_selling', $t);

                    if ($best_selling) :
                        $hero_image = get_field('best_selling_image', $t);
                        $countries  = get_field('destinations', $t);
                        $price_packages = get_field('price_packages', $t);
                        $lowest = lowest_tour_price($price_packages, $currentYear);

                    ?>
                        <!-- Tour Card -->
                        <a class="wide-slider-card" href="<?php echo get_permalink($t); ?>">
                            <?php if ($hero_image) { ?>
                                <div class="wide-slider-card__image">
                                    <img <?php afloat_image_markup($hero_image['id'], 'wide-slider-medium'); ?>>

                                </div>
                            <?php } ?>

                            <div class="wide-slider-card__content">
                                <div class="wide-slider-card__content__tag-area">
                                    <div class="wide-slider-card__content__tag-area__tag">
                                        Best Seller
                                    </div>

                                </div>
                                <div class="wide-slider-card__content__text-area">
                                    <div class="wide-slider-card__content__text-area__country">
                                        <?php foreach ($countries as $c) :
                                            $isCountry = get_field('is_country', $c);
                                            if ($isCountry) : ?>
                                                <li>
                                                    <?php echo get_the_title($c); ?>
                                                </li>

                                        <?php endif;
                                        endforeach; ?>
                                    </div>
                                    <h3 class="wide-slider-card__content__text-area__title">
                                        <?php echo get_field('tour_name', $t) ?>
                                    </h3>
                                    <h5 class="wide-slider-card__content__text-area__info">
                                        <div class="wide-slider-card__content__text-area__info__length">
                                            <?php echo get_field('length', $t) ?>-Day Tour
                                        </div>
                                        <div class="wide-slider-card__content__text-area__info__price">
                                            From <?php echo "$" . number_format($lowest, 0); ?> <span>USD</span>
                                        </div>

                                    </h5>
                                </div>
                            </div>
                        </a>
                <?php endif;
                endforeach; ?>
            </div>
        </div>
    </div>

    <?php
    $tour_search_link = get_field('tour_search_link');
    ?>

    <div class="destination-main__lengths">

        <a class="btn-outline btn-outline--dark btn-outline--small" href="<?php echo $tour_search_link; ?>">View All Tours</a>
    </div>


</div>