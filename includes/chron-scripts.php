<?php

//SCHEDULING --------------
// IMPORTANT - Hook for the action
//add_action( 'rfc_cron_clear_outdated', 'clear_outdated' );

// //create function refresh_cruise_info_all - loop through all cruises
// function clear_outdated()
// { 

//      //get property_id of each rfc_cruises post types
//     $args = array(
//         'posts_per_page' => -1,
//         'post_type' => 'rfc_itineraries',
//     );

//     $itineraries = get_posts($args);

//     foreach($itineraries as $itinerary){
//         $departures = get_field('departures', $itinerary);
//         foreach($departures as $departure) {

//         }
//     }
// }
// //----------------------------------------------------------------

// //On Save Post
// add_action('acf/save_post', 'acf_clear_outdated');
// function acf_clear_outdated($post_id)
// {

//     if ('rfc_itineraries' == get_post_type()) {
//         $departures = get_field('departures', get_post());
//         foreach($departures as $departure) {
//             $departureDate = $departure['Date'];


//             console_log($departureDate);
//         }
//         //delete_row('departures', 1);
//     }
   
// }

