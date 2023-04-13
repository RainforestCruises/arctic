<?php

// DEPARTURE LIST ----------------------------------------------------------------------------------------------
function getDepartureList($post, $specificShip = null)
{
    $departures = [];
    if (get_post_type($post) == 'rfc_cruises') {

        $itineraryPosts = get_field('itineraries', $post);

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

                    if ($ship == $post) {
                        $departure = [
                            'ID' => $id,
                            'DepartureDate' => $d['date'],
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
                            'Deals' => $d['deals'],
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

                $match = true;
                if ($specificShip && ($specificShip != $ship)) {
                    $match = false;
                }
                if ($match) {
                    $departure = [
                        'ID' => $id,
                        'Ship' => $d['ship'],
                        'ShipId' => $ship->ID,
                        'DepartureDate' => $d['date'],
                        'ReturnDate' => $returnDate,
                        'Cabins' => $cabin_prices,
                        'ItineraryPostId' => $post->ID,
                        'ItineraryPost' => $post,
                        'LowestPrice' => getLowestDeparturePrice($d),
                        'HighestPrice' => getHighestDeparturePrice($d),
                        'BestDiscount' => getBestDepartureDiscount($d),
                        'LengthInNights' => $itineraryLength,
                        'Deals' => $d['deals'],
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

// OVERALL
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

// PER DEPARTURE
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

// DEALS ----------------------------------------------------------------------------------------------
// get a list of unique deals from a list of departures
function getDepartureListDeals($departures)
{
    $uniqueDealsArray = [];
    foreach ($departures as $d) {
        $deals = $d['Deals'];
        foreach ($deals as $deal) {
            if (!in_array($deal, $uniqueDealsArray)) {
                $uniqueDealsArray[] = $deal; // only add non dulpicates
            }
        }
    }
    return $uniqueDealsArray;
}
function getDealsDisplay($deals)
{
    $displayText = '';
    if ($deals) {
        if ($deals == 1) {
            $displayText = '1 Deal Available';
        } else {
            $displayText =  count($deals) . ' Deals Available';
        }
    }
    echo $displayText;
}
function getDaysUntilExpiry($expiry_date)
{
    $now = time();
    $datediff = strtotime($expiry_date) - $now;
    $daysUntilExpiry = round($datediff / (60 * 60 * 24));
    return $daysUntilExpiry;
}


// MAPS ----------------------------------------------------------------------------------------------
function getItineraryObject($itinerary)
{
    $embarkation_point = get_field('embarkation_point', $itinerary);
    $disembarkation_point = get_field('disembarkation_point', $itinerary);
    $hasDifferentPorts = $disembarkation_point != null && ($disembarkation_point != $embarkation_point);

    $days = get_field('itinerary', $itinerary);

    // Destination Point Series
    $destinationPoints = [];
    $destinationList = [];
    $count = 0;

    //Build Destination List
    foreach ($days as $day) {

        $destinations = $day['destination']; // multiple destinations

        foreach ($destinations as $destination) {
            $dayDisplay = dayCountMarkup($day['day_count']);
            $destinationImage =  get_field('image', $destination); //get default image if none provided
            $destinationImageURL = $destinationImage ? wp_get_attachment_image_url($destinationImage['ID'], 'portrait-small') : "";


            $point  = [
                'index' => $count,
                'isEmbarkation' => $destination == $embarkation_point,
                'isDisembarkation' => $destination == $disembarkation_point,
                'postid' => $destination->ID,
                'title' => get_the_title($destination),
                'day' => $dayDisplay,
                'image' => $destinationImageURL,
                'coordinates' => [get_field('longitude', $destination), get_field('latitude', $destination)],
            ];

            // to check duplicates
            if (!in_array($destination, $destinationList)) {
                $destinationPoints[] = $point; // only add non dulpicates
                $count++; //increment index

            } else { // append the day markup
                $match = findObjectById($point['postid'], $destinationPoints, 'postid');
                $matchIndex = $match['index'];
                $destinationPoints[$matchIndex]['day'] .= ', ' . $point['day']; // append the day markup to matched destination
            }

            $destinationList[] = $destination; //full list
        }
    }

    //Reformat to feature 
    $featureList = [];
    foreach ($destinationPoints as $point) {
        $feature = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => $point['coordinates']
            ],
            'properties' => [
                'day' => $point['day'],
                'title' => $point['title'],
                'image' => $point['image'],
                'isEmbarkation' => $point['isEmbarkation'],
                'isDisembarkation' => $point['isDisembarkation']
            ],
        ];

        $featureList[] = $feature;
    }

    // Itinerary Object
    $itineraryObject = [
        'featureList' => $featureList,
        'hasDifferentPorts' => $hasDifferentPorts,
        'geojson' => json_decode(get_field('geojson', $itinerary)),
        'startLatitude' => get_field('latitude_start_point', $itinerary),
        'startLongitude' => get_field('longitude_start_point', $itinerary),
        'startZoom' => get_field('zoom_level_start_point', $itinerary),
        'postId' => get_the_ID($itinerary),
    ];

    return $itineraryObject;
}


// destination list
function getItineraryObjectFromDestinations($destinations, $startLatitude, $startLongitude, $startZoomPoint)
{

    // Destination Point Series
    $destinationPoints = [];

    foreach ($destinations as $destination) {
        $destinationImage =  get_field('image', $destination); //get default image if none provided
        $destinationImageURL = $destinationImage ? wp_get_attachment_image_url($destinationImage['ID'], 'portrait-small') : "";

        $point  = [
            'index' => 0,
            'isEmbarkation' => false,
            'isDisembarkation' => false,
            'postid' => $destination->ID,
            'title' => get_the_title($destination),
            'day' => null,
            'image' => $destinationImageURL,
            'coordinates' => [get_field('longitude', $destination), get_field('latitude', $destination)],
        ];

        $destinationPoints[] = $point; // only add non dulpicates
    }

    //Reformat to feature 
    $featureList = [];
    foreach ($destinationPoints as $point) {
        $feature = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => $point['coordinates']
            ],
            'properties' => [
                'day' => $point['day'],
                'title' => $point['title'],
                'image' => $point['image'],
                'isEmbarkation' => $point['isEmbarkation'],
                'isDisembarkation' => $point['isDisembarkation']
            ],
        ];

        $featureList[] = $feature;
    }

    // Itinerary Object
    $itineraryObject = [
        'featureList' => $featureList,
        'hasDifferentPorts' => false,
        'geojson' => null,
        'startLatitude' => $startLatitude,
        'startLongitude' => $startLongitude,
        'startZoom' => $startZoomPoint,
        'postId' => null,
    ];

    return $itineraryObject;
}


function getFlightOption($itinerary)
{
    $embarkation_is_flight = get_field('embarkation_is_flight', $itinerary);
    $disembarkation_is_flight = get_field('disembarkation_is_flight', $itinerary);

    if ($embarkation_is_flight && $disembarkation_is_flight) {
        return 'Fly / Fly';
    }

    if ($embarkation_is_flight && !$disembarkation_is_flight) {
        return 'Fly / Sail';
    }

    if (!$embarkation_is_flight && $disembarkation_is_flight) {
        return 'Sail / Fly';
    }

    return false;
}


// GENERIC ----------------------------------------------------------------------------------------------
// Random Code Generator
function getRandomHex($num_bytes = 4)
{
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
}


// generate array of years 
function createYearSelection($current, $yearsCount)
{
    $years = [];
    $count = 0;
    while ($count < $yearsCount) {
        $years[] = $current + $count;
        $count++;
    }
    return $years;
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


function dayCountMarkup($string, $exclude_number = false)
{
    $string = str_replace(' ', '', $string);
    if ($exclude_number == true) {
        if (str_contains($string, '-')) {
            return 'Days';
        } else {
            return 'Day';
        }
    } else {
        if (str_contains($string, '-')) {
            return 'Days ' . $string;
        } else {
            return 'Day ' . $string;
        }
    }
}


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

// build list of unique destinations within an itinerary, with embarkations removed
function getItineraryDestinations($itinerary)
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

    $display = "";
    $destinationCount = count($uniqueDestinationList);

    $x = 1;
    foreach ($uniqueDestinationList as $name) {
        if ($x < $destinationCount) {
            $display .= $name . ", ";
        } else {
            $display .= $name;
        }
        $x++;
    }
    return $display;
}

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


//Range (From x Days to x Days)
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

