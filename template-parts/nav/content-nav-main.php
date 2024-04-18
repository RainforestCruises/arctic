<?php
$landing_pages = get_field('landing_pages', 'options');
$ships = get_field('ships', 'options'); // create new array with ships split for each region
$guides = get_field('guides', 'options');
$top_level_guides_page = get_field('top_level_guides_page', 'options');
$top_level_deals_page = get_field('top_level_deals_page', 'options');
$top_level_search_page = get_field('top_level_search_page', 'options');

$regionsArgs = array(
    'post_type' => 'rfc_regions',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
);
$regions = get_posts($regionsArgs);
$initialRegion = checkPageRegion(); // set based on the page template
$primaryRegion = getPrimaryRegion();
$templateHeaderActive = checkActiveHeader();
$hideSecondaryRegions = get_field('hide_secondary_regions', 'options');

console_log('test');
console_log($guides);

?>

<!-- Nav Main -->
<div class="nav-main <?php echo ($templateHeaderActive == true) ? 'active' : ''; ?>">

    <div class="nav-main__content">
        <!-- Left (logo) -->
        <div class="nav-main__content__left">
            <a href="<?php echo get_home_url(); ?>" class="nav-main__content__left__logo-area">
                <?php
                $logo = get_field('logo_main', 'options');
                $logoMinimal = get_field('logo_minimal', 'options');
                ?>
                <img src="<?php echo $logo['url']; ?>" class="nav-main__content__left__logo-area__logo-main" alt="<?php echo get_bloginfo('name') ?>" />
                <img src="<?php echo $logoMinimal['url']; ?>" class="nav-main__content__left__logo-area__logo-minimal" alt="<?php echo get_bloginfo('name') ?>" />
            </a>
        </div>

        <!-- Center -->
        <div class="nav-main__content__center">

            <!-- Search-->
            <div class="nav-main__content__center__search-area">
                <?php get_template_part('template-parts/nav/search/content', 'nav-search-cta'); ?>
            </div>

            <!-- Nav Links -->
            <nav class="nav-main__content__center__nav">

                <ul class="nav-main__content__center__nav__list">
                    <li class="nav-main__content__center__nav__list__item" navelement="category">
                        Cruises
                    </li>
                    <li class="nav-main__content__center__nav__list__item" navelement="ships">
                        Ships
                    </li>
                    <li class="nav-main__content__center__nav__list__item" navelement="guides">
                        Guide
                    </li>
                    <li class="nav-main__content__center__nav__list__link" navelement="deals">
                        <a href="<?php echo $top_level_deals_page; ?>">Deals</a>
                    </li>
                </ul>

            </nav>

            <!-- Nav Mega (abs position)-->
            <div class="nav-mega">

                <!-- Cruises Panel (category) -->
                <div class="nav-mega__panel" panel="category">
                    <div class="nav-mega__panel__regions" style="display: <?php echo $hideSecondaryRegions ? 'none' : '' ?>">
                        <?php foreach ($regions as $region) : ?>
                            <button class="btn-region <?php echo ($region == $initialRegion) ? 'active' : '' ?> nav-region-select" region="<?php echo $region->ID; ?>">
                                <?php echo get_the_title($region) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <div class="mega-panel-category">
                        <?php
                        $categorySliderCount = 0;
                        foreach ($landing_pages as $group) :
                            $group_title = $group['group'];
                            $items = $group['items'];
                        ?>
                            <div class="mega-slider mega-slider--category">
                                <div class="mega-slider__top title-divider">
                                    <!-- Title -->
                                    <div class="mega-slider__top__title">
                                        <?php echo $group_title; ?>
                                    </div>
                                    <!-- Nav Buttons -->
                                    <div class="mega-slider__top__nav">

                                    </div>
                                </div>


                                <div class="swiper mega-slider__slider" id="mega-category-slider-<?php echo $categorySliderCount; ?>">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($items as $item) :
                                            $url = get_permalink($item);
                                            $hero_title = get_field('hero_title', $item);
                                            $hero_images =  get_field('hero_images', $item);
                                            $itemRegionObject = get_field('region', $item);
                                            $itemRegionId = $itemRegionObject ? $itemRegionObject->ID : "all";
                                            $showInitial = true;
                                            if($itemRegionObject){
                                                $showInitial = $initialRegion->ID == $itemRegionId || $itemRegionId == "all";
                                            }                                        ?>
                                            <a class="mega-category-item swiper-slide nav-mega-item" href="<?php echo $url; ?>" region="<?php echo $itemRegionId; ?>" style="display: <?php echo $showInitial ? '' : 'none' ?>">
                                                <div class="mega-category-item__image-area">
                                                    <img <?php afloat_image_markup($hero_images[0]['id'], 'square-small', array('square-small')); ?>>
                                                </div>
                                                <div class="mega-category-item__title">
                                                    <?php echo $hero_title ?>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="swiper-button-prev swiper-button-prev--white-border mega-category-slider-btn-prev-<?php echo $categorySliderCount; ?>">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                                        </svg>
                                    </div>
                                    <div class="swiper-button-next swiper-button-next--white-border mega-category-slider-btn-next-<?php echo $categorySliderCount; ?>">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                    </div>
                                </div>


                            </div>
                        <?php $categorySliderCount++;
                        endforeach; ?>
                    </div>
                </div>

                <!-- Ships Panel -->
                <div class="nav-mega__panel " panel="ships">
                    <div class="nav-mega__panel__regions" style="display: <?php echo $hideSecondaryRegions ? 'none' : '' ?>">
                        <?php foreach ($regions as $region) : ?>
                            <button class="btn-region <?php echo ($region == $initialRegion) ? 'active' : '' ?> nav-region-select" region="<?php echo $region->ID; ?>">
                                <?php echo get_the_title($region) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <div class="mega-panel-ships">
                        <?php
                        $shipsSliderCount = 0;
                        foreach ($ships as $group) :
                            $group_title = $group['group'];
                            $items = $group['items']; //ships
                        ?>
                            <div class="mega-slider mega-slider--ships">
                                <div class="mega-slider__top title-divider">
                                    <!-- Title -->
                                    <div class="mega-slider__top__title">
                                        <?php echo $group_title; ?>
                                    </div>
                                    <!-- Nav Buttons -->
                                    <div class="mega-slider__top__nav">

                                    </div>
                                </div>
                                <div class="mega-slider__slider" id="mega-ships-slider-<?php echo $shipsSliderCount; ?>">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($items as $item) : // ships
                                            $title = get_the_title($item);
                                            $hero_gallery = get_field('hero_gallery', $item);
                                            $ship_image = $hero_gallery[0];
                                            $shipRegions = getShipRegions($item);
                                            $guestsDisplay = get_field('vessel_capacity', $item) . ' Guests';

                                            foreach ($shipRegions as $shipRegion) :
                                                $url = get_permalink($item);
                                                if($primaryRegion != $shipRegion){
                                                    $url .= "?region=" . $shipRegion->ID;
                                                }
                                                $itineraries = getShipItineraries($item, $shipRegion);
                                                $itineraryDisplay = count($itineraries) . ' Itineraries, ' . itineraryRange($itineraries, "-") . " Days";

                                                
                                                $shipRegionId = $shipRegion ? $shipRegion->ID : "all";
                                                $showInitial = $initialRegion->ID == $shipRegionId || $shipRegionId == "all";
                                        ?>
                                            <a class="btn-avatar-info swiper-slide nav-mega-item" href="<?php echo $url; ?>" region="<?php echo $shipRegionId; ?>" style="display: <?php echo $showInitial ? '' : 'none' ?>">
                                                <div class="btn-avatar-info__image-area">
                                                    <img <?php afloat_image_markup($ship_image['id'], 'square-small'); ?>>
                                                </div>
                                                <div class="btn-avatar-info__title-group">
                                                    <div class="btn-avatar-info__title-group__title">
                                                        <?php echo $title ?>
                                                    </div>
                                                    <div class="btn-avatar-info__title-group__sub">
                                                        <?php echo $itineraryDisplay ?>
                                                    </div>
                                                    <div class="btn-avatar-info__title-group__sub">
                                                        <?php echo $guestsDisplay ?>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; endforeach; ?>

                                    </div>
                                    <div class="swiper-button-prev swiper-button-prev--white-border mega-ships-slider-btn-prev-<?php echo $shipsSliderCount; ?>">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                                        </svg>
                                    </div>
                                    <div class="swiper-button-next swiper-button-next--white-border mega-ships-slider-btn-next-<?php echo $shipsSliderCount; ?>">
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                    </div>

                                </div>

                            </div>

                        <?php $shipsSliderCount++;
                        endforeach; ?>
                    </div>
                    <!-- View All CTA -->
                    <div class="nav-mega__panel__cta">
                        <a class="btn-pill btn-pill--icon" href="<?php echo $top_level_search_page; ?> . ?viewType=search-ships">
                            View All Ships
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Guides Panel -->
                <div class="nav-mega__panel" panel="guides">
                    <div class="nav-mega__panel__regions" style="display: <?php echo $hideSecondaryRegions ? 'none' : '' ?>">
                        <?php foreach ($regions as $region) : ?>
                            <button class="btn-region <?php echo ($region == $initialRegion) ? 'active' : '' ?> nav-region-select" region="<?php echo $region->ID; ?>">
                                <?php echo get_the_title($region) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <div class="mega-panel-guides">

                        <?php foreach ($guides as $g) :
                            $group = $g['group'];
                            $items = $g['items'];
                        ?>

                            <!-- Group -->
                            <div class="mega-slider mega-slider--guides">
                                <div class="mega-slider__top title-divider">
                                    <!-- Title -->
                                    <div class="mega-slider__top__title">
                                        <?php echo $group; ?>
                                    </div>
                                    <!-- Nav Buttons -->
                                    <div class="mega-slider__top__nav">

                                    </div>
                                </div>
                                <div class="mega-slider__slider">
                                    <?php foreach ($items as $i) :
                                        $title = $i['title'];
                                        $guide_post = $i['guide_post'];
                                        $featured_image = get_field('featured_image', $guide_post);
                                        $itemRegionObject = get_field('region', $guide_post);
                                        $itemRegionId = $itemRegionObject ? $itemRegionObject->ID : "all";
                                        $showInitial = true;
                                        if($itemRegionObject){
                                            $showInitial = $initialRegion->ID == $itemRegionId || $itemRegionId == "all";
                                        }
                                        
                                    ?>

                                        <a class="btn-avatar-info no-border nav-mega-item" href="<?php echo get_permalink($guide_post); ?>" region="<?php echo $itemRegionId; ?>" style="display: <?php echo $showInitial ? '' : 'none' ?>">
                                            <div class="btn-avatar-info__image-area">
                                                <img <?php afloat_image_markup($featured_image['id'], 'square-small'); ?>>
                                            </div>
                                            <div class="btn-avatar-info__title-group">
                                                <div class="btn-avatar-info__title-group__title">
                                                    <?php echo $title ?>
                                                </div>

                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- View All CTA -->
                    <div class="nav-mega__panel__cta">
                        <a class="btn-pill btn-pill--icon" href="<?php echo $top_level_guides_page; ?>">
                            View The Guide
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <!-- Right -->
        <div class="nav-main__content__right">

            <!-- Right Widget-->
            <?php get_template_part('template-parts/nav/content', 'nav-right'); ?>

        </div>

    </div>
</div>