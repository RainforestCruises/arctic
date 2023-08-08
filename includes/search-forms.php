<?php

//Primary Search
add_action('wp_ajax_primarySearch', 'search_filter_primary_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_primarySearch', 'search_filter_primary_search');

function search_filter_primary_search()
{

    // paging and sorting
    $sorting = $_POST['formSort'];
    $pageNumber = $_POST['formPageNumber'];
    $viewType = $_POST['formViewType'];

    
    $formFilterDeals = false;
    if (isset($_POST['formFilterDeals']) && $_POST['formFilterDeals']) {
        $formFilterDeals = filter_var($_POST['formFilterDeals'], FILTER_VALIDATE_BOOLEAN);
    }
    $formFilterSpecials = false;
    if (isset($_POST['formFilterSpecials']) && $_POST['formFilterSpecials']) {
        $formFilterSpecials = filter_var($_POST['formFilterSpecials'], FILTER_VALIDATE_BOOLEAN);
    }


    //--seach input (top level only)
    $formSearchInput = null;
    if (isset($_POST['formSearchInput']) && $_POST['formSearchInput']) {
        $formSearchInput = $_POST['formSearchInput'];
    }

    //--region
    $formRegion = null;
    if (isset($_POST['formRegion']) && $_POST['formRegion']) {
        $formRegion = $_POST['formRegion'];
    }

    //--routes
    $formRoutes = [];
    if (isset($_POST['formRoutes']) && $_POST['formRoutes']) {
        $stringValue = $_POST['formRoutes'];
        $formRoutes = explode(";", $stringValue);
    }

    //--themes (styles)
    $formThemes = [];
    if (isset($_POST['formThemes']) && $_POST['formThemes']) {
        $stringValue = $_POST['formThemes'];
        $formThemes = explode(";", $stringValue);
    }

    //--dates
    $formDates = [];
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

    //--price
    $formMinPrice = null;
    $formMaxPrice = null;
    if (isset($_POST['formMinPrice']) && $_POST['formMinPrice']) {
        $formMinPrice = $_POST['formMinPrice']; //they will both have value as long as at least one is set
        $formMaxPrice = $_POST['formMaxPrice'];
    }


    $resultsObject = getSearchPosts($formRegion, $formRoutes, $formThemes, $formMinLength, $formMaxLength, $formMinPrice, $formMaxPrice, $formDates, $formSearchInput, $sorting, $pageNumber, $viewType, $formFilterDeals, $formFilterSpecials);


    // return result cards -- content-search-listing
    get_template_part('template-parts/search/content', 'search-listing', $resultsObject);


    die();
}
