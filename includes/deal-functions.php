<?php
// DEALS ----------------------------------------------------------------------------------------------
// get a list of unique deals from a list of departures
function getDealsFromDepartureList($departures, $getSpecials = false)
{
    $uniqueDealsArray = [];
    foreach ($departures as $d) {
        $deals = $d['Deals'];
        foreach ($deals as $deal) {
            $is_active = get_field('is_active', $deal);
            $has_expiry_date = get_field('has_expiry_date', $deal);
            $is_special_departure = get_field('is_special_departure', $deal);
            if ($is_special_departure != $getSpecials) { // skip inactive deals
                continue;
            }
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
            if (!in_array($deal, $uniqueDealsArray)) { // only add non dulpicates
                $uniqueDealsArray[] = $deal;
            }
        }
    }
    return $uniqueDealsArray;
}

// get a list of active deals from a single departure
function getDealsFromSingleDeparture($departure)
{
    $dealsArray = [];
    $deals = $departure['deals'];
    foreach ($deals as $deal) {
        $is_active = get_field('is_active', $deal);
        $has_expiry_date = get_field('has_expiry_date', $deal);
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
        $dealsArray[] = $deal;
    }
    return $dealsArray;
}

// get a list of departure dates that have a given deal
function getDeparturesWithDeal($departures, $deal)
{
    $departuresWithDealsList = [];
    foreach ($departures as $departure) {
        if ($departure['Deals'] && in_array($deal, $departure['Deals'])) {
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

    return get_posts($queryArgs);
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
            if (is_array($deals)) { // if matching an array of deals
                foreach ($deals as $deal) {
                    if ($departure['Deals'] && in_array($deal, $departure['Deals'])) {
                        $hasDeal = true;
                    }
                }
            } else { // if matchine a single deal
                if ($departure['Deals'] && in_array($deals, $departure['Deals'])) {
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

// get a string display of departures dates, grouped by month, comma seperated and trucated with remainder
function getDateListDisplay($departures, $limit)
{
    $length = count($departures);
    $displayString = "";
    $count = 1;
    $overCount = 0;
    $monthNumber = null;
    foreach ($departures as $departure) {

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

    echo $displayString;
}

// get a string display number of deals, with plurality 
function getDealsDisplay($deals, $specialDepartures = false)
{
    $displayText = '';
    if ($deals) {
        if (count($deals) == 1) {
            $displayText = $specialDepartures ? '1 special departure' : '1 deal';
        } else {
            $displayText =  count($deals);
            $displayText .= $specialDepartures ? 'special departures' : 'deals';
        }
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
