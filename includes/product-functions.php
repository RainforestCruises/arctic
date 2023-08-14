<?php

// DEPARTURES ----------------------------------------------------------------------------------------------
// get a list of departures
function getDepartureList($post, $specificShip = null)
{
    $departures = [];
    if (get_post_type($post) == 'rfc_cruises') {

        $itineraryPosts = getShipItineraries($post);


        foreach ($itineraryPosts as $i) { //each itinerary

            $itineraryLength = get_field('length_in_nights', $i);
            $itineraryDepartures = get_field('departures', $i);

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
                            'BestDiscount' => getBestDepartureDiscount($d),
                            'LengthInNights' => $itineraryLength,
                            'Deals' => $filteredDeals,
                            'SpecialDepartures' => $filteredSpecialDepartures,
                        ];
                        $departures[] = $departure;
                    }
                }
            }
        }
    } else if (get_post_type($post) == 'rfc_itineraries') {
        $itineraryLength = get_field('length_in_nights', $post);
        $itineraryDepartures = get_field('departures', $post);

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
                        'BestDiscount' => getBestDepartureDiscount($d),
                        'LengthInNights' => $itineraryLength,
                        'Deals' => $filteredDeals,
                        'SpecialDepartures' => $filteredSpecialDepartures,

                    ];
                    $departures[] = $departure;
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
    foreach ($departures as $d) {
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
            $priceArray[] = $c['discounted_price'] == "" ? $c['price'] : $c['discounted_price'];
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
            $priceArray[] = $c['discounted_price'] == "" ? $c['price'] : $c['discounted_price'];
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
function getLowestPriceFromListOfItineraries($itineraries)
{
    $priceList = [];
    foreach ($itineraries as $itinerary) {
        $departures = getDepartureList($itinerary);
        $lowestPrice = getLowestDepartureListPrice($departures);
        if($lowestPrice){
            $priceList[] = $lowestPrice;
        }
    }

    $lowestOverallPrice = min($priceList);
    return ($lowestOverallPrice);
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

// get display of ships sailing the itinerary
function getItineraryShips($itinerary)
{
    $ships = get_field('ships', $itinerary);
    $display = "";
    $shipCount = count($ships);

    $x = 1;
    foreach ($ships as $s) {
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

// get list of regions from itinerary post
function getItineraryRegions($itinerary)
{
    $routes = get_field('route', $itinerary);
    $regionsList = [];
    foreach ($routes as $route) {
        $regionsList[] = get_field('region', $route);
    }


    $uniqueRegionsList = getUniquePostsFromArrayOfPosts($regionsList);
    return $uniqueRegionsList;
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
function getShipItineraries($ship)
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
        $departures = get_field('departures', $itinerary);
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
