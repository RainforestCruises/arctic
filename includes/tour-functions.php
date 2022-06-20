<?php

//Get lowest price (Price From)
function lowest_tour_price($price_packages, $fromYear)
{

    $priceList = [];

    if ($price_packages) {
        foreach ($price_packages as $price_package) {
            if ($price_package['year'] >= $fromYear) {
                $priceList[] = $price_package['price'];
            }
        }
    }

    $lowestPrice = 0;
    if ($priceList) {
        sort($priceList);
        $lowestPrice = $priceList[0];
    }

    return $lowestPrice;
}

//Get first year that prices exist
function initial_price_year($price_packages)
{
    
    $fromYear = date('Y');
    $priceList = [];
    
    if ($price_packages) {
        foreach ($price_packages as $price_package) {
            if ($price_package['year'] >= $fromYear) {
                $priceList[] = $price_package['year'];
            }
        }
    }

    
    if ($priceList) {
        sort($priceList);
        $lowestYear = $priceList[0];
    }
    
    return $lowestYear;
}

function tours_available($destination, $experience)
{

    $count = 0;
    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_tours',
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
    $tourPosts = get_posts($postCriteria);
    $count = count($tourPosts);

    return $count;
}



function tours_available_region($region, $experience)
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
    $postCriteria = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_tours',
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
    $tourPosts = get_posts($postCriteria);
    $count = count($tourPosts);
    return $count;

}
