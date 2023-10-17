<?php

function getNavSearchResults($formSearchInput, $initial = false)
{
    $resultCategories = [];


    // serp pages ---------------------------------------------------------
    $resultCount = $initial ? 4 : 3;
    $categoryName = $initial ? 'Trending Searches' : 'Search Results';
    $queryArgs = array(
        'post_type' => 'page',
        'posts_per_page' => $resultCount,
        'meta_key' => 'search_rank',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_wp_page_template',
                'value' => 'template-search.php',
            ),
            array(
                'key' => 'title_text',
                'value' => $formSearchInput,
                'compare' => 'LIKE',
            ),
        ),
    );

    $pages = get_posts($queryArgs);
    $pageResults = [];
    foreach ($pages as $page) {
        $title = get_field('title_text', $page);
        $result = [
            'Title' => $title,
            'Image' => null,
            'Subtitle' => null,
            'Url' => get_permalink($page),
        ];
        $pageResults[] = $result;
    }

    $resultCategory = [
        'CategoryName' => $categoryName,
        'Items' => $pageResults,
        'Count' => count($pageResults)
    ];
    $resultCategories[] = $resultCategory;

    // ships ---------------------------------------------------------
    $resultCount = 3;
    $categoryName = $initial ? 'Trending Ships' : 'Cruise Ships';
    $queryArgs = array(
        'post_type' => 'rfc_cruises',
        'posts_per_page' => $resultCount,
        'meta_key' => 'search_rank',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        's' => $formSearchInput,

    );
    $ships = get_posts($queryArgs);
    $shipResults = [];
    foreach ($ships as $ship) {
        $title = get_the_title($ship);
        $hero_gallery = get_field('hero_gallery', $ship);
        $service_level = get_field('service_level', $ship);
        $serviceDisplay = ($service_level) ? get_the_title($service_level) : "Luxury";
        $vessel_capacity = get_field('vessel_capacity', $ship);
        $subtitle = $serviceDisplay . ", " . $vessel_capacity . " Guests";
        $image = $hero_gallery[0];

        $result = [
            'Title' => $title,
            'Image' => $image,
            'Subtitle' => $subtitle,
            'Url' => get_permalink($ship),
        ];
        $shipResults[] = $result;
    }

    $resultCategory = [
        'CategoryName' => $categoryName,
        'Items' => $shipResults,
        'Count' => count($shipResults)
    ];
    $resultCategories[] = $resultCategory;


    // itineraries ---------------------------------------------------------
    $resultCount = 3;
    $categoryName = $initial ? 'Trending Itineraries' : 'Cruise Itineraries';
    $queryArgs = array(
        'post_type' => 'rfc_itineraries',
        'posts_per_page' => $resultCount,
        'meta_key' => 'search_rank',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'display_name', // Name of the text field
                'value' => $formSearchInput, // Search input
                'compare' => 'LIKE',
            ),
        ),

    );
    $itineraries = get_posts($queryArgs);
    $itineraryResults = [];
    foreach ($itineraries as $itinerary) {
        $title = get_field('display_name', $itinerary);
        $hero_gallery = get_field('hero_gallery', $itinerary);
        $image = $hero_gallery[0];
        $length_in_nights = get_field('length_in_nights', $itinerary);
        $subtitle = ($length_in_nights + 1) . '-Day Itinerary';
        $result = [
            'Title' => $title,
            'Image' => $image,
            'Subtitle' => $subtitle,
            'Url' => get_permalink($itinerary),
        ];
        $itineraryResults[] = $result;
    }

    $resultCategory = [
        'CategoryName' => $categoryName,
        'Items' => $itineraryResults,
        'Count' => count($itineraryResults)
    ];
    $resultCategories[] = $resultCategory;



    //return object with results, result count, and page count seperately
    $resultsObject = [
        'resultCategories' => $resultCategories,
    ];

    return $resultsObject;
}
