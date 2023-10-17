<?php
function load_scripts()
{
    wp_enqueue_style('select2-css', get_template_directory_uri() . '/vendor/select2/select2.min.css', array(), false, 'all');
    wp_enqueue_style('ion-css', get_template_directory_uri() . '/vendor/ion-range-slider/css/ion.rangeSlider.min.css', array(), false, 'all');
    wp_enqueue_style('odometer-css', get_template_directory_uri() . '/vendor/odometer/odometer-theme-minimal.css', array(), false, 'all');
    wp_enqueue_style('swiper-css', get_template_directory_uri() . '/vendor/swiper/swiper-bundle.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap-datepicker-css', get_template_directory_uri() . '/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css', array(), false, 'all');
    wp_enqueue_style('mapbox-gl-css', get_template_directory_uri() . '/vendor/mapbox/mapbox-gl.css', array(), false, 'all');

    wp_enqueue_style('template', get_template_directory_uri() . '/css/style.css', array(), false, 'all');



    //JS -------------- scripts
    wp_enqueue_script('jquery', get_template_directory_uri() . '/vendor/jquery/jquery-3.6.0.min.js', array(), '3.6.0', true);
    wp_enqueue_script('mapbox-gl', get_template_directory_uri() . '/vendor/mapbox/mapbox-gl.js', array(), false, true);
    wp_enqueue_script('select2',  get_template_directory_uri() .  '/vendor/select2/select2.min.js', array('jquery'), false, true);
    wp_enqueue_script('ion-js', get_template_directory_uri() . '/vendor/ion-range-slider/js/ion.rangeSlider.min.js', array('jquery'), false, true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/vendor/isotope/isotope.pkgd.min.js', array('jquery'), false, true);
    wp_enqueue_script('odometer', get_template_directory_uri() . '/vendor/odometer/odometer.min.js', array('jquery'), false, true);
    wp_enqueue_script('moment',  get_template_directory_uri() . '/vendor/moment/moment.min.js', array('jquery'), false, true);
    wp_enqueue_script('swiper', get_template_directory_uri() . '/vendor/swiper/swiper-bundle.min.js', array(), false, true);
    wp_enqueue_script('bootstrap-datepicker', get_template_directory_uri() . '/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js', array(), false, true);
    wp_enqueue_script('popper', get_template_directory_uri() . '/vendor/popperjs/popper.min.js', array(), false, true);
    wp_enqueue_script('vimeo', get_template_directory_uri() . '/vendor/vimeo/player.js', array(), false, true);

    wp_enqueue_script('utility', get_template_directory_uri() . '/js/utilities.js', array('jquery'), false, true);
    wp_enqueue_script('global-functions', get_template_directory_uri() . '/js/global-functions.js', array('jquery'), false, true);
    wp_enqueue_script('header', get_template_directory_uri() . '/js/header.js', array('jquery'), false, true);
    wp_enqueue_script('header-mobile', get_template_directory_uri() . '/js/header-mobile.js', array('jquery'), false, true);


    $alwaysActiveHeader = checkActiveHeader();
    $defaultSearchUrl = get_field('top_level_search_page', 'options');
    wp_localize_script(
        'header',
        'header_vars',
        array(
            'alwaysActiveHeader' =>  $alwaysActiveHeader,
            'defaultSearchUrl' =>  $defaultSearchUrl,

        )
    );

}

add_action('wp_enqueue_scripts', 'load_scripts');
