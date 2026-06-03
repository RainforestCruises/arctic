<?php


// DEPARTURES ----------------------------------------------------------------------------------------------
// get a list of departures for a ship
// uses precalculated ship itineraries
// uses precalculated departures if they exist for the itinerary, otherwise calculates on the fly (slower)
function getDepartureListShip($shipPost, $specificRegion = null, $specificItineraryList = null)
{

    // TODO specific itinerary list doesnt work !!!!!!!
    $departures = [];
    $itineraryPosts = $specificItineraryList ? $specificItineraryList : getShipItineraries($shipPost, $specificRegion); // ship itineraries filtered for region (includes sold out)
    foreach ($itineraryPosts as $itineraryPost) { // so here ideally get the precalculated departures per each itinerary, and then just filter those for the ship
        $itineraryDepartures = get_field('precalculated_departures', $itineraryPost)
            ? getPrecalculatedDeparturesByShip($itineraryPost, $shipPost)
            : getDepartureListItinerary($itineraryPost, $shipPost); // perform the calculation if its not there
        $departures = array_merge($departures, $itineraryDepartures); // only available
    }

    usort($departures, function ($a, $b) {
        return strtotime($a['departureDate']) <=> strtotime($b['departureDate']);
    });

    return $departures;
}

// get a list of departures for an itinerary
function getDepartureListItinerary($itineraryPost, $specificShip = null, $filterSoldOut = true)
{
    $departures = [];

    $use_automation = get_field('use_automation', $itineraryPost);
    $itineraryDepartures = $use_automation ? get_field('automation_departure_data', $itineraryPost) : get_field('departures', $itineraryPost);
    if (!is_array($itineraryDepartures) || empty($itineraryDepartures)) return $departures; // if no departures

    $itineraryRegionId = getItineraryRegionId($itineraryPost);
    $itineraryDefaultLength = (int) get_field('length_in_nights', $itineraryPost);
    $itineraryDefaultEmbarkatoin = get_field('embarkation_point', $itineraryPost);
    $itineraryDefaultDisembarkation = get_field('disembarkation_point', $itineraryPost);
    $itineraryDefaultVariantTitle = get_field('variant_title', $itineraryPost);
    $itineraryHasVariants = get_field('has_variants', $itineraryPost);
    $itineraryVariants = get_field('variants', $itineraryPost);

    foreach ($itineraryDepartures as $d) {
        $isCurrent = strtotime($d['date']) >= strtotime(date('Y-m-d'));  // skip past departures
        if (!$isCurrent) continue;

        $ship = $d['ship']; // skip if looking for specific ship and this departure doesn't have it
        if ($specificShip && $ship && $specificShip->ID != $ship->ID) continue;

        $cabin_prices = $d['cabin_prices'];
        $hasAvailability = false;
        if ($cabin_prices) {
            $cabin_prices = array_map(function ($cabin) {
                $cabin['price'] = (float) $cabin['price'];
                $cabin['discounted_price'] = (float) $cabin['discounted_price'];
                return $cabin;
            }, $cabin_prices);

            usort($cabin_prices, function ($first, $second) {
                return $second['price'] <=> $first['price'];
            });

            $hasAvailability = count(array_filter($cabin_prices, fn($cabin) => !$cabin['sold_out'])) > 0;
        }

        if (!$hasAvailability && $filterSoldOut) continue; // skip if filtering sold out and no availability

        $departureItineraryLength = $itineraryDefaultLength;
        $departureEmbarkation = $itineraryDefaultEmbarkatoin;
        $departureDisembarkation = $itineraryDefaultDisembarkation;
        $departureVariantTitle = $itineraryDefaultVariantTitle;

        if ($itineraryHasVariants) {
            $departureVariantNumber = isset($d['variant']) ? (int)$d['variant'] : 0;
            if ($departureVariantNumber > 0 && is_array($itineraryVariants) && isset($itineraryVariants[$departureVariantNumber - 1])) {
                $matchedVariant = $itineraryVariants[$departureVariantNumber - 1];

                $departureItineraryLength = (int) $matchedVariant['length_in_nights'] ?? $itineraryDefaultLength;
                $departureEmbarkation = $matchedVariant['embarkation_point'] ?? $itineraryDefaultEmbarkatoin;
                $departureDisembarkation = $matchedVariant['disembarkation_point'] ?? $itineraryDefaultDisembarkation;
                $departureVariantTitle = $matchedVariant['variant_title'] ?? "";
            };
        };

        $embarkationDisplay = get_the_title($departureEmbarkation) . ", " . get_the_title(get_field('embarkation_country', $departureEmbarkation));
        if ($departureEmbarkation && $departureDisembarkation && $departureEmbarkation->ID != $departureDisembarkation->ID) {
            $embarkationDisplay = $embarkationDisplay . " (Disembarking: " . get_the_title($departureDisembarkation) . ", " . get_the_title(get_field('embarkation_country', $departureDisembarkation)) . ")";
        }

        $id = $itineraryPost->ID . "-" . getRandomHex();
        $returnDate = date('Y-m-d', strtotime($d['date'] . ' + ' . $departureItineraryLength . ' days'));


        $filteredDeals = getDealsFromSingleDeparture($d);
        $filteredSpecialDepartures = getDealsFromSingleDeparture($d, true);

        // NOTE that with data from ACF fields 'automated_departures' and 'departures' their properties are lower case names, ie: ['ship'] and['date']
        // TODO replace objects with IDs
        $departure = [
            'id'                  => $id,
            'ship'                => $d['ship'],
            'shipId'              => $ship->ID ?? null,
            'departureDate'       => $d['date'],
            'departureDateSimple' => date('Y-m', strtotime($d['date'])),
            'hasAvailability'     => $hasAvailability, // always true unless explicitly returned otherwise
            'returnDate'          => $returnDate,
            'embarkation'         => $departureEmbarkation,
            'disembarkation'      => $departureDisembarkation,
            'embarkationDisplay'  => $embarkationDisplay,
            'cabins'              => $cabin_prices,
            'itineraryPostId'     => $itineraryPost->ID ?? null,
            'itineraryPost'       => $itineraryPost,
            'itineraryRegionId'   => $itineraryRegionId,
            'lowestPrice'         => getLowestDeparturePrice($d),
            'highestPrice'        => getHighestDeparturePrice($d),
            'bestDiscount'        => getBestDepartureDiscount($d),
            'lengthInNights'      => $departureItineraryLength,
            'lengthInDays'        => $departureItineraryLength + 1,
            'deals'               => $filteredDeals,
            'specialDepartures'   => $filteredSpecialDepartures,
            'variantTitle'        => $departureVariantTitle,
            'variantIndex'        => (int) ($d['variant'] ?? 0),
        ];
        $departures[] = $departure;
    }

    usort($departures, function ($a, $b) {
        return strtotime($a['departureDate']) <=> strtotime($b['departureDate']);
    });

    return $departures;
}

function getPrecalculatedDeparturesByShip($itinerary, $ship)
{
    $precalculated_departures = get_field('precalculated_departures', $itinerary);
    if (empty($precalculated_departures)) return [];
    return array_filter($precalculated_departures, fn($departure) => $departure['shipId'] == $ship->ID);
}



// LIST
// get lowest price from a list of departures
function getLowestDepartureListPrice($departures)
{
    $price = 0;
    $priceArray = [];
    foreach ($departures as $d) {
        $lowestCabinPrice = $d['lowestPrice'];
        if ($lowestCabinPrice > 0) {
            $priceArray[] = $lowestCabinPrice;
        }
    }
    $price = !empty($priceArray) ? min($priceArray) : 0;
    return $price;
}

// get highest price from a list of departures
function getHighestDepartureListPrice($departures)
{
    $price = 0;
    $priceArray = [];
    foreach ($departures as $d) {
        $highestCabinPrice = $d['highestPrice'];
        if ($highestCabinPrice > 0) {
            $priceArray[] = $highestCabinPrice;
        }
    }
    $price = !empty($priceArray) ? max($priceArray) : 0;
    return $price;
}
// get best discount from a list of departures
function getBestDepartureListDiscount($departures)
{
    $bestDiscount = 0;
    $bestDiscountArray = [];
    foreach ($departures as $d) {
        $bestDiscount = $d['bestDiscount'];
        if ($bestDiscount > 0) {
            $bestDiscountArray[] = $bestDiscount;
        }
    }
    $bestDiscount = !empty($bestDiscountArray) ? max($bestDiscountArray) : 0;
    return $bestDiscount;
}

// get ships from list of departures
function getShipsFromDepartureList($departures)
{
    $shipArray = [];
    foreach ($departures as $d) {
        $ship = $d['ship'];
        if ($ship) {
            $shipArray[] = $ship;
        }
    }
    $uniqueShipsList = getUniquePostsFromArrayOfPosts($shipArray);
    return $uniqueShipsList;
}

// SINGLE
// get lowest cabin price (not sold out) from a single departure
function getLowestDeparturePrice($departure)
{
    $price = 0;
    $cabin_prices = $departure['cabin_prices'];
    if (!$cabin_prices) return $price;

    $priceArray = [];
    foreach ($cabin_prices as $c) {
        if ($c['sold_out'] != true && (float)$c['price'] > 0) {
            $discounted = (float)$c['discounted_price'];
            $regular    = (float)$c['price'];
            $effectivePrice = ($discounted > 0) ? $discounted : $regular;
            $priceArray[] = $effectivePrice;
        }
    }



    return !empty($priceArray) ? min($priceArray) : 0;
}

function getHighestDeparturePrice($departure)
{
    $price = 0;
    $cabin_prices = $departure['cabin_prices'];
    if (!$cabin_prices) return $price;

    $priceArray = [];
    foreach ($cabin_prices as $c) {
        if ($c['sold_out'] != true && (float)$c['price'] > 0) {
            $discounted = (float)$c['discounted_price'];
            $regular    = (float)$c['price'];
            $effectivePrice = ($discounted > 0) ? $discounted : $regular;
            $priceArray[] = $effectivePrice;
        }
    }

    return !empty($priceArray) ? max($priceArray) : 0;
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
        $price = (float) $c['price'];
        $discountedPrice = $c['discounted_price'];

        $hasDiscount = (float)$discountedPrice > 0;
        if ($c['sold_out'] != true && $hasDiscount && $price > 0) {
            $difference = $price - (float) $discountedPrice;
            $percentage = ceil(($difference / $price) * 100);
            $percentageArray[] = $percentage;
        }
    }

    if ($departure['date'] == "2028-01-31") {
        console_log("test");
        console_log($percentageArray);
        $test = !empty($percentageArray) ? max($percentageArray) : 0;
        console_log($test);
    }

    return !empty($percentageArray) ? max($percentageArray) : 0;
}




// ITINERARY ----------------------------------------------------------
// get lowest price from a list of itineraries, landing pages
function getLowestItineraryListPrice($itineraries)
{
    $priceList = [];
    foreach ($itineraries as $itinerary) {
        $lowestPrice = get_field('precalculated_price_low', $itinerary);
        if ($lowestPrice) {
            $priceList[] = (float) $lowestPrice;
        }
    }
    return !empty($priceList) ? min($priceList) : 0;
}

// fly / sail display
function getFlightOption($fly_category)
{
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
function getItineraryDestinations($itinerary)
{
    $days = get_field('itinerary', $itinerary) ?: []; // PHP 8 FIX
    $embarkation_point = get_field('embarkation_point', $itinerary);
    $disembarkation_point = get_field('disembarkation_point', $itinerary);
    $destinationList = [];

    foreach ($days as $day) {
        $destinations = $day['destination'];
        foreach ($destinations as $destination) {
            $is_crossing = get_field('is_crossing', $destination);
            if ($destination == $embarkation_point || $destination == $disembarkation_point || $is_crossing) continue;
            $destinationList[] = $destination;
        }
    }
    $uniqueDestinationList = getUniquePostsFromArrayOfPosts($destinationList);
    return $uniqueDestinationList;
}

// take a list of detinations and return a display string with a limit and + more if over
function getDestinationsDisplay($destinations, $limit = 4)
{
    $unique = getUniquePostsFromArrayOfPosts($destinations);
    if (empty($unique) || !is_countable($unique)) return 'N/A';
    $visible = array_slice($unique, 0, $limit);
    $overflow = count($unique) - count($visible);
    $display = implode(', ', array_map('get_the_title', $visible));
    if ($overflow > 0) $display .= ' + ' . $overflow . ' More';
    return $display;
}

// return a list of ships from itinerary or list
// evaluates the raw departure info, so this will include any current departure even if sold out
function getShipsFromItineraries($itineraries)
{
    $ships = [];
    $itineraryList = is_array($itineraries) ? $itineraries : [$itineraries];

    foreach ($itineraryList as $itinerary) {
        $use_automation = get_field('use_automation', $itinerary);
        $itineraryDepartures = $use_automation ? get_field('automation_departure_data', $itinerary) : get_field('departures', $itinerary);
        if (!is_array($itineraryDepartures) || empty($itineraryDepartures)) continue;

        foreach ($itineraryDepartures as $d) {
            $isCurrent = strtotime($d['date']) >= strtotime(date('Y-m-d'));
            if ($isCurrent && !empty($d['ship'])) {
                $ships[] = $d['ship'];
            }
        }
    }

    $unique_ships = getUniquePostsFromArrayOfPosts($ships);
    usort($unique_ships, 'sortBySearchRank');
    return $unique_ships;
}

function getShipsDisplay($ships)
{
    if (!is_array($ships) || !is_countable($ships) || count($ships) == 0) {
        return "N/A";
    }

    $shipCount = count($ships);
    $display = "";
    $x = 1;
    foreach ($ships as $s) {
        $name = get_the_title($s);
        $display .= $x < $shipCount ? $name . ", " : $name;
        $x++;
    }
    return $display;
}



// utility to sort by search rank
function sortBySearchRank($a, $b)
{
    if (is_object($a) && is_object($b)) {
        $searchRankA = intval(get_field('search_rank', $a->ID));
        $searchRankB = intval(get_field('search_rank', $b->ID));
        return $searchRankB <=> $searchRankA;
    }
    return 0;
}

function getItinerariesFromRegion($region, $limit = -1)
{
    $bypass_precalculated_queries = get_field('bypass_precalculated_queries', 'options');
    if (!$bypass_precalculated_queries) {
        $metaQuery = array(
            array(
                'key'     => 'precalculated_available',
                'value'   => '1',
                'compare' => '='
            )
        );

        if ($region != null) {
            $metaQuery[] = array(
                'key'     => 'precalculated_region',
                'value'   => $region->ID,
                'compare' => '=',
                'type'    => 'NUMERIC'
            );
        }

        $queryArgs = array(
            'post_type'      => 'rfc_itineraries',
            'posts_per_page' => $limit,
            'meta_key'       => 'search_rank',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
            'meta_query'     => $metaQuery
        );

        return get_posts($queryArgs);
    } else {
        // NON-PRECALCULATED VERSION (SLOW)
        $queryArgs = array(
            'post_type' => 'rfc_itineraries',
            'posts_per_page' => -1,
            'meta_key' => 'search_rank',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        );
        $itineraries = get_posts($queryArgs);
        $itineraryList = [];
        if ($region == null) {
            $itineraryList = $itineraries;
        } else {
            foreach ($itineraries as $itinerary) {
                $routes = get_field('route', $itinerary) ?: [];
                foreach ($routes as $route) {
                    if (get_field('region', $route) == $region) {
                        $itineraryList[] = $itinerary;
                        break;
                    }
                }
            }
        }
        $uniqueItinerariesList = getUniquePostsFromArrayOfPosts($itineraryList);
        return $limit === -1 ? $uniqueItinerariesList : array_slice($uniqueItinerariesList, 0, $limit);
    }
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
// this will include sold out since it doesnt consider the departures
function getShipItineraries($ship, $region = null)
{
    $bypass_precalculated_queries = get_field('bypass_precalculated_queries', 'options');
    if (!$bypass_precalculated_queries) {
        $metaQuery = array(
            array(
                'key'     => 'precalculated_ships',
                'value'   => '"ID";i:' . $ship->ID . ';',
                'compare' => 'LIKE'
            )
        );
        if ($region != null) {
            $metaQuery[] = array(
                'key'     => 'precalculated_region',
                'value'   => $region->ID,
                'compare' => '=',
                'type'    => 'NUMERIC'
            );
        }

        $queryArgs = array(
            'post_type'      => 'rfc_itineraries',
            'posts_per_page' => -1,
            'meta_key'       => 'length_in_nights',
            'orderby'        => 'meta_value_num',
            'order'          => 'ASC',
            'meta_query'     => $metaQuery
        );
        return get_posts($queryArgs);
    } else {
        // NON-PRECALCULATED VERSION (SLOW)
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
                $precalculated_region = get_field('precalculated_region', $itinerary);
                $itineraryRegionID = $precalculated_region ? $precalculated_region : getItineraryRegionId($itinerary);
                if ($region->ID != $itineraryRegionID) {
                    continue;
                }
            }

            $precalculated_ships = get_field('precalculated_ships', $itinerary);
            $ships = $precalculated_ships ? $precalculated_ships :  getShipsFromItineraries($itinerary);
            $match = in_array($ship->ID, array_map(fn($s) => $s->ID, $ships));
            if (!$match) continue;
            $itineraryList[] = $itinerary;
        }

        return $itineraryList;
    }
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

        if (!($departure['lowestPrice'] > 0)) { // if sold out skip
            continue;
        }

        if ($count <= $limit) {
            // month grouping
            $newMonth = false;
            if ($monthNumber == null) {
                $monthNumber = date('m', strtotime($departure['departureDate']));
                $newMonth = true;
            } else {
                if ($monthNumber != date('m', strtotime($departure['departureDate']))) {
                    $newMonth = true;
                }
            }

            if ($newMonth) {
                $displayString .= date('M j', strtotime($departure['departureDate']));
            } else {
                $displayString .=  date('j', strtotime($departure['departureDate']));
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
        if (($departure['lowestPrice'] > 0)) {
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
            if ($countryZone && $countryZone->ID == $zone->ID) {
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
