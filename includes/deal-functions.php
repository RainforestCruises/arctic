<?php
// DEALS ----------------------------------------------------------------------------------------------
// get a list of unique deals from a list of departures
function getDealsFromDepartureList($departures, $getSpecials = false)
{
    $uniqueDealsArray = [];

    foreach ($departures as $d) {
        $deals = ($getSpecials) ? $d['SpecialDepartures'] : $d['Deals'];
        foreach ($deals as $deal) {
            $is_active = get_field('is_active', $deal);
            $has_expiry_date = get_field('has_expiry_date', $deal);
            $has_activation_date = get_field('has_activation_date', $deal);

            if (!$is_active) { // skip inactive deals
                continue;
            }
            if ($has_expiry_date) { // skip expired deals
                $expiry_date =  get_field('expiry_date', $deal);
                $isCurrent = strtotime($expiry_date) >= strtotime(date('Y-m-d'));
                if (!$isCurrent) {
                    continue;
                }
            }
            if ($has_activation_date) { // skip prior to activated deals
                $activation_date =  get_field('activation_date', $deal);
                $isCurrent = strtotime($activation_date) <= strtotime(date('Y-m-d'));
                if (!$isCurrent) {
                    continue;
                }
            }
            if (!in_array($deal, $uniqueDealsArray)) { // only add non dulpicates
                $uniqueDealsArray[] = $deal;
            }
        }
    }
    return $uniqueDealsArray;
}

// META OBJECT
// get a list of active deals from a single departure 
function getDealsFromSingleDeparture($departure, $getSpecials = false)
{
    $dealsArray = [];
    $deals = $departure['deals'];
    foreach ($deals as $deal) {
        $is_active = get_field('is_active', $deal);
        $has_expiry_date = get_field('has_expiry_date', $deal);
        $has_activation_date = get_field('has_activation_date', $deal);

        $is_special_departure = get_field('is_special_departure', $deal);
        if ($is_special_departure != $getSpecials) { // skip type
            continue;
        }
        if (!$is_active) { // skip inactive
            continue;
        }
        if ($has_expiry_date) { // skip expired 
            $expiry_date =  get_field('expiry_date', $deal);
            $isCurrent = strtotime($expiry_date) >= strtotime(date('Y-m-d'));
            if (!$isCurrent) {
                continue;
            }
        }
        if ($has_activation_date) { // skip prior to activated deals
            $activation_date =  get_field('activation_date', $deal);
            $isCurrent = strtotime($activation_date) <= strtotime(date('Y-m-d'));
            if (!$isCurrent) {
                continue;
            }
        }
        $dealsArray[] = $deal;
    }
    usort($dealsArray, "sortDealRank"); // sort by search rank score

    return $dealsArray;
}

// get a list of departure dates that have a given deal
function getDeparturesWithDeal($departures, $deal)
{
    $departuresWithDealsList = [];
    foreach ($departures as $departure) {
        $combinedDepartureDeals = array_merge($departure['Deals'], $departure['SpecialDepartures']);

        if ($combinedDepartureDeals && in_array($deal, $combinedDepartureDeals)) {
            $departuresWithDealsList[] = $departure;
        }
    }
    return $departuresWithDealsList;
}

// get a list of deal objects per deal category
function getDealsInCategory($category)
{
    //related posts
    $queryArgs = array(
        'post_type' => 'rfc_deals',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'category',
                'value'   =>  $category->ID,
                'compare' => 'EQUALS'
            )
        )
    );

    $deals = get_posts($queryArgs);
    foreach ($deals as $deal) {
        $is_active = get_field('is_active', $deal);
        $has_expiry_date = get_field('has_expiry_date', $deal);
        $has_activation_date = get_field('has_activation_date', $deal);

        if (!$is_active) { // skip inactive deals
            continue;
        }
        if ($has_expiry_date) { // skip expired deals
            $expiry_date =  get_field('expiry_date', $deal);
            $isCurrent = strtotime($expiry_date) >= strtotime(date('Y-m-d'));
            if (!$isCurrent) {
                continue;
            }
        }
        if ($has_activation_date) { // skip prior to activated deals
            $activation_date =  get_field('activation_date', $deal);
            $isCurrent = strtotime($activation_date) <= strtotime(date('Y-m-d'));
            if (!$isCurrent) {
                continue;
            }
        }
        $dealsArray[] = $deal;
    }

    usort($dealsArray, "sortDealRank"); // sort by search rank score

    return $dealsArray;
}


// get a list of itineraries that have a particular deal, accepts a single deal or array of deals to match
function getItinerariesWithDeal($deals)
{
    $queryArgs = array(
        'post_type' => 'rfc_itineraries',
        'posts_per_page' => -1,
    );
    $itineraries = get_posts($queryArgs);

    $itinerariesWithDeal = [];
    foreach ($itineraries as $itinerary) {
        $departures = getDepartureList($itinerary);
        $hasDeal = false;
        foreach ($departures as $departure) {
            $combinedDepartureDeals = array_merge($departure['Deals'], $departure['SpecialDepartures']);

            if (is_array($deals)) { // if matching an array of deals
                foreach ($deals as $deal) {
                    if ($combinedDepartureDeals && in_array($deal, $combinedDepartureDeals)) {
                        $hasDeal = true;
                    }
                }
            } else { // if matchine a single deal
                if ($combinedDepartureDeals && in_array($deals, $combinedDepartureDeals)) {
                    $hasDeal = true;
                }
            }
        }
        if ($hasDeal) {
            $itinerariesWithDeal[] = $itinerary;
        }
    }
    return $itinerariesWithDeal;
}

// get a list of itineraries that have a particular deal, accepts a single deal or array of deals to match
function getShipsWithDeal($deals)
{
    $queryArgs = array(
        'post_type' => 'rfc_cruises',
        'posts_per_page' => -1,
    );
    $ships = get_posts($queryArgs);

    $shipsWithDeal = [];
    foreach ($ships as $ship) {
        $departures = getDepartureList($ship);
        $hasDeal = false;
        foreach ($departures as $departure) {
            $combinedDepartureDeals = array_merge($departure['Deals'], $departure['SpecialDepartures']);
            if (is_array($deals)) { // if matching an array of deals
                foreach ($deals as $deal) {
                    if ($combinedDepartureDeals && in_array($deal, $combinedDepartureDeals)) {
                        $hasDeal = true;
                    }
                }
            } else { // if matchine a single deal
                if ($combinedDepartureDeals && in_array($deals, $combinedDepartureDeals)) {
                    $hasDeal = true;
                }
            }
        }
        if ($hasDeal) {
            $shipsWithDeal[] = $ship;
        }
    }
    return $shipsWithDeal;
}



// get a string display number of deals, with plurality 
function getDealsDisplay($deals)
{
    $displayText = '';
    if ($deals) {
        $displayText = count($deals);
        $displayText .= (count($deals) == 1) ? ' deal' : ' deals';
    }
    return $displayText;
}

// get a string display number of special departures, with plurality 
function getSpecialDeparturesDisplay($specialDepartures)
{
    $displayText = '';
    if ($specialDepartures) {
        $displayText = count($specialDepartures);
        $displayText .= (count($specialDepartures) == 1) ? ' special departure' : ' special departures';
    }
    return $displayText;
}


// get a count of days until a deal expires
function getDaysUntilExpiry($expiry_date)
{
    $now = time();
    $datediff = strtotime($expiry_date) - $now;
    $daysUntilExpiry = round($datediff / (60 * 60 * 24));
    return $daysUntilExpiry;
}


// Sorting - rank
function sortDealRank($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->search_rank - $a->search_rank;
    }
}

