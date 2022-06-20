<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0,user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Ryan Lewis">

    <!-- Structured Data / Rich Snippets -->
    <?php
    //Destination
    if (is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-cruise.php') || is_page_template('template-destinations-region.php')) {
        echo structuredData('destination'); //Breadcrumbs
        echo structuredDataFaq(); // FAQ
    }

    //Product
    if (get_post_type() == 'rfc_cruises' || get_post_type() == 'rfc_tours' || get_post_type() == 'rfc_lodges') {
        echo structuredData('product');
    }

    //Search
    if (is_page_template('template-search.php')) {
        echo structuredData('product'); //identical structures
    }

    //Travel Guide Landing Page
    if (is_page_template('template-travel-guide.php')) {
        echo structuredData('guideLanding');
    }

    //Travel Guide
    if (get_post_type() == 'rfc_travel_guides') {
        echo structuredData('guide');
    }

    ?>

    <!-- Load Head / Style Sheets -->
    <?php wp_head(); ?>
</head>

<body <?php body_class("global"); ?> id="body">


    <?php
    $is_arctic = get_field('is_arctic', 'options');

    if ($is_arctic != true) :
        
        get_template_part('template-parts/content', 'nav-rfc');
 
    else :
        get_template_part('template-parts/content', 'nav-arctic');
    endif;
    ?>