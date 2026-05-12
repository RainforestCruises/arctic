<?php
// returns the primary region post object, or null if no primary region is set
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

// get list of regions from itinerary post (should only be one, but in case of multiple routes with different regions, will return the first region)
// returns the ID of the region
function getItineraryRegionId($itinerary)
{
    $routes = get_field('route', $itinerary) ?: []; // PHP 8 FIX
    $regionsList = [];
    if (empty($routes)) {
        return [];
    }
    foreach ($routes as $route) {
        $regionsList[] = get_field('region', $route);
    }
    $uniqueRegionsList = getUniquePostsFromArrayOfPosts($regionsList);
    return $uniqueRegionsList[0]->ID ?? null; // there should always only be one
}



// Get routes for a specific region, or all routes if no region specified. 
// Sorted with ranked routes returned first.
function getRoutesFromRegion($region = null)
{
    $regionFilter = [];
    if ($region) {
        $ids = is_array($region)
            ? array_map(fn($r) => is_object($r) ? $r->ID : $r, $region)
            : [is_object($region) ? $region->ID : $region];

        $regionFilter = [['key' => 'region', 'value' => $ids, 'compare' => 'IN']];
    }

    $baseArgs = [
        'post_type'      => 'rfc_routes',
        'posts_per_page' => -1,
    ];

    $rankedRoutes = get_posts(array_merge($baseArgs, [
        'orderby'    => 'meta_value_num title',
        'meta_key'   => 'search_rank',
        'order'      => 'DESC',
        'meta_query' => ['relation' => 'AND', ...$regionFilter, ['key' => 'search_rank', 'value' => '', 'compare' => '!=']],
    ]));

    $unrankedRoutes = get_posts(array_merge($baseArgs, [
        'orderby'    => 'title',
        'order'      => 'ASC',
        'meta_query' => ['relation' => 'AND', ...$regionFilter, [
            'relation' => 'OR',
            ['key' => 'search_rank', 'value' => '', 'compare' => '='],
            ['key' => 'search_rank', 'compare' => 'NOT EXISTS'],
        ]],
    ]));

    return array_merge($rankedRoutes, $unrankedRoutes);
}



// gets a list of every unique region a ship sails
function getShipRegions($ship)
{
    $itineraries = getShipItineraries($ship); // this is expensive
    $regionsList = [];
    foreach ($itineraries as $itinerary) {
        $precalculated_region_itinerary = get_field('precalculated_region', $itinerary);
        if ($precalculated_region_itinerary) {
            $regionsList[] = get_post($precalculated_region_itinerary); // get region objext
        } else {
            $regionId = getItineraryRegionId($itinerary);
            $regionsList[] = get_post($regionId);  // get region objext
        }
    }

    $uniqueShipRegionsList = getUniquePostsFromArrayOfPosts($regionsList);
    return ($uniqueShipRegionsList);
}

function getBadgeClass($region)
{
    $badgeClass = 'badge--' . strtolower(get_the_title($region));
    return $badgeClass;
}
