<?php

// DEPARTURES ----------------------------------------------------------------------------------------------
// get a list of departures
function getDepartureList($post, $specificShip = null, $filterSoldOut = false, $region = null)
{
    $departures = [];
    if (get_post_type($post) == 'rfc_cruises') {
        $itineraryPosts = getShipItineraries($post, $region);


        foreach ($itineraryPosts as $i) { // each itinerary
            $itineraryLength = get_field('length_in_nights', $i);

            // get itinerary departures
            $use_automation = get_field('use_automation', $i);
            $itineraryDepartures = $use_automation ? get_field('automation_departure_data', $i) : get_field('departures', $i);

            
            foreach ($itineraryDepartures as $d) {   // each departure   
                $isCurrent = strtotime($d['date']) >= strtotime(date('Y-m-d'));

                if ($isCurrent) {
                    $id = $i->ID . "-" . getRandomHex();
                    $returnDate = date('Y-m-d', strtotime($d['date'] . ' + ' . $itineraryLength . ' days'));
                    $cabin_prices = $d['cabin_prices'];
                    $ship = $d['ship'];
                    if ($cabin_prices) { // sort cabin price high to low
                        usort($cabin_prices, function ($first, $second) {
                            return strtolower($first['price']) < strtolower($second['price']);
                        });
                    }

                    if ($ship == $post) {

                        $filteredDeals = getDealsFromSingleDeparture($d);
                        $filteredSpecialDepartures = getDealsFromSingleDeparture($d, true);

                        $departure = [
                            'ID' => $id,
                            'DepartureDate' => $d['date'],
                            'DepartureDateSimple' => date('Y-m', strtotime($d['date'])),
                            'ReturnDate' => $returnDate,
                            'Cabins' => $cabin_prices,
                            'ShipId' => $ship->ID,
                            'Ship' => $ship,
                            'ItineraryPostId' => $i->ID,
                            'ItineraryPost' => $i,
                            'LowestPrice' => getLowestDeparturePrice($d),
                            'HighestPrice' => getHighestDeparturePrice($d),
                            'BestDiscount' => $filteredDeals != null ? getBestDepartureDiscount($d) : 0,
                            'LengthInNights' => $itineraryLength,
                            'Deals' => $filteredDeals,
                            'SpecialDepartures' => $filteredSpecialDepartures,
                        ];
                      

                        if ($filterSoldOut) {
                            if ($departure['LowestPrice'] > 0) {
                                $departures[] = $departure;
                            }
                        } else {
                            $departures[] = $departure;
                        }
                    }
                }
            }
        }
    } else if (get_post_type($post) == 'rfc_itineraries') {
        $itineraryLength = get_field('length_in_nights', $post);

        // get itinerary departures
        $use_automation = get_field('use_automation', $post);
        $itineraryDepartures = $use_automation ? get_field('automation_departure_data', $post) : get_field('departures', $post);


        foreach ($itineraryDepartures as $d) {   // each departure   
            $isCurrent = strtotime($d['date']) >= strtotime(date('Y-m-d'));
            if ($isCurrent) {
                $id = $post->ID . "-" . getRandomHex();
                $returnDate = date('Y-m-d', strtotime($d['date'] . ' + ' . $itineraryLength . ' days'));
                $cabin_prices = $d['cabin_prices'];
                $ship = $d['ship'];

                if ($cabin_prices) { // sort cabin price high to low
                    usort($cabin_prices, function ($first, $second) {
                        return strtolower($first['price']) < strtolower($second['price']);
                    });
                }

                $match = true;
                if ($specificShip && ($specificShip != $ship)) {
                    $match = false;
                }
                if ($match) {
                    $filteredDeals = getDealsFromSingleDeparture($d);
                    $filteredSpecialDepartures = getDealsFromSingleDeparture($d, true);

                    $departure = [
                        'ID' => $id,
                        'Ship' => $d['ship'],
                        'ShipId' => $ship->ID,
                        'DepartureDate' => $d['date'],
                        'DepartureDateSimple' => date('Y-m', strtotime($d['date'])),
                        'ReturnDate' => $returnDate,
                        'Cabins' => $cabin_prices,
                        'ItineraryPostId' => $post->ID,
                        'ItineraryPost' => $post,
                        'LowestPrice' => getLowestDeparturePrice($d),
                        'HighestPrice' => getHighestDeparturePrice($d),
                        'BestDiscount' => $filteredDeals != null ? getBestDepartureDiscount($d) : 0,
                        'LengthInNights' => $itineraryLength,
                        'Deals' => $filteredDeals,
                        'SpecialDepartures' => $filteredSpecialDepartures,

                    ];
                    if ($filterSoldOut) {
                        if ($departure['LowestPrice'] > 0) {
                            $departures[] = $departure;
                        }
                    } else {
                        $departures[] = $departure;
                    }
                }
            }
        }
    }

    usort($departures, function ($a, $b) {
        return strtotime($a['DepartureDate']) - strtotime($b['DepartureDate']);
    });

    return $departures;
}





// LIST
// get lowest price from a list of departures
function getLowestDepartureListPrice($departures)
{
    $price = 0;
    $priceArray = [];
    foreach ($departures as $d) {
        $lowestCabinPrice = $d['LowestPrice'];
        if ($lowestCabinPrice > 0) {
            $priceArray[] = $lowestCabinPrice;
        }
    }
    $price = min($priceArray); //lowest price, not sold out
    return $price;
}

// get highest price from a list of departures
function getHighestDepartureListPrice($departures)
{
    $price = 0;
    $priceArray = [];
    foreach ($departures as $d) {
        $highestCabinPrice = $d['HighestPrice'];
        if ($highestCabinPrice > 0) {
            $priceArray[] = $highestCabinPrice;
        }
    }
    $price = max($priceArray); //lowest price, not sold out
    return $price;
}
// get best discount from a list of departures
function getBestDepartureListDiscount($departures)
{
    $bestDiscount = 0;
    $bestDiscountArray = [];
    $filteredDepartures = filterSoldOutDepartures($departures);

    foreach ($filteredDepartures as $d) {
        $bestDiscount = $d['BestDiscount'];
        if ($bestDiscount > 0) {
            $bestDiscountArray[] = $bestDiscount;
        }
    }
    $bestDiscount = max($bestDiscountArray); //lowest price, not sold out
    return $bestDiscount;
}

// get ships from list of departures
function getShipsFromDepartureList($departures, $display = false)
{
    $shipArray = [];
    foreach ($departures as $d) {
        $ship = $d['Ship'];
        if ($ship) {
            $shipArray[] = $ship;
        }
    }
    $uniqueShipsList = getUniquePostsFromArrayOfPosts($shipArray);


    if ($display) {
        $display = "";
        $shipCount = count($uniqueShipsList);
        $x = 1;
        foreach ($uniqueShipsList as $s) {
            $name = get_the_title($s);

            if ($x < $shipCount) {
                $display .= $name . ", ";
            } else {
                $display .= $name;
            }
            $x++;
        }
        return $display;
    } else {
        return $uniqueShipsList;
    }
}

// SINGLE
// get lowest cabin price (not sold out) from a single departure
function getLowestDeparturePrice($departure)
{
    $price = 0;
    $cabin_prices = $departure['cabin_prices'];
    if (!$cabin_prices) {
        return $price;
    }

    $priceArray = [];
    foreach ($cabin_prices as $c) {
        if ($c['sold_out'] != true) {
            if (!($c['discounted_price'] == "" && $c['price'] == "")) {
                $priceArray[] = $c['discounted_price'] == "" ? $c['price'] : $c['discounted_price'];
            }
        }
    }

    $price = min($priceArray); //lowest price, not sold out
    return $price;
}

// get highest cabin price (not sold out) from a single departure
function getHighestDeparturePrice($departure)
{
    $price = 0;
    $cabin_prices = $departure['cabin_prices'];
    if (!$cabin_prices) {
        return $price;
    }

    $priceArray = [];
    foreach ($cabin_prices as $c) {
        if ($c['sold_out'] != true) {
            if (!($c['discounted_price'] == "" && $c['price'] == "")) {
                $priceArray[] = $c['discounted_price'] == "" ? $c['price'] : $c['discounted_price'];
            }
        }
    }

    $price = max($priceArray); //highest price, not sold out
    return $price;
}

// get highest discount percentage form a single departures
function getBestDepartureDiscount($departure)
{
    $bestDiscount = 0;
    $cabin_prices = $departure['cabin_prices'];
    if (!$cabin_prices) {
        return $bestDiscount;
    }

    $percentageArray = [];
    foreach ($cabin_prices as $c) {
        $difference = 0;
        $percentage = 0;
        if ($c['sold_out'] != true && $c['discounted_price'] != "") {
            $difference = $c['price'] - $c['discounted_price'];
            $percentage = ceil(($difference / $c['price']) * 100);

            $percentageArray[] = $percentage;
        }
    }

    $bestDiscount = max($percentageArray); //lowest price, not sold out
    return $bestDiscount;
}




// ITINERARY ----------------------------------------------------------
// lowest price from list of itineraries
function getLowestPriceFromListOfItineraries($itineraries, $region = null)
{
    $priceList = [];
    foreach ($itineraries as $itinerary) {
        $departures = getDepartureList($itinerary, null, true, $region);
        $lowestPrice = getLowestDepartureListPrice($departures);
        if ($lowestPrice) {
            $priceList[] = $lowestPrice;
        }
    }

    $lowestOverallPrice = min($priceList);
    return ($lowestOverallPrice);
}

// highest price from list of itineraries
function getHighestPriceFromListOfItineraries($itineraries, $region = null)
{
    $priceList = [];
    foreach ($itineraries as $itinerary) {
        $departures = getDepartureList($itinerary, null, true, $region);
        $highestPrice = getHighestDepartureListPrice($departures);
        if ($highestPrice) {
            $priceList[] = $highestPrice;
        }
    }

    $highestOverallPrice = max($priceList);
    return ($highestOverallPrice);
}

// fly / sail display
function getFlightOption($itinerary)
{

    $fly_category = get_field('fly_category', $itinerary);

    if ($fly_category == 'fly-fly') {
        return 'Fly / Fly';
    }

    if ($fly_category == 'fly-sail') {
        return 'Fly / Sail';
    }

    if ($fly_category == 'sail-fly') {
        return 'Sail / Fly';
    }

    return false;
}
// embarkation / disembarkation display
function getEmbarkationDisplay($itinerary)
{
    $embarkation_point = get_field('embarkation_point', $itinerary);
    $disembarkation_point = get_field('disembarkation_point', $itinerary);

    $display = get_the_title($embarkation_point);

    if ($disembarkation_point && ($embarkation_point != $disembarkation_point)) {
        $display .= ' - ' . get_the_title($disembarkation_point);
    }

    return $display;
}
// get display of passenger count range
function getItineraryShipSize($ships)
{
    $display = "";
    $capacityArray = [];
    foreach ($ships as $ship) {
        $capacityArray[] = get_field('vessel_capacity', $ship);
    }

    $low = min($capacityArray); //lowest price, not sold out
    $high = max($capacityArray); //lowest price, not sold out
    $display = $low . "-" . $high;

    return $display;
}

// build list of unique destinations within an itinerary, with embarkations removed
function getItineraryDestinations($itinerary, $display = false, $limit = 0)
{
    $days = get_field('itinerary', $itinerary);

    $embarkation_point = get_field('embarkation_point', $itinerary);
    $disembarkation_point = get_field('disembarkation_point', $itinerary);
    $destinationList = [];

    foreach ($days as $day) {
        $destinations = $day['destination'];
        foreach ($destinations as $destination) {
            $is_crossing = get_field('is_crossing', $destination);
            if ($destination == $embarkation_point || $destination == $disembarkation_point || $is_crossing) continue;
            $destinationList[] = get_the_title($destination);
        }
    }

    $uniqueDestinationList = array_unique($destinationList);

    if ($display == false) {
        return $uniqueDestinationList;
    } else {
        $displayString = "";
        $destinationCount = count($uniqueDestinationList);
        $count = 1;
        $overCount = 0;

        foreach ($uniqueDestinationList as $name) {
            if ($count <= $limit) {
                $displayString .= $name;

                // trailing comma
                if ($count != $destinationCount) {
                    $displayString .= ', ';
                }
            } else {
                $overCount++;
            }

            $count++;
        }

        if ($overCount > 0) {
            $displayString .= ' + ' . $overCount . ' More';
        }

        return $displayString;
    }
}

// return a list of ships from itinerary or list
function getShipsFromItineraryList($itineraries, $display = false)
{
    $ships = [];
    if(is_array($itineraries)){
        foreach ($itineraries as $itinerary) { // list of itineraries
            $itineraryDepartures = getDepartureList($itinerary); 
            foreach ($itineraryDepartures as $d) {
                $ships[] = $d['Ship'];
            }
        }   
    } else {
        $itineraryDepartures = getDepartureList($itineraries); // single itinerary
        foreach ($itineraryDepartures as $d) {
            $ships[] = $d['Ship'];
        }
    }

    $tempArray = array(); // array unique for objects
    foreach ($ships as $value) {
        $tempArray[serialize($value)] = $value;
    }
    $unique_ships = array_values($tempArray);
    usort($unique_ships, 'sortBySearchRank'); // sort the ships array

    if(!$display){
        return $unique_ships;
    } else {
        $display = ""; // display friendly list in cards
        $shipCount = count($unique_ships);   
        if($shipCount == 0){
            return "N/A";
        }
        $x = 1; 
        foreach ($unique_ships as $s) {
            $name = get_the_title($s);
            if ($x < $shipCount) {
                $display .= $name . ", ";
            } else {
                $display .= $name;
            }
            $x++;
        }
        return $display;
    }

}

// utility to sort by search rank
function sortBySearchRank($a, $b) {
    if (is_object($a) && is_object($b)) {
        $searchRankA = intval(get_field('search_rank', $a->ID)); 
        $searchRankB = intval(get_field('search_rank', $b->ID)); 
        return $searchRankB - $searchRankA ;
    }
}



// // get display of ships sailing the itinerary -- CHECK THIS ISSUE
// function getItineraryShips($itinerary)
// {
//     $ships = get_field('ships', $itinerary);
//     $display = "";
//     $shipCount = count($ships);

//     $x = 1; // FIX THIS LATER
//     foreach ($ships as $s) {
//         $name = get_the_title($s);

//         if ($x < $shipCount) {
//             $display .= $name . ", ";
//         } else {
//             $display .= $name;
//         }
//         $x++;
//     }
//     return $display;
// }

// get list of regions from itinerary post
function getItineraryRegion($itinerary)
{
    $routes = get_field('route', $itinerary);
    $regionsList = [];
    foreach ($routes as $route) {
        $regionsList[] = get_field('region', $route);
    }


    $uniqueRegionsList = getUniquePostsFromArrayOfPosts($regionsList);
    return $uniqueRegionsList[0]; // there should always only be one
}

// range (From x Days to x Days)
function itineraryRange($itineraries, $separator, $onlyMin = false)
{
    $returnString = "";
    $itineraryValues  = [];

    if (count($itineraries) > 0) {
        foreach ($itineraries as $i) {
            $itineraryValues[] = get_field('length_in_nights', $i) + 1;
        }

        $rangeFrom = min($itineraryValues);
        $rangeTo = max($itineraryValues);


        if (!$onlyMin) {
            if ($rangeFrom != $rangeTo) {
                $returnString = $rangeFrom . $separator . $rangeTo;
            } else {
                $returnString = $rangeFrom;
            }
        } else {
            $returnString = $rangeFrom;
        }
    } else {
        $returnString = "N/A";
    }

    return $returnString;
}

// get list of itineraries from route
function getItinerariesFromRoute($routes)
{
    $queryArgs = array(
        'post_type' => 'rfc_itineraries',
        'posts_per_page' => -1,
    );
    $itineraries = get_posts($queryArgs);

    $itineraryList = [];
    foreach ($itineraries as $itinerary) {
        $itineraryRoutes = get_field('route', $itinerary);
        $match = false;
        foreach ($itineraryRoutes as $itineraryRoute) {
            $match = is_array($routes) ? in_array($itineraryRoute, $routes) : $itineraryRoute == $routes;
            if ($match) {
                $itineraryList[] = $itinerary;
            }
        }
    }

    $uniqueItinerariesList = getUniquePostsFromArrayOfPosts($itineraryList);

    return $uniqueItinerariesList;
}


//SHIPS ------------------------------------------------------
// get display of ship size classification
function shipSizeDisplay($pax)
{
    $displayText = "Small Size";
    if ($pax > 200) {
        $displayText = "Large Size";
    } else if ($pax >= 120) {
        $displayText = "Medium Size";
    }
    return $displayText;
}

// gets a list of itinerary posts that have this ship within a departure
function getShipItineraries($ship, $region = null)
{
    $queryArgs = array(
        'post_type' => 'rfc_itineraries',
        'posts_per_page' => -1,
        'meta_key' => 'length_in_nights',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    );

    $itineraries = get_posts($queryArgs);
    $itineraryList = [];
    foreach ($itineraries as $itinerary) {
        if ($region != null) { // filter regions
            $itineraryRegion = getItineraryRegion($itinerary);
            if ($region != $itineraryRegion) {
                continue;
            }
        }

        $use_automation = get_field('use_automation', $itinerary);
        $departures = $use_automation ? get_field('automation_departure_data', $itinerary) : get_field('departures', $itinerary);


        $departureMatch = false;
        foreach ($departures as $departure) {
            $departureShip = $departure['ship'];
              
            if ($departureShip == $ship) {
                $departureMatch = true;
            }
        }

        if ($departureMatch) {         
            $itineraryList[] = $itinerary;
        }
    }

    return $itineraryList;
}

// gets a list of unique regions per ship
function getShipRegions($ship)
{
    $itineraries = getShipItineraries($ship);
    $regionsList = [];
    foreach ($itineraries as $itinerary) {
        $routes = get_field('route', $itinerary);
        foreach ($routes as $route) {
            $regionsList[] = get_field('region', $route);
        }
    }

    $uniqueShipRegionsList = getUniquePostsFromArrayOfPosts($regionsList);
    return ($uniqueShipRegionsList);
}

function shipHasMultipleRegions($ship)
{

    $regions = getShipRegions($ship);
    if (count($regions) > 1) {
        return true;
    } else {
        return false;
    };
}


//REGIONS -----------------------------------
function getPrimaryRegion()
{
    $regionsArgs = array(
        'post_type' => 'rfc_regions',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
    );
    $regions = get_posts($regionsArgs);

    $primaryRegion = null;
    foreach ($regions as $region) {
        $primary = get_field('primary', $region);
        if ($primary) {
            $primaryRegion = $region;
        }
    }

    return $primaryRegion;
}

// EXTRA -----------------------
// get a string display of departures dates, grouped by month, comma seperated and trucated with remainder
function getDateListDisplay($departures, $limit)
{

    //$filteredDepartures = filterSoldOutDepartures($departures);
    $length = count($departures);
    $displayString = "";
    $count = 1;
    $overCount = 0;
    $monthNumber = null;
    foreach ($departures as $departure) {

        if (!($departure['LowestPrice'] > 0)) { // if sold out skip
            continue;
        }

        if ($count <= $limit) {
            // month grouping
            $newMonth = false;
            if ($monthNumber == null) {
                $monthNumber = date('m', strtotime($departure['DepartureDate']));
                $newMonth = true;
            } else {
                if ($monthNumber != date('m', strtotime($departure['DepartureDate']))) {
                    $newMonth = true;
                }
            }

            if ($newMonth) {
                $displayString .= date('M j', strtotime($departure['DepartureDate']));
            } else {
                $displayString .=  date('j', strtotime($departure['DepartureDate']));
            }

            // trailing comma
            if ($count != $length) {
                $displayString .= ', ';
            }
        } else {
            $overCount++;
        }
        $count++;
    }

    if ($overCount > 0) {
        $displayString .= ' + ' . $overCount . ' More';
    }

    return $displayString;
}


function filterSoldOutDepartures($departures)
{
    $nonSoldOutDepartures = [];
    foreach ($departures as $departure) {
        if (($departure['LowestPrice'] > 0)) {
            $nonSoldOutDepartures[] = $departure;
        }
    }
    return $nonSoldOutDepartures;
}

function getEmbarkationList()
{
    $embarkationList = [];
    $embarkArgs = array(
        'post_type' => 'rfc_embark_zones',
        'posts_per_page' => -1,

    );
    $sidebarEmbarkZones = get_posts($embarkArgs);

    $countryArgs = array(
        'post_type' => 'rfc_countries',
        'posts_per_page' => -1,
    );
    $countryPosts = get_posts($countryArgs); // get all countries (bug is preventing a meta query)

    foreach ($sidebarEmbarkZones as $zone) {


        $countryList = [];
        foreach ($countryPosts as $countryPost) {
            $countryZone = get_field('embarkation_zone', $countryPost);
            if ($countryZone->ID == $zone->ID) {
                $countryObject = [
                    'country' => $countryPost,
                    'destinations' => []
                ];
                $countryList[] = $countryObject;
            }
        }


        $embarkationObject = [
            'zone' => $zone,
            'region' => get_field('region', $zone),
            'countries' => $countryList
        ];
        $embarkationList[] = $embarkationObject;
    }
    return $embarkationList;
}
