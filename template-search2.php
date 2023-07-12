<?php
/*Template Name: Search 2*/
wp_enqueue_script('page-search2', get_template_directory_uri() . '/js/page-search2.js', array('jquery'), false, true);
get_header();


//Paging
$pageNumber = 1;
if (isset($_GET["pageNumber"]) && $_GET["pageNumber"]) {
    $pageNumber = htmlspecialchars($_GET["pageNumber"]);
}

//Sorting
$sorting = "popularity";
if (isset($_GET["sorting"]) && $_GET["sorting"]) {
    $sorting = htmlspecialchars($_GET["sorting"]);
}

//Search Input
$searchInput = '';
if (isset($_GET["searchInput"]) && $_GET["searchInput"]) {
    $searchInput = htmlspecialchars($_GET["searchInput"]);
}

//Departure Dates
$departures = [];
$departuresString = "";
if (isset($_GET["departures"]) && $_GET["departures"]) {
    $departuresParameters = htmlspecialchars($_GET["departures"]);
    $departuresString = $departuresParameters;
    console_log($departuresString);
    $departures = explode(";", $departuresString);
}

//View
$viewType = 'search-itineraries';
// $gridDefault = get_field('grid_view_default');
// if ($gridDefault == true) {
//     $viewType = 'grid';
// }

if (isset($_GET["viewType"]) && $_GET["viewType"]) {
    $viewType = htmlspecialchars($_GET["viewType"]);
}


// Region
$region = get_field('region');
if (isset($_GET["region"]) && $_GET["region"]) {
    $regions = htmlspecialchars($_GET["region"]);
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
$selectedStyles = get_field('styles');
if ($selectedStyles != null) {
    $styles = $selectedStyles;
    $stylesString = implode(";", $styles);
}

// -- URL param
if (isset($_GET["styles"])) {
    if (isset($_GET["styles"]) && $_GET["styles"]) {
        $stylesParameters = htmlspecialchars($_GET["styles"]);
        $stylesString = $stylesParameters;
        $styles = explode(";", $stylesString);
    } else {
        $styles = [];
        $stylesString = "";
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



//  first load
$resultsObject = getSearchPosts($region, $routes, $styles, $lengthMin, $lengthMax, $departures, $searchInput, $sorting, $pageNumber, $viewType);
$resultCount = $resultsObject['resultsCount'];

//Page arguments ------------
$args = array(
    'region' => $region, //preselection
    'styles' => $styles, //preselection
    'routes' => $routes, //preselection
    'departures' => $departures, //preselection
    'lengthMin' => $lengthMin, //preselection
    'lengthMax' => $lengthMax, //preselection
    'sorting' => $sorting,
    'searchInput' => $searchInput,
    'pageNumber' => $pageNumber,
    'resultsObject' => $resultsObject,
    'resultCount' => $resultCount,
    'viewType' => $viewType,
);



?>

<main class="main-content">
    <?php
    get_template_part('template-parts/search/content', 'search-intro', $args);
    ?>

    <div class="search-filter-bar" id="search-filter-bar">
        <button class="search-filter-bar__button search-button" id="search-filter-bar-button">
            Filters
        </button>
    </div>

    <!-- Content -->
    <section class="search-main" >
        <div class="search-main__content" id="search-page-content">
            <?php
            get_template_part('template-parts/search/content', 'search-sidebar', $args); //page args --> initial preselection
            get_template_part('template-parts/search/content', 'search-results-area', $args); //page args --> initial render
            ?>
        </div>
    </section>

</main>

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

    <input type="hidden" name="formDates" id="formDates" value="<?php echo $departuresString ?>">
    <input type="hidden" name="formMinLength" id="formMinLength" value="<?php echo $lengthMin ?>">
    <input type="hidden" name="formMaxLength" id="formMaxLength" value="<?php echo $lengthMax ?>">
    <input type="hidden" name="formSort" id="formSort" value="<?php echo $sorting ?>">
    <input type="hidden" name="formPageNumber" id="formPageNumber" value="<?php echo $pageNumber ?>">

    <input type="hidden" name="formRegion" id="formRegion" value="<?php echo $region ?>">
    <input type="hidden" name="formThemes" id="formThemes" value="<?php echo $stylesString ?>">
    <input type="hidden" name="formRoutes" id="formRoutes" value="<?php echo $routesString ?>">

    <input type="hidden" name="initialPage" id="initialPage" value="">

</form>


<?php get_footer(); ?>