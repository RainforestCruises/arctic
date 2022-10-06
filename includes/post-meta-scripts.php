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
        'post_type' => array('rfc_cruises', 'rfc_itineraries'), //add itineraries
    );

    $posts = get_posts($args);
    foreach($posts as $post) {

        $propertyId = null;
        if ('rfc_cruises' == get_post_type($post)) {
            $propertyId = get_field('property_id', $post); //get property data from DF
            if($propertyId){
                refresh_cruise_info($propertyId, $post);
                usleep(1000000); //1 second pause
            }
        }
        if ('rfc_itineraries' == get_post_type($post)) {
            $cruisePost = get_field('ship', $post); //get cruise post
            $propertyId = get_field('property_id', $cruisePost); //get property data from DF
            if($propertyId){
                refresh_cruise_info($propertyId, $post);
                usleep(1000000); //1 second pause
            }
            
        }

    }


}
//----------------------------------------------------------------



//On Save Post
add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post($post_id)
{
    if ('rfc_cruises' == get_post_type()) {
        $propertyId = get_field('property_id', $post_id); //get property data from DF
        refresh_cruise_info($propertyId, $post_id);
    }

    if ('rfc_itineraries' == get_post_type()) {
        $cruisePost = get_field('ship', $post_id); //get cruise post
        $propertyId = get_field('property_id', $cruisePost); //get property data from DF
        refresh_cruise_info($propertyId, $post_id);

        $cruiseDataUpdated = get_field('cruise_data', $post_id); //updated cruise data
        $itinerary_id = get_field('itinerary_id', $post_id); //get itinerary id from field

        $itineraries = $cruiseDataUpdated['Itineraries'];
        $itinerary_data = "";
      
        //Get Itinerary from cruise data
        foreach ($itineraries as $i) {
          if ($i['Id'] == $itinerary_id) {
            $itinerary_data = $i;
          }
        }
        update_field('itinerary_data', $itinerary_data);

    }

  
}
function refresh_cruise_info($propertyId, $post_id)
{
    //LOCAL TEST
    //$url = 'http://localhost:63665/api/wpproperties/';

    //DF WEB
    $url = 'https://departurefinder-arctic.azurewebsites.net/api/wpproperties/';
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
