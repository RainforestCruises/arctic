<?php
$sections = get_field('sections');
$categoryCount = 0;
$allDeals = [];

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
                            $allDeals[] = $deal;
                            $id = $deal->ID;
                            $image =  get_field('featured_image', $deal);
                            $itineraries = getItinerariesWithDeal($deal);
                            $ships = getShipsWithDeal($deal);
                            $title = get_field('navigation_title', $deal);
                            $description = get_field('description', $deal);
                            $is_special_departure = get_field('is_special_departure', $deal);
                            $expand = strlen($description) > 320 ? true : false;
                            $description_limited = substr($description, 0, 320);
                            $has_expiry_date = get_field('has_expiry_date', $deal);
                            $expiry_date =  get_field('expiry_date', $deal);
                            $is_exclusive =  get_field('is_exclusive', $deal);

                            if ($expand) {
                                $description_limited .= '...';
                            }
                        ?>

                            <!-- Itinerary Card -->
                            <div class="search-card-itinerary swiper-slide toplevel-deal-card <?php echo $is_special_departure ? "special-departure-cta" : "" ?>" dealId="<?php echo $id ?>">

                                <!-- Tag Area -->
                                <div class="search-card-itinerary__tag-area">
                                    <?php if ($is_special_departure) : ?>
                                        <div class="card-tag card-tag--special">
                                            Special Departure
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($is_exclusive) : ?>
                                        <div class="card-tag card-tag--light">
                                            Exclusive Deal
                                        </div>
                                    <?php endif; ?>
                                </div>
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
                                <div class="search-card-itinerary__bottom search-card-itinerary__bottom--deal">
                                    <?php if (!$is_special_departure) : ?>
                                        <div class="validity-badge">
                                            <div class="validity-badge__icon-area">
                                                <svg>
                                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-stopwatch"></use>
                                                </svg>
                                            </div>

                                            <div class="validity-badge__title">
                                                <?php if ($has_expiry_date) : ?>
                                                    Expires <?php echo date("F j, Y", strtotime($expiry_date)); ?>
                                                    <div class="validity-badge__title__sub">
                                                        <?php echo getDaysUntilExpiry($expiry_date) ?> Days Remaining
                                                    </div>
                                                <?php else : ?>
                                                    Limited time offer
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="validity-badge">
                                            <div class="validity-badge__icon-area">
                                                <svg>
                                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                                </svg>
                                            </div>
                                            <div class="validity-badge__title">
                                                Special Departure
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <button class="btn-primary btn-primary--icon btn-primary--small">
                                        Details
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                    </button>
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


<div class="modal" id="dealsModal">
    <div class="modal__content">

        <!-- Top Modal Content -->
        <div class="modal__content__top">
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title" id="dealsModalTitle">
                    Deal Information
                </div>
            </div>
            <button class="btn-text btn-text--bg close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main" id="dealsModalMainContent">

            <?php
            foreach ($allDeals as $deal) :
                $id = $deal->ID;
                $image = get_field('featured_image', $deal);
                $title = get_field('navigation_title', $deal);
                $description = get_field('description', $deal);
                $terms_and_conditions = get_field('terms_and_conditions', $deal);
                $has_expiry_date = get_field('has_expiry_date', $deal);
                $expiry_date =  get_field('expiry_date', $deal);
                $is_special_departure = get_field('is_special_departure', $deal);
                $itinerariesWithDeal = getItinerariesWithDeal($deal);
                $is_exclusive =  get_field('is_exclusive', $deal);


            ?>

                <div class="product-deals-modal-item" dealId="<?php echo $id; ?>">
                    <div class="product-deals-modal-item__title">
                        <?php echo $title; ?>
                    </div>
                    <div class="product-deals-modal-item__image-area">
                        <img <?php afloat_image_markup($image['id'], 'landscape-small', array('landscape-small', 'portrait-small')); ?>>

                        <!-- Tag Area -->
                        <div class="product-deals-modal-item__image-area__tag-area">
                            <?php if ($is_special_departure) : ?>
                                <div class="card-tag card-tag--special">
                                    Special Departure
                                </div>
                            <?php endif; ?>
                            <?php if ($is_exclusive) : ?>
                                <div class="card-tag card-tag--light">
                                    Exclusive Deal
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="product-deals-modal-item__description">
                        <?php echo $description; ?>
                    </div>

                    <!-- Validity -->
                    <div class="product-deals-modal-item__validity">
                        <?php if (!$is_special_departure) : ?>
                            <div class="validity">
                                <svg class="validity__icon">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-stopwatch"></use>
                                </svg>
                                <div class="validity__title">
                                    <?php if ($has_expiry_date) : ?>
                                        Offer Valid Until <?php echo date("F j, Y", strtotime($expiry_date)); ?>
                                        <div class="validity__title__sub">
                                            <?php echo getDaysUntilExpiry($expiry_date) ?> Days Remaining
                                        </div>
                                    <?php else : ?>
                                        Limited time offer
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Products -->
                    <?php if (count($itinerariesWithDeal) > 0) : ?>
                        <div class="product-deals-modal-item__itineraries">
                            <h4>Itineraries with <?php echo $is_special_departure ? 'Special Departure' : 'Deal' ?></h4>
                            <div class="product-deals-modal-item__itineraries__grid">
                                <?php
                                foreach ($itinerariesWithDeal as $itinerary) :
                                    $images =  get_field('hero_gallery', $itinerary);
                                    $image = $images[0];
                                    $title = get_field('display_name', $itinerary);
                                    $length_in_nights = get_field('length_in_nights', $itinerary);
                                    $length = $length_in_nights + 1 . ' Day / ' . $length_in_nights . ' Night';
                                ?>
                                    <a class="nav-search-item nav-search-item--border nav-search-item--avatar" href="<?php echo get_permalink($itinerary); ?>">
                                        <?php if ($image != null) : ?>
                                            <div class="nav-search-item__image-area">
                                                <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                            </div>
                                        <?php endif; ?>
                                        <div class="nav-search-item__title-group">
                                            <div class="nav-search-item__title-group__title">
                                                <?php echo $title ?>
                                            </div>
                                            <div class="nav-search-item__title-group__sub">
                                                <?php echo $length ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- TC -->
                    <?php if ($terms_and_conditions) : ?>
                        <h4>Terms & Conditions</h4>
                        <ul class="highlight-list">
                            <?php foreach ($terms_and_conditions as $term) : ?>
                                <li>
                                    <span>&#8212;</span>
                                    <?php echo $term['condition'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>