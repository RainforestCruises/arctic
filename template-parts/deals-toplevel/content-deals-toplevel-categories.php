<?php
$sections = get_field('sections');
$categoryCount = 0;
$allDeals = [];

foreach ($sections as $section) :
    $category = $section['category'];
    $title = $section['title'];
    $snippet = $section['snippet'];
    $dealsInCategory = getDealsInCategory($category);
    $itinerariesWithDealsInCategory = getItinerariesWithDeal($dealsInCategory);
    $titleSlug = slugify(get_the_title($category));
    if (!$itinerariesWithDealsInCategory) continue; // skip if no deals found for category
?>

    <section class="slider-block deal-slider-block" id="<?php echo $titleSlug; ?>">
        <div class="slider-block__content block-top-divider">

            <!-- Top - Title/Nav -->
            <div class="slider-block__content__top">

                <!-- Title -->
                <div class="title-group">
                    <h2 class="title-group__title">
                        <?php echo $title ?>
                    </h2>
                    <div class="title-group__sub">
                        <?php echo $snippet; ?>
                    </div>
                </div>

                <!-- Nav Buttons -->
                <div class="slider-block__content__top__nav">
                    <div class="swiper-button-prev swiper-button-prev--white-border category-slider-btn-prev-<?php echo $categoryCount; ?>">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                        </svg>
                    </div>
                    <div class="swiper-button-next swiper-button-next--white-border category-slider-btn-next-<?php echo $categoryCount; ?>">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                        </svg>
                    </div>
                </div>

            </div>

            <!-- Slider Area -->
            <div class="slider-block__content__slider">

                <div class="swiper" id="category-slider-<?php echo $categoryCount; ?>">


                    <div class="swiper-wrapper">
                        <?php
                        $count = 0;
                        foreach ($itinerariesWithDealsInCategory as $itinerary) :

                            if ($count > 24) break; // Limit to 12 itineraries per region
                            $images =  get_field('hero_gallery', $itinerary);
                            $image = $images[0];
                            $title = get_field('display_name', $itinerary);
                            $itineraryInfoObject = createItineraryInfoObject($itinerary);
                            $lengthDisplay = $itineraryInfoObject->lengthDisplay;
                            $shipsDisplay = getShipsFromItineraryList($itinerary, true);
                            $departures = getDepartureList($itinerary);
                            if (!$departures) continue; // Skip if sold out
                            $lowestPrice = getLowestDepartureListPrice($departures);
                            $highestPrice = getHighestDepartureListPrice($departures);
                            $bestOverallDiscount = getBestDepartureListDiscount($departures);
                            $count++;
                        ?>

                            <!-- Itinerary Card -->
                            <div class="resource-card swiper-slide">

                                <!-- Tag -->
                                <?php if ($bestOverallDiscount) : ?>
                                    <div class="resource-card__tag">
                                        Up to <span class="green-text"><?php echo $bestOverallDiscount; ?>%</span> savings
                                    </div>
                                <?php endif; ?>


                                <!-- Images Slider -->
                                <div class="resource-card__image-area">
                                    <a class="resource-card__image-area__item" href="<?php echo get_permalink($itinerary) ?>">
                                        <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                                    </a>
                                </div>

                                <!-- Content -->
                                <div class="resource-card__content">

                                    <!-- Title -->
                                    <h3 class="resource-card__content__title">
                                        <a href="<?php echo get_permalink($itinerary) ?>"><?php echo $title; ?></a>
                                    </h3>

                                    <!-- Specs -->
                                    <div class="resource-card__content__specs">

                                        <!-- Itinerary -->
                                        <div class="specs-item">
                                            <div class="specs-item__icon">
                                                <svg>
                                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-time-clock"></use>
                                                </svg>
                                            </div>
                                            <div class="specs-item__text">
                                                Length: <?php echo $lengthDisplay; ?>
                                            </div>
                                        </div>
                                        <!-- Ships -->
                                        <div class="specs-item">
                                            <div class="specs-item__icon">
                                                <svg>
                                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-16"></use>
                                                </svg>
                                            </div>
                                            <div class="specs-item__text">
                                                Ships: <?php echo $shipsDisplay; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="resource-card__content__bottom">
                                        <!-- Price Group -->
                                        <div class="resource-card__content__bottom__price-group">
                                            <div class="resource-card__content__bottom__price-group__amount">
                                                <?php priceFormat($lowestPrice, $highestPrice); ?>
                                            </div>
                                            <div class="resource-card__content__bottom__price-group__text">
                                                <?php echo ($lowestPrice) ? "Per Person" : ""; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>
            </div>

        </div>
    </section>

<?php $categoryCount++;
endforeach;
?>

