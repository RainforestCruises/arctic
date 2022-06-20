<?php


//Product Date Search
add_action('wp_ajax_productsearch', 'search_filter_product_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_productsearch', 'search_filter_product_search');

function search_filter_product_search()
{
    //Set up 
    //Start / End dates
    //Pass Along Post Id (WP ID of Product)

    $productId = $_POST['productId'];
    $selectedItinerary = $_POST['form-itinerary'];
    $selectedMonth = $_POST['form-month'];
    $selectedYear = $_POST['form-year'];


    $args = array(
        'selectedItinerary' => $selectedItinerary,
        'selectedMonth' => $selectedMonth,
        'selectedYear' => $selectedYear,
        'productId' => $productId,
    );

    get_template_part('template-parts/content', 'product-dates-grid', $args);

    die();
}



//HOME SEARCH
add_action('wp_ajax_homeSearch', 'search_filter_home_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_homeSearch', 'search_filter_home_search');

function search_filter_home_search()
{

    //DESTINATION / REGION - Post ID
    $destinationId = 0;
    if (isset($_POST['formDestination']) && $_POST['formDestination']) {
        $destinationId = $_POST['formDestination'];
    }

    //DATE
    $travelDate = null;
    if (isset($_POST['formDates']) && $_POST['formDates']) {
        $travelDate = $_POST['formDates'];

        
    }

    $pageLink = null;

    if($destinationId == 'anywhere'){
        $pageLink = get_field('top_level_search_page', 'option');
    }else {
        $destinationPost = get_post($destinationId);
        $pageLink = get_field('default_search_link', $destinationPost);
    }

    

    if ($pageLink != null) {

        if ($travelDate != null) {
            wp_redirect($pageLink . "?departures=" . $travelDate);
        } else {
            wp_redirect($pageLink);
        }
        
    } else {
        wp_redirect(home_url());
    }




    die();
}



//Primary Search
add_action('wp_ajax_primarySearch', 'search_filter_primary_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_primarySearch', 'search_filter_primary_search');

function search_filter_primary_search()
{
    //Sidebar Form Searches

    $searchType = $_POST['searchType'];
    $destinationId = $_POST['destination'];
    $regionId = $_POST['region'];


    //Paging
    //Sorting
    $sorting = $_POST['formSort'];
    $pageNumber = $_POST['formPageNumber'];
    $viewType = $_POST['formViewType'];


    //--seach input (top level only)
    $formSearchInput = null;
    if (isset($_POST['formSearchInput']) && $_POST['formSearchInput']) {
        $formSearchInput = $_POST['formSearchInput'];
    }

    //--travel style
    $formTravelStyles = array('rfc_cruises', 'rfc_tours', 'rfc_lodges');
    if (isset($_POST['formTravelStyles']) && $_POST['formTravelStyles']) {
        $stringValue = $_POST['formTravelStyles'];
        $formTravelStyles = explode(";", $stringValue);
    }

    //--destinations
    $formDestinations = [];
    if (isset($_POST['formDestinations']) && $_POST['formDestinations']) {
        $stringValue = $_POST['formDestinations'];
        $formDestinations = explode(";", $stringValue);
    }

    //--experiences
    $formExperiences = [];
    if (isset($_POST['formExperiences']) && $_POST['formExperiences']) {
        $stringValue = $_POST['formExperiences'];
        $formExperiences = explode(";", $stringValue);
    }

    //--dates
    $formDates = null;
    if (isset($_POST['formDates']) && $_POST['formDates']) {
        $stringValue = $_POST['formDates'];
        $formDates = explode(";", $stringValue);
    }



    //--length
    $formMinLength = null;
    $formMaxLength = null;
    if (isset($_POST['formMinLength']) && $_POST['formMinLength']) {
        $formMinLength = $_POST['formMinLength']; //they will both have value as long as at least one is set
        $formMaxLength = $_POST['formMaxLength'];
    }




    $posts = getSearchPosts($formTravelStyles, $formDestinations, $formExperiences, $searchType, $destinationId, $regionId, $formMinLength, $formMaxLength, $formDates, $formSearchInput, $sorting, $pageNumber, $viewType);




    //Return result cards -- content-search-results-content
    get_template_part('template-parts/content', 'search-results-content', $posts);


    die();
}
