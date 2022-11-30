<?php
/*Template Name: Home*/

wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home.js', array('jquery'), false, true);

$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-home',
    'page_vars',
    array(
        'templateUrl' =>  $templateUrl
    )
);

get_header();


?>


<main class="home-page">

    <!-- Hero -->
    <?php
    get_template_part('template-parts/home/content', 'home-hero');
    ?>

    <!-- Cruises  -->
    <?php
    get_template_part('template-parts/home/content', 'home-cruises');
    ?>

    <!-- Itineraries  -->
    <?php
    get_template_part('template-parts/home/content', 'home-itineraries');
    ?>

    <!-- Styles  -->
    <?php
    get_template_part('template-parts/home/content', 'home-styles');
    ?>

    <!-- Reviews  -->
    <?php
    get_template_part('template-parts/home/content', 'home-reviews');
    ?>

    <!-- Guides  -->
    <?php
    get_template_part('template-parts/home/content', 'home-guides');
    ?>

</main>





<?php get_footer(); ?>