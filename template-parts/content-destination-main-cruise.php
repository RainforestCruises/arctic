<?php
$destination = $args['destination'];
$title = $args['title'];

$locations = $args['locations'];
$activities = $args['activities'];

$cruise_locations = get_field('cruise_countries');

$cruises = $args['cruises'];
$currentYear = date("Y");


$currentYear = date("Y");
$destinationType = $args['destinationType'];

$background_map = get_field('background_map');
$highlights = get_field('highlights');

$cruise_experiences = get_field('cruise_experiences');

?>

<div class="destination-main">

    <!-- Map Background -->
    <div class="destination-main__bg">
        <img src="<?php echo esc_url($background_map['url']); ?>" alt="<?php echo get_post_meta($background_map['id'], '_wp_attachment_image_alt', TRUE) ?>">
    </div>

    <!-- Intro -->
    <div class="destination-main__intro">
        <div class="destination-main__intro__description">
            <h2 class="destination-main__intro__description__title" id="intro">
                <?php echo get_field('intro_title') ?>
            </h2>
            <div class="destination-main__intro__description__text">
                <?php echo get_field('intro_text') ?>
            </div>
            <?php if ($highlights) : ?>
                <h3 class="destination-main__intro__description__highlights-title">
                    Highlights
                </h3>
                <ul class="destination-main__intro__description__highlights">
                    <?php
                    foreach ($highlights as $h) : ?>
                        <li>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                            </svg>
                            <span>
                                <?php echo $h['highlight'] ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </div>

    </div>

    <!-- Cruises -->
    <div class="destination-main__packages" id="cruises">
        <div class="destination-main__packages__header">
            <h2 class="destination-main__packages__header__title page-divider">
                <?php echo $title ?> Cruises
            </h2>
            <div class="destination-main__packages__header__sub-text">
                <?php echo get_field('cruise_title_subtext') ?>
            </div>
        </div>



        <!-- Best Selling - use secondary slider-->
        <div class="destination-secondary__best-selling">
            <div class="destination-secondary__best-selling__slider" id="secondary-slider">


                <?php foreach ($cruises as $c) : ?>
                    <?php
                    $featured_image = get_field('featured_image', $c);
                    $destinations  = get_field('destinations', $c);
                    $cruise_data = get_field('cruise_data', $c);
                    $charter_only = get_field('charter_only', $c);
                    $charter_min_days = get_field('charter_min_days', $c);

                    if (array_key_exists("LowestCharterPrice", $cruise_data)) {
                        $charter_daily_price = $cruise_data['LowestCharterPrice'];
                    }

                    $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear);
                    ?>
                    <!-- Tour Card -->



                    <a class="product-card" href="<?php echo get_permalink($c); ?>">
                        <div class="product-card__image-area">
                            <?php if ($featured_image) : ?>
                                <img <?php afloat_image_markup($featured_image['id'], 'featured-medium'); ?>>
                            <?php endif; ?>
                            <ul class="product-card__image-area__destinations">
                                <?php
                                $destinations = $c->destinations;
                                if ($destinations) :
                                    foreach ($destinations as $d) :
                                        echo '<li>' . get_field('navigation_title', $d) . '</li>';
                                    endforeach;
                                endif; ?>
                            </ul>
                            <?php if ($charter_only) : ?>
                                <div class="product-card__image-area__charter-text">
                                    Private Charter
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="product-card__bottom">
                            <div class="product-card__bottom__title-group">
                                <h3 class="product-card__bottom__title-group__product-name">
                                    <?php echo get_the_title($c) ?>
                                </h3>
                            </div>
                            <div class="product-card__bottom__text">
                                <?php echo get_field('top_snippet', $c) ?>
                            </div>
                            <div class="product-card__bottom__info">


                                <div class="product-card__bottom__info__length-group">
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                    </svg>
                                    <div class="product-card__bottom__info__length-group__length">
                                        <?php if ($charter_only) :
                                            echo $charter_min_days . ' Days +';
                                        else :
                                            echo itineraryRange($cruise_data, " - ") . ' Days';
                                        endif; ?>
                                    </div>
                                </div>
                                <div class="product-card__bottom__info__price-group">
                                    <?php if ($charter_only) : ?>
                                        <div class="product-card__bottom__info__price-group__from">Day</div>
                                        <div class="product-card__bottom__info__price-group__data"><?php echo priceFormat($charter_daily_price);  ?> <span>USD</span></div>

                                    <?php else : ?>
                                        <div class="product-card__bottom__info__price-group__from">From</div>
                                        <div class="product-card__bottom__info__price-group__data"><?php echo priceFormat($lowestPrice);  ?> <span>USD</span></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>


                <?php endforeach; ?>



            </div>
        </div>

    </div>



    <!-- destination tiles -->
    <?php $hideDesinations = get_field('hide_cruise_destinations') ?>
    <?php if ($hideDesinations == false) : ?>
        <h2 class="sub-divider destination-main__experiences-title">
            <?php echo $title ?> Destinations
        </h2>
        <div class="destination-main__experiences-sub-text">
            <?php echo get_field('cruise_destination_title_subtext') ?>
        </div>

        <div class="destination-main__experiences">
            <?php
            if ($cruise_locations) :

                foreach ($cruise_locations as $c) :
                    $location = $c['country'];
                    $background_image = $c['background_image'];
                    $link = $c['search_link'];
            ?>
                    <a class="category-card" href="<?php echo $link ?>">
                        <div class="category-card__image">
                            <img <?php afloat_image_markup($background_image['id'], 'pill-large'); ?>>
                        </div>

                        <div class="category-card__content">
                            <h3 class="category-card__content__title">
                                <?php echo get_field('navigation_title', $location); ?> Cruises
                            </h3>
                            <div class="category-card__content__availability">
                                <?php
                                echo cruises_available_location($location) . ' Cruises Available';
                                ?>
                            </div>
                        </div>
                    </a>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    <?php endif; ?>

    <!-- experiences -->
    <h2 class="sub-divider destination-main__experiences-title">
        <?php echo $title ?> Experiences
    </h2>
    <div class="destination-main__experiences-sub-text">
        <?php echo get_field('cruise_experience_title_subtext') ?>
    </div>
    <div class="destination-main__experiences">
        <?php
        if ($cruise_experiences) {
            foreach ($cruise_experiences as $e) {
                $experience = $e['cruise_experience'];
                $background_image = $e['background_image'];
                $search_link = $e['search_page_link'];
                $is_charter = $e['is_charter'];

        ?>
                <a class="category-card" href="<?php echo $search_link ?>">
                    <div class="category-card__image">
                        <?php if ($background_image) : ?>
                            <img <?php afloat_image_markup($background_image['id'], 'pill-large'); ?>>
                        <?php endif; ?>
                    </div>

                    <div class="category-card__content">
                        <h3 class="category-card__content__title">
                            <?php if ($is_charter) :
                                echo 'Charter Cruises';
                            else :
                                echo get_the_title($experience) . ' Cruises';
                            endif; ?>

                        </h3>
                        <div class="category-card__content__availability">
                            <?php if ($is_charter) :
                                echo cruises_available_charter($destination) . ' Cruises Available';
                            else :
                                echo cruises_available_experience($destination, $experience) . ' Cruises Available';
                            endif; ?>

                        </div>
                    </div>
                </a>
        <?php
            }
        }
        ?>
    </div>

    <?php
    $cruise_lengths = get_field('cruise_lengths');
    ?>

    <div class="destination-main__lengths">
        <?php if ($cruise_lengths) : ?>
            <?php foreach ($cruise_lengths as $length) :
                $link = $length['link'];
                $buttonText = $length['button_text'];
            ?>
                <a class="btn-outline btn-outline--small " href="<?php echo $link; ?>"><?php echo $buttonText ?></a>
        <?php endforeach;
        endif;
        ?>

        <a class="btn-outline btn-outline--dark btn-outline--small" href="<?php echo get_field('cruise_search_link'); ?>">View All Cruises</a>
        <?php $deal_page_link = get_field('deal_page_link');
        if ($deal_page_link != '') : ?>
            <a class="btn-outline btn-outline--green btn-outline--small" href="<?php echo get_field('deal_page_link'); ?>">View Deals</a>
        <?php endif; ?>
    </div>
</div>