<?php

require_once(__DIR__ . '/includes/load-scripts.php');
require_once(__DIR__ . '/includes/custom-post-types.php');
require_once(__DIR__ . '/includes/theme-config.php');
require_once(__DIR__ . '/includes/header-footer-functions.php');
require_once(__DIR__ . '/includes/utilities.php');


require_once(__DIR__ . '/includes/product-functions.php');
require_once(__DIR__ . '/includes/deal-functions.php');
require_once(__DIR__ . '/includes/map-functions.php');
require_once(__DIR__ . '/includes/chron-scripts.php');
require_once(__DIR__ . '/includes/rank-math-config.php');


require_once(__DIR__ . '/includes/search-form-primary.php');
require_once(__DIR__ . '/includes/search-form-nav.php');
require_once(__DIR__ . '/includes/search-functions-primary.php');
require_once(__DIR__ . '/includes/search-functions-nav.php');
require_once(__DIR__ . '/includes/currency-form.php');



//ACP local files system storage
add_filter('acp/storage/file/directory', function () {
    // Use a writable path, directory will be created for you
    return get_stylesheet_directory() . '/acp-settings';
});

//enable migrations
add_filter('acp/storage/file/directory/migrate', '__return_true');


function sortImportance($a, $b)
{
    if (is_object($a) && is_object($b)) {
        return strcmp($a->importance, $b->importance);
    }
}

//enable ACF options page
if (function_exists('acf_add_options_page')) {

    acf_add_options_page();
}
