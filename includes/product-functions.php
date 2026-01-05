<?php

function getBadgeClass($region)
{
    $badgeClass = 'badge--' . strtolower(get_the_title($region));
    return $badgeClass;
}

// DEPARTURES ----------------------------------------------------------------------------------------------
// get a list of departures
function getDepartureList($post, $specificShip = null, $filterSoldOut = false, $region = null, $test = false)
{
    $departures = [];
    if (get_post_type($post) == 'rfc_cruises') {
        $itineraryPosts = getShipItineraries($post, $region);


        foreach ($itineraryPosts as $i) { // each itinerary
            $itineraryDefaultLength = get_field('length_in_nights', $i);
            $itineraryDefaultEmbarkatoin = get_field('embarkation_point', $i);
            $itineraryDefaultDisembarkation = get_field('disembarkation_point', $i);

            $itineraryHasVariants = get_field('has_variants', $i);
            $itineraryVariants = get_field('variants', $i);


            // get itinerary departures
            $use_automation = get_field('use_automation', $i);
            $itineraryDepartures = $use_automation ? get_field('automation_departure_data', $i) : get_field('departures', $i);



            foreach ($itineraryDepartures as $d) {   // each departure   
                $isCurrent = strtotime($d['date']) >= strtotime(date('Y-m-d'));

                if ($isCurrent) {

                    // variant overrides
                    $departureItineraryLength = $itineraryDefaultLength;
                    $departureEmbarkation = $itineraryDefaultEmbarkatoin;
                    $departureDisembarkation = $itineraryDefaultDisembarkation;

                    if ($itineraryHasVariants) {
                        $departureVariantNumber = $d['variant'] ?? 0;
                        if ($departureVariantNumber != 0) {
                            $matchedVariant = $itineraryVariants[$departureVariantNumber - 1];

                            $departureItineraryLength = $matchedVariant['length_in_nights'] ?? $itineraryDefaultLength;
                            $departureEmbarkation = $matchedVariant['embarkation_point'] ?? $itineraryDefaultEmbarkatoin;
                            $departureDisembarkation = $matchedVariant['disembarkation_point'] ?? $itineraryDefaultDisembarkation;
                        };
                    };

                    // embarkation display
                    $embarkationDisplay = get_the_title($departureEmbarkation) . ", " . get_the_title(get_field('embarkation_country', $departureEmbarkation));
                    if ($departureEmbarkation->ID != $departureDisembarkation->ID) {
                        $embarkationDisplay = $embarkationDisplay . " (Disembarking: " . get_the_title($departureDisembarkation) . ", " . get_the_title(get_field('embarkation_country', $departureDisembarkation)) . ")";
                    }



                    $id = $i->ID . "-" . getRandomHex();
                    $returnDate = date('Y-m-d', strtotime($d['date'] . ' + ' . $departureItineraryLength . ' days'));
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
                            'Embarkation' => $departureEmbarkation,
                            'Disembarkation' => $departureDisembarkation,
                            'EmbarkationDisplay' => $embarkationDisplay,
                            'Cabins' => $cabin_prices,
                            'ShipId' => $ship->ID,
                            'Ship' => $ship,
                            'ItineraryPostId' => $i->ID,
                            'ItineraryPost' => $i,
                            'LowestPrice' => getLowestDeparturePrice($d),
                            'HighestPrice' => getHighestDeparturePrice($d),
                            'BestDiscount' => $filteredDeals != null ? getBestDepartureDiscount($d) : 0,
                            'LengthInNights' => $departureItineraryLength,
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
        $itineraryDefaultLength = get_field('length_in_nights', $post);
        $itineraryDefaultEmbarkatoin = get_field('embarkation_point', $post);
        $itineraryDefaultDisembarkation = get_field('disembarkation_point', $post);

        $itineraryHasVariants = get_field('has_variants', $post);
        $itineraryVariants = get_field('variants', $post);

        // get itinerary departures
        $use_automation = get_field('use_automation', $post);
        $itineraryDepartures = $use_automation ? get_field('automation_departure_data', $post) : get_field('departures', $post);

        if ($test) {
            console_log($itineraryDepartures);
        }
        foreach ($itineraryDepartures as $d) {   // each departure   
            $isCurrent = strtotime($d['date']) >= strtotime(date('Y-m-d'));
            if ($isCurrent) {

                // variant overrides
                $departureItineraryLength = $itineraryDefaultLength;
                $departureEmbarkation = $itineraryDefaultEmbarkatoin;
                $departureDisembarkation = $itineraryDefaultDisembarkation;

                if ($itineraryHasVariants) {
                    $departureVariantNumber = $d['variant'] ?? 0;
                    if ($departureVariantNumber != 0) {
                        $matchedVariant = $itineraryVariants[$departureVariantNumber - 1];

                        $departureItineraryLength = $matchedVariant['length_in_nights'] ?? $itineraryDefaultLength;
                        $departureEmbarkation = $matchedVariant['embarkation_point'] ?? $itineraryDefaultEmbarkatoin;
                        $departureDisembarkation = $matchedVariant['disembarkation_point'] ?? $itineraryDefaultDisembarkation;
                    };
                };

                // embarkation display
                $embarkationDisplay = get_the_title($departureEmbarkation) . ", " . get_the_title(get_field('embarkation_country', $departureEmbarkation));
                if ($departureEmbarkation->ID != $departureDisembarkation->ID) {
                    $embarkationDisplay = $embarkationDisplay . " (Disembarking: " . get_the_title($departureDisembarkation) . ", " . get_the_title(get_field('embarkation_country', $departureDisembarkation)) . ")";
                }



                $id = $post->ID . "-" . getRandomHex();
                $returnDate = date('Y-m-d', strtotime($d['date'] . ' + ' . $departureItineraryLength . ' days'));
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
                        'Embarkation' => $departureEmbarkation,
                        'Disembarkation' => $departureDisembarkation,
                        'EmbarkationDisplay' => $embarkationDisplay,
                        'Cabins' => $cabin_prices,
                        'ItineraryPostId' => $post->ID,
                        'ItineraryPost' => $post,
                        'LowestPrice' => getLowestDeparturePrice($d),
                        'HighestPrice' => getHighestDeparturePrice($d),
                        'BestDiscount' => $filteredDeals != null ? getBestDepartureDiscount($d) : 0,
                        'LengthInNights' => $departureItineraryLength,
                        'LengthInDays' => $departureItineraryLength + 1,
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
    //$price = min($priceArray); //lowest price, not sold out
    $price = !empty($priceArray) ? min($priceArray) : 0;
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
    //$price = max($priceArray); //lowest price, not sold out
    $price = !empty($priceArray) ? max($priceArray) : 0;

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
    $bestDiscount = !empty($bestDiscountArray) ? max($bestDiscountArray) : 0;
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

        if (!is_array($uniqueShipsList) && !is_countable($uniqueShipsList)) {
            return "N/A";
        }

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

    $price = !empty($priceArray) ? min($priceArray) : 0;
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

    $price = !empty($priceArray) ? max($priceArray) : 0;
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

    $bestDiscount = !empty($percentageArray) ? max($percentageArray) : 0;
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

    $lowestOverallPrice = !empty($priceList) ? min($priceList) : 0;
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

    $highestOverallPrice = !empty($priceList) ? max($priceList) : 0;
    return ($highestOverallPrice);
}

// fly / sail display
function getFlightOption($fly_category)
{

    // $fly_category = get_field('fly_category', $itinerary);

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

    $low = !empty($capacityArray) ? min($capacityArray) : 0;
    $high = !empty($capacityArray) ? max($capacityArray) : 0;
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

        if (!is_array($uniqueDestinationList) && !is_countable($uniqueDestinationList)) {
            return "N/A";
        }

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
    if (is_array($itineraries)) {
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

    if (!$display) {
        return $unique_ships;
    } else {
        $display = ""; // display friendly list in cards

        if (!is_array($unique_ships) && !is_countable($unique_ships)) {
            return "N/A";
        }

        $shipCount = count($unique_ships);
        if ($shipCount == 0) {
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
function sortBySearchRank($a, $b)
{
    if (is_object($a) && is_object($b)) {
        $searchRankA = intval(get_field('search_rank', $a->ID));
        $searchRankB = intval(get_field('search_rank', $b->ID));
        return $searchRankB - $searchRankA;
    }
}

function getItinerariesFromRegion($region, $limit = -1)
{
    $queryArgs = array(
        'post_type' => 'rfc_itineraries',
        'posts_per_page' => $limit,
        'meta_key' => 'search_rank',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    );
    $itineraries = get_posts($queryArgs);
    $itineraryList = [];
    foreach ($itineraries as $itinerary) {
        $routes = get_field('route', $itinerary);
        $match = false;
        foreach ($routes as $route) {
            $itineraryRegion = get_field('region', $route);
            if ($itineraryRegion == $region) {
                $match = true;
            }
        }
        if ($match) {
            $itineraryList[] = $itinerary;
        }
    }

    $uniqueItinerariesList = getUniquePostsFromArrayOfPosts($itineraryList);

    return $uniqueItinerariesList;
}

// get list of regions from itinerary post
function getItineraryRegion($itinerary)
{
    $routes = get_field('route', $itinerary);
    $regionsList = [];

    if (empty($routes)) {
        return [];
    }

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

    // Check if $itineraries is actually an array or countable
    if (!is_array($itineraries) && !is_countable($itineraries)) {
        return "N/A";
    }

    if (count($itineraries) > 0) {
        foreach ($itineraries as $i) {
            $lengthInNights = get_field('length_in_nights', $i);
            $itineraryValues[] = (int)$lengthInNights + 1; // Convert to integer to prevent string + int error
        }

        $rangeFrom = !empty($itineraryValues) ? min($itineraryValues) : 0;
        $rangeTo = !empty($itineraryValues) ? max($itineraryValues) : 0;


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

        if (empty($departures)) {
            continue;
        }

        $departureMatch = false;
        foreach ($departures as $departure) {
            $departureShip = $departure['ship'];

            if ($departureShip->ID == $ship->ID) {
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

    // Check if $itineraries is actually an array or countable
    if (!is_array($regions) && !is_countable($regions)) {
        return false;
    }


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

    if (!is_array($departures) || count($departures) == 0) {
        return '';
    }

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


function getRoutesFromRegionList($regions)
{
    $region_ids = array();
    foreach ($regions as $region) {
        $region_ids[] = $region->ID;
    }
    $routesArgs = array(
        'post_type' => 'rfc_routes',
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num title',
        'meta_key' => 'search_rank',
        'order' => 'DESC',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'region',
                'value' => $region_ids,
                'compare' => 'IN'
            ),
            array(
                'key' => 'search_rank',
                'value' => '',
                'compare' => '!='
            )
        )
    );

    // Get routes WITH search_rank values
    $routes_with_rank = get_posts($routesArgs);

    // Get routes WITHOUT search_rank values (or empty/null)
    $routesArgsNoRank = array(
        'post_type' => 'rfc_routes',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'region',
                'value' => $region_ids,
                'compare' => 'IN'
            ),
            array(
                'relation' => 'OR',
                array(
                    'key' => 'search_rank',
                    'value' => '',
                    'compare' => '='
                ),
                array(
                    'key' => 'search_rank',
                    'compare' => 'NOT EXISTS'
                )
            )
        )
    );

    $routes_without_rank = get_posts($routesArgsNoRank);

    // Combine the arrays - ranked routes first, then unranked routes
    $routes = array_merge($routes_with_rank, $routes_without_rank);
    return $routes;
}
