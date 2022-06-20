<?php
//Get lowest price (Price From)
function lowest_property_price($cruise_data, $fromLength, $fromYear, $currentYearOnly = false)
{

    $prices = [];
    $lowestPrice = 0;
    if (array_key_exists('Itineraries', $cruise_data)) {
        $itineraries = $cruise_data['Itineraries'];

        if (count($itineraries) > 0) {

            foreach ($itineraries as $i) {
                // needs to check If lodge and Is Sample then skip

                if ($i['LengthInDays'] >= $fromLength) {
                    $rateYears = $i['RateYears'];
                    foreach ($rateYears as $r) {

                        //Include sliding range of years
                        if ($currentYearOnly == false) {
                            if ($r['Year'] >= $fromYear) {
                                $rates = $r['Rates'];
                                $rateValues = [];
                                foreach ($rates as $rate) {
                                    if ($rate['WebAmount'] > 0) {
                                        $rateValues[] = $rate['WebAmount'];
                                    }
                                }
                                if ($rateValues) {
                                    $prices[] = min($rateValues);
                                }
                            }
                        } else { //Shown in product header
                            if ($r['Year'] == date("Y")) {
                                $rates = $r['Rates'];
                                $rateValues = [];
                                foreach ($rates as $rate) {
                                    if ($rate['WebAmount'] > 0) {
                                        $rateValues[] = $rate['WebAmount'];
                                    }
                                }
                                if ($rateValues) {
                                    $prices[] = min($rateValues);
                                }
                            }
                        }
                    }
                }
            }

            if (count($prices) > 0) {
                $lowestPrice = min($prices);
            } else {
                $lowestPrice = 0;
            }
        } else {
            $lowestPrice = 0;
        }
    }



    return $lowestPrice;
}


//Range (From x Days to x Days)
function itineraryRange($cruise_data, $separator, $onlyMin = false)
{
    $returnString = "";
    if (array_key_exists('Itineraries', $cruise_data)) {
        $itineraries = $cruise_data['Itineraries'];
        $itineraryValues  = [];


        if (count($itineraries) > 0) {
            foreach ($itineraries as $i) {
                $itineraryValues[] = $i['LengthInDays'];
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
