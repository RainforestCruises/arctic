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

// Custom Post Type - Cruises 
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
            'rewrite' => array('slug' => 'cruises'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_cruises');

// Custom Post Type - Tours 
function create_post_type_rfc_tours()
{
    register_post_type(
        'rfc_tours',
        array(
            'labels' => array(
                'name' => __('Tours'),
                'singular_name' => __('Tour'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'tours'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_tours');


// Custom Post Type - Lodges 
function create_post_type_rfc_lodges()
{
    register_post_type(
        'rfc_lodges',
        array(
            'labels' => array(
                'name' => __('Lodges'),
                'singular_name' => __('Lodge'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'lodges'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_lodges');


// Custom Post Type - Hotels 
function create_post_type_rfc_hotels()
{
    register_post_type(
        'rfc_hotels',
        array(
            'labels' => array(
                'name' => __('Hotels'),
                'singular_name' => __('Hotel'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'hotels'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_hotels');

// Custom Post Type - Price Levels
function create_post_type_rfc_price_levels()
{
    register_post_type(
        'rfc_price_levels',
        array(
            'labels' => array(
                'name' => __('Price Levels'),
                'singular_name' => __('Price Level'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'price-levels'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_price_levels');


// Custom Post Type - experiences
function create_post_type_rfc_experiences()
{
    register_post_type(
        'rfc_experiences',
        array(
            'labels' => array(
                'name' => __('Experiences'),
                'singular_name' => __('Experience'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'experiences'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_experiences');

// Custom Post Type - activities
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


// Custom Post Type - Locations
function create_post_type_rfc_locations()
{
    register_post_type(
        'rfc_locations',
        array(
            'labels' => array(
                'name' => __('Locations'),
                'singular_name' => __('Location'),
            ),
            'public' => true,
            'rewrite' => array('slug' => 'locations'),
            'supports' => array(
                'title',
            )
        )
    );
}
add_action('init', 'create_post_type_rfc_locations');





