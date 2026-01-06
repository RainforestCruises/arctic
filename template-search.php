<?php
/*Template Name: Search*/
wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);
get_header();


$show_faqs = get_field('show_faqs');
$show_travel_guides = get_field('show_travel_guides');


// Region Preselection
$preselectedRegion = get_field('region');
$primaryRegion = getPrimaryRegion();
if (isset($_GET["region"])) {
    if (isset($_GET["region"]) && $_GET["region"]) {
        $preselectedRegion = htmlspecialchars($_GET["region"]);
    } else {
        $preselectedRegion = $primaryRegion ? $primaryRegion->ID : null;
    }
} else {
    if (!$preselectedRegion) {
        $preselectedRegion = $primaryRegion ? $primaryRegion->ID : null;
    }
}

// Sidebar Filter Lists --------------------------------------------------------------------------------------------------------
// Sidebar Regions
$regionsArgs = array(
    'post_type' => 'rfc_regions',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
);
$sidebarRegions = get_posts($regionsArgs);

// Sidebar Routes
$routesArgs = array(
    'post_type' => 'rfc_routes',
    'posts_per_page' => -1,
    'meta_key' => 'title', // Sorting by ACF field 'display_title'
    'orderby' => 'meta_value', // Order by meta value
    'order' => 'ASC', // ASC or DESC
);
$sidebarRoutes = get_posts($routesArgs);

// Sidebar Styles
$stylesArgs = array(
    'post_type' => 'rfc_styles',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
);
$sidebarStyles = get_posts($stylesArgs);


// Sidebar Embarkation
$sidebarEmbarkationZones = getEmbarkationList();

// Sidebar Ship Sizes
$sidebarShipSizes = [
    (object)[
        'ID' => 1,
        'Display' => 'Small (Under 120)'
    ],
    (object)[
        'ID' => 2,
        'Display' => 'Medium (120 - 200)'
    ],
    (object)[
        'ID' => 3,
        'Display' => 'Large (Over 200)'
    ]
];




// Sidebar Months
$sidebarMonths = [];
$currentMonth = (int)date('m');
$monthLimit = 36;

for ($x = $currentMonth; $x < $currentMonth + $monthLimit; $x++) {

    $object = new stdClass();
    $object->monthName = date('F', mktime(0, 0, 0, $x, 1));
    $object->monthNumber = date('m', mktime(0, 0, 0, $x, 1));
    $object->year = date('Y', mktime(0, 0, 0, $x, 1));
    $object->initiallyShown = true;

    $monthRegions = [];
    foreach ($sidebarRegions as $region) {
        $season_start = get_field('season_start', $region);
        $season_length = get_field('season_length', $region);
        $season_end = $season_start + $season_length;

        $monthNumberArray = []; // build array of month numbers applicable to this region
        for ($z = $season_start - 1; $z <= $season_end; $z++) {
            $monthNumberArray[] = date('m', mktime(0, 0, 0, $z, 1));
        }

        if (array_search($object->monthNumber, $monthNumberArray)) { // check if the current month number corresponds to the array
            $monthRegions[] = $region->ID;
        }
    }
    $object->monthRegions = $monthRegions;

    if ($preselectedRegion != null && array_search($preselectedRegion, $object->monthRegions) === false) {  // determine if initially shown based on preselected region
        $object->initiallyShown = false;
    }

    $sidebarMonths[] = $object;
}


// Preselections --------------------------------------------------------------------------------------------------------
// Paging
$pageNumber = 1;
if (isset($_GET["pageNumber"]) && $_GET["pageNumber"]) {
    $pageNumber = htmlspecialchars($_GET["pageNumber"]);
}

// Sorting
$sorting = "popularity";
if (isset($_GET["sorting"]) && $_GET["sorting"]) {
    $sorting = htmlspecialchars($_GET["sorting"]);
}

// Search Input
$searchInput = '';
if (isset($_GET["searchInput"]) && $_GET["searchInput"]) {
    $searchInput = htmlspecialchars($_GET["searchInput"]);
}

// Departure Dates
$departures = [];
// -- preselected months
$selectedMonthsString = get_field('departure_months');
if (trim($selectedMonthsString) != "") {
    $selectedMonths = explode(",", $selectedMonthsString);
    $currentYear = (int)date('Y');
    $selectedDepartures = [];
    for ($x = $currentYear; $x < $currentYear + 4; $x++) {
        foreach ($selectedMonths as $selectedMonth) {
            $selectedDepartures[] = $x . '-' . trim($selectedMonth);
        }
    }
    $departures = $selectedDepartures;
}

// -- preselected years
$selectedYearsString = get_field('departure_years');
if (trim($selectedYearsString) != "") {
    $selectedYears = explode(",", $selectedYearsString);
    $currentYear = (int)date('Y');
    $currentMonth = (int)date('m');
    $selectedDepartures = [];
    foreach ($selectedYears as $selectedYear) {
        $startMonth = $currentYear == $selectedYear ? $currentMonth : 1;
        for ($x = $startMonth; $x <= 12; $x++) {
            $selectedDepartures[] = trim($selectedYear) . '-' . str_pad($x, 2, '0', STR_PAD_LEFT);
        }
    }
    $departures = $selectedDepartures;
}

$preselectedDepartures = [];
$preselectedDeparturesString = '';
$filteredSidebarMonths = [];
foreach ($sidebarMonths as $m) {
    if ($m->initiallyShown == true) {
        $stringMonth = $m->year . "-" . $m->monthNumber;
        $filteredSidebarMonths[] = $stringMonth;
    }
}
$preselectedDepartures = array_intersect($filteredSidebarMonths, $departures); // reduce preselect to that of months only shown initially
$preselectedDeparturesString = implode(";", $preselectedDepartures);


// -- URL param
if (isset($_GET["departures"])) {
    if (isset($_GET["departures"]) && $_GET["departures"]) {
        $departuresParameters = htmlspecialchars($_GET["departures"]);
        $preselectedDeparturesString = $departuresParameters;
        $preselectedDepartures = explode(";", $preselectedDeparturesString);
    }
}


// View
$viewType = get_field('default_view');
if (isset($_GET["viewType"])) {
    if (isset($_GET["viewType"]) && $_GET["viewType"]) {
        $viewType = htmlspecialchars($_GET["viewType"]);
    } else {
        $viewType = 'search-itineraries';
    }
}


// Routes
$routes = [];
$routesString = "";
$selectedRoutes = get_field('routes');
if ($selectedRoutes != null) {
    $routes = $selectedRoutes;
    $routesString = implode(";", $routes);
}

// -- URL param
if (isset($_GET["routes"])) {
    if (isset($_GET["routes"]) && $_GET["routes"]) {
        $routesParameters = htmlspecialchars($_GET["routes"]);
        $routesString = $routesParameters;
        $routes = explode(";", $routesString);
    } else {
        $routes = [];
        $routesString = "";
    }
}


// Styles
$styles = [];
$stylesString = "";
$selectedStyles = get_field('themes');
if ($selectedStyles != null) {
    $styles = $selectedStyles;
    $stylesString = implode(";", $styles);
}

// -- URL param
if (isset($_GET["themes"])) {
    if (isset($_GET["themes"]) && $_GET["themes"]) {
        $stylesParameters = htmlspecialchars($_GET["themes"]);
        $stylesString = $stylesParameters;
        $styles = explode(";", $stylesString);
    } else {
        $styles = [];
        $stylesString = "";
    }
}


// Deals
$filterDeals = get_field('filter_deals');
if (isset($_GET["filterDeals"])) {
    if (isset($_GET["filterDeals"]) && $_GET["filterDeals"]) {
        $filterDeals = filter_var($_GET['filterDeals'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $filterDeals = false;
    }
}

// Specials
$filterSpecials = get_field('filter_special_departures');
if (isset($_GET["filterSpecials"])) {
    if (isset($_GET["filterSpecials"]) && $_GET["filterSpecials"]) {
        $filterSpecials = filter_var($_GET['filterSpecials'], FILTER_VALIDATE_BOOLEAN);
    } else {
        $filterSpecials = false;
    }
}

// Ship Sizes
$shipSizes = [];
$shipSizesString = "";
$selectedShipSizes = get_field('shipSizes');
if ($selectedShipSizes != null) {
    $shipSizes = $selectedShipSizes;
    $shipSizesString = implode(";", $shipSizes);
}

// -- URL param
if (isset($_GET["shipSizes"])) {
    if (isset($_GET["shipSizes"]) && $_GET["shipSizes"]) {
        $shipSizesParameters = htmlspecialchars($_GET["shipSizes"]);
        $shipSizesString = $shipSizesParameters;
        $shipSizes = explode(";", $shipSizesString);
    } else {
        $shipSizes = [];
        $shipSizesString = "";
    }
}




// Length Min
$lengthMin = 1;
$selectedLengthMin = get_field('itinerary_length_min');
if ($selectedLengthMin != null) {
    $lengthMin = $selectedLengthMin;
}

// -- URL param
if (isset($_GET["length_min"])) {
    if (isset($_GET["length_min"]) && $_GET["length_min"]) {
        $lengthMinParameters = htmlspecialchars($_GET["length_min"]);
        $lengthMin = $lengthMinParameters;
    } else {
        $lengthMin = 1;
    }
}

// Length Max
$lengthMax = 28;
$selectedLengthMax = get_field('itinerary_length_max');
if ($selectedLengthMax != null) {
    $lengthMax = $selectedLengthMax;
}

// -- URL param
if (isset($_GET["length_max"])) {
    if (isset($_GET["length_max"]) && $_GET["length_max"]) {
        $lengthMaxParameters = htmlspecialchars($_GET["length_max"]);
        $lengthMax = $lengthMaxParameters;
    } else {
        $lengthMax = 28;
    }
}




// Price Min
$priceMin = 1;
$selectedPriceMin = get_field('itinerary_price_min');
if ($selectedPriceMin != null) {
    $priceMin = $selectedPriceMin;
}

// -- URL param
if (isset($_GET["price_min"])) {
    if (isset($_GET["price_min"]) && $_GET["price_min"]) {
        $priceMinParameters = htmlspecialchars($_GET["price_min"]);
        $priceMin = $priceMinParameters;
    } else {
        $priceMin = 1;
    }
}

// Price Max
$priceMax = 50000;
$selectedPriceMax = get_field('itinerary_price_max');
if ($selectedPriceMax != null) {
    $priceMax = $selectedPriceMax;
}

// -- URL param
if (isset($_GET["price_max"])) {
    if (isset($_GET["price_max"]) && $_GET["price_max"]) {
        $priceMaxParameters = htmlspecialchars($_GET["price_max"]);
        $priceMax = $priceMaxParameters;
    } else {
        $priceMax = 28;
    }
}




// Embarkation Countries
$embarkationCountries = [];
$embarkationCountriesString = "";
$selectedEmbarkationCountries = get_field('embarkation_countries');
if ($selectedEmbarkationCountries != null) {
    $embarkationCountries = $selectedEmbarkationCountries;
    $embarkationCountriesString = implode(";", $embarkationCountries);
}

// -- URL param
if (isset($_GET["countries"])) {
    if (isset($_GET["countries"]) && $_GET["countries"]) {
        $countriesParameters = htmlspecialchars($_GET["countries"]);
        $embarkationCountriesString = $countriesParameters;
        $embarkationCountries = explode(";", $embarkationCountriesString);
    } else {
        $embarkationCountries = [];
        $embarkationCountriesString = "";
    }
}



// first load
$resultsObject = getSearchPosts($preselectedRegion, $routes, $embarkationCountries, $styles, $shipSizes, $lengthMin, $lengthMax, $priceMin, $priceMax, $preselectedDepartures, $searchInput, $sorting, $pageNumber, $viewType, $filterDeals, $filterSpecials);
$resultCount = $resultsObject['resultsCount'];

console_log($resultsObject);

// page arguments ------------
$args = array(
    'preselectedRegion' => $preselectedRegion, //preselection
    'styles' => $styles, //preselection
    'routes' => $routes, //preselection
    'departures' => $preselectedDepartures, //preselection
    'lengthMin' => $lengthMin, //preselection
    'lengthMax' => $lengthMax, //preselection
    'priceMin' => $priceMin, //preselection
    'priceMax' => $priceMax, //preselection
    'embarkationCountries' => $embarkationCountries, //preselection
    'shipSizes' => $shipSizes, //preselection
    'sorting' => $sorting,
    'searchInput' => $searchInput,
    'pageNumber' => $pageNumber,
    'resultsObject' => $resultsObject,
    'resultCount' => $resultCount,
    'viewType' => $viewType,
    'filterDeals' => $filterDeals,
    'filterSpecials' => $filterSpecials,
    'sidebarMonths' => $sidebarMonths,
    'sidebarRegions' => $sidebarRegions,
    'sidebarRoutes' => $sidebarRoutes,
    'sidebarStyles' => $sidebarStyles,
    'sidebarShipSizes' => $sidebarShipSizes,
    'sidebarEmbarkationZones' => $sidebarEmbarkationZones,
    'footerCtaDivider' => true
);

?>

<main class="main-content" style="padding-bottom: 6rem;">
    <?php
    get_template_part('template-parts/search/content', 'search-intro', $args);
    ?>

    <div class="search-filter-bar" id="search-filter-bar">
        <div class="search-filter-bar__left">
            <button class="search-filter-bar__button btn-pill" id="search-filter-bar-button">
                Filters
            </button>
            <button class="search-filter-bar__button btn-pill generic-inquire-cta">
                Inquire
            </button>
        </div>

    </div>

    <!-- Content -->
    <section class="search-main">
        <div class="search-main__content" id="search-page-content">
            <?php
            get_template_part('template-parts/search/content', 'search-sidebar', $args); // page args --> initial preselection
            get_template_part('template-parts/search/content', 'search-results-area', $args); // page args --> initial render
            ?>
        </div>
    </section>

    <?php if ($show_faqs) :
        get_template_part('template-parts/search/content', 'search-faqs', $args);
    endif; ?>

    <?php if ($show_travel_guides) :
        get_template_part('template-parts/search/content', 'search-travel-guides', $args);
    endif; ?>

    <!-- Footer CTA  -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
    ?>

</main>

<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'shared-basic-inquiry-modal', $args);
?>


<!-- Full Search Mobile -->
<div class="search-filter-mobile-area" id="search-filter-mobile-area">
</div>

<div class="search-filter-mobile-cta" id="search-filter-mobile-cta">
    <button id="search-filter-mobile-cta-button">
        See <?php echo $resultCount; ?> Results
    </button>
</div>



<!-- Hidden Form -->
<form class="search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">

    <!-- Direct to function within functions.php -->
    <input type="hidden" name="action" value="primarySearch">
    <input type="hidden" name="formSearchInput" id="formSearchInput" value="<?php echo $searchInput ?>">
    <input type="hidden" name="formViewType" id="formViewType" value="<?php echo $viewType ?>">
    <input type="hidden" name="formFilterDeals" id="formFilterDeals" value="<?php echo $filterDeals ?>">
    <input type="hidden" name="formFilterSpecials" id="formFilterSpecials" value="<?php echo $filterSpecials ?>">

    <input type="hidden" name="formDates" id="formDates" value="<?php echo $preselectedDeparturesString ?>">
    <input type="hidden" name="formMinLength" id="formMinLength" value="<?php echo $lengthMin ?>">
    <input type="hidden" name="formMaxLength" id="formMaxLength" value="<?php echo $lengthMax ?>">
    <input type="hidden" name="formMinPrice" id="formMinPrice" value="<?php echo $priceMin ?>">
    <input type="hidden" name="formMaxPrice" id="formMaxPrice" value="<?php echo $priceMax ?>">
    <input type="hidden" name="formSort" id="formSort" value="<?php echo $sorting ?>">
    <input type="hidden" name="formPageNumber" id="formPageNumber" value="<?php echo $pageNumber ?>">
    <input type="hidden" name="formRegion" id="formRegion" value="<?php echo $preselectedRegion ?>">
    <input type="hidden" name="formThemes" id="formThemes" value="<?php echo $stylesString ?>">
    <input type="hidden" name="formShipSizes" id="formShipSizes" value="<?php echo $shipSizesString ?>">
    <input type="hidden" name="formRoutes" id="formRoutes" value="<?php echo $routesString ?>">
    <input type="hidden" name="formCountries" id="formCountries" value="<?php echo $embarkationCountriesString ?>">

    <input type="hidden" name="initialPage" id="initialPage" value="">

</form>


<?php get_footer(); ?>