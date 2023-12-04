<?php
// Nav Search
add_action('wp_ajax_currencyForm', 'search_filter_nav_currency'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_currencyForm', 'search_filter_nav_currency');

function search_filter_nav_currency()
{
    // return result cards -- content-search-listing
    get_template_part('template-parts/nav/content', 'nav-currency');


    die();
}
