<?php
//Upper bounded list of products for search results
function getSearchPosts($region, $routes, $styles, $minLength, $maxLength, $datesArray, $searchInput, $sorting, $pageNumber, $viewType)
{

    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_itineraries',
    );


    // regional selection - generate list of possible routes (IDs)
    $regionalRoutes = [];
    if ($region != null) {
        $routeCriteria = array(
            'posts_per_page' => -1,
            'post_type' => 'rfc_routes',
            "meta_key" => "region",
            "meta_value" => $region
        );
        $regionalRoutes = wp_list_pluck(get_posts($routeCriteria), 'ID');
    } else {
        $routeCriteria = array(
            'posts_per_page' => -1,
            'post_type' => 'rfc_routes',
        );
        $regionalRoutes = wp_list_pluck(get_posts($routeCriteria), 'ID');
    }

    // route selection
    if ($routes != null) {
        $matchedRoutes = array_intersect($routes, $regionalRoutes); // find routes that are within regional selection

        $queryargs = array();
        $queryargs['relation'] = 'OR';
        foreach ($matchedRoutes as $route) {
            $queryargs[] = array(
                'key'     => 'route',
                'value'   => '"' . $route . '"', //value must be in parenthesis to get ACF exact match, and use LIKE
                'compare' => 'LIKE'
            );
        }
        $args['meta_query'][] = $queryargs;
    }


    // style (theme) selection
    if ($styles != null) {
        $queryargs = array();
        $queryargs['relation'] = 'OR';
        foreach ($styles as $style) {
            $queryargs[] = array(
                'key'     => 'styles',
                'value'   => '"' . $style . '"', //value must be in parenthesis to get ACF exact match, and use LIKE
                'compare' => 'LIKE'
            );
        }
        $args['meta_query'][] = $queryargs;
    }



    $itineraries = get_posts($args); // stage I - itinerary posts w/ initial filters
    $formattedPosts =  formatFilterSearch($itineraries, $minLength, $maxLength, $datesArray, $sorting, $searchInput, $viewType); // stage II metadata filtering


    $resultsPerPage = 12;
    if ($viewType == 'search-ship') {
        $resultsPerPage = 8;
    }
    if ($viewType == 'search-departures') {
        $resultsPerPage = 18;
    }

    $resultsTotal = count($formattedPosts);
    $pageCount = floor($resultsTotal / $resultsPerPage);
    if ($resultsTotal % $resultsPerPage != 0) {
        $pageCount++;
    };

    if (is_numeric($pageNumber) && $pageNumber != 'all') {
        $startIndex = (($pageNumber - 1) * $resultsPerPage);
        $formattedPosts = array_slice($formattedPosts, $startIndex, $resultsPerPage);
    } else if ($pageNumber == 'all') {
        $formattedPosts = array_slice($formattedPosts, 0, 50);
    } else {
        $startIndex = 0;
        $formattedPosts = array_slice($formattedPosts, $startIndex, $resultsPerPage);
    }

    //return object with results, result count, and page count seperately
    $searchResults = [
        'results' => $formattedPosts,
        'resultsCount' => $resultsTotal,
        'pageCount' => $pageCount,
        'pageNumber' => $pageNumber,
        'viewType' => $viewType,
    ];



    return $searchResults;
}


//Stage II - metadata
function formatFilterSearch($itineraries, $minLength, $maxLength, $datesArray, $sorting, $searchInput, $viewType)
{
    $results = [];
    $itineraryObjects = [];
    foreach ($itineraries as $itinerary) { // loop through itineraries

        $lengthInNights = get_field('length_in_nights', $itinerary); // filter min/max length
        if ($lengthInNights < $minLength || $lengthInNights > $maxLength) {
            continue;
        }

        $departuresFullList = getDepartureList($itinerary); // filter dates
        $departures = [];
        if ($datesArray) {
            foreach ($departuresFullList as $departure) {
                $matchedDates = in_array($departure['DepartureDateSimple'], $datesArray); // match dates create new list
                if ($matchedDates) {
                    $departures[] = $departure;
                }
            }
        } else {
            $departures = $departuresFullList; // use full list
        }
        if (count($departures) == 0) {
            continue;
        }

        if ($viewType == 'search-ships') { // ship search
            $itineraryObjects[] = (object) array(
                'departures' => $departures,
                'itinerary' => $itinerary,
            );
            continue;
        }


        // generic result object fields
        $regions = getItineraryRegions($itinerary);
        $itineraryImages = get_field('hero_gallery', $itinerary);
        $itineraryHeroImage = ($itineraryImages) ? $itineraryImages[0] : null;
        $destinations = getItineraryDestinations($itinerary); //build list of unique destinations within an itinerary, with embarkations removed
        $destinationDisplay = getItineraryDestinations($itinerary, true, 4); //build list of unique destinations within an itinerary, with embarkations removed
        $searchRank = get_field('search_rank', $itinerary);
        $embarkation_point = get_field('embarkation_point', $itinerary);
        $disembarkation_point = get_field('disembarkation_point', $itinerary);
        $displayName = get_field('display_name', $itinerary);
        $flightOption = getFlightOption($itinerary);
        $topSnippet = get_field('top_snippet', $itinerary);
        $lengthDisplay = $lengthInNights + 1 . ' Day / ' . $lengthInNights . ' Night';

        // departure specific fields
        if ($viewType == 'search-departures') {
            foreach ($departures as $departure) {
                $ship = $departure['Ship'];
                $shipDisplayName = get_the_title($ship);
                $shipImages = get_field('hero_gallery', $ship);
                $shipHeroImage = ($shipImages) ? $shipImages[0] : null;
                $lowestPrice = $departure['LowestPrice'];
                $highestPrice = $departure['HighestPrice'];
                $bestDiscount = $departure['BestDiscount'];
                $deals = getDealsFromSingleDeparture($departures);
                $specialDepartures = getDealsFromSingleDeparture($departures, true);
                $departureDate = $departure['DepartureDate'];
                $returnDate = $departure['ReturnDate'];

                $results[] = (object) array(
                    'type' => 'departure',
                    'itinerary' => $itinerary,
                    'resourceLink' => get_permalink($itinerary),
                    'displayName' => $displayName,
                    'flightOption' => $flightOption,
                    'lengthInNights' => $lengthInNights,
                    'lengthDisplay' => $lengthDisplay,
                    'lowestPrice' => $lowestPrice,
                    'highestPrice' => $highestPrice,
                    'bestDiscount' => $bestDiscount,
                    'deals' => $deals,
                    'specialDepartures' => $specialDepartures,
                    'embarkation' => $embarkation_point,
                    'embarkationDisplay' => get_the_title($embarkation_point),
                    'disembarkation' => $disembarkation_point,
                    'disembarkationDisplay' => get_the_title($disembarkation_point),
                    'hasDifferentPorts' =>  $disembarkation_point != null && ($disembarkation_point != $embarkation_point),
                    'departureDate' => $departureDate,
                    'returnDate' => $returnDate,
                    'destinations' => $destinations,
                    'destinationDisplay' => $destinationDisplay,
                    'itineraryHeroImage' => $itineraryHeroImage,
                    'shipHeroImage' => $shipHeroImage,
                    'shipDisplayName' => $shipDisplayName,
                    'ship' => $ship,
                    'regions' => $regions,
                    'searchRank' => $searchRank
                );
            }
        }

        // itinerary specific fields
        if ($viewType == 'search-itineraries') {
            $ships = getShipsFromDepartureList($departures);
            $shipsDisplay = getShipsFromDepartureList($departures, true);
            $lowestPrice = getLowestDepartureListPrice($departures);
            $highestPrice = getHighestDepartureListPrice($departures);
            $bestDiscount = getBestDepartureListDiscount($departures);
            $deals = getDealsFromDepartureList($departures);
            $specialDepartures = getDealsFromDepartureList($departures, true);
            $datesDisplay = getDateListDisplay($departures, 3);

            $results[] = (object) array(
                'type' => 'itinerary',
                'itinerary' => $itinerary,
                'resourceLink' => get_permalink($itinerary),
                'displayName' => $displayName,
                'flightOption' => $flightOption,
                'lengthInNights' => $lengthInNights,
                'lengthDisplay' => $lengthDisplay,
                'topSnippet' => $topSnippet,
                'lowestPrice' => $lowestPrice,
                'highestPrice' => $highestPrice,
                'bestDiscount' => $bestDiscount,
                'deals' => $deals,
                'specialDepartures' => $specialDepartures,
                'ships' => $ships,
                'shipsDisplay' => $shipsDisplay,
                'embarkation' => $embarkation_point,
                'embarkationDisplay' => get_the_title($embarkation_point),
                'disembarkation' => $disembarkation_point,
                'disembarkationDisplay' => get_the_title($disembarkation_point),
                'hasDifferentPorts' =>  $disembarkation_point != null && ($disembarkation_point != $embarkation_point),
                'departures' => $departures,
                'datesDisplay' => $datesDisplay,
                'destinations' => $destinations,
                'destinationDisplay' => $destinationDisplay,
                'itineraryHeroImage' => $itineraryHeroImage,
                'regions' => $regions,
                'searchRank' => $searchRank
            );
        }
    }


    // ship search
    if ($viewType == 'search-ships') {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'rfc_cruises',
        );
        $ships = get_posts($args); // full list of ships

        foreach ($ships as $ship) {

            $itineraryResults = [];
            foreach ($itineraryObjects as $object) { // loop all the objects (itineraries)

                $itinerary = $object->itinerary;
                $departures = $object->departures;

                $departureMatches = [];
                foreach ($departures as $departure) { // loop all departures of this itinerary     

                    if ($departure['Ship'] == $ship) {
                        $departureMatches[] = $departure;
                    }
                }

                if (count($departureMatches) > 0) {
                    $itineraryResults[] = (object) array(
                        'itinerary' => $itinerary,
                        'departures' => $departureMatches,
                    );
                }
            }

            if (count($itineraryResults) > 0) {

                $shipImages = get_field('hero_gallery', $ship);
                $shipHeroImage = ($shipImages) ? $shipImages[0] : null;

                $service_level =  get_field('service_level', $ship);
                $serviceLevelDisplay = ($service_level) ? get_the_title($service_level) : "N/A";
                $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests, ' . $serviceLevelDisplay;

                $departuresList = [];
                $itinerariesList = [];
                $lowPriceList = [];
                $highPriceList = [];
                $dealsList = [];
                $specialDeparturesList = [];
                //$bestDiscountList = [];

                foreach($itineraryResults as $itineraryResult){
                    $itinerariesList[] = $itineraryResult->itinerary;

                    foreach($itineraryResult->departures as $departure){
                        $lowPriceList[] = $departure['LowestPrice'];
                        $highPriceList[] = $departure['HighestPrice'];
                        $departuresList[] = $departure;

                        foreach($departure['Deals'] as $deal){
                            $dealsList[] = $deal;
                        }
                        foreach($departure['SpecialDepartures'] as $specialDeparture){
                            $specialDeparturesList[] = $specialDeparture;
                        }

                    }
                }
                usort($departuresList, "sortDates2"); //sort by search rank score

                $itineraryDisplay = itineraryRange($itinerariesList, "-") . " Days, " . count($itinerariesList);
                $itineraryDisplay .= count($itinerariesList) == 1 ? ' Itinerary' : ' Itineraries';
                $datesDisplay = getDateListDisplay($departuresList, 3);


                $results[] = (object) array(
                    'type' => 'ship',
                    'itineraries' => $itineraryResults,
                    'ship' => $ship,
                    'resourceLink' => get_permalink($ship),
                    'displayName' => get_the_title($ship),
                    'shipHeroImage' => $shipHeroImage,
                    'lowestPrice' => min($lowPriceList),
                    'highestPrice' => max($highPriceList),
                    'guestsDisplay' => $guestsDisplay,
                    'itineraryDisplay' => $itineraryDisplay,

                    // 'bestDiscount' => $bestDiscount,
                    'deals' => $deals,
                    'specialDepartures' => $specialDepartures,
                    'datesDisplay' => $datesDisplay,

                );
            }


        }

    }




    if ($viewType == 'search-departures') {
        usort($results, "sortDates"); //sort by search rank score
        return $results;
    }

    if ($sorting == 'popularity') {
        usort($results, "sortRank"); //sort by search rank score
    }

    if ($sorting == 'high') {
        usort($results, "sortPriceHigh");
    }

    if ($sorting == 'low') {
        usort($results, "sortPriceLow");
    }

    return $results;
}



// SORTING -----------------------
// ranking
function sortRank($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->searchRank - $a->searchRank;
    }
}

// price high
function sortPriceHigh($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->lowestPrice - $a->lowestPrice;
    }
}

// price low
function sortPriceLow($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $a->lowestPrice - $b->lowestPrice;
    }
}

// dates
function sortDates($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strtotime($a->departureDate) - strtotime($b->departureDate);
    }
}

// dates (but with capital field name)
function sortDates2($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strtotime($a->DepartureDate) - strtotime($b->DepartureDate);
    }
}