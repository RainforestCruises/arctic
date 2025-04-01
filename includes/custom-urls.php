<?php
// Custom function to handle permalinks for rfc_travel_guides
function custom_cruise_permalinks($permalink, $post)
{
    // Only modify permalinks for our post type
    if (!is_object($post) || $post->post_type !== 'rfc_travel_guides') {
        return $permalink;
    }

    // If we have a parent page set in ACF
    $parent_page = get_field('parent_page', $post->ID);
    
    if ($parent_page) {
        // Get the full hierarchical path to the parent page
        $parent_path = get_page_uri($parent_page->ID);

        // Build URL with full parent page path
        return home_url() . '/' . $parent_path . '/guide/' . $post->post_name . '/';
    }
    
    // Default URL if no parent page
    return home_url() . '/guide/' . $post->post_name . '/';
}
add_filter('post_type_link', 'custom_cruise_permalinks', 999, 2);

// Add custom rewrite rules
function custom_cruise_rewrites()
{
    add_rewrite_rule(
        '(.+?)/guide/([^/]+)/?$',
        'index.php?post_type=rfc_travel_guides&name=$matches[2]',
        'top'
    );
    
    // For guides without parent pages
    add_rewrite_rule(
        'guide/([^/]+)/?$',
        'index.php?post_type=rfc_travel_guides&name=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_cruise_rewrites');