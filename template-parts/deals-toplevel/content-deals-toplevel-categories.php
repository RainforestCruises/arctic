<?php
$sections = get_field('sections');
$categoryCount = 0;
foreach ($sections as $section) :
    $category = $section['category'];
    $title = $section['title'];
    $snippet = $section['snippet'];
    $dealsInCategory = getDealsInCategory($category);
    $titleSlug = slugify(get_the_title($category));

    if (!$dealsInCategory) continue; // skip if no deals found for category
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

                        <?php foreach ($dealsInCategory as $deal) :
                            $image =  get_field('featured_image', $deal);
                            $itineraries = getItinerariesWithDeal($deal);
                            $ships = getShipsWithDeal($deal);
                            $title = get_field('navigation_title', $deal);
                            $description = get_field('description', $deal);
                            $expand = strlen($description) > 320 ? true : false;
                            $description_limited = substr($description, 0, 320);
                            if ($expand) {
                                $description_limited .= '...';
                            }
                        ?>

                            <!-- Itinerary Card -->
                            <a class="search-card-itinerary swiper-slide" href="<?php echo get_permalink($deal) ?>">


                                <!-- Image -->
                                <div class="search-card-itinerary__image-area">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>

                                </div>

                                <!-- Content -->
                                <div class="search-card-itinerary__content">

                                    <!-- Title -->
                                    <div class="search-card-itinerary__content__title">
                                        <?php echo $title; ?>
                                    </div>

                                    <!-- Description -->
                                    <div class="search-card-itinerary__content__description">
                                        <?php echo $description_limited; ?>
                                    </div>

                           

                                </div>

                            </a>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

        </div>
    </section>

<?php $categoryCount++;
endforeach; ?>