<?php

function createItineraryInfoObject($itinerary)
{

    // default itinerary (first object)
    $days = get_field('itinerary', $itinerary);
    $length_in_nights = get_field('length_in_nights', $itinerary);
    $length_in_days = $length_in_nights + 1;
    $embarkation_point = get_field('embarkation_point', $itinerary);
    $disembarkation_point = get_field('disembarkation_point', $itinerary);
    $fly_category = get_field('fly_category', $itinerary);
    $geojson = get_field('geojson', $itinerary);
    $latitude_start_point = get_field('latitude_start_point', $itinerary);
    $longitude_start_point =  get_field('longitude_start_point', $itinerary);
    $zoom_level_start_point = get_field('zoom_level_start_point', $itinerary);
    $post_id = get_the_ID($itinerary);

    // Create departure display for default
    $departure_display = ($embarkation_point->id == $disembarkation_point->id)
        ? "From {$embarkation_point->post_title}"
        : "From {$embarkation_point->post_title} to {$disembarkation_point->post_title}";

    $departure_display = get_field('variant_title', $itinerary) ?: $departure_display;

    $defaultItineraryObject = (object) [
        'days' => $days,
        'length_in_nights' => $length_in_nights,
        'length_in_days' => $length_in_days,
        'embarkation_point' => $embarkation_point,
        'disembarkation_point' => $disembarkation_point,
        'fly_category' => $fly_category,
        'geojson' => $geojson,
        'startLatitude' => $latitude_start_point,
        'startLongitude' => $longitude_start_point,
        'startZoom' => $zoom_level_start_point,
        'postId' => $post_id,
        'index' => 0,
        'departureDisplay' => $departure_display,
    ];
    $defaultItineraryObject->mapObject = getItineraryMapObject($defaultItineraryObject);
    $itineraryObjects[] = $defaultItineraryObject;

    // Initialize flags
    $hasDifferentPorts = false;
    $hasDifferentLengths = false;
    $hasDifferentTransport = false;

    $uniqueLengths = [$length_in_days];
    $uniqueEmbarkations = [$embarkation_point->post_title];
    $uniqueDisembarkations = [$disembarkation_point->post_title];
    $uniqueFlyCategories = [$fly_category];


    $hasVariants = get_field('has_variants', $itinerary);
    $variants = get_field('variants', $itinerary);
    if ($hasVariants && $variants) {

        $index = 1;
        foreach ($variants as $variant) {

            // default itinerary (first object)
            $days = $variant['itinerary'];
            $variant_length_in_nights = $variant['length_in_nights'] ?? $length_in_nights;
            $variant_length_in_days = $variant_length_in_nights + 1;
            $variant_embarkation_point = $variant['embarkation_point'] ?? $embarkation_point;
            $variant_disembarkation_point = $variant['disembarkation_point'] ?? $disembarkation_point;
            $variant_fly_category = $variant['fly_category'] ?? $fly_category;
            $variant_geojson = $variant['geojson'] ?? $geojson;

            // Create departure display for variant
            $variant_departure_display = ($variant_embarkation_point->ID == $variant_disembarkation_point->ID)
                ? "From {$variant_embarkation_point->post_title}"
                : "From {$variant_embarkation_point->post_title} to {$variant_disembarkation_point->post_title}";

            $variant_departure_display = $variant['variant_title'] ?: $variant_departure_display;

            // Track unique values
            if (!in_array($variant_length_in_days, $uniqueLengths)) {
                $uniqueLengths[] = $variant_length_in_days;
            }
            if (!in_array($variant_embarkation_point->post_title, $uniqueEmbarkations)) {
                $uniqueEmbarkations[] = $variant_embarkation_point->post_title;
            }
            if (!in_array($variant_disembarkation_point->post_title, $uniqueDisembarkations)) {
                $uniqueDisembarkations[] = $variant_disembarkation_point->post_title;
            }
            if (!in_array($variant_fly_category, $uniqueFlyCategories)) {
                $uniqueFlyCategories[] = $variant_fly_category;
            }

            // Check for differences
            if ($variant_length_in_nights !== $length_in_nights) {
                $hasDifferentLengths = true;
            }
            if (
                $variant_embarkation_point->ID !== $embarkation_point->ID ||
                $variant_disembarkation_point->ID !== $disembarkation_point->ID
            ) {
                $hasDifferentPorts = true;
            }
            if ($variant_fly_category !== $fly_category) {
                $hasDifferentTransport = true;
            }

            $variantItineraryObject = (object) [
                'days' => $days,
                'length_in_nights' => $variant_length_in_nights,
                'length_in_days' => $variant_length_in_days,
                'embarkation_point' => $variant_embarkation_point,
                'disembarkation_point' => $variant_disembarkation_point,
                'fly_category' => $variant_fly_category,
                'geojson' => $variant_geojson,
                'startLatitude' => $latitude_start_point, // same as default
                'startLongitude' => $longitude_start_point, // same as default
                'startZoom' => $zoom_level_start_point, // same as default
                'postId' => $post_id, // same as default
                'index' => $index,
                'departureDisplay' => $variant_departure_display,
            ];
            $variantItineraryObject->mapObject = getItineraryMapObject($variantItineraryObject);

            $itineraryObjects[] = $variantItineraryObject;
            $index++;
        }
    }


    // Sort and create display strings
    sort($uniqueLengths);
    $lengthDisplayArray = array_map(function ($days) {
        return $days . ' Days';
    }, $uniqueLengths);
    $lengthDisplay = implode(', ', $lengthDisplayArray);

    sort($uniqueEmbarkations);
    $embarkationDisplay = implode(', ', $uniqueEmbarkations);

    sort($uniqueDisembarkations);
    $disembarkationDisplay = implode(', ', $uniqueDisembarkations);

    sort($uniqueFlyCategories);
    $uniqueFlyCategoriesArray = $uniqueFlyCategories;

    $itineraryInfoObject = (object) [
        'itineraryObjects' => $itineraryObjects,
        'hasVariants' => $hasVariants,
        'hasDifferentPorts' => $hasDifferentPorts,
        'hasDifferentLengths' => $hasDifferentLengths,
        'hasDifferentTransport' => $hasDifferentTransport,
        'lengthDisplay' => $lengthDisplay,
        'embarkationDisplay' => $embarkationDisplay,
        'disembarkationDisplay' => $disembarkationDisplay,
        'uniqueFlyCategoriesArray' => $uniqueFlyCategoriesArray,
        'uniqueLengthsArray' => $uniqueLengths,


    ];

    return $itineraryInfoObject;
}
