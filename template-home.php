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



    <!-- Newest Cruises  -->
    <?php
    get_template_part('template-parts/home/content', 'home-newest');
    ?>

    <!-- Destinations -->
    <?php
    get_template_part('template-parts/home/content', 'home-destinations');
    ?>




  </main>





  <?php get_footer(); ?>
</div>