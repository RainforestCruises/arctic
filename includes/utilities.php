<?php

function getUniquePostsFromArrayOfPosts($posts)
{
    $uniquePosts = [];
    foreach ($posts as $post) {
        if (!in_array($post, $uniquePosts)) {
            $uniquePosts[] = $post;
        }
    }
    return $uniquePosts;
}

function findObjectById($id, $array, $key = 'Id')
{
    foreach ($array as $element) {
        if ($id == $element[$key]) {
            return $element;
        }
    }
    return false;
}


//Console Log Utility--------------
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}
//--------------------------------


//IMAGES ------------------------
function afloat_image_markup($image_id, $image_size, $sizes_array = [])
{
    if ($image_id == '') {
        return 'no-image-id';
    }

    $image_src = wp_get_attachment_image_url($image_id, $image_size);
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

    $default_image_attributes = wp_get_attachment_image_src($image_id, $image_size);
    $default_width = $default_image_attributes[1];
    $default_height = $default_image_attributes[2];

    $markup = 'src="' . $image_src . '" alt="' . $image_alt . '" ' . 'width="' . $default_width . '" height="' . $default_height . '"';


    $generate_source_set_image_markup = get_field('generate_source_set_image_markup', 'options');
    if (!$generate_source_set_image_markup) {
        echo $markup;
    } else {

        if (!$sizes_array) {
            echo $markup;
        } else {
            $image_srcset = '';
            $max_width = 0;
            foreach ($sizes_array as $s) {
                $image_attributes = wp_get_attachment_image_src($image_id, $s);
                $image_srcset = $image_srcset . $image_attributes[0] . ' ' . $image_attributes[1] . 'w,';

                if ($image_attributes[1] > $max_width) {
                    $max_width = $image_attributes[1];
                }
            }
            echo $markup . ' " srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . 'px) 100vw, ' . $max_width . 'px"';
        }
    }
}



//FORMATTING -----------------------
function removePtags($text)
{
    $formatted_text = str_replace(['<p>', '</p>'], '', $text);

    return $formatted_text;
}
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

        $fieldText = get_the_title($a);
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
    if (is_plugin_active('currency-switcher/index.php')) {
        $display = do_shortcode('[wpcs_price value=' . $price . ']');
        if ($price > 0) {
            $display = do_shortcode('[wpcs_price value=' . $price . ']');
        } else {
            $display = "N/A";
        }
    } else {
        if ($price > 0) {
            $display = "$" .  number_format($price, 0);
        } else {
            $display = "N/A";
        }
    }

    echo $display;
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


// Random Code Generator
function getRandomHex($num_bytes = 4)
{
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
}


// generate array of years 
function createYearSelection($current, $yearsCount)
{
    $years = [];
    $count = 0;
    while ($count < $yearsCount) {
        $years[] = $current + $count;
        $count++;
    }
    return $years;
}

// Table Of Contents Generator
function generateIndex($html)
{
    preg_match_all('/<h([1-6])([^>]*)>(.*?)<\/h[1-6]>/i', $html, $matches, PREG_SET_ORDER);
    $index = "<ul>";
    $prev = 2;
    foreach ($matches as $match) {
        $curr = $match[1];
        $attributes = $match[2];
        $text = strip_tags($match[3]);
        $slug = strtolower(str_replace("--", "-", preg_replace('/[^\da-z&]/i', '-', str_replace('&amp', 'and', $text))));
        $anchor = '<div name="' . $slug . '" class="toc-link">' . $text . '</div>';
        $replacement = "<h{$curr}{$attributes}>{$anchor}</h{$curr}>";
        $html = str_replace($match[0], $replacement, $html);
        $prev <= $curr ?: $index .= str_repeat('</ul>', ($prev - $curr));
        $prev >= $curr ?: $index .= "<ul>";
        $index .= '<li><a href="#' . $slug . '" class="toc-link">' . $text . '</a></li>';
        $prev = $curr;
    }
    $index .= "</ul>";
    return ["html" => $html, "index" => $index];
}


//Generate Initials 
function generateInitials($name)
{
    $words = explode(' ', $name);

    if (count($words) >= 2) {
        return mb_strtoupper(
            mb_substr($words[0], 0, 1, 'UTF-8') .
                mb_substr(end($words), 0, 1, 'UTF-8'),
            'UTF-8'
        );
    } else {
        preg_match_all('#([A-Z]+)#', $name, $capitals);
        if (count($capitals[1]) >= 2) {
            return mb_substr(implode('', $capitals[1]), 0, 2, 'UTF-8');
        }
        return mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');
    }
}

//Random Background Color
function generateBgColor()
{
    $background_colors = array('#60568f', '#708765', '#164852', '#919169', '#798fb3', '#7d6a5f', '#608071', '#537875', '#455d73', '#734d6e');
    $rand_background = $background_colors[array_rand($background_colors)];

    return $rand_background;
}
