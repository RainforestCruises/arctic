<?php
/*Template Name: Landing*/
wp_enqueue_script('page-landing', get_template_directory_uri() . '/js/page-landing.js', array('jquery'), false, true);
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);


get_header();


$args = array('footerCtaDivider' => true);

?>



<main class="main-content">

  <!-- Hero -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-hero', $args);
  ?>

  <!-- Overview / Highlights -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-overview', $args);
  ?>

  <!-- Itineraries  -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-itineraries', $args);
  ?>

  <!-- Topics  -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-topics', $args);
  ?>

  <!-- map  -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-map', $args);
  ?>

  <!-- Faq  -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-faq', $args);
  ?>

  <!-- Ships -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-ships', $args);
  ?>

  <!-- Guides  -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-guides', $args);
  ?>


  <!-- Footer CTA  -->
  <?php
  get_template_part('template-parts/shared/content', 'shared-footer-cta');
  ?>


</main>

<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'shared-basic-inquiry-modal', $args);
?>




<?php get_footer(); ?>