<?php
// On daily chron job 
add_action('rfc_cron_refresh_api', 'refresh_itinerary_info_all'); // chron job hook
function refresh_itinerary_info_all() // loop all itineraries with automation and refresh
{
    $args = array(
        'posts_per_page' => -1,
        'post_type' => array('rfc_itineraries'),
    );

    // loop all itineraries
    $itineraryPosts = get_posts($args);
    foreach ($itineraryPosts as $itineraryPost) {

        $use_automation = get_field('use_automation', $itineraryPost);
        if ($use_automation) {
            $automation_itinerary_id = get_field('automation_itinerary_id', $itineraryPost);
            refresh_itinerary_info($automation_itinerary_id, $itineraryPost->ID); // refresh data
            usleep(5000000); // 5 second pause
        }
    }
}



// On Save Post
add_action('acf/save_post', 'acf_automation_on_save');
function acf_automation_on_save($post_id) // get data from API if post type is itinerary and automation is enabled
{
    if ('rfc_itineraries' == get_post_type()) {
        $use_automation = get_field('use_automation', $post_id);
        if ($use_automation) {
            $automation_itinerary_id = get_field('automation_itinerary_id', $post_id);
            refresh_itinerary_info($automation_itinerary_id, $post_id);
        }
    }
}
function refresh_itinerary_info($itineraryId, $post_id)
{
    // // LOCAL 
    // $url = 'https://localhost:7250/api/wpitineraries/';
    // $url .= $itineraryId;
    // $request = wp_remote_get($url, array('sslverify' => FALSE));

    // API
    $url = 'https://tourtrack.azurewebsites.net/api/wpitineraries/';
    $url .= $itineraryId;
    $request = wp_remote_get($url);

    if (is_wp_error($request)) {
        $error_message = $request->get_error_message();
        update_field('automation_departure_data', $error_message, $post_id);
        return false;
    }

    $body = wp_remote_retrieve_body($request);
    $data = json_decode($body, true);

    if ($data['succeeded'] == false) {
        update_field('automation_message', 'Request failed', $post_id);
        return false;
    }

    $timezone  = -5; // (GMT -5:00) EST (U.S. & Canada)
    $currentTime =  gmdate("M d, Y  H:i:s", time() + 3600 * ($timezone + date("I")));
    $responseObject = formatDepartureApiData($data['data'], $post_id);
    update_field('automation_message', array_unique($responseObject['errors']), $post_id);
    update_field('automation_departure_data', $responseObject['departures'], $post_id);
    update_field('automation_last_updated', $currentTime, $post_id);
}



// map / format API departure list to conform to WP departure lists ( )
function formatDepartureApiData($automation_departure_data, $itineraryId)
{
    $error_messages = [];
    $departure_list = [];
    $automation_extra_deals = get_field('automation_extra_deals', $itineraryId);

    foreach ($automation_departure_data as $departure_item) {

        // build cabin rate list
        $cabin_price_list = [];
        foreach ($departure_item['rates'] as $rate) {
            $cabinPost = get_post($rate['wpRoomId']);
            if (!get_post_status($rate['wpRoomId']) || get_post_type($rate['wpRoomId']) != 'rfc_cabins') { // check if not found
                $error_messages[] = "missing cabin";
            }
            $cabin_price = [
                'cabin' => $cabinPost,
                'discounted_price' => $rate['discountedAmount'],
                'price' => $rate['baseAmount'],
                'sold_out' => $rate['soldOut'],
            ];
            $cabin_price_list[] = $cabin_price;
        };

        // get ship post
        $shipPost = get_post($departure_item['wpShipId']);
        if (!get_post_status($departure_item['wpShipId']) || get_post_type($departure_item['wpShipId']) != 'rfc_cruises') { // check if not found
            $error_messages[] = "missing ship";
        }

        // add deals
        $deals_post_list = [];
        $default_deal = null;
        foreach ($departure_item['deals'] as $deal) {
            $dealPost = get_post($deal['wpDealId']);
            if (!get_post_status($deal['wpDealId']) || get_post_type($deal['wpDealId']) != 'rfc_deals') { // check if not found
                $error_messages[] = "missing deal";
            }
            $deals_post_list[] = $dealPost;

            if ($deal['isDefault']) {
                $default_deal = $dealPost; // if there is a default deal, mark it
            }
        };

        // check extra deals (special departures)
        foreach ($automation_extra_deals as $extra_deal) {
            if ($extra_deal['date'] == $departure_item['departureDate']) {
                if ($extra_deal['overwrite_default'] == true) {           
                    $deals_post_list = array_filter($deals_post_list, function ($deal) use ($default_deal) { // Remove default deal from list
                        return $deal->ID !== $default_deal->ID;
                    });
                    $deals_post_list[] = $extra_deal['deal'];
                } else {
                    $deals_post_list[] = $extra_deal['deal'];
                }
            }
        };

        // build final departure object
        $departure = [
            'cabin_prices' => $cabin_price_list,
            'date' => $departure_item['departureDate'],
            'deals' => $deals_post_list,
            'ship' => $shipPost,
            'variant' => $departure_item['variant']
        ];

        // add to departure list
        $departure_list[] = $departure;
    }

    // return an object with departure list and any error messages
    $responseObject = [
        'departures' => $departure_list,
        'errors' => $error_messages
    ];

    return $responseObject;
}



// function custom_log($message)
// {
//     $log_file = WP_CONTENT_DIR . '/custom.log'; // Path to your custom log file
//     error_log($message . PHP_EOL, 3, $log_file);
// }


// Disable automation ACF fields in itinerary post admin view
add_filter('acf/load_field/name=automation_last_updated', 'acf_read_only_automation_last_updated');
function acf_read_only_automation_last_updated($field)
{
    $field['readonly'] = 1;
    return $field;
}
add_filter('acf/load_field/name=automation_message', 'acf_read_only_automation_message');
function acf_read_only_automation_message($field)
{
    $field['readonly'] = 1;
    return $field;
}
add_filter('acf/load_field/name=automation_departure_data', 'acf_read_only_automation_departure_data');
function acf_read_only_automation_departure_data($field)
{
    $field['readonly'] = 1;
    return $field;
}
