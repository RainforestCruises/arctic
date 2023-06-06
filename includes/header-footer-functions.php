<?php
function checkActiveHeader()
{
    $alwaysActiveHeader = false;
    $templateName = get_page_template_slug();
    $postTypeName = get_post_type();

    if ( $templateName == 'template-reviews-toplevel.php' || $templateName == 'template-about.php' || $templateName == 'template-generic.php' || $templateName == 'template-deals.php' || $templateName == 'template-error404.php' || $templateName == 'template-contact.php' || $templateName == 'template-search2.php' || $templateName == 'template-guides-toplevel.php') {
        $alwaysActiveHeader = true;
    }

    if ($postTypeName == 'rfc_travel_guides') {
        $alwaysActiveHeader = true;
    }

    return $alwaysActiveHeader;
}

function renderHeaderClasses()
{
    $classes = '';
    $templateName = get_page_template_slug();
    $postTypeName = get_post_type();

    //fixed to view always
    if ($templateName == 'template-home.php' || $postTypeName == 'rfc_travel_guides') {
        $classes .= ' fixed ';
    }

    //narrow
    if ($postTypeName == 'rfc_cruises' || $postTypeName == 'rfc_itineraries' || $postTypeName == 'rfc_travel_guides') {
        $classes .= ' narrow ';
    }
    if ($templateName == 'template-about.php' || $templateName == 'template-generic.php') {
        $classes .= ' narrow ';
    }

    return $classes;
}


function renderFooterClasses()
{
    $classes = '';
    $templateName = get_page_template_slug();
    $postTypeName = get_post_type();

    if ($postTypeName == 'rfc_cruises' || $postTypeName == 'rfc_itineraries' || $postTypeName == 'rfc_travel_guides') {
        $classes .= ' narrow ';
    }
    if ($templateName == 'template-about.php' || $templateName == 'template-generic.php') {
        $classes .= ' narrow ';
    }

    return $classes;
}