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

<!-- About Page Container -->
<main class="about-page">



    <!-- Mission -->
    <section class="about-page__section-mission" id="mission">
        <?php
        get_template_part('template-parts/content', 'about-mission');
        ?>
    </section>

    <!-- Difference -->
    <section class="about-page__section-difference" id="differece">
        <?php
        get_template_part('template-parts/content', 'about-difference');
        ?>
    </section>

    <!-- Team -->
    <section class="about-page__section-team" id="team">
        <?php
        get_template_part('template-parts/content', 'about-team');
        ?>
    </section>


    <!-- Corporate -->
    <section class="about-page__section-corporate" id="corporate">
        <?php
        $isResponsibleTravel = get_field('is_responsible_travel');
        if (!$isResponsibleTravel) :
            get_template_part('template-parts/content', 'about-corporate');
        else :
            get_template_part('template-parts/content', 'about-responsible-travel');
        endif; ?>
  
    </section>


</main>




<?php get_footer(); ?>

