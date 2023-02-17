<?php 


// Custom Post Type - Deals
function create_post_type_rfc_deals()
{
    register_post_type(
        'rfc_deals',
        array(
            'labels' => array(
                'name' => __('Deals'),
                'singular_name' => __('Deal'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'deals'),
            'supports' => array(
                'title'
            )

        )
    );
}
add_action('init', 'create_post_type_rfc_deals');



// Custom Post Type - Deal Categories
function create_post_type_rfc_deal_categories()
{
    register_post_type(
        'rfc_deal_categories',
        array(
            'labels' => array(
                'name' => __('Deal Categories'),
                'singular_name' => __('Deal Category'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'deal-category'),
            'supports' => array(
                'title',
            )

        )
    );
}
add_action('init', 'create_post_type_rfc_deal_categories');



// Custom Post Type - Travel Guides
function create_post_type_rfc_travel_guides()
{
    register_post_type(
        'rfc_travel_guides',
        array(
            'labels' => array(
                'name' => __('Travel Guides'),
                'singular_name' => __('Travel Guide'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'guides'),
            'supports' => array(
                'title', 'editor'
            )

        )
    );
}
add_action('init', 'create_post_type_rfc_travel_guides');



// Custom Post Type - Travel Guide Categories
function create_post_type_rfc_guide_categories()
{
    register_post_type(
        'rfc_guide_categories',
        array(
            'labels' => array(
                'name' => __('Travel Guide Categories'),
                'singular_name' => __('Travel Guide Category'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'travel-guide-category'),
            'supports' => array(
                'title',
            )

        )
    );
}
add_action('init', 'create_post_type_rfc_guide_categories');

// Custom Post Type - Cruises (ships)
function create_post_type_rfc_cruises()
{
    register_post_type(
        'rfc_cruises',
        array(
            'labels' => array(
                'name' => __('Cruises'),
                'singular_name' => __('Cruise'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'ships'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_cruises');

// Custom Post Type - Itineraries 
function create_post_type_rfc_itineraries()
{
    register_post_type(
        'rfc_itineraries',
        array(
            'labels' => array(
                'name' => __('Itineraries'),
                'singular_name' => __('Itinerary'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'itineraries'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_itineraries');

// Custom Post Type - Cabins 
function create_post_type_rfc_cabins()
{
    register_post_type(
        'rfc_cabins',
        array(
            'labels' => array(
                'name' => __('Cabins'),
                'singular_name' => __('Cabin'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'cabins'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_cabins');


// Custom Post Type - Wildlife
function create_post_type_rfc_wildlife()
{
    register_post_type(
        'rfc_wildlife',
        array(
            'labels' => array(
                'name' => __('Wildlife'),
                'singular_name' => __('Wildlife'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'wildlife'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_wildlife');

// Custom Post Type - Amenities
function create_post_type_rfc_amenities()
{
    register_post_type(
        'rfc_amenities',
        array(
            'labels' => array(
                'name' => __('Amenities'),
                'singular_name' => __('Amenity'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'amenities'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_amenities');

// Custom Post Type - Activities
function create_post_type_rfc_activities()
{
    register_post_type(
        'rfc_activities',
        array(
            'labels' => array(
                'name' => __('Activities'),
                'singular_name' => __('Activity'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'activities'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_activities');

// Custom Post Type - Regions
function create_post_type_rfc_regions()
{
    register_post_type(
        'rfc_regions',
        array(
            'labels' => array(
                'name' => __('Regions'),
                'singular_name' => __('Region'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'regions'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_regions');

// Custom Post Type - Destinations
function create_post_type_rfc_destinations()
{
    register_post_type(
        'rfc_destinations',
        array(
            'labels' => array(
                'name' => __('Destinations'),
                'singular_name' => __('Destination'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'destinations'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_destinations');


// Custom Post Type - Styles
function create_post_type_rfc_styles()
{
    register_post_type(
        'rfc_styles',
        array(
            'labels' => array(
                'name' => __('Styles'),
                'singular_name' => __('Style'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'styles'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_styles');

// Custom Post Type - Routes
function create_post_type_rfc_routes()
{
    register_post_type(
        'rfc_routes',
        array(
            'labels' => array(
                'name' => __('Routes'),
                'singular_name' => __('Route'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'routes'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_routes');

// Custom Post Type - Service Levels
function create_post_type_rfc_levels()
{
    register_post_type(
        'rfc_levels',
        array(
            'labels' => array(
                'name' => __('Levels'),
                'singular_name' => __('Level'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'level'),
            'supports' => array(
                'title',
            )

        )
    );
}
add_action('init', 'create_post_type_rfc_levels');





