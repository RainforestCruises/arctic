<?php

// Sidebar lists
$sidebarMonths = $args['sidebarMonths'];
$sidebarRegions = $args['sidebarRegions'];
$sidebarRoutes = $args['sidebarRoutes'];
$sidebarStyles = $args['sidebarStyles'];
$sidebarEmbarkationZones = $args['sidebarEmbarkationZones'];

// Preselections
$preselectedRegion = $args['preselectedRegion'];
$selectedStyles = $args['styles'];
$selectedRoutes = $args['routes'];
$selectedDepartures = $args['departures'];
$searchInput = $args['searchInput'];
$selectedDeals = $args['filterDeals'];
$selectedSpecials = $args['filterSpecials'];
$selectedEmbarkationCountries = $args['embarkationCountries'];

$hideSecondaryRegions = get_field('hide_secondary_regions', 'options');

?>

<!-- Search Sidebar -->
<aside class="search-sidebar" id="search-sidebar">

    <!-- Mobile Header -->
    <div class="search-sidebar__mobile-header" id="search-sidebar-mobile-header">
        <button class="search-sidebar__mobile-header__close-button" id="search-sidebar-mobile-close-button">
            <div class="search-sidebar__mobile-header__close-button__icon-area">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                </svg>
            </div>
            <div class="search-sidebar__mobile-header__close-button__text-area">
                Close
            </div>
        </button>

        <button class="search-sidebar__mobile-header__clear-button btn-pill clear-filters" id="search-sidebar-mobile-clear-button">
            Clear
        </button>
    </div>

    <?php if (!$hideSecondaryRegions) : ?>
        <!-- Product Name Search Filter -->
        <div class="filter">
            <div class="filter__heading">
                <h5 class="filter__heading__text">
                    Product Name
                </h5>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                </svg>
            </div>
            <div class="filter__content" style="padding-right: .5rem; padding-bottom: 3.5rem; padding-top: 0rem;">
                <div class="filter__content__search-area">
                    <input class="filter__content__search-area__input" type="text" id="searchInput" autocomplete="off" value="<?php echo $searchInput; ?>">
                    <button class="filter__content__search-area__clear" id="searchInputClear">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-cross"></use>
                        </svg>
                    </button>
                    <button class="filter__content__search-area__button " id="searchInputButton">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Regions Filter -->
        <div class="filter">
            <div class="filter__heading">
                <h5 class="filter__heading__text">
                    Region
                    <?php $filterCount = count($preselectedRegion) ?>
                    <div class="filter__heading__text__count <?php echo ($filterCount > 0 ? 'show' : '') ?>" id="regionFilterCount">
                        <?php echo $filterCount; ?>
                    </div>
                </h5>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                </svg>
            </div>
            <div class="filter__content">
                <!-- List -->
                <ul class="filter__content__list">
                    <?php
                    $count = 1;
                    foreach ($sidebarRegions as $region) :
                    ?>
                        <li class="filter__content__list__item">
                            <div class="form-checkbox">
                                <input class="checkbox region-checkbox" type="checkbox" id="region-checkbox-<?php echo $count; ?>" value="<?php echo $region->ID ?>" <?php echo ($preselectedRegion != null ? ($region->ID == $preselectedRegion ? 'checked' : '') : '') ?>>
                                <label for="region-checkbox-<?php echo $count; ?>" tabindex="1"><?php echo get_the_title($region) ?></label>
                            </div>
                        </li>
                    <?php $count++;
                    endforeach; ?>

                </ul>
            </div>
        </div>

    <?php endif ?>
    <!-- Departure Date Filter -->
    <div class="filter">
        <div class="filter__heading" id="departure-filter-heading">
            <h5 class="filter__heading__text">
                Departure Date
                <?php $filterCount = count($selectedDepartures); ?>
                <div class="filter__heading__text__count <?php echo ($filterCount > 0 ? 'show' : '') ?>" id="departuresFilterCount">
                    <?php echo $filterCount; ?>
                </div>
            </h5>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List  add expanded if selection-->
            <ul class="filter__content__list  filter__content__list--fixedHeight" id="departure-filter-list">

                <?php
                $count = 1;
                foreach ($sidebarMonths as $m) :
                    $currentItemValue = $m->year . '-' . $m->monthNumber;
                    $matchRegion = $m->initiallyShown == false ? "none" : "block";

                ?>
                    <li class="filter__content__list__item departure-checkbox-group" region-value="<?php echo implode(",", $m->monthRegions); ?>" style="display: <?php echo $matchRegion ?>">
                        <div class="form-checkbox">
                            <input class="checkbox departure-checkbox <?php echo ($count > 6) ? 'checkbox-expand-group' : ''; ?>" type="checkbox" id="departure-checkbox-<?php echo $count; ?>" value="<?php echo $currentItemValue; ?>" <?php echo ($selectedDepartures != null ? (in_array($currentItemValue, $selectedDepartures) ? 'checked' : '') : '') ?>>
                            <label for="departure-checkbox-<?php echo $count; ?>"><?php echo $m->monthName . " " . $m->year; ?></label>
                        </div>
                    </li>
                <?php $count++;
                endforeach; ?>

            </ul>
            <div class="filter__content__show-more">
                <button class="btn-primary btn-primary--inverse-outline btn-primary--small btn-primary--bold" id="departure-show-more">Show More</button>
            </div>
            <!-- Extras here, button etc-->
        </div>
    </div>

    <!-- Routes Filter -->
    <div class="filter">
        <div class="filter__heading">
            <h5 class="filter__heading__text">
                Routes
                <?php
                $filterCount = count($selectedRoutes);
                ?>
                <div class="filter__heading__text__count <?php echo ($filterCount > 0 ? 'show' : '') ?>" id="routesFilterCount">
                    <?php echo $filterCount; ?>
                </div>

            </h5>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List -->
            <ul class="filter__content__list">

                <?php
                $count = 1;
                foreach ($sidebarRoutes as $route) :
                    $routeRegion = get_field('region', $route);
                    $matchRegion = ($preselectedRegion != null && $routeRegion->ID != $preselectedRegion) ? "none" : "block";
                ?>
                    <li class="filter__content__list__item route-checkbox-group" region-value="<?php echo $routeRegion != null ? $routeRegion->ID : 0 ?>" style="display: <?php echo $matchRegion ?>">
                        <div class="form-checkbox">
                            <input class="checkbox route-checkbox" type="checkbox" id="route-checkbox-<?php echo $count; ?>" value="<?php echo $route->ID ?>" <?php echo ($selectedRoutes != null ? (in_array($route->ID, $selectedRoutes) ? 'checked' : '') : '') ?> region-value="<?php echo $routeRegion != null ? $routeRegion->ID : 0 ?>">
                            <label for="route-checkbox-<?php echo $count; ?>"><?php echo get_field('title', $route) ?></label>
                        </div>
                    </li>
                <?php $count++;
                endforeach; ?>

            </ul>
        </div>
    </div>

    <!-- Styles Filter -->
    <div class="filter">
        <div class="filter__heading">
            <h5 class="filter__heading__text">
                Themes
                <?php $filterCount = count($selectedStyles); ?>
                <div class="filter__heading__text__count <?php echo ($filterCount > 0 ? 'show' : '') ?>" id="themesFilterCount">
                    <?php echo $filterCount; ?>
                </div>
            </h5>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List -->
            <ul class="filter__content__list">
                <?php
                $count = 1;
                foreach ($sidebarStyles as $style) :
                ?>
                    <li class="filter__content__list__item">
                        <div class="form-checkbox">
                            <input class="checkbox theme-checkbox" type="checkbox" id="theme-checkbox-<?php echo $count; ?>" value="<?php echo $style->ID ?>" <?php echo ($selectedStyles != null ? (in_array($style->ID, $selectedStyles) ? 'checked' : '') : '') ?>>
                            <label for="theme-checkbox-<?php echo $count; ?>" tabindex="1"><?php echo get_the_title($style) ?></label>
                        </div>
                    </li>
                <?php $count++;
                endforeach; ?>

            </ul>
        </div>
    </div>

    <!-- Length Filter -->
    <div class="filter">
        <div class="filter__heading">
            <h5 class="filter__heading__text">
                Itinerary Length
            </h5>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>

        <div class="filter__content">
            <!-- List -->
            <input class="filter__content__range-slider" type="text" name="range-slider" id="range-slider">
            <div class="filter__content__fine-print">
                Drag sliders to modify range
            </div>
        </div>
    </div>

    <!-- Price Filter -->
    <div class="filter">
        <div class="filter__heading">
            <h5 class="filter__heading__text">
                Price Range
            </h5>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List -->
            <input class="filter__content__range-slider" type="text" name="price-slider" id="price-slider">
            <div class="filter__content__fine-print">
                Drag sliders to modify range
            </div>
        </div>
    </div>

    <!-- Extras Filter -->
    <div class="filter">
        <div class="filter__heading">
            <h5 class="filter__heading__text">
                Deals & Special Guests
                <?php
                $filterCount = 0;
                $filterCount += $selectedDeals == true ? 1 : 0;
                $filterCount += $selectedSpecials == true ? 1 : 0;
                ?>
                <div class="filter__heading__text__count <?php echo ($filterCount > 0 ? 'show' : '') ?>" id="extrasFilterCount">
                    <?php echo $filterCount; ?>
                </div>
            </h5>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>

        <div class="filter__content">
            <!-- List -->
            <ul class="filter__content__list">

                <li class="filter__content__list__item">
                    <div class="form-checkbox">
                        <input class="checkbox extras-checkbox" type="checkbox" id="deal-checkbox" <?php echo ($selectedDeals == true ? 'checked' : '') ?>>
                        <label for="deal-checkbox" tabindex="1">Departures with Deals</label>
                    </div>
                </li>
                <li class="filter__content__list__item">
                    <div class="form-checkbox">
                        <input class="checkbox extras-checkbox" type="checkbox" id="special-checkbox" <?php echo ($selectedSpecials == true ? 'checked' : '') ?>>
                        <label for="special-checkbox" tabindex="2">Special Guest Departures</label>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <!-- Embarkation Filter -->
    <div class="filter">
        <div class="filter__heading">
            <h5 class="filter__heading__text">
                Embarkation Points
                <?php $filterCount = count($selectedEmbarkationCountries); ?>
                <div class="filter__heading__text__count <?php echo ($filterCount > 0 ? 'show' : '') ?>" id="embarkFilterCount">
                    <?php echo $filterCount; ?>
                </div>
            </h5>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
            </svg>
        </div>
        <div class="filter__content">
            <!-- List -->
            <ul class="filter__content__list">
                <?php
                $count = 1;
                foreach ($sidebarEmbarkationZones as $zone) :
                    $matchRegion = ($preselectedRegion != null && $zone['region']->ID != $preselectedRegion) ? "none" : "block";
                    $zonePost = $zone['zone'];
                    $regionPost = $zone['region'];
                    $countryList = $zone['countries'];
                    $isPrimaryRegion = get_field('primary', $regionPost);
                    if($hideSecondaryRegions && !$isPrimaryRegion) {
                        continue;
                    }
                ?>
                    <div class="filter__content__subtitle embark-subtitle"  region-value="<?php echo $zone['region']->ID ?>" style="display: <?php echo $matchRegion ?>">
                        <?php echo get_the_title($zonePost); ?>
                    </div>
                    <?php foreach ($countryList as $country) : 
                        $countryPost = $country['country']; 
                        ?>
                        <li class="filter__content__list__item embark-checkbox-group" region-value="<?php echo $zone['region']->ID ?>"  style="display: <?php echo $matchRegion ?>">
                            <div class="form-checkbox">
                                <input class="checkbox embark-checkbox" type="checkbox" id="embark-checkbox-<?php echo $count; ?>" value="<?php echo $countryPost->ID ?>" <?php echo ($selectedEmbarkationCountries != null ? (in_array($countryPost->ID, $selectedEmbarkationCountries) ? 'checked' : '') : '') ?>>
                                <label for="embark-checkbox-<?php echo $count; ?>"><?php echo get_the_title($countryPost) ?></label>
                            </div>
                        </li>
                <?php $count++;
                    endforeach;
                endforeach; ?>

            </ul>
        </div>
    </div>



    <!-- Clear Filters Button -->
    <div class="filter--clear clear-filters-area" id="clear-filters-area">
        <button class="btn-primary btn-primary--inverse-outline btn-primary--small btn-primary--bold clear-filters">
            Clear Filters
        </button>
    </div>
</aside>