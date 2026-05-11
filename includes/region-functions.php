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



// Get routes for a specific region, or all routes if no region specified. Ranked routes will be returned first.
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
        'meta_query' => ['relation' => 'AND', ...$regionFilter, ['relation' => 'OR',
            ['key' => 'search_rank', 'value' => '', 'compare' => '='],
            ['key' => 'search_rank', 'compare' => 'NOT EXISTS'],
        ]],
    ]));

    return array_merge($rankedRoutes, $unrankedRoutes);
}



// gets a list of unique regions per ship
function getShipRegions($ship)
{
    $itineraries = getShipItineraries($ship);
    $regionsList = [];
    foreach ($itineraries as $itinerary) {
        $routes = get_field('route', $itinerary) ?: []; // PHP 8 FIX
        foreach ($routes as $route) {
            $regionsList[] = get_field('region', $route);
        }
    }

    $uniqueShipRegionsList = getUniquePostsFromArrayOfPosts($regionsList);
    return ($uniqueShipRegionsList);
}