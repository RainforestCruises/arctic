<?php


// On Save Post
add_action('acf/save_post', 'acf_automation_on_save');
function acf_automation_on_save($post_id)
{

    // get data from API if post type is itinerary and automation is enabled
    if ('rfc_itineraries' == get_post_type()) {
        $use_automation = get_field('use_automation', $post_id);
        if($use_automation){
            $automation_itinerary_id = get_field('automation_itinerary_id', $post_id); 
            refresh_cruise_info($automation_itinerary_id, $post_id);
        }
    }
   
}
function refresh_cruise_info($itineraryId, $post_id)
{
    // LOCAL 
    $url = 'https://localhost:7250/api/wpitineraries/';        
    $url .= $itineraryId;
    $request = wp_remote_get($url, array('sslverify' => FALSE));

    // // API
    // $url = 'https://tourengine.azurewebsites.net/api/wpitineraries/';
    // $url .= $itineraryId;
    // $request = wp_remote_get($url);

    if (is_wp_error($request)) {
        $error_message = $request->get_error_message();
        update_field('automation_departure_data', $error_message, $post_id);
        return false; // Bail early
    }

    $body = wp_remote_retrieve_body($request);
    $data = json_decode($body, true);

    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
    $currentTime =  gmdate("M d, Y  H:i:s", time() + 3600 * ($timezone + date("I")));

    update_field('automation_departure_data', $data['data'], $post_id);
    update_field('automation_last_updated', $currentTime, $post_id);
}

function custom_log($message) {
    $log_file = WP_CONTENT_DIR . '/custom.log'; // Path to your custom log file
    error_log($message . PHP_EOL, 3, $log_file);
}


// Disable automation ACF fields in itinerary post admin view
add_filter('acf/load_field/name=automation_last_updated', 'acf_read_only_automation_last_updated');
function acf_read_only_automation_last_updated($field)
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
