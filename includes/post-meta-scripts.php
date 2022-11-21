<?php



//On Save Post
add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post($post_id)
{


    // if ('rfc_itineraries' == get_post_type() || 'rfc_cruises' == get_post_type()) {
    //     $post = get_post();
    //     $departures = createDepartureList($post);
    //     $lowestPrice = getLowestDepartureListPrice($departures);

    //     console_log($departures);

    //     update_field('static_price', $lowestPrice, $post_id);
    // }

  
}




//Make ACF Fields read only in Admin -----------------------
add_filter('acf/load_field/name=static_price', 'acf_read_only_static_price');
function acf_read_only_static_price($field)
{
    $field['readonly'] = 1;
    return $field;
}



