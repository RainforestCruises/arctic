<?php



//SCHEDULING --------------
// IMPORTANT - Hook for the action
add_action( 'rfc_cron_refresh_df', 'refresh_cruise_info_all' );

//create function refresh_cruise_info_all - loop through all cruises
function refresh_cruise_info_all()
{ 

     //get property_id of each rfc_cruises post types
    $args = array(
        'posts_per_page' => -1,
        'post_type' => array('rfc_cruises', 'rfc_lodges'),
    );

    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) :
            $the_query->the_post();
            // content goes here
            $pid = get_field('property_id', get_the_ID()); 
            if ($pid) {
                
                refresh_cruise_info($pid, get_the_ID());
                usleep(1000000); //1 second pause
            }

        endwhile;
        wp_reset_postdata();
    else :
    endif;
}
//----------------------------------------------------------------



//On Save Post
add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post($post_id)
{
    if ('rfc_cruises' == get_post_type()) {
        $dfPropertyId = get_field('property_id', $post_id); //get property data from DF
        refresh_cruise_info($dfPropertyId, $post_id);
    }
    if ('rfc_lodges' == get_post_type()) {
        $dfPropertyId = get_field('property_id', $post_id); //get property data from DF
        refresh_cruise_info($dfPropertyId, $post_id);
    }

    if ('rfc_tours' == get_post_type()) {
        $dailyActivities = get_field('daily_activities');
        $count = 1;
        if ($dailyActivities) {
            $count = count($dailyActivities);
        }
        update_field('length_in_days', $count);
    }

    //$yearTitle = date("Y") . "-" . date('Y', strtotime('+1 year'));
    
  
}
function refresh_cruise_info($propertyId, $post_id)
{
    //LOCAL TEST
    //$url = 'http://localhost:63665/api/wpproperties/';

    //DF WEB
    $url = 'https://departurefinder.azurewebsites.net/api/wpproperties/';
    $url .= $propertyId;

    $request = wp_remote_get($url);

    if (is_wp_error($request)) {
        return false; // Bail early
    }

    $body = wp_remote_retrieve_body($request);
    $data = json_decode($body, true);


    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
    $currentTime =  gmdate("M d, Y  H:i:s", time() + 3600 * ($timezone + date("I")));

    update_field('cruise_data', $data, $post_id);
    update_field('last_updated', $currentTime, $post_id);
}




//Make Last_Updated and Cruise_Data and Length in Days read only in Admin -----------------------
add_filter('acf/load_field/name=last_updated', 'acf_read_only_last_updated');
function acf_read_only_last_updated($field)
{
    $field['readonly'] = 1;
    return $field;
}
add_filter('acf/load_field/name=cruise_data', 'acf_read_only_cruise_data');
function acf_read_only_cruise_data($field)
{
    $field['readonly'] = 1;
    return $field;
}
add_filter('acf/load_field/name=length_in_days', 'acf_read_only_length_in_days');
function acf_read_only_length_in_days($field)
{
    $field['readonly'] = 1;
    return $field;
}
