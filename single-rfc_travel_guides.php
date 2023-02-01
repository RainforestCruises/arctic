<?php
get_header();
wp_enqueue_script('page-travel-guide', get_template_directory_uri() . '/js/page-travel-guide.js', array('jquery'), false, true);




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


  <!-- Footer CTA  -->
  <?php
  get_template_part('template-parts/shared/content', 'shared-footer-cta');
  ?>


</main>



<!-- #site-wrapper end-->
<?php get_footer() ?>