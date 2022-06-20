//TOURS ---------------------------------------
        if ($postType  == 'rfc_tours') {

            $lengthInDays = get_field('length', $p);

            //length filter
            if ($minLength != null) {
                if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                    continue; // skip to next if not in range
                }
            }


            $itineraryLengthDisplay = $lengthInDays . " Days";
            $productTitle = get_field('tour_name', $p);
            $productTypeDisplay = 'Private Tour';
            $productTypeCta = 'Tour';
            $pricePackages = get_field('price_packages', $p);
            $productLowestPrice = lowest_tour_price($pricePackages, date('Y')); //current year only for consistency
            // $prices = [];
            // $priceValues = [];

            // for ($x = 0; $x <= 1; $x++) { //loop twice
            //     $year = $startYear + $x;

            //     $lowestPrice = lowest_tour_price($pricePackages, $year);
            //     $prices[] = (object) array(
            //         'year' => $year,
            //         'lowestPrice' => $lowestPrice, //lowest per price package
            //     );

            //     if ($lowestPrice != 0) {
            //         $priceValues[] = $lowestPrice;
            //     }
            // }

            // //lowest price for itinerary
            // if ($priceValues) {
            //     $itineraryLowestPrice = min($priceValues);
            // }



            // $itineraries[] = (object) array(
            //     'lengthInDays' => $lengthInDays,
            //     'prices' => $prices, //lowest per price package -- Break down yearly (year array in tour is similar to departure dates array for cruises)
            //     'lowestItineraryPrice' => $itineraryLowestPrice
            // );
        };


        //CRUISES / LODGES -------------------------------------------------------
        if ($postType  == 'rfc_lodges' || $postType  == 'rfc_cruises') {
            $productTitle = get_the_title($p);



            $cruiseData = get_field('cruise_data', $p);
            $vesselCapacity = get_field('vessel_capacity', $p);
            $numberOfCabins = get_field('number_of_cabins', $p);

            if ($postType  == 'rfc_cruises') { //CRUISES 
                $productTypeCta = 'Cruise';
                $charterAvailable = get_field('charter_available', $p);

                if ($charterAvailable) {
                    $charterOnly = get_field('charter_only', $p);
                }

                if($charterOnly == true){
                    $productTypeDisplay = 'Private Charter';
                } else {
                    $cruiseType = get_field('cruise_type', $p);
                    $productTypeDisplay = $cruiseType . ' Cruise';
                }


                if ($charterFilter == true && $charterAvailable != true) {
                    continue;
                }


                //Cruise Itineraries
                if (array_key_exists('Itineraries', $cruiseData)) {
                    foreach ($cruiseData['Itineraries'] as $itinerary) {

                        $lengthInDays = $itinerary['LengthInDays'];
    
                        if ($minLength != null) {
                            if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                                continue; // skip to next itinerary if not in range
                            }
                        }
    
    
                        if ($charterFilter && $charterOnly == true) { //Charter Only + Charter Filter -- bypass availability
                            $itineraries[] = (object) array(
                                'lengthInDays' => $lengthInDays,
                                'departureCount' => 1,
                                'lowestItineraryPrice' => 0
                            );
                        } else { //FIT
                            $departures = [];
                            $priceValues = [];
    
                            if ($itinerary['Departures'] != null) {
                                //-------------could loop departure months here instead
                                //have lowest price already


                                foreach ($itinerary['Departures'] as $d) { //departure loop
    
    
                                    if ($datesArray) {
    
                                        $match = false;
                                        foreach ($datesArray as $dateSelection) { //selection loop
    
                                            $testdate = strtotime($d['DepartureDate']); // this will be converted to YYYY-MM-DD
                                            $selectedDate = strtotime($dateSelection);
    
                                            if (date('Ym', $selectedDate) == date('Ym', $testdate)) { //test Ym (year + month)
                                                $match = true;
                                            }
                                        }
    
                                        if (!$match) { //continue to next iteration of departure loop (date doesnt match any selection range)
                                            continue;
                                        }
                                    }
    
    
                                    if ($d['LowestPrice'] != 0) {
                                        $priceValues[] = $d['LowestPrice'];
                                    }
    
                                    if ($d['HasPromo'] == true) {
                                        $promoAvailable = true;
                                    }
    
    
                                    $departures[] = (object) array(
                                        'departureDate' => $d['DepartureDate'],
                                        'lowestPrice' => $d['LowestPrice'], //lowest per cabin
                                        'hasPromo' => $d['HasPromo'],
                                        'isHighSeason' => $d['IsHighSeason'],
                                        'isLowSeason' => $d['IsLowSeason'],
                                        'promoName' => $d['PromoName'],
                                    );
                                }
                            } else {
                                continue; // no departure dates to begin with
                            }
    
                            if (!$departures) {
                                continue; //no departures in this itinerary after date filtering
                            }
    
                            $departureCount = 0;
                            if ($departures) {
                                $departureCount = count($departures);
                            }
    
                            //lowest price for itinerary
                            $itineraryLowestPrice = 0;
                            if ($priceValues) {
                                $itineraryLowestPrice = min($priceValues);
                            }
    
    
                            $itineraries[] = (object) array(
                                'lengthInDays' => $lengthInDays,
                                //'departures' => $departures,
                                'departureCount' => $departureCount,
                                'lowestItineraryPrice' => $itineraryLowestPrice
                            );
                        }
                    }
                } else {
                    continue;
                }
               


                // if (!$itineraries) {
                //     continue;
                // }
            } else { //LODGES
                $productTypeDisplay = 'Lodge Stay';
                $productTypeCta = 'Lodge';
    
                foreach ($cruiseData['Itineraries'] as $itinerary) {
                    $lowestItineraryPrice  = $itinerary['LowestPrice'];
                    $lengthInDays = $itinerary['LengthInDays'];

                    if ($minLength != null) {
                        if (($lengthInDays >= $minLength && $lengthInDays <= $maxLength) == false) {
                            continue; // skip to next
                        }
                    }

                    $itineraries[] = (object) array(
                        'lengthInDays' => $itinerary['LengthInDays'],
                        'lowestItineraryPrice' => $lowestItineraryPrice,
                    );
                }
                if (!$itineraries) {
                    continue;
                }
            }

            //Itinerary Attributes Display
            //--Count
            if (count($itineraries) > 1) {
                $itineraryCountDisplay = count($itineraries) . " Itineraries";
            } else {
                $itineraryCountDisplay = count($itineraries) . " Itinerary";
            }

            //--Length
            $itineraryValues = [];
            foreach ($itineraries as $i) { 
                $itineraryValues[] = $i->lengthInDays;
            }
            $rangeFrom = min($itineraryValues);
            $rangeTo = max($itineraryValues);

            if ($rangeFrom != $rangeTo) {
                $itineraryLengthDisplay = $rangeFrom . " - " . $rangeTo . " Days";
            } else {
                $itineraryLengthDisplay = $rangeFrom . " Days";
            }


            //Capacity Attributes Display
            if ($numberOfCabins) {
                $numberOfCabinsDisplay = $numberOfCabins . " Cabins";
            }
            if ($vesselCapacity) {
                $vesselCapacityDisplay = $vesselCapacity . " Guests";
            }
        }
