<?php


//DEPARTURES
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
                            'LengthInNights' => $itineraryLength,
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
                        'LengthInNights' => $itineraryLength,
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


//MAPS
function getItineraryObject($itinerary)
{

    $embarkation_point = get_field('embarkation_point', $itinerary);
    $disembarkation_point = get_field('disembarkation_point', $itinerary);
    $days = get_field('itinerary', $itinerary);

    // Destination Point Series
    $destinationPoints = [];
    $destinationList = [];
    $count = 0;
    foreach ($days as $day) {

        $destinations = $day['destination']; // multiple destinations

        $locationType = '';
        foreach ($destinations as $destination) {
            $dayDisplay = dayCountMarkup($day['day_count']);
            $destinationImage =  get_field('image', $destination); //get default image if none provided
            $destinationImageURL = $destinationImage ? wp_get_attachment_image_url($destinationImage['ID'], 'portrait-small') : "";
            $description = get_field('description', $destination) ?? "";

            if ($destination == $embarkation_point) {
                $locationType = '<span>embarkation</span>';
            }
            if ($destination == $disembarkation_point) {
                $locationType = '<span>disembarkation</span>';
            }

            $point  = [
                'index' => $count,
                'locationType' => $locationType,
                'postid' => $destination->ID,
                'title' => get_the_title($destination),
                'day' => $dayDisplay,
                'description' => $description,
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

    // Itinerary Object
    $itineraryObject = [
        'destinationPoints' => $destinationPoints,
        'geojson' => json_decode(get_field('geojson', $itinerary)),
        'startLatitude' => get_field('latitude_start_point', $itinerary),
        'startLongitude' => get_field('longitude_start_point', $itinerary),
        'startZoom' => get_field('zoom_level_start_point', $itinerary),
        'postId' => get_the_ID($itinerary),
    ];

    return $itineraryObject;
}


function getFlightOption($itinerary){
    $embarkation_is_flight = get_field('embarkation_is_flight', $itinerary);
    $disembarkation_is_flight = get_field('disembarkation_is_flight', $itinerary);

    if ($embarkation_is_flight && $disembarkation_is_flight){
        return 'Fly / Fly';
    } 

    if ($embarkation_is_flight && !$disembarkation_is_flight){
        return 'Fly / Sail';
    } 

    if (!$embarkation_is_flight && $disembarkation_is_flight){
        return 'Sail / Fly';
    } 

    return false;
}












// Random Code Generator
function getRandomHex($num_bytes = 4)
{
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
}


// generate array of years (generic)
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

function getEmbarkationDisplay($itinerary)
{
    $embarkation_point = get_field('embarkation_point', $itinerary);
    $disembarkation_point = get_field('disembarkation_point', $itinerary);

    $display = get_the_title($embarkation_point) . ', ' . get_field('country_name_short', $embarkation_point);

    if ($disembarkation_point && ($embarkation_point != $disembarkation_point)) {
        $display .= ' - ' . get_the_title($disembarkation_point) . ', ' . get_field('country_name_short', $disembarkation_point);
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


// get lowest price from a list of departures
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
    if ($pax > 150) {
        $displayText = "Large Size";
    } else if ($pax >= 80) {
        $displayText = "Medium Size";
    }
    return $displayText;
}

function getItineraryDestinations($itinerary)
{
    $days = get_field('itinerary', $itinerary);

    // $embarkationList = [];

    // $embarkation_point = get_field('embarkation_point', $itinerary);
    // $disembarkation_point = get_field('disembarkation_point', $itinerary);

    $destinationList = [];
    foreach ($days as $day) {
        $destinations = $day['destination'];
        foreach ($destinations as $destination) {
            $destinationList[] = get_the_title($destination);
        }
    }

    $uniqueDestinationList = array_unique($destinationList);

    $display = "";
    $destinationCount = count($uniqueDestinationList);

    $x = 1;
    foreach ($uniqueDestinationList as $d) {
        $name = $d;

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

function countriesInDestinations($destinations, $separator)
{

    $count = 0;
    if ($destinations) {
        foreach ($destinations as $r) {
            if ($r) {
                $isCountry = get_field('is_country', $r);
                if ($isCountry == true) {
                    $title = get_the_title($r);
                    if ($count != 0) {
                        echo " $separator " . $title;
                    } else {
                        echo $title;
                    }
                    $count++;
                }
            }
        }
    }
}

function productType($property)
{
    $postType = get_post_type($property);

    if ($postType == 'rfc_tours') {
        echo 'Tour Package';
    } else if ($postType == 'rfc_lodges') {
        echo 'Lodge';
    } else if ($postType == 'rfc_cruises') {

        $cruiseType = get_field('cruise_type', $property);
        if ($cruiseType == 'river') {
            echo 'River Cruise';
        } else {
            echo 'Costal Cruise';
        }
    }
}


//Cruises available functions --> return number for the rectangular blocks on destination pages
//NOTE: this WILL include cruises with no departure dates... SERPs will not include cruises with no departure dates, itineraries, etc. So the number may differ.
//Location
function cruises_available_location($location)
{

    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_cruises',
        'meta_query' => array(

            array(
                'key' => 'locations', // name of custom field
                'value' => '"' . $location->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );


    $count = 0;
    $cruisePosts = get_posts($postCriteria);

    //filter out charter only
    foreach ($cruisePosts as $c) {
        $charterOnly = get_field('charter_only', $c);
        if ($charterOnly == false) {
            $count++;
        }
    }

    return $count;
}

//Experience
function cruises_available_experience($destination, $experience)
{

    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_cruises',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'destinations', // name of custom field
                'value' => '"' . $destination->ID . '"',
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'experiences', // name of custom field
                'value' => '"' . $experience->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );


    $cruisePosts = get_posts($postCriteria);
    $count = count($cruisePosts);

    // //filter out charter only
    // foreach ($cruisePosts as $c) {
    //     $charterOnly = get_field('charter_only', $c);
    //     if ($charterOnly == false) {

    //         $count++;
    //     }
    // }


    return $count;
}

//Charter
function cruises_available_charter($destination)
{
    $count = 0;
    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_cruises',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'destinations', // name of custom field
                'value' => '"' . $destination->ID . '"',
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'charter_available', // name of custom field
                'value' => true,
                'compare' => 'LIKE'
            )
        )
    );
    $cruisesPosts = get_posts($postCriteria);
    $count = count($cruisesPosts);

    return $count;
}

//Cruises available region (experience templates)
function cruises_available_region($region, $experience, $isCharter, $isLodge = false)
{

    //DESTINATIONS
    $destinationCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_destinations',
        "meta_key" => "region",
        "meta_value" => $region->ID
    );
    $destinations = get_posts($destinationCriteria);

    //get destination IDs
    $destinationIds = [];
    foreach ($destinations as $d) {
        $destinationIds[] = $d->ID;
    }

    //build meta query criteria
    $queryargs = array();
    $queryargs['relation'] = 'OR';
    foreach ($destinationIds as $d) {
        $queryargs[] = array(
            'key'     => 'destinations',
            'value'   => serialize(strval($d)),
            'compare' => 'LIKE'
        );
    }


    $count = 0;

    if ($isCharter == false) {
        if ($isLodge == false) {
            $postCriteria = array(
                'posts_per_page' => -1,
                'post_type' => 'rfc_cruises',
                'meta_query' => array(
                    'relation' => 'AND',
                    $queryargs,
                    array(
                        'key' => 'experiences', // name of custom field
                        'value' => '"' . $experience->ID . '"',
                        'compare' => 'LIKE'
                    )
                )
            );
        } else {
            $postCriteria = array(
                'posts_per_page' => -1,
                'post_type' => 'rfc_lodges',
                'meta_query' => array(
                    'relation' => 'AND',
                    $queryargs,
                    array(
                        'key' => 'experiences', // name of custom field
                        'value' => '"' . $experience->ID . '"',
                        'compare' => 'LIKE'
                    )
                )
            );
        }
    } else {
        $postCriteria = array(
            'posts_per_page' => -1,
            'post_type' => 'rfc_cruises',
            'meta_query' => array(
                'relation' => 'AND',
                $queryargs,
                array(
                    'key' => 'charter_available', // name of custom field
                    'value' => true,
                    'compare' => 'LIKE'
                )
            )
        );
    }

    $cruisesPosts = get_posts($postCriteria);
    $count = count($cruisesPosts);
    return $count;
}



//Deprecated
function check_if_promo($cruise_data, $startDate, $endDate, $lengthMin, $lengthMax)
{
    //filter itineraries if selection
    $itineraries = $cruise_data['Itineraries'];
    $filteredItineraries = [];

    foreach ($itineraries as $itinerary) {
        if ($itinerary['LengthInDays'] >= $lengthMin && $itinerary['LengthInDays'] <= $lengthMax) {
            $filteredItineraries[] = $itinerary;
        }
    }

    $hasPromo = false;
    foreach ($filteredItineraries as $itinerary) {

        $departures = $itinerary['Departures'];
        foreach ($departures as $departure) {
            $dateString = strtotime($departure['DepartureDate']);
            if ($dateString >= $startDate && $dateString <= $endDate) {
                if ($departure['HasPromo'] == true) {
                    $hasPromo = true;
                }
            }
        }
    }
    return $hasPromo;
}

//Works for cruise / lodge / tour
function listDealsForProduct($post, $charterView = false)
{

    //Deals
    $dealArgs = array(
        'post_type' => 'rfc_deals',
        'posts_per_page' => -1,
        'meta_key' => 'value_rating',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    );
    $dealArgs['meta_query'][] = array(
        'key'     => 'products',
        'value'   => '"' . $post->ID . '"',
        'compare' => 'LIKE'
    );
    $dealArgs['meta_query'][] = array(
        'key'     => 'is_active',
        'value'   => true,
        'compare' => '='
    );

    //Filter for charter deals
    if ($charterView == true) {
        $dealArgs['meta_query'][] = array(
            'key'     => 'is_charter_deal',
            'value'   => '1'
        );
    } else {
        $dealArgs['meta_query'][] = array(
            'key'     => 'is_charter_deal',
            'value'     => '0',

        );
    }


    $dealPosts = get_posts($dealArgs);
    return $dealPosts;
}



//Count of Deals available in region or destination
function deals_available($regionOrDestinationPost)
{


    $dealArgs = array(
        'post_type' => 'rfc_deals',
        'posts_per_page' => -1,
    );

    $dealArgs['meta_query'][] = array(
        'key'     => 'is_active',
        'value'   => true,
        'compare' => '='
    );


    $postType = get_post_type($regionOrDestinationPost);
    if ($postType == 'rfc_regions') {
        $dealArgs['meta_query'][] = array(
            'key'     => 'regions',
            'value'   => '"' . $regionOrDestinationPost->ID . '"',
            'compare' => 'LIKE'
        );
    } else {
        $dealArgs['meta_query'][] = array(
            'key'     => 'destinations',
            'value'   => '"' . $regionOrDestinationPost->ID . '"',
            'compare' => 'LIKE'
        );
    }

    $dealPosts = get_posts($dealArgs);
    $count = count($dealPosts);
    return $count;
}
