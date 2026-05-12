<?php
// list of products for search results
function getSearchPosts($region, $routes, $countries, $styles, $filterShipSizes, $minLength, $maxLength, $minPrice, $maxPrice, $datesArray, $searchInput, $sorting, $pageNumber, $viewType, $filterDeals, $filterSpecials)
{

    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_itineraries',
        'meta_query' => []
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

        if ($routes == null) { // if region is selected, but no routes. Populate all routes
            $routeCriteria = array(
                'posts_per_page' => -1,
                'post_type' => 'rfc_routes',
            );
            $routes = wp_list_pluck(get_posts($routeCriteria), 'ID');
        }
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
                'value'   => '"' . $route . '"', // value must be in parenthesis to get ACF exact match, and use LIKE
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
    $resultObjects =  filterAndBuildMetaObject($itineraries, $countries, $minLength, $maxLength, $minPrice, $maxPrice, $datesArray, $sorting, $searchInput, $viewType, $filterDeals, $filterSpecials, $filterShipSizes, $region); // stage II metadata filtering



    $resultsPerPage = 12;
    if ($viewType == 'search-ship') {
        $resultsPerPage = 8;
    }
    if ($viewType == 'search-departures') {
        $resultsPerPage = 18;
    }

    $resultsTotal = count($resultObjects);
    $pageCount = floor($resultsTotal / $resultsPerPage);
    if ($resultsTotal % $resultsPerPage != 0) {
        $pageCount++;
    };

    if (is_numeric($pageNumber) && $pageNumber != 'all') {
        $startIndex = (($pageNumber - 1) * $resultsPerPage);
        $resultObjects = array_slice($resultObjects, $startIndex, $resultsPerPage);
    } else if ($pageNumber == 'all') {
        $resultObjects = array_slice($resultObjects, 0, 50);
    } else {
        $startIndex = 0;
        $resultObjects = array_slice($resultObjects, $startIndex, $resultsPerPage);
    }

    //return object with results, result count, and page count seperately
    $searchResults = [
        'results' => $resultObjects,
        'resultsCount' => $resultsTotal,
        'pageCount' => $pageCount,
        'pageNumber' => $pageNumber,
        'viewType' => $viewType,
        'preselectedRegion' => $region
    ];
    return $searchResults;
}


// stage II - metadata
function filterAndBuildMetaObject($itineraries, $countries, $minLength, $maxLength, $minPrice, $maxPrice, $datesArray, $sorting, $searchInput, $viewType, $filterDeals, $filterSpecials, $filterShipSizes, $region)
{
    $results = [];
    $itineraryObjects = []; // prelimenary list for ship search


    foreach ($itineraries as $itinerary) { // loop through itineraries    
        // length filter
        $uniqueLengths = getItineraryLengths($itinerary); // Check if any length in the array is within the filter range
        $hasValidLength = false;
        foreach ($uniqueLengths as $length) {
            if ($length >= $minLength && $length <= $maxLength) {
                $hasValidLength = true;
                break; // Found a valid length, no need to check more
            }
        }
        if (!$hasValidLength) {
            continue; // Skip this itinerary if no valid lengths found
        }

        // embarkation filter
        $embarkation_point = get_field('embarkation_point', $itinerary); // filter embarkation countries
        $disembarkation_point = get_field('disembarkation_point', $itinerary);
        $embarkation_country = get_field('embarkation_country', $embarkation_point);
        $embarkationMatch = false;
        if ($countries == null) {
            $embarkationMatch = true;
        } else {
            if (!$embarkation_country || !$disembarkation_point || !$embarkation_country) { // if any null value is found, skip this itinerary
                continue;
            }
            foreach ($countries as $country) {
                if ($country == $embarkation_country->ID) {
                    $embarkationMatch = true;
                }
            }
        }
        if ($embarkationMatch == false) {
            continue;
        }


        // FILTER DEPARTURES
        $precalculated_departures = get_field('precalculated_departures', $itinerary);
        $departuresFullList = $precalculated_departures ? $precalculated_departures : getDepartureListItinerary($itinerary);


        // filter dates - if no dates in filter, use full list
        $departuresFiltered = [];
        if ($datesArray) {
            foreach ($departuresFullList as $departure) {
                $matchedDates = in_array($departure['departureDateSimple'], $datesArray); // match dates create new list
                if ($matchedDates) {
                    $departuresFiltered[] = $departure;
                }
            }
        } else {
            $departuresFiltered = $departuresFullList; // use full list
        }
        if (empty($departuresFiltered)) {
            continue;
        }

        if ($viewType == 'search-ships') { // bounce out to ship search
            $itineraryObjects[] = (object) array(
                'departuresFiltered' => $departuresFiltered,
                'itinerary' => $itinerary,
            );
            continue;
        }


        // generic result object fields
        $itineraryImages = get_field('hero_gallery', $itinerary);
        $itineraryHeroImage = ($itineraryImages) ? $itineraryImages[0] : null;
        $searchRank = get_field('search_rank', $itinerary);
        $displayName = get_field('display_name', $itinerary);
        $flightOption = getFlightOption(get_field('fly_category', $itinerary));
        $lengthDisplay = formatLengthDisplay($uniqueLengths);

        // itinerary specific fields
        if ($viewType == 'search-itineraries') {

            // price filter
            $lowestPrice = getLowestDepartureListPrice($departuresFiltered);
            $highestPrice = getHighestDepartureListPrice($departuresFiltered);
            if ($highestPrice < $minPrice || $lowestPrice > $maxPrice) {
                continue;
            }

            // deals and specials filter
            $deals = getDealsFromDepartureList($departuresFiltered);
            $specialDepartures = getDealsFromDepartureList($departuresFiltered, true);
            $bestDiscount = getBestDepartureListDiscount($departuresFiltered);
            if ($filterDeals && $filterSpecials) { // deals and specials filter
                if (!$bestDiscount && !$deals && !$specialDepartures) {
                    continue;
                }
            } else if ($filterDeals) {
                if (!$bestDiscount && !$deals) { // deals filter
                    continue;
                }
            } else if ($filterSpecials) {
                if (!$specialDepartures) { // specials filter
                    continue;
                }
            }

            // ships
            $ships = getShipsFromDepartureList($departuresFiltered);
            $shipsDisplay = getShipsDisplay($ships);
            if ($filterShipSizes) { // ship size filter
                $shipMatches = false;
                $filteredShipList = [];
                foreach ($ships as $ship) {
                    if (doesShipMatchSizeFilter($ship, $filterShipSizes)) {
                        $shipMatches = true;
                        $filteredShipList[] = $ship;
                        break;
                    }
                }
                $ships = $filteredShipList;
                if (!$shipMatches) {
                    continue;
                }
            }

            $datesDisplay = getDateListDisplay($departuresFiltered, 3);

            // itinerary fields
            $results[] = (object) array(
                'Type' => 'itinerary',
                'Itinerary' => $itinerary,
                'ResourceLink' => get_permalink($itinerary),
                'DisplayName' => $displayName,
                'FlightOption' => $flightOption,
                'LengthDisplay' => $lengthDisplay,
                'LowestPrice' => $lowestPrice,
                'HighestPrice' => $highestPrice,
                'BestDiscount' => $bestDiscount,
                'Deals' => $deals,
                'SpecialDepartures' => $specialDepartures,
                'Ships' => $ships,
                'ShipsDisplay' => $shipsDisplay,
                'Embarkation' => $embarkation_point,
                'EmbarkationDisplay' => get_the_title($embarkation_point),
                'EmbarkationCountry' => $embarkation_country,
                'Disembarkation' => $disembarkation_point,
                'DisembarkationDisplay' => get_the_title($disembarkation_point),
                'HasDifferentPorts' =>  $disembarkation_point != null && ($disembarkation_point != $embarkation_point),
                'Departures' => $departuresFiltered,
                'DatesDisplay' => $datesDisplay,
                'ItineraryHeroImage' => $itineraryHeroImage,
                'SearchRank' => $searchRank
            );
        }

        // departure specific fields
        if ($viewType == 'search-departures') {
            foreach ($departuresFiltered as $departure) {

                // prices
                $lowestPrice = $departure['lowestPrice'];
                $highestPrice = $departure['highestPrice'];
                if ($highestPrice < $minPrice || $lowestPrice > $maxPrice) { // price filter
                    continue;
                }

                // deals
                $deals = $departure['deals'];
                $specialDepartures = $departure['specialDepartures'];
                $bestDiscount = $departure['bestDiscount'];
                if ($filterDeals && $filterSpecials) { // deals and specials filter
                    if (!$bestDiscount && !$deals && !$specialDepartures) {
                        continue;
                    }
                } else if ($filterDeals) {
                    if (!$bestDiscount && !$deals) { // deals filter
                        continue;
                    }
                } else if ($filterSpecials) {
                    if (!$specialDepartures) { // specials filter
                        continue;
                    }
                }

                // ship
                $ship = $departure['ship'];
                if ($filterShipSizes) { // ship size filter
                    if (!doesShipMatchSizeFilter($ship, $filterShipSizes)) {
                        continue;
                    }
                }

                $shipDisplayName = get_the_title($ship);
                $shipImages = get_field('hero_gallery', $ship);
                $shipHeroImage = ($shipImages) ? $shipImages[0] : null;
                $departureDate = $departure['departureDate'];
                $returnDate = $departure['returnDate'];
                $lengthDisplay = $departure['lengthInDays'] . ' Days';
                if ($departure['variantTitle'] != null) {
                    $lengthDisplay .= " (" . $departure['variantTitle'] . ")";
                }

                $results[] = (object) array(
                    'Type' => 'departure',
                    'Itinerary' => $itinerary,
                    'ResourceLink' => get_permalink($itinerary),
                    'DisplayName' => $displayName,
                    'FlightOption' => $flightOption,
                    'LengthDisplay' => $lengthDisplay,
                    'LowestPrice' => $lowestPrice,
                    'HighestPrice' => $highestPrice,
                    'BestDiscount' => $bestDiscount,
                    'Deals' => $deals,
                    'SpecialDepartures' => $specialDepartures,
                    'Embarkation' => $embarkation_point,
                    'EmbarkationDisplay' => get_the_title($embarkation_point),
                    'EmbarkationCountry' => $embarkation_country,
                    'Disembarkation' => $disembarkation_point,
                    'DisembarkationDisplay' => get_the_title($disembarkation_point),
                    'HasDifferentPorts' =>  $disembarkation_point != null && ($disembarkation_point != $embarkation_point),
                    'DepartureDate' => $departureDate,
                    'ReturnDate' => $returnDate,
                    'ItineraryHeroImage' => $itineraryHeroImage,
                    'ShipHeroImage' => $shipHeroImage,
                    'ShipDisplayName' => $shipDisplayName,
                    'Ship' => $ship,
                    'SearchRank' => $searchRank
                );
            }
        }
    }


    // ship search
    if ($viewType == 'search-ships') {

        $args = [
            'posts_per_page' => -1,
            'post_type'      => 'rfc_cruises',
        ];
        if ($filterShipSizes) {
            $args['meta_query'] = constructCapacityQuery($filterShipSizes);
        }
        $ships = get_posts($args);

        // regional appendix for ship links - only append region if it's selected and not the primary region
        $primaryRegion = getPrimaryRegion();
        $primaryRegionId = $primaryRegion ? $primaryRegion->ID : null;
        $regionAppendix = (!$region == null && $region != $primaryRegionId) ? "?region=" . $region : "";

        foreach ($ships as $ship) {
            $departuresList = []; // combines all departures from all itineraries that match the ship, used for filtering and display
            $itinerariesList = [];
            $lowPriceList = [];
            $highPriceList = [];
            $bestDiscountList = [];
            $dealsList = [];
            $specialDeparturesList = [];

            foreach ($itineraryObjects as $object) { // itineraries already filtered by other criteria, now just need to find matching ships and apply deal/special filters
                $departureMatches = [];
                foreach ($object->departuresFiltered as $departure) {
                    if ($departure['ship'] != $ship) continue; // filter for departures matching the ship
                    $departureMatches[] = $departure;
                    if ($departure['lowestPrice'] > 0) {
                        $lowPriceList[] = $departure['lowestPrice'];
                    }
                    if ($departure['highestPrice']) {
                        $highPriceList[] = $departure['highestPrice'];
                    }
                    $bestDiscountList[] = $departure['bestDiscount'];

                    foreach ($departure['deals'] as $deal) {
                        if (!in_array($deal, $dealsList)) $dealsList[] = $deal;
                    }
                    foreach ($departure['specialDepartures'] as $sd) {
                        if (!in_array($sd, $specialDeparturesList)) $specialDeparturesList[] = $sd;
                    }
                }

                if (!empty($departureMatches)) {
                    $itinerariesList[] = $object->itinerary;
                    array_push($departuresList, ...$departureMatches);
                }
            }

            if (empty($itinerariesList)) continue;

            // price filter
            $lowestPrice = !empty($lowPriceList) ? min($lowPriceList) : 0;
            $highestPrice = !empty($highPriceList) ? max($highPriceList) : 0;
            if ($highestPrice < $minPrice || $lowestPrice > $maxPrice) continue;

            // deals and specials filter
            $bestDiscount = !empty($bestDiscountList) ? max($bestDiscountList) : 0;
            if ($filterDeals && $filterSpecials) {
                if (!$bestDiscount && !$dealsList && !$specialDeparturesList) continue;
            } else if ($filterDeals) {
                if (!$bestDiscount && !$dealsList) continue;
            } else if ($filterSpecials) {
                if (!$specialDeparturesList) continue;
            }

            usort($departuresList, "sortDates");

            $shipImages = get_field('hero_gallery', $ship);
            $shipHeroImage = ($shipImages) ? $shipImages[0] : null;
            $searchRank = get_field('search_rank', $ship);
            $service_level = get_field('service_level', $ship);
            $serviceLevelDisplay = ($service_level) ? get_the_title($service_level) : "N/A";
            $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests, ' . $serviceLevelDisplay;
            $itineraryLengths = getItineraryLengths($itinerariesList);
            $itineraryDisplay = formatLengthDisplay($itineraryLengths, true) . " , " . count($itinerariesList) . (count($itinerariesList) == 1 ? ' Itinerary' : ' Itineraries');
            $datesDisplay = getDateListDisplay($departuresList, 3);


            $results[] = (object) [
                'Type'             => 'ship',
                'Ship'             => $ship,
                'ResourceLink'     => get_permalink($ship) . $regionAppendix,
                'DisplayName'      => get_the_title($ship),
                'ShipHeroImage'    => $shipHeroImage,
                'LowestPrice'      => $lowestPrice,
                'HighestPrice'     => $highestPrice,
                'GuestsDisplay'    => $guestsDisplay,
                'ItineraryDisplay' => $itineraryDisplay,
                'BestDiscount'     => $bestDiscount,
                'Deals'            => $dealsList,
                'SpecialDepartures' => $specialDeparturesList,
                'DatesDisplay'     => $datesDisplay,
                'SearchRank'       => $searchRank,
            ];
        }
    }


    // search input field
    $searchMatches = [];
    if ($searchInput != null) {
        foreach ($results as $result) {
            $matchString = $result->DisplayName;
            if ($result->Type == 'departure') { //
                $matchString .= " " . $result->ShipDisplayName;
            }
            if ($result->Type == 'itinerary') { //
                $matchString .= " " . $result->ShipsDisplay;
            }

            if (preg_match("/{$searchInput}/i", $matchString)) {
                $searchMatches[] = $result;
            }
        }
        $results = $searchMatches;
    }


    if ($viewType == 'search-departures') {
        usort($results, "sortDates");
        return $results;
    }

    if ($sorting == 'popularity') {
        usort($results, "sortRank"); // sort by search rank score
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
function sortRank($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->SearchRank <=> $a->SearchRank;
    }
    return 0;
}

function sortPriceHigh($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->LowestPrice <=> $a->LowestPrice;
    }
    return 0;
}

function sortPriceLow($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $a->LowestPrice <=> $b->LowestPrice;
    }
    return 0;
}

function sortDates($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strtotime($a->DepartureDate) <=> strtotime($b->DepartureDate);
    }
    return 0;
}

function constructCapacityQuery($selectedSizes)
{
    $conditions = array('relation' => 'OR');
    foreach ($selectedSizes as $sizeId) {
        switch (intval($sizeId)) {
            case 1: // Small
                $conditions[] = array(
                    'key' => 'vessel_capacity',
                    'value' => array(0, 120),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                );
                break;

            case 2: // Medium
                $conditions[] = array(
                    'key' => 'vessel_capacity',
                    'value' => array(120, 200),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                );
                break;

            case 3: // Large
                $conditions[] = array(
                    'key' => 'vessel_capacity',
                    'value' => 200,
                    'type' => 'NUMERIC',
                    'compare' => '>'
                );
                break;
        }
    }
    return $conditions;
}

// check ship capacity
function doesShipMatchSizeFilter($ship, $filterShipSizes)
{
    $capacity = $ship ? intval(get_field('vessel_capacity', $ship->ID)) : 0;
    foreach ($filterShipSizes as $sizeId) {
        switch (intval($sizeId)) {
            case 1: // Small
                if ($capacity >= 0 && $capacity < 120) {
                    return true;
                }
                break;

            case 2: // Medium
                if ($capacity >= 120 && $capacity <= 200) {
                    return true;
                }
                break;

            case 3: // Large
                if ($capacity > 200) {
                    return true;
                }
                break;
        }
    }

    return false;
}
