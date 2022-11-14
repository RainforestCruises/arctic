<?php



//On Save Post
add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post($post_id)
{

    console_log('xx');

    if ('rfc_itineraries' == get_post_type() || 'rfc_cruises' == get_post_type()) {
        $post = get_post();
        $departures = createDepartureList($post);
        $lowestPrice = getLowestDepartureListPrice($departures);

        console_log($departures);

        update_field('static_price', $lowestPrice, $post_id);
    }

  
}




//Make Last_Updated and Cruise_Data and Length in Days read only in Admin -----------------------
add_filter('acf/load_field/name=static_price', 'acf_read_only_static_price');
function acf_read_only_static_price($field)
{
    $field['readonly'] = 1;
    return $field;
}


// add_filter('acf/load_field/name=cruise_data', 'acf_read_only_cruise_data');
// function acf_read_only_cruise_data($field)
// {
//     $field['readonly'] = 1;
//     return $field;
// }


// add_filter('acf/load_field/name=length_in_days', 'acf_read_only_length_in_days');
// function acf_read_only_length_in_days($field)
// {
//     $field['readonly'] = 1;
//     return $field;
// }
