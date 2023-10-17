<?php
// Nav Search
add_action('wp_ajax_navSearch', 'search_filter_nav_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_navSearch', 'search_filter_nav_search');

function search_filter_nav_search()
{
    $formSearchInput = null;
    if (isset($_POST['formSearchInput']) && $_POST['formSearchInput']) {
        $formSearchInput = strtolower($_POST['formSearchInput']);
    }


    $resultsObject = getNavSearchResults($formSearchInput);


    // return result cards -- content-search-listing
    get_template_part('template-parts/nav/search/content', 'nav-search-listing', $resultsObject);


    die();
}
