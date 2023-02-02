<?php
get_header();
wp_enqueue_script('page-guide', get_template_directory_uri() . '/js/page-guide.js', array('jquery'), false, true);

$show_ships = get_field('show_ships');
$show_itineraries = get_field('show_itineraries');


?>


<!-- Travel Guide Single -->
<main>

  <!-- Hero -->
  <?php
  get_template_part('template-parts/guide/content', 'guide-hero', $args);
  ?>

  <!-- Main Section -->
  <?php
  get_template_part('template-parts/guide/content', 'guide-main', $args);
  ?>

  <!-- Related Guides -->
  <?php
  get_template_part('template-parts/guide/content', 'guide-related', $args);
  ?>

  <!-- Ships -->
  <?php
  if ($show_ships) :
    get_template_part('template-parts/guide/content', 'guide-ships', $args);
  endif;
  ?>

  <!-- Itineraries -->
  <?php
  if ($show_itineraries) :
    get_template_part('template-parts/guide/content', 'guide-itineraries', $args);
  endif;
  ?>

  <!-- Footer CTA  -->
  <?php
  get_template_part('template-parts/shared/content', 'shared-footer-cta');
  ?>


</main>



<!-- #site-wrapper end-->
<?php get_footer() ?>