<?php
/*Template Name: Home Old*/

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

$newsletter_image = get_field('newsletter_image');
$newsletter_title = get_field('newsletter_title');
$newsletter_snippet = get_field('newsletter_snippet');

?>

<!-- Hero -->
<?php
get_template_part('template-parts/home/content', 'home-hero');
?>

<div class="content">
  <main>


    <!-- Itineraries  -->
    <?php
    get_template_part('template-parts/home/content', 'home-itineraries');
    ?>

    <!-- Cruises  -->
    <?php
    get_template_part('template-parts/home/content', 'home-cruises');
    ?>



  </main>





  <?php get_footer(); ?>
</div>