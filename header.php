<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0,user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Ryan">

    <!-- Custom OG Meta -->
    <?php
    // Note: use WP Featured Image for Serps
    $og_featured_image = null;

    // home page
    if (is_page_template('template-home.php')) {
        $og_featured_image = get_field('hero_featured_image');
    }

    // landing / deals top-level page
    if (is_page_template('template-landing.php' || 'template-deals-toplevel.php')) {
        $images = get_field('hero_images');
        $og_featured_image = $images[0];
    }

    // deal / travel guide post
    if (get_post_type() == 'rfc_deals' || get_post_type() == 'rfc_travel_guides') {
        $og_featured_image = get_field('featured_image');
    }

    // ship / itinerary post
    if (get_post_type() == 'rfc_cruises' || get_post_type() == 'rfc_itineraries') {
        $images = get_field('hero_gallery');
        $og_featured_image = $images[0];
    }

    if ($og_featured_image) : ?>
        <meta property="og:image" content="<?php echo $og_featured_image['url']; ?>" />
        <meta property="og:image:secure_url" content="<?php echo $og_featured_image['url']; ?>" />
        <meta property="og:width" content="<?php echo $og_featured_image['width']; ?>" />
        <meta property="og:height" content="<?php echo $og_featured_image['height']; ?>" />
        <meta property="og:alt" content="<?php echo $og_featured_image['alt']; ?>" />
        <meta property="og:type" content="image/jpeg" />
        <meta name="twitter:image" content="<?php echo $og_featured_image['url']; ?>" />
    <?php endif; ?>

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
            background-image: url("<?php echo bloginfo('template_url') ?>/css/img/pin-embark.png");
            background-size: cover;
            width: 20px;
            height: 32px;
            cursor: pointer;
        }

        .disembarkation-marker {
            background-image: url("<?php echo bloginfo('template_url') ?>/css/img/pin-disembark.png");
            background-size: cover;
            width: 20px;
            height: 32px;
            cursor: pointer;
        }
    </style>


    <?php wp_head(); ?>
</head>

<body <?php body_class("global"); ?> id="body">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJ4WH6JQ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <?php get_template_part('template-parts/nav/content', 'nav-mobile'); ?>

    <!-- Header (Main Nav) -->

    <header class="header <?php echo renderHeaderClasses(); ?>" id="header">

        <!--  Notice -->
        <?php if (get_field('show_site_notice', 'options')) : ?>
            <div class="site-notice <?php echo renderHeaderClasses(); ?>">
                <div class="site-notice__content">
                    <?php echo get_field('site_notice', 'options') ?>
                </div>
            </div>
        <?php endif; ?>
        <!-- End Notice -->

        <?php if (get_post_type() == 'rfc_travel_guides') : ?>
            <div class="progress-container">
                <div class="progress-bar" id="progressBar"></div>
            </div>
        <?php endif; ?>
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
    if (is_page_template('template-landing.php')) :
        get_template_part('template-parts/nav/secondary/content', 'nav-landing');
    endif; ?>

    <?php
    if (is_page_template('template-deals-toplevel.php')) :
        get_template_part('template-parts/nav/secondary/content', 'nav-deals-toplevel');
    endif; ?>