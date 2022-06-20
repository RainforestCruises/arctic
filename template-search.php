<?php
/*Template Name: Search*/
wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-search',
    'page_vars',
    array(
      'templateUrl' =>  $templateUrl
    )
  );
?>

<?php
get_header();
?>

<?php 

//Initial Search from Page Load

//Region / Destination Setup --------------
$searchType = get_field('search_type');

$region = null;
$regionId = null;
$destination = null;
$destinationId = null;

if ($searchType == 'region') {
    $region = get_field('region');
    
    $regionId = $region->ID;
} else if ($searchType == 'destination'){

    $destination = get_field('destination');
    $region = get_field('region', $destination);

    $regionId = $region->ID;
    $destinationId = $destination->ID;
} 




//Preselections (strings for form values) ------------
//From URL

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

//View
$viewType = 'list';
$gridDefault = get_field('grid_view_default');

if($gridDefault == true){
    $viewType = 'grid';
}

if (isset($_GET["viewType"]) && $_GET["viewType"]) {
    $viewType = htmlspecialchars($_GET["viewType"]);
}



//--Length Max
$lengthMax = 21;
$selectedLengthMax = get_field('itinerary_length_max');
if ($selectedLengthMax != null) {
    $lengthMax = $selectedLengthMax;
}



//Departure Dates
$departures = [];
$departuresString = "";
$selectedDepartures = get_field('departures'); //--preselection
if ($selectedDepartures != null) {
    $departures = $selectedDepartures;
    $departuresString = implode(";", $departures);
}

//URL param
if (isset($_GET["departures"])) {
    if (isset($_GET["departures"]) && $_GET["departures"]) {
        $departuresParameters = htmlspecialchars($_GET["departures"]);
        $departuresString = $departuresParameters;
        $departures = explode(";", $departuresString);
    } else {
        $departures = [];
        $departuresString = "";
    }
}


//--Travel style
$travelTypes = [];
$travelTypesString = "";
$selectedTravelTypes = get_field('travel_type');
if ($selectedTravelTypes != null) {
    $travelTypes = $selectedTravelTypes;
    $travelTypesString = implode(";", $travelTypes);
}

//URL param
if (isset($_GET["travel_style"])) {
    if (isset($_GET["travel_style"]) && $_GET["travel_style"]) {
        $travelTypesParameters = htmlspecialchars($_GET["travel_style"]);
        $travelTypesString = $travelTypesParameters;
        $travelTypes = explode(";", $travelTypesString);
    } else {
        $travelTypes = [];
        $travelTypesString = "";
    }
}



$charterFilter = false;
if (!$travelTypes == null) {

    if ($travelTypes[0] == 'charter_cruises') {
        $charterFilter = true;
    }
}


//--Destinations
$destinations = [];
$destinationsString = "";
$selectedDestinations = ($searchType == 'destination') ? get_field('location_filter') : get_field('destination_filter');
if ($selectedDestinations != null) {
    $destinations = $selectedDestinations;
    $destinationsString = implode(";", $destinations);
}

//URL param
if (isset($_GET["destinations"])) {
    if (isset($_GET["destinations"]) && $_GET["destinations"]) {
        $destinationsParameters = htmlspecialchars($_GET["destinations"]);
        $destinationsString = $destinationsParameters;
        $destinations = explode(";", $destinationsString);
    } else {
        $destinations = [];
        $destinationsString = "";
    }
}


//--Experiences
$experiences = [];
$experiencesString = "";
$selectedExperiences = get_field('experience');
if ($selectedExperiences != null) {
    $experiences = $selectedExperiences;
    $experiencesString = implode(";", $experiences);
}



//URL param
if (isset($_GET["experiences"])) {
    if (isset($_GET["experiences"]) && $_GET["experiences"]) {
        $experiencesParameters = htmlspecialchars($_GET["experiences"]);
        $experiencesString = $experiencesParameters;
        $experiences = explode(";", $experiencesString);
    } else {
        $experiences = [];
        $experiencesString = "";
    }
}

//--Length Min
$lengthMin = 1;
$selectedLengthMin = get_field('itinerary_length_min');
if ($selectedLengthMin != null) {
    $lengthMin = $selectedLengthMin;
}

//URL param
if (isset($_GET["length_min"])) {
    if (isset($_GET["length_min"]) && $_GET["length_min"]) {
        $lengthMinParameters = htmlspecialchars($_GET["length_min"]);
        $lengthMin = $lengthMinParameters;
    } else {
        $lengthMin = 1;
    }
}

//--Length Max
$lengthMax = 21;
$selectedLengthMax = get_field('itinerary_length_max');
if ($selectedLengthMax != null) {
    $lengthMax = $selectedLengthMax;
}

//URL param
if (isset($_GET["length_max"])) {
    if (isset($_GET["length_max"]) && $_GET["length_max"]) {
        $lengthMaxParameters = htmlspecialchars($_GET["length_max"]);
        $lengthMax = $lengthMaxParameters;
    } else {
        $lengthMax = 21;
    }
}

//first load
$resultsObject = getSearchPosts($travelTypes,  $destinations, $experiences, $searchType, $destinationId, $regionId, $lengthMin, $lengthMax, $departures, $searchInput, $sorting, $pageNumber, $viewType);
$resultCount = $resultsObject['resultsCount'];

//Page arguments ------------
$args = array(
    'searchType' => $searchType,
    'destinationId' => $destinationId,
    'regionId' => $regionId,
    'travelTypes' => $travelTypes, //preselection
    'experiences' => $experiences, //preselection
    'destinations' => $destinations, //preselection
    'departures' => $departures, //preselection
    'lengthMin' => $lengthMin, //preselection
    'lengthMax' => $lengthMax, //preselection
    'sorting' => $sorting,
    'searchInput' => $searchInput,
    'pageNumber' => $pageNumber,
    'resultsObject' => $resultsObject,
    'resultCount' => $resultCount,
    'viewType' => $viewType,
    'charterFilter' => $charterFilter,

);



?>

<main class="search-page">
    <section class="search-page__intro" id="search-page-intro">
        <?php
        get_template_part('template-parts/content', 'search-intro', $args);
        ?>
    </section>

    <div class="search-filter-bar" id="search-filter-bar">
        <button class="search-filter-bar__button search-button" id="search-filter-bar-button">
            Filters
        </button>
    </div>

    <!-- Content -->
    <section class="search-page__content" id="search-page-content">

        <?php
        get_template_part('template-parts/content', 'search-sidebar', $args); //page args --> initial preselection
        get_template_part('template-parts/content', 'search-results-area', $args); //page args --> initial render
        ?>

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
    <input type="hidden" name="formTravelStyles" id="formTravelStyles" value="<?php echo $travelTypesString ?>">
    <input type="hidden" name="formDestinations" id="formDestinations" value="<?php echo $destinationsString ?>">
    <input type="hidden" name="formExperiences" id="formExperiences" value="<?php echo $experiencesString ?>">
    <input type="hidden" name="formMinLength" id="formMinLength" value="<?php echo $lengthMin ?>">
    <input type="hidden" name="formMaxLength" id="formMaxLength" value="<?php echo $lengthMax ?>">
    <input type="hidden" name="formSort" id="formSort" value="<?php echo $sorting ?>">
    <input type="hidden" name="formPageNumber" id="formPageNumber" value="<?php echo $pageNumber ?>">

    <input type="hidden" name="region" id="region" value="<?php echo $regionId ?>">
    <input type="hidden" name="destination" id="destination" value="<?php echo $destinationId ?>">
    <input type="hidden" name="searchType" id="searchType" value="<?php echo $searchType ?>">
    <input type="hidden" name="initialPage" id="initialPage" value="">

</form>


<?php get_footer(); ?>

