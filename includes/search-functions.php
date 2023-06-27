<?php
//Upper bounded list of products for search results
function getSearchPosts($region, $routes, $styles, $minLength, $maxLength, $datesArray, $searchInput, $sorting, $pageNumber, $viewType)
{

    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_itineraries',
    );


    // regions - generate list of possible routes (IDs)
    $regionalRoutes = [];
    if ($region != null) {
        $routeCriteria = array(
            'posts_per_page' => -1,
            'post_type' => 'rfc_routes',
            "meta_key" => "region",
            "meta_value" => $region
        );
        $regionalRoutes = wp_list_pluck(get_posts($routeCriteria), 'ID');
    } else {
        $routeCriteria = array(
            'posts_per_page' => -1,
            'post_type' => 'rfc_routes',
        );
        $regionalRoutes = wp_list_pluck(get_posts($routeCriteria), 'ID');
    }

    // routes
    if ($routes != null) {
        $matchedRoutes = array_intersect($routes, $regionalRoutes); // find routes that are within regional selection

        $queryargs = array();
        $queryargs['relation'] = 'OR';
        foreach ($matchedRoutes as $route) {
            $queryargs[] = array(
                'key'     => 'route',
                'value'   => '"' . $route . '"', //value must be in parenthesis to get ACF exact match, and use LIKE
                'compare' => 'LIKE'
            );
        }
        $args['meta_query'][] = $queryargs;
    }


    // styles
    if ($styles != null) {
        $queryargs = array();
        $queryargs['relation'] = 'OR';
        foreach ($styles as $style) {
            $queryargs[] = array(
                'key'     => 'styles',
                'value'   => '"' . $style . '"', //value must be in parenthesis to get ACF exact match, and use LIKE
                'compare' => 'LIKE'
            );
        }
        $args['meta_query'][] = $queryargs;
    }



    $posts = get_posts($args); //Stage I posts
    $formattedPosts = $posts;
    //formatFilterSearch($posts, $minLength, $maxLength, $datesArray, $charterFilter, $sorting, $searchInput, $viewType); //Stage II metadata





    $resultsPerPage = 12;
    if ($viewType == 'grid') {
        $resultsPerPage = 30;
    }

    $resultsTotal = count($formattedPosts);

    $pageCount = floor($resultsTotal / $resultsPerPage);
    if ($resultsTotal % $resultsPerPage != 0) {
        $pageCount++;
    };




    if (is_numeric($pageNumber) && $pageNumber != 'all') {
        $startIndex = (($pageNumber - 1) * $resultsPerPage);
        $formattedPosts = array_slice($formattedPosts, $startIndex, $resultsPerPage);
    } else if ($pageNumber == 'all') {
        $formattedPosts = array_slice($formattedPosts, 0, 50);
    } else {
        $startIndex = 0;
        $formattedPosts = array_slice($formattedPosts, $startIndex, $resultsPerPage);
    }

    //return object with results, result count, and page count seperately
    $searchResults = [
        'results' => $formattedPosts,
        'resultsCount' => $resultsTotal,
        'pageCount' => $pageCount,
        'pageNumber' => $pageNumber,
        'viewType' => $viewType,
    ];



    return $searchResults;
}


//Stage II - metadata
function formatFilterSearch($posts, $minLength, $maxLength, $datesArray, $charterFilter, $sorting, $searchInput, $viewType)
{

    $results = [];


    //loop through posts (travel type, experience, destinations --> already filtered)
    foreach ($posts as $p) {

        $postType = get_post_type($p);

        $productTitle = ($postType  == 'rfc_tours') ? get_field('tour_name', $p) : get_the_title($p);

        if ($searchInput != null) {
            if (!preg_match("/{$searchInput}/i", $productTitle)) {
                continue;
            }
        }


        $productTypeDisplay = "";
        $productTypeCta = "";
        $searchRank = intval(get_field('search_rank', $p) ?? 1);
        $snippet = get_field('top_snippet', $p);
        $featuredImage = get_field('featured_image', $p); //need specific image size  - 600x500
        $productImageId = '';

        if ($featuredImage) {
            $productImageId = $featuredImage['id'];
        }


        $vesselCapacity = 0;
        $numberOfCabins = 0;

        $itineraryCountDisplay = "";
        $itineraryLengthDisplay = "";
        $itineraryLengthDisplayCharter = "";

        $vesselCapacityDisplay = "";
        $numberOfCabinsDisplay = "";




        $charterAvailable = false;
        $charterOnly = false;

        $productLowestPrice = 0;
        $productLowestCharterPrice = 0;

        $postUrl = get_permalink($p);





        //TOURS ---------------------------------------
        if ($postType  == 'rfc_tours') {

            $lengthInDays = get_field('length', $p);

            //Length filter
            if ($minLength != null) {
                if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                    continue; // skip to next if not in range
                }
            }

            $productTypeCta = 'Tour';
            $productTypeDisplay = 'Private Tour';


            //Price / Length -- (no itinerary count on tours)
            $pricePackages = get_field('price_packages', $p);
            $productLowestPrice = lowest_tour_price($pricePackages, date('Y')); //current year only for consistency

            $itineraryLengthDisplay = $lengthInDays . " Days";
        };


        //CRUISES / LODGES -------------------------------------------------------
        if ($postType  == 'rfc_lodges' || $postType  == 'rfc_cruises') {


            $cruiseData = get_field('cruise_data', $p);


            if ($postType  == 'rfc_cruises') { //CRUISES 
                $productTypeCta = 'Cruise';


                //Charter Filters
                $charterAvailable = get_field('charter_available', $p);
                if ($charterAvailable) {
                    $charterOnly = get_field('charter_only', $p);
                }
                if ($charterFilter == true && $charterAvailable != true) {
                    continue;
                }

                //Product Type Display
                if ($charterOnly == true) {
                    $productTypeDisplay = 'Private Charter';
                } else {
                    $cruiseType = get_field('cruise_type', $p); //River Cruise / Coastal Cruise
                    $productTypeDisplay = $cruiseType . ' Cruise';
                }

                //Price / Length
                $itineraryCount = 0;
                $itineraryLengthValues = [];
                $itineraryPriceValues = [];
                $itineraryPriceValuesCharter = [];

                if (array_key_exists("Itineraries", $cruiseData)) {
                    foreach ($cruiseData['Itineraries'] as $itinerary) {

                        $lengthInDays = $itinerary['LengthInDays'];

                        if ($minLength != null) {
                            if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                                continue; // skip to next itinerary if not in range
                            }
                        }

                        if ($itinerary['CharterAmount'] > 0) {
                            $itineraryPriceValuesCharter[] = $itinerary['CharterAmount'];
                        }




                        if ($charterFilter && $charterOnly == true) {

                            $itineraryCount = 1; //Charter Only + Charter Filter -- bypass availability
                        } else { //FIT

                            if ($charterOnly == false) {
                                if ($itinerary['Departures'] != null) {

                                    if ($datesArray) {

                                        //check date selection for availability
                                        $match = false;
                                        foreach ($datesArray as $dateSelection) {
                                            $ds = explode("-", $dateSelection);
                                            $dYear = $ds[0];
                                            $dMonth = $ds[1];

                                            foreach ($itinerary['DepartureYears'] as $dy) {

                                                if ($dy['Year'] == $dYear) {

                                                    $departureMonths = $dy['DepartureMonths'];
                                                    foreach ($departureMonths as $dm) {

                                                        if ($dm['Month'] == $dMonth && $dm['HasDepartures'] == true) {
                                                            $match = true;
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        if (!$match) { //continue to next iteration of departure loop (date doesnt match any selection range)
                                            continue;
                                        }
                                    }


                                    $itineraryLengthValues[] = $itinerary['LengthInDays'];
                                    $itineraryCount += 1;
                                    $itineraryPriceValues[] = $itinerary['LowestPrice'];
                                } else {

                                    continue; // no departure dates to begin with
                                }
                            } else {
                                $itineraryCount = 1; //TODO: check intinerary['IsOngoing] make sure is included
                            }
                        }
                    }
                }



                //Price / Length - Charter
                if (count($itineraryPriceValuesCharter) > 0) {
                    $productLowestCharterPrice = min($itineraryPriceValuesCharter);
                }

                $itineraryLengthDisplayCharter = get_field('charter_min_days', $p) . " Days +";
            } else { //LODGES
                $productTypeDisplay = 'Lodge Stay';
                $productTypeCta = 'Lodge';

                $itineraryCount = 0;
                $itineraryLengthValues = [];
                $itineraryPriceValues = [];
                if (array_key_exists("Itineraries", $cruiseData)) {
                    foreach ($cruiseData['Itineraries'] as $itinerary) {
                        $lengthInDays = $itinerary['LengthInDays'];

                        if ($minLength != null) {
                            if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                                continue; // skip to next
                            }
                        }

                        $itineraryLengthValues[] = $itinerary['LengthInDays'];
                        $itineraryCount += 1;
                        $itineraryPriceValues[] = $itinerary['LowestPrice'];
                    }
                }
            }



            if ($itineraryCount == 0) {
                continue;
            }

            //Itinerary Count Display (Cruise /Lodge)
            $itineraryCountDisplay = $itineraryCount . (($itineraryCount > 1) ? " Itineraries" : " Itinerary");


            //Lowest Price
            if (count($itineraryPriceValues) > 0) {

                $productLowestPrice = min($itineraryPriceValues);
            }
            if ($charterOnly == true) {
                $productLowestPrice = $productLowestCharterPrice;
            }

            //Itinerary Length Display (Cruise /Lodge)
            if (count($itineraryLengthValues) > 0) {
                $rangeFrom = min($itineraryLengthValues);
                $rangeTo = max($itineraryLengthValues);

                if ($rangeFrom != $rangeTo) {
                    $itineraryLengthDisplay = $rangeFrom . " - " . $rangeTo . " Days";
                } else {
                    $itineraryLengthDisplay = $rangeFrom . " Days";
                }
            }



            //Capacity Attributes Display -- (Cruise /Lodge)
            $vesselCapacity = get_field('vessel_capacity', $p);
            $numberOfCabins = get_field('number_of_cabins', $p);

            if ($numberOfCabins) {
                $numberOfCabinsDisplay = $numberOfCabins . " Cabins";
            }
            if ($vesselCapacity) {
                $vesselCapacityDisplay = $vesselCapacity . " Guests";
            }
        }


        //check if has promos
        $dealAvailable = false;
        $dealPosts = [];
        $dealPosts = listDealsForProduct($p);
        if (count($dealPosts) > 0) {
            $dealAvailable = true;
        }

        $charterDealAvailable = false;
        $charterDealPosts = [];
        $charterDealPosts = listDealsForProduct($p, true);
        if (count($charterDealPosts) > 0) {
            $charterDealAvailable = true;
        }

        $results[] = (object) array(
            'post' => $p,
            'postUrl' => $postUrl,
            'postType' => $postType,
            'productTypeDisplay' => $productTypeDisplay,
            'productTypeCta' => $productTypeCta,
            'productTitle' => $productTitle,
            'productImageId' => $productImageId, //need image ID and then get custom size -- return URL here
            'snippet' => $snippet,
            'destinations' => get_field('destinations', $p),
            'locations' => get_field('locations', $p),
            'experiences' => get_field('experiences', $p),
            'lowestPrice' => $productLowestPrice,
            'lowestCharterPrice' => $productLowestCharterPrice,
            'itineraryLengthDisplay' => $itineraryLengthDisplay,
            'itineraryLengthDisplayCharter' => $itineraryLengthDisplayCharter,

            'itineraryCountDisplay' => $itineraryCountDisplay,
            'dealAvailable' => $dealAvailable,
            'dealPosts' => $dealPosts,
            'charterDealAvailable' => $charterDealAvailable,
            'charterDealPosts' => $charterDealPosts,
            'charterOnly' => $charterOnly,
            'charterAvailable' => $charterAvailable,
            'vesselCapacity' => $vesselCapacity,
            'vesselCapacityDisplay' => $vesselCapacityDisplay,
            'numberOfCabins' => $numberOfCabins,
            'numberOfCabinsDisplay' => $numberOfCabinsDisplay,
            'searchRank' => $searchRank

        );
    }

    if ($sorting == 'popularity') {
        usort($results, "sortRank"); //sort by search rank score
    }

    if ($sorting == 'high') {
        if ($charterFilter == true) {
            usort($results, "sortPriceHighCharter");
        } else {
            usort($results, "sortPriceHigh");
        }
    }

    if ($sorting == 'low') {
        if ($charterFilter == true) {
            usort($results, "sortPriceLowCharter");
        } else {
            usort($results, "sortPriceLow");
        }
    }


    return $results;
}



//SORTING -----------------------
//Rank
function sortRank($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->searchRank - $a->searchRank;
    }
}

//Price
//FIT
function sortPriceHigh($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->lowestPrice - $a->lowestPrice;
    }
}

function sortPriceLow($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $a->lowestPrice - $b->lowestPrice;
    }
}

//Charter
function sortPriceHighCharter($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $b->lowestCharterPrice - $a->lowestCharterPrice;
    }
}

function sortPriceLowCharter($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return $a->lowestCharterPrice - $b->lowestCharterPrice;
    }
}
