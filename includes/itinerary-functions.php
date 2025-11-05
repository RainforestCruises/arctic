<?php 

function createItineraryInfoObject($itinerary)
{


    $itineraryObjects = [];



    // default itinerary (first object)
    $days = get_field('itinerary', $itinerary);
    $length_in_nights = get_field('length_in_nights', $itinerary);
    $length_in_days = $length_in_nights + 1;
    $embarkation_point = get_field('embarkation_point', $itinerary);
    $embarkation_is_flight = get_field('embarkation_is_flight', $itinerary);
    $disembarkation_point = get_field('disembarkation_point', $itinerary);
    $disembarkation_is_flight = get_field('embarkation_is_flight', $itinerary);

    $defaultItineraryObject = (object) [
        'days' => $days,
        'length_in_nights' => $length_in_nights,
        'length_in_days' => $length_in_days,
        'embarkation_point' => $embarkation_point,
        'embarkation_is_flight' => $embarkation_is_flight,
        'disembarkation_point' => $disembarkation_point,
        'disembarkation_is_flight' => $disembarkation_is_flight,
    ];

    $itineraryObjects[] = $defaultItineraryObject;

    $hasVariants = get_field('has_variants', $itinerary);
    $variants = get_field('variants', $itinerary);



    if ($hasVariants && $variants) {
        foreach ($variants as $variant) {

            // default itinerary (first object)
            $days = $variant['itinerary'];
            $length_in_nights = $variant['length_in_nights'] ?? get_field('length_in_nights', $itinerary);
            $length_in_days = $length_in_nights + 1;
            $embarkation_point = $variant['embarkation_point'] ?? get_field('embarkation_point', $itinerary);
            $embarkation_is_flight = $variant['embarkation_is_flight'] ?? get_field('embarkation_is_flight', $itinerary);
            $disembarkation_point = $variant['disembarkation_point'] ?? get_field('disembarkation_point', $itinerary);
            $disembarkation_is_flight = $variant['disembarkation_is_flight'] ?? get_field('disembarkation_is_flight', $itinerary);

            $variantItineraryObject = (object) [
                'days' => $days,
                'length_in_nights' => $length_in_nights,
                'length_in_days' => $length_in_days,
                'embarkation_point' => $embarkation_point,
                'embarkation_is_flight' => $embarkation_is_flight,
                'disembarkation_point' => $disembarkation_point,
                'disembarkation_is_flight' => $disembarkation_is_flight,
            ];
            $itineraryObjects[] = $variantItineraryObject;
        }
    }
    return $days;
}
