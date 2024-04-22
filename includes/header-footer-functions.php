<?php
function checkActiveHeader()
{
    $alwaysActiveHeader = false;
    $templateName = get_page_template_slug();
    $postTypeName = get_post_type();

    if ($templateName == 'template-agency.php' || $templateName == 'template-reviews-toplevel.php' || $templateName == 'template-about.php' || $templateName == 'template-generic.php' || $templateName == 'template-deals.php' || $templateName == 'template-error404.php' || $templateName == 'template-contact.php' || $templateName == 'template-search.php' || $templateName == 'template-guides-toplevel.php') {
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
    if ($templateName == 'template-agency.php' || $templateName == 'template-about.php' || $templateName == 'template-generic.php') {
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



function checkPageRegion()
{
    $initialRegion = getPrimaryRegion();
    $templateName = get_page_template_slug();
    $postTypeName = get_post_type();

    if ($templateName == 'template-landing.php' || $templateName == 'template-home.php') {
        $selectedPageRegion = get_field('region');
        if ($selectedPageRegion) {
            $initialRegion = $selectedPageRegion;
        }
    }

    if ($postTypeName == 'rfc_travel_guides') {
        $selectedPageRegion = get_field('region');
        if ($selectedPageRegion) {
            $initialRegion = $selectedPageRegion;
        }
    }

    if ($postTypeName == 'rfc_itineraries') {
        $selectedPageRegion = getItineraryRegion(get_post());
        if ($selectedPageRegion) {
            $initialRegion = $selectedPageRegion;
        }
    }

    if ($postTypeName == 'rfc_cruises') {
        $shipRegions = getShipRegions(get_post());
        if (count($shipRegions) == 1) {
            $initialRegion = $shipRegions[0];
        }
        if (count($shipRegions) > 1) {
            $initialRegion = $initialRegion;
        }

        // check parameter
        if (isset($_GET["region"])) {
            if (isset($_GET["region"]) && $_GET["region"]) {
                $parameter = htmlspecialchars($_GET["region"]);
                $parameterPost = get_post($parameter);
                if ($parameterPost) {
                    $initialRegion = $parameterPost;
                };
            }
        }
    }



    return $initialRegion;
}
