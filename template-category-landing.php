<?php
/*Template Name: Category Landing*/
wp_enqueue_script('page-category-landing', get_template_directory_uri() . '/js/page-category-landing.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-category-landing',
    'page_vars',
    array(
        'templateUrl' =>  $templateUrl
    )
);
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);


get_header();

?>



<main class="main-content">

    <!-- Hero -->
    <?php
    get_template_part('template-parts/category-landing/content', 'category-hero', $args);
    ?>

    <!-- Overview / Highlights -->
    <?php
    get_template_part('template-parts/category-landing/content', 'category-overview', $args);
    ?>

    <!-- Ships -->
    <?php
    get_template_part('template-parts/category-landing/content', 'category-ships', $args);
    ?>

    <!-- Itineraries  -->
    <?php
    get_template_part('template-parts/category-landing/content', 'category-itineraries', $args);
    ?>
    
    <!-- Guides  -->
    <?php
    get_template_part('template-parts/category-landing/content', 'category-guides', $args);
    ?>

    <!-- Faq  -->
    <?php
    get_template_part('template-parts/category-landing/content', 'category-faq', $args);
    ?>


</main>

<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'modal-inquiry', $args);
?>




<?php get_footer(); ?>