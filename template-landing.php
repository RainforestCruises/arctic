<?php
/*Template Name: Landing*/
wp_enqueue_script('page-landing', get_template_directory_uri() . '/js/page-landing.js', array('jquery'), false, true);
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);

get_header();

$args = array('footerCtaDivider' => true);

$show_faq = get_field('show_faq');
$show_topics = get_field('show_topics');
$show_map = get_field('show_map');

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
  if ($show_topics) :
    get_template_part('template-parts/landing/content', 'landing-topics', $args);
  endif;
  ?>

  <!-- Map -->
  <?php
  if ($show_map) :
    get_template_part('template-parts/landing/content', 'landing-map', $args);
  endif;
  ?>

  <!-- Faq  -->
  <?php
  if ($show_faq) :
    get_template_part('template-parts/landing/content', 'landing-faq', $args);
  endif;
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
  get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
  ?>


</main>

<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'shared-basic-inquiry-modal', $args);
?>




<?php get_footer(); ?>