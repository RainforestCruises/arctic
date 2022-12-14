<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0,user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Ryan">

    <!-- Structured Data / Rich Snippets -->
    <!-- Load Head / Style Sheets -->

    <style>
        .destination-marker {
            background-image: url("<?php echo bloginfo('template_url') ?>/css/img/pin-dest.png");
            background-size: cover;
            width: 20px;
            height: 32px;
            cursor: pointer;
            opacity: .85 !important;
        }
        .embarkation-marker {
            background-image: url("<?php echo bloginfo('template_url') ?>/css/img/pinMarker-embark.png");
            background-size: cover;
            width: 20px;
            height: 32px;
            cursor: pointer;
        }
        .disembarkation-marker {
            background-image: url("<?php echo bloginfo('template_url') ?>/css/img/pinMarker-disembark.png");
            background-size: cover;
            width: 20px;
            height: 32px;
            cursor: pointer;
        }
    </style>


    <?php wp_head(); ?>
</head>

<body <?php body_class("global"); ?> id="body">

    <!-- Form Hidden -->
    <form class="nav-search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="nav-search-form">
        <input type="hidden" name="action" value="navSearch">
        <input type="hidden" name="formDates" id="formDates" value="">
        <input type="hidden" name="formDestination" id="formDestination" value="">
    </form>


    <!-- Header (Main Nav) -->
    <?php $headerClasses = renderHeaderClasses(); ?>
    <header class="header <?php echo $headerClasses; ?>" id="header">
        <?php get_template_part('template-parts/nav/content', 'nav-main'); ?>
    </header>
    <div class="nav-backdrop"></div>


    <?php if (get_post_type() == 'rfc_cruises') :
        get_template_part('template-parts/nav/secondary/content', 'nav-cruise');
    endif; ?>

    <?php if (get_post_type() == 'rfc_itineraries') :
        get_template_part('template-parts/nav/secondary/content', 'nav-itinerary');
    endif; ?>

    <?php
    if (is_page_template('template-category-landing.php')) :
        get_template_part('template-parts/nav/secondary/content', 'nav-category');
    endif; ?>