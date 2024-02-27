<?php
add_action('wp_ajax_currencyForm', 'search_filter_nav_currency'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_currencyForm', 'search_filter_nav_currency');

function search_filter_nav_currency()
{
    // return result cards -- content-search-listing
    get_template_part('template-parts/nav/content', 'nav-currency');
    die();
}




add_action('wp_ajax_currencyFormCta', 'search_filter_nav_currency_cta'); // just return the currency text
add_action('wp_ajax_nopriv_currencyFormCta', 'search_filter_nav_currency_cta');

function search_filter_nav_currency_cta()
{
    if (is_plugin_active('currency-switcher/index.php')) {
        global $WPCS;
        $current_currency = $WPCS->current_currency;
    }
    
    if (is_plugin_active('currency-switcher/index.php')) : 
        echo $current_currency;
    endif; 
    die();
}