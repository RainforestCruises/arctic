<?php
/*Template Name: About*/


wp_enqueue_script('page-about', get_template_directory_uri() . '/js/page-about.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-about',
    'page_vars',
    array(
        'templateUrl' =>  $templateUrl
    )
);
?>

<?php
get_header();

?>


<main class="main-content">

    <!-- Mission -->
    <?php
    get_template_part('template-parts/about/content', 'about-mission');
    ?>
    <!-- Difference -->
    <?php
    get_template_part('template-parts/about/content', 'about-difference');
    ?>
    <!-- Team -->
    <?php
    get_template_part('template-parts/about/content', 'about-team');
    ?>


    <!-- Corporate / Partners-->
    <?php
    $isResponsibleTravel = get_field('is_responsible_travel');
    if (!$isResponsibleTravel) :
        get_template_part('template-parts/about/content', 'about-corporate');
    else :
        get_template_part('template-parts/about/content', 'about-responsible-travel');
    endif; ?>


</main>




<?php get_footer(); ?>