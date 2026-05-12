<?php

function createItineraryInfoObject($itinerary)
{

    // default itinerary (first object)
    $post_id = $itinerary->ID;
    $days = get_field('itinerary', $itinerary) ?: [];
    $length_in_nights =  (int) get_field('length_in_nights', $itinerary);
    $length_in_days = $length_in_nights + 1;
    $embarkation_point = get_field('embarkation_point', $itinerary);
    $disembarkation_point = get_field('disembarkation_point', $itinerary);
    $fly_category = get_field('fly_category', $itinerary);
    $geojson = get_field('geojson', $itinerary);
    $latitude_start_point = get_field('latitude_start_point', $itinerary);
    $longitude_start_point =  get_field('longitude_start_point', $itinerary);
    $zoom_level_start_point = get_field('zoom_level_start_point', $itinerary);
    $show_itinerary_note = get_field('show_itinerary_note', $itinerary);
    $itinerary_note = get_field('itinerary_note', $itinerary);
    $departure_display = get_field('variant_title', $itinerary) ?: null;

    $hasDifferentPorts = false;
    $hasDifferentLengths = false;
    $hasDifferentTransport = false;
    $uniqueLengths = [$length_in_days];
    $uniqueEmbarkations = [get_the_title($embarkation_point)];
    $uniqueDisembarkations = [get_the_title($disembarkation_point)];
    $uniqueFlyCategories = [$fly_category];

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
        'show_itinerary_note' => $show_itinerary_note,
        'itinerary_note' => $itinerary_note,
    ];
    $defaultItineraryObject->mapObject = getItineraryMapObject($defaultItineraryObject);
    $itineraryObjects[] = $defaultItineraryObject; // info object can have multiple 'itinerary objects'

    $hasVariants = get_field('has_variants', $itinerary);
    $variants = get_field('variants', $itinerary);
    if ($hasVariants && $variants) {

        $index = 1;
        foreach ($variants as $variant) {

            // default itinerary (first object)
            $days = $variant['itinerary'] ?? [];
            $variant_length_in_nights = $variant['length_in_nights'] ?? $length_in_nights;
            $variant_length_in_nights = (int) (
                $variant['length_in_nights'] ?? $length_in_nights
            );
            $variant_length_in_days = $variant_length_in_nights + 1;
            $variant_embarkation_point = $variant['embarkation_point'] ?? $embarkation_point;
            $variant_disembarkation_point = $variant['disembarkation_point'] ?? $disembarkation_point;
            $variant_fly_category = $variant['fly_category'] ?? $fly_category;
            $variant_geojson = $variant['geojson'] ?? $geojson;
            $variant_show_itinerary_note = $variant['show_itinerary_note'] ?? false;
            $variant_itinerary_note = $variant['itinerary_note'] ?? null;
            $variant_departure_display = $variant['variant_title'] ?: null;

            // Track unique values
            if (!in_array($variant_length_in_days, $uniqueLengths)) {
                $uniqueLengths[] = $variant_length_in_days;
            }
            if (!in_array(get_the_title($variant_embarkation_point), $uniqueEmbarkations)) {
                $uniqueEmbarkations[] = get_the_title($variant_embarkation_point);
            }

            if (!in_array(get_the_title($variant_disembarkation_point), $uniqueDisembarkations)) {
                $uniqueDisembarkations[] = get_the_title($variant_disembarkation_point);
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
                'show_itinerary_note' => $variant_show_itinerary_note,
                'itinerary_note' => $variant_itinerary_note,
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
        'itineraryObjects' => $itineraryObjects, // can be multiple itinerary objects if there are variants
        'hasVariants' => $hasVariants,
        'hasDifferentPorts' => $hasDifferentPorts, // for showing another row in the itinerary card for disembarkation
        'hasDifferentLengths' => $hasDifferentLengths, // for a Days + in the nav
        'hasDifferentTransport' => $hasDifferentTransport, // for showing flight icons in the nav and map
        'lengthDisplay' => $lengthDisplay,
        'embarkationDisplay' => $embarkationDisplay,
        'disembarkationDisplay' => $disembarkationDisplay,
        'uniqueFlyCategoriesArray' => $uniqueFlyCategoriesArray,
        'uniqueLengthsArray' => $uniqueLengths,
        'postId' => $post_id,

    ];

    return $itineraryInfoObject;
}


// Itinerary lengths
// takes an itinerary and returns an array of unique lengths 
function getItineraryLengths($itineraries)
{
    $uniqueLengths = [];

    $itineraryList = is_array($itineraries) ? $itineraries : [$itineraries];

    foreach ($itineraryList as $itinerary) {
        $length_in_nights = (int) get_field('length_in_nights', $itinerary);
        $length_in_days = $length_in_nights + 1;

        if (!in_array($length_in_days, $uniqueLengths)) {
            $uniqueLengths[] = $length_in_days;
        }

        $hasVariants = get_field('has_variants', $itinerary);
        $variants = get_field('variants', $itinerary);
        if ($hasVariants && $variants) {
            foreach ($variants as $variant) {
                $variant_length_in_nights = (int) (
                    $variant['length_in_nights'] ?? $length_in_nights
                );
                $variant_length_in_days = $variant_length_in_nights + 1;

                if (!in_array($variant_length_in_days, $uniqueLengths)) {
                    $uniqueLengths[] = $variant_length_in_days;
                }
            }
        }
    }

    sort($uniqueLengths);
    return $uniqueLengths;
}



// generic format lengths
// takes an array of lengths and formats it for display, with options for range or only min
function formatLengthDisplay($lengths, $range = false, $onlyMin = false)
{
    if (empty($lengths)) return "N/A";

    $lengths = is_array($lengths) ? $lengths : [$lengths];
    $lengths = array_filter($lengths, fn($l) => !is_null($l));

    if (empty($lengths)) return "N/A";

    sort($lengths);

    $min = min($lengths);
    $max = max($lengths);

    if ($onlyMin) {
        return $min . ' Days';
    }

    if ($range) {
        return $min === $max ? $min . ' Days' : $min . '-' . $max . ' Days';
    }

    return implode(', ', array_map(fn($days) => $days . ' Days', $lengths));
}
