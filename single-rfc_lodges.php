<?php

wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
  'page-product',
  'page_vars',
  array(
    'templateUrl' =>  $templateUrl
  )
);

get_header();
?>
<?php
while (have_posts()) :
  the_post();


  $cruise_data = get_field('cruise_data');

  //Time Variables
  $currentYear = date("Y");
  $currentMonth = date("m");
  $years = array($currentYear, ($currentYear + 1), ($currentYear + 2));
  $months = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
  $monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

  $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear, true);


  
  $dealPosts = listDealsForProduct(get_post(), false);
  $hasDeals = (count($dealPosts) > 0) ? true : false;
  console_log($dealPosts);

  $args = array(
    'lowestPrice' => $lowestPrice,
    'cruiseData' => $cruise_data,
    'productType' => 'Lodge',
    'currentYear' => $currentYear,
    'currentMonth' => $currentMonth,
    'years' => $years,
    'months' => $months,
    'monthNames' => $monthNames,
    'charter_view' => false,
    'hasDeals' => $hasDeals,
    'dealPosts' => $dealPosts
  );

?>

  <!-- Product Page Container -->
  <main class="product-page">

    <!-- Hero -->
    <section class="product-page__section-hero" id="top">
      <?php
      get_template_part('template-parts/content', 'product-hero', $args);
      ?>
    </section>


    <!-- Overview Content -->
    <section class="product-page__section-overview" id="overview">
      <?php
      get_template_part('template-parts/content', 'product-overview', $args);
      ?>
    </section>

    <!-- Itineraries Content -->
    <section class="product-page__section-itineraries" id="itineraries">
      <?php
      get_template_part('template-parts/content', 'product-itineraries', $args);
      ?>
    </section>

    <!-- Accommodations Content -->
    <section class="product-page__section-accommodation" id="accommodations">
      <h2 class="page-divider page-divider--padding u-margin-bottom-medium">
        Accommodations
      </h2>
      <?php
      get_template_part('template-parts/content', 'product-explore', $args); //common areas gallery
      ?>
      <?php
      get_template_part('template-parts/content', 'product-cabins', $args);
      ?>
      <?php
      get_template_part('template-parts/content', 'product-technical', $args);
      ?>
    </section>


    <!-- Reviews -->
    <?php if (get_field('show_testimonials') == true) : ?>
      <section class="product-page__section-reviews">
        <?php
        get_template_part('template-parts/content', 'product-reviews', $args);
        ?>
      </section>
    <?php endif; ?>

    <!-- Related Travel -->

    <section class="product-page__section-related">
      <?php
      get_template_part('template-parts/content', 'product-related', $args);
      ?>
    </section>


    </ma>



  <?php
endwhile;
  ?>
  
    <!-- Deals Modal -->
    <?php
  if ($hasDeals == true) {
    get_template_part('template-parts/content', 'product-deals-modal', $args);
  }
  ?>
  <!-- Contact Modal -->
  <?php
  get_template_part('template-parts/content', 'shared-contact-modal', $args);
  ?>

  <!-- Prices Extra -->
  <?php
  get_template_part('template-parts/content', 'product-prices-extra', $args);
  ?>

  <!-- Notification Message-->
  <?php
  $show_notification = get_field('show_notification');
  if ($show_notification) :
    get_template_part('template-parts/content', 'product-notification', $args);
  endif;
  ?>

  <!-- #site-wrapper end-->
  <?php get_footer() ?>