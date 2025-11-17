<?php
// MAPS ----------------------------------------------------------------------------------------------\
//create itinerary object from single itinerary
function getItineraryMapObject($itineraryObject)
{
    $embarkation_point = $itineraryObject->embarkation_point;
    $disembarkation_point = $itineraryObject->disembarkation_point;
    $hasDifferentPorts = $disembarkation_point != null && ($disembarkation_point != $embarkation_point);

    $days = $itineraryObject->days;

    // Destination Point Series
    $destinationPoints = [];
    $destinationList = [];
    $count = 0;

    //Build Destination List
    foreach ($days as $day) {

        $destinations = $day['destination']; // multiple destinations

        foreach ($destinations as $destination) {
            if (get_field('exclude_map_pin', $destination)) {
                continue;
            }
            $dayDisplay = dayCountMarkup($day['day_count']);
            $destinationImage =  get_field('image', $destination); //get default image if none provided
            $destinationImageURL = $destinationImage ? wp_get_attachment_image_url($destinationImage['ID'], 'portrait-small') : "";


            $point  = [
                'index' => $count,
                'isEmbarkation' => $destination == $embarkation_point,
                'isDisembarkation' => $destination == $disembarkation_point,
                'postid' => $destination->ID,
                'title' => get_the_title($destination),
                'day' => $dayDisplay,
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

    //Reformat to feature 
    $featureList = [];
    foreach ($destinationPoints as $point) {
        $feature = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => $point['coordinates']
            ],
            'properties' => [
                'day' => $point['day'],
                'title' => $point['title'],
                'image' => $point['image'],
                'isEmbarkation' => $point['isEmbarkation'],
                'isDisembarkation' => $point['isDisembarkation']
            ],
        ];

        $featureList[] = $feature;
    }

    // Get and validate geojson field
    $geojsonField = $itineraryObject->geojson;
    $geojsonDecoded = null;

    if (!empty($geojsonField) && is_string($geojsonField)) {
        $geojsonDecoded = json_decode($geojsonField);
    }


    // Itinerary Object
    $itineraryObject = [
        'featureList' => $featureList,
        'hasDifferentPorts' => $hasDifferentPorts,
        'geojson' => $geojsonDecoded,
        'startLatitude' => $itineraryObject->startLatitude,
        'startLongitude' => $itineraryObject->startLongitude,
        'startZoom' => $itineraryObject->startZoom,
        'postId' => $itineraryObject->postId,
        'excludeDayMarkup' => false
    ];

    return $itineraryObject;
}

// create itinerary object from list of destinations, and starting points
function getItineraryObjectFromDestinations($destinations, $startLatitude, $startLongitude, $startZoomPoint)
{

    // Destination Point Series
    $destinationPoints = [];

    foreach ($destinations as $destination) {
        $destinationImage =  get_field('image', $destination); //get default image if none provided
        $destinationImageURL = $destinationImage ? wp_get_attachment_image_url($destinationImage['ID'], 'portrait-small') : "";

        $point  = [
            'index' => 0,
            'isEmbarkation' => false,
            'isDisembarkation' => false,
            'postid' => $destination->ID,
            'title' => get_the_title($destination),
            'day' => null,
            'image' => $destinationImageURL,
            'coordinates' => [get_field('longitude', $destination), get_field('latitude', $destination)],
        ];

        $destinationPoints[] = $point; // only add non dulpicates
    }

    //Reformat to feature 
    $featureList = [];
    foreach ($destinationPoints as $point) {
        $feature = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => $point['coordinates']
            ],
            'properties' => [
                'day' => $point['day'],
                'title' => $point['title'],
                'image' => $point['image'],
                'isEmbarkation' => $point['isEmbarkation'],
                'isDisembarkation' => $point['isDisembarkation']
            ],
        ];

        $featureList[] = $feature;
    }

    // Itinerary Object
    $itineraryObject = [
        'featureList' => $featureList,
        'hasDifferentPorts' => false,
        'geojson' => null,
        'startLatitude' => $startLatitude,
        'startLongitude' => $startLongitude,
        'startZoom' => $startZoomPoint,
        'postId' => null,
        'excludeDayMarkup' => true
    ];

    return $itineraryObject;
}

// generate day markup for map object
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
