<?php


//Console Log Utility--------------
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}
//--------------------------------


//IMAGES ------------------------
//CLD 3.0
function afloat_image_markup($image_id, $image_size, $sizes_array = [], $flickity = false)
{


    if ($image_id != '') {
        //options - generate_custom_image_markup
        $customEnabled = true; //easier way to control image markup .. set to false to test CLS v3 (must change hero sliders - home/destination - flickity sliders lazy loading)

        if ($customEnabled == false) {
            //CLOUDINARY v3 --
            //specify h/w, generare src only, add class='size-imagesize'
            $image_src = wp_get_attachment_image_url($image_id, $image_size);
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
            $image_attributes = wp_get_attachment_image_src($image_id, $image_size);
            echo 'height="' . $image_attributes[2] . '" width="' . $image_attributes[1] . '" src="' . $image_src . '" alt="' . $image_alt . '" class="size-' . $image_size . '"';
        } 
        else {
            //Cloudinary v2.6 (and everything else)
            //omit h/w, generate src and srcset

            // set the default src image size
            $image_src = wp_get_attachment_image_url($image_id, $image_size);
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);


            $image_srcset = '';
            $max_width = 0;
            foreach ($sizes_array as $s) {
                $image_attributes = wp_get_attachment_image_src($image_id, $s);
                $image_srcset = $image_srcset . $image_attributes[0] . ' ' . $image_attributes[1] . 'w,';

                if ($image_attributes[1] > $max_width) {
                    $max_width = $image_attributes[1];
                }
            }

            if($flickity == false){
                echo 'src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . 'px) 100vw, ' . $max_width . 'px" alt="' . $image_alt . '"';
            }else {
                //special markup for flickity slider with lazy loading
                echo ' data-flickity-lazyload-src="' . $image_src . '" data-flickity-lazyload-srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . 'px) 100vw, ' . $max_width . 'px" alt="' . $image_alt . '"';
            }

        }
    } else {
        'no-image-id';
    }
}

//For images from DF (Cruises / Lodges) - Cabins, D2D, Maps, apply cloudinary custom transformation for format/quality/crop
function afloat_dfcloud_image($image_url)
{

    //check for res.cloudinary.com
    if (strpos($image_url, 'res.cloudinary.com') == false) {
        return $image_url;
    }

    $string = $image_url;
    $prefix = "/image/upload/";
    $first = substr($string, 0, strpos($string, '/image/upload/') + strlen($prefix));

    $transformationString = 'f_auto,q_auto/c_fill,g_auto/';
    $index = strpos($string, $prefix) + strlen($prefix);

    $second = substr($string, $index);

    $new_url = $first . $transformationString . $second;


    return $new_url;
}

//Images - DEPRECATED
function afloat_responsive_image($image_id, $image_size, $sizes_array, $slickLazy = false)
{

    // check the image ID is not blank
    if ($image_id != '') {

        // set the default src image size
        $image_src = wp_get_attachment_image_url($image_id, $image_size);
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);


        $image_srcset = '';
        $max_width = 0;
        foreach ($sizes_array as $s) {
            $image_attributes = wp_get_attachment_image_src($image_id, $s);
            $image_srcset = $image_srcset . $image_attributes[0] . ' ' . $image_attributes[1] . 'w,';

            if ($image_attributes[1] > $max_width) {
                $max_width = $image_attributes[1];
            }
        }

        // generate the markup for the responsive image

        if ($slickLazy == true) {
            echo 'data-lazy="' . $image_src . '"  alt="' . $image_alt . '"';
        } else {
            echo 'loading="lazy" src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . 'px) 100vw, ' . $max_width . 'px" alt="' . $image_alt . '"';
            //echo 'src="' . $image_src . '" alt="' . $image_alt . '"';

        }
    }
}


//Images - lazy loading for flickity - DEPRECATED
function afloat_responsive_image_lazy($image_id, $image_size, $sizes_array)
{

    // check the image ID is not blank
    if ($image_id != '') {

        // set the default src image size
        $image_src = wp_get_attachment_image_url($image_id, $image_size);
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

        $image_srcset = '';
        $max_width = 0;
        foreach ($sizes_array as $s) {
            $image_attributes = wp_get_attachment_image_src($image_id, $s);
            $image_srcset = $image_srcset . $image_attributes[0] . ' ' . $image_attributes[1] . 'w,';

            if ($image_attributes[1] > $max_width) {
                $max_width = $image_attributes[1];
            }
        }

        // generate the markup for the responsive image
        echo ' data-flickity-lazyload-src="' . $image_src . '" data-flickity-lazyload-srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . 'px) 100vw, ' . $max_width . 'px" alt="' . $image_alt . '"';
        //echo ' src="' . $image_src . '"  alt="' . $image_alt . '"';

    } else {
        echo 'no-image-id';
    }
}


//FORMATTING -----------------------
function comma_separate_list($arr, $limit = 0)
{
    $count = 0;
    $display = "";

    $listCount = count($arr);
    foreach ($arr as $a) :

        if ($limit != 0 && $count >= $limit) {
            $display .= ' +' . ($listCount - $limit) . ' more';
            break;
        }

        $fieldText = get_field('navigation_title', $a);
        if ($count != 0) {
            $display .= ", " . $fieldText;
        } else {
            $display .= $fieldText;
        }
        $count++;
    endforeach;


    return $display;
}

function priceFormat($price)
{

    $display = "";
    if ($price > 0) {
        $display = "$" .  number_format($price, 0);
    } else {
        $display = "N/A";
    }

    return $display;
}

//Breadcrumbs - json-ld
function structuredData($templateType)
{

    $breadcrumb = get_field('breadcrumb');

    //breadcrumb
    $breadcrumbStart = '<script type="application/ld+json">{ 
                "@context": "https://schema.org",
                "@type": "BreadcrumbList",
                "itemListElement": [';


    $breadcrumbEnd = '] } </script>';

    $initialItem = '{"@type": "ListItem", "position": 1, "name": "Home", "item": "' . home_url() . '" },';

    $returnString = '';

    //PRODUCT / Search - same structure
    if ($templateType == 'product') {

        if ($breadcrumb) {
            $count = 2; //home is first item
            $returnString = $breadcrumbStart;

            $returnString .= $initialItem;



            $i = 1;
            foreach ($breadcrumb as $b) {
                $itemLink = $b['link'] == null ? '' : $b['link'];
                $itemTitle = $b['title'] == null ? '' : $b['title'];

                if ($b['link'] != null) {
                    $itemString = '{"@type": "ListItem", "position": ' . $count . ', "name": "' . $itemTitle . '", "item": "' . $itemLink . '" }';
                } else {
                    $itemString = '{"@type": "ListItem", "position": ' . $count . ', "name": "' . $itemTitle . '" }';
                }

                if ($i != count($breadcrumb)) { //add comma if not last
                    $itemString .= ',';
                }

                $returnString .= $itemString;
                $count++;
                $i++;
            }
            $returnString .= $breadcrumbEnd;
        };
        return $returnString;
    }


    //DESTINATION
    if ($templateType == 'destination') {

        $returnString = $breadcrumbStart;
        $returnString .= $initialItem;

        if (!is_page_template('template-destinations-region.php')) { //Destination / Cruise
            $destination = get_field('destination_post');
            $itemTitle = get_field('breadcrumb_name');
            $itemLink = get_field('breadcrumb_link');
            $itemString = '{"@type": "ListItem", "position": 2, "name": "' . $itemTitle . '", "item": "' . $itemLink . '" },';

            $returnString .= $itemString; //region

            $itemTitle2 = get_field('navigation_title', $destination);
            $itemString2 = '{"@type": "ListItem", "position": 3, "name": "' . $itemTitle2 . '" }';
            $returnString .= $itemString2; //current destination (no-link)

        } else { //Region Variant

            $region = get_field('region_post');

            $itemTitle = get_field('navigation_title', $region);
            $itemString = '{"@type": "ListItem", "position": 2, "name": "' . $itemTitle . '" }';
            $returnString .= $itemString; // current destination (region - no link)
        }

        return $returnString .= $breadcrumbEnd;
    }


    //Guide Landing Page
    if ($templateType == 'guideLanding') {

        $returnString = $breadcrumbStart;
        $returnString .= $initialItem;


        $breadcrumbDestinationPage  = get_field('breadcrumb_destination_page');

        $itemTitle = '';
        $itemLink = '';
        if ($breadcrumbDestinationPage) {
            $itemLink = get_permalink($breadcrumbDestinationPage);
            $templateType = get_page_template_slug($breadcrumbDestinationPage->ID);

            //get the name (itemTitle) based on page template selection
            if ($templateType == 'template-destinations-destination.php' || $templateType == 'template-destinations-cruise.php') {
                $destinationPost = get_field('destination_post', $breadcrumbDestinationPage);
                $itemTitle  = get_field('navigation_title', $destinationPost);
            }
            if ($templateType == 'template-destinations-region.php') {
                $regionPost = get_field('region_post', $breadcrumbDestinationPage);
                $itemTitle  = get_field('navigation_title', $regionPost);
            }


            $itemString = '{"@type": "ListItem", "position": 2, "name": "' . $itemTitle . '", "item": "' . $itemLink . '" },'; //parent breadcrumb
            $returnString .= $itemString;

            $itemString2 = '{"@type": "ListItem", "position": 3, "name": "' . get_the_title() . '" }'; //the current page
            $returnString .= $itemString2;
        }

        return $returnString .= $breadcrumbEnd;
    }


    //Guide 
    if ($templateType == 'guide') {

        $returnString = $breadcrumbStart;
        $returnString .= $initialItem;


        $breadcrumbDestinationPage  = get_field('breadcrumb_destination_page');

        $itemTitle = '';
        $itemLink = '';
        if ($breadcrumbDestinationPage) {
            $itemLink = get_permalink($breadcrumbDestinationPage);
            $templateType = get_page_template_slug($breadcrumbDestinationPage->ID);

            //get the name (itemTitle) based on page template selection
            if ($templateType == 'template-destinations-destination.php' || $templateType == 'template-destinations-cruise.php') {
                $destinationPost = get_field('destination_post', $breadcrumbDestinationPage);
                $itemTitle  = get_field('navigation_title', $destinationPost);
            }
            if ($templateType == 'template-destinations-region.php') {
                $regionPost = get_field('region_post', $breadcrumbDestinationPage);
                $itemTitle  = get_field('navigation_title', $regionPost);
            }


            //destination/region
            $itemString = '{"@type": "ListItem", "position": 2, "name": "' . $itemTitle . '", "item": "' . $itemLink . '" },'; //parent breadcrumb
            $returnString .= $itemString;





            //landing page
            $breadcrumbTravelGuidePage  = get_field('breadcrumb_travel_guide_page');
            $itemTitle2  = "";
            $itemLink2  = "";
            if ($breadcrumbTravelGuidePage) {
                $itemLink2 = get_permalink($breadcrumbTravelGuidePage);

                $guideType = get_field('destination_type', $breadcrumbTravelGuidePage);

                $itemTitle2  = "";

                if ($guideType == 'rfc_destinations') {
                    $destinationPost = get_field('destination', $breadcrumbTravelGuidePage);
                    $itemTitle2  = get_field('navigation_title', $destinationPost);
                }
                if ($guideType == 'rfc_regions') {
                    $regionPost = get_field('region', $breadcrumbTravelGuidePage);
                    $itemTitle2  = get_field('navigation_title', $regionPost);
                }
                if ($guideType == 'rfc_locations') {
                    $locationPost = get_field('location', $breadcrumbTravelGuidePage);
                    $itemTitle2  = get_field('navigation_title', $locationPost);
                }
                $itemTitle2 .= ' Travel Guide';
            }


            //landing page
            $itemString2 = '{"@type": "ListItem", "position": 2, "name": "' . $itemTitle2 . '", "item": "' . $itemLink2 . '" },'; //parent breadcrumb
            $returnString .= $itemString2;


            $itemString3 = '{"@type": "ListItem", "position": 4, "name": "' . get_the_title() . '" }'; //the current page
            $returnString .= $itemString3;
        }

        return $returnString .= $breadcrumbEnd;
    }
}


//FAQ json-ld
function structuredDataFaq()
{
    $faqs = get_field('faqs');


    $jsonStart = '<script type="application/ld+json">{ 
                "@context": "https://schema.org",
                "@type": "FAQPage",
                "mainEntity": [';


    $jsonEnd = '] } </script>';



    $returnString = '';


    if ($faqs) {
        $count = 1; //home is first item
        $returnString = $jsonStart;

        foreach ($faqs as $f) {
            $itemQuestion = $f['question'] == null ? '' : $f['question'];
            $itemAnswer = $f['answer'] == null ? '' : $f['answer'];
            $itemAnswerTrim = trim($itemAnswer);
            $itemAnswerNoQuote = str_replace('"', "'", $itemAnswerTrim);

            $itemString = '{"@type": "Question", "name": "' . $itemQuestion . '", "acceptedAnswer": {"@type": "Answer", "text": "' . $itemAnswerNoQuote . '"}}';;


            if ($count != count($faqs)) { //add comma if not last
                $itemString .= ',';
            }

            $returnString .= $itemString;
            $count++;
        }
        $returnString .= $jsonEnd;
    };



    return $returnString;
}


function checkActiveHeader()
{
    $alwaysActiveHeader = false;
    $templateName = get_page_template_slug();
    $postTypeName = get_post_type();

    if ($templateName == 'template-reviews-toplevel.php' || $templateName == 'template-about.php' || $templateName == 'template-generic.php' || $templateName == 'template-deals.php' || $templateName == 'template-deals-toplevel.php' || $templateName == 'template-error404.php' || $templateName == 'template-contact.php' || $templateName == 'template-search.php' || $templateName == 'template-travel-guide.php') {
        $alwaysActiveHeader = true;
    }

    if ($postTypeName == 'rfc_travel_guides') {
        $alwaysActiveHeader = true;
    }

    return $alwaysActiveHeader;
}
