<?php
function load_scripts()
{

    wp_enqueue_style('flickity-css',  get_template_directory_uri() . '/vendor/flickity/flickity.css', array(), false, 'all');
    wp_enqueue_style('flickity-fade-css', get_template_directory_uri() . '/vendor/flickity/flickity-fade.css', array(), false, 'all');

    wp_enqueue_style('slick-theme',  get_template_directory_uri() . '/vendor/slick/slick-theme.css', array(), false, 'all');
    wp_enqueue_style('slick-min', get_template_directory_uri() . '/vendor/slick/slick.css', array(), false, 'all');

    wp_enqueue_style('magnific-css', get_template_directory_uri() .  '/vendor/magnific/magnific-popup.css', array(), false, 'all');
    wp_enqueue_style('select2-css', get_template_directory_uri() . '/vendor/select2/select2.min.css', array(), false, 'all');
    wp_enqueue_style('ion-css', get_template_directory_uri() . '/vendor/ion-range-slider/css/ion.rangeSlider.min.css', array(), false, 'all');
    wp_enqueue_style('odometer-css', get_template_directory_uri() . '/vendor/odometer/odometer-theme-minimal.css', array(), false, 'all');



    wp_enqueue_style('template', get_template_directory_uri() . '/css/style.css', array(), false, 'all');



    //JS -------------- scripts
    wp_enqueue_script('jquery', get_template_directory_uri() . '/vendor/jquery/jquery-3.6.0.min.js', array(), '3.6.0', true);

    wp_enqueue_script('flickity-js', get_template_directory_uri() . '/vendor/flickity/flickity.pkgd.min.js', array(), false, true);
    wp_enqueue_script('flickity-fade-js', get_template_directory_uri() . '/vendor/flickity/flickity-fade.js', array(), false, true);
    wp_enqueue_script('flickity-nav-js', get_template_directory_uri() . '/vendor/flickity/as-nav-for.js', array(), false, true);

    wp_enqueue_script('slick', get_template_directory_uri() . '/vendor/slick/slick.js', array('jquery'), false, true);
    wp_enqueue_script('magnific-js', get_template_directory_uri() .  '/vendor/magnific/jquery.magnific-popup.min.js', array('jquery'), false, true);
    wp_enqueue_script('select2',  get_template_directory_uri() .  '/vendor/select2/select2.min.js', array('jquery'), false, true);
    wp_enqueue_script('ion-js', get_template_directory_uri() . '/vendor/ion-range-slider/js/ion.rangeSlider.min.js', array('jquery'), false, true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/vendor/isotope/isotope.pkgd.min.js', array('jquery'), false, true);
    wp_enqueue_script('odometer', get_template_directory_uri() . '/vendor/odometer/odometer.min.js', array('jquery'), false, true);
    wp_enqueue_script('moment',  get_template_directory_uri() . '/vendor/moment/moment.min.js', array('jquery'), false, true);



    wp_enqueue_script('utility', get_template_directory_uri() . '/js/utilities.js', array('jquery'), false, true);
    wp_enqueue_script('header', get_template_directory_uri() . '/js/header.js', array('jquery'), false, true);

    $alwaysActiveHeader = checkActiveHeader();

    wp_localize_script(
        'header',
        'header_vars',
        array(
            'alwaysActiveHeader' =>  $alwaysActiveHeader
        )
    );
    

}

add_action('wp_enqueue_scripts', 'load_scripts');
