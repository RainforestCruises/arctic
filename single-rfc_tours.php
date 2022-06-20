<?php
get_header();
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
?>


<?php
while (have_posts()) :
  the_post();

  //Time Variables
  $currentYear = date("Y");
  $currentMonth = date("m");
  $years = array($currentYear, ($currentYear + 1), ($currentYear + 2));
  $months = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
  $monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");


  $price_packages = get_field('price_packages');
  $lowestPrice = lowest_tour_price($price_packages, $currentYear);
  $lowestYear = initial_price_year($price_packages);


  $dealPosts = listDealsForProduct(get_post(), false);
  $hasDeals = (count($dealPosts) > 0) ? true : false;
  console_log($dealPosts);


  $args = array(
    'lowestPrice' => $lowestPrice,
    'productType' => 'Tour',
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

    <?php
    $show_overview = get_field('show_overview');
    if ($show_overview) : ?>
      <!-- Overview Content -->
      <section class="product-page__section-overview" id="overview">
        <?php
        get_template_part('template-parts/content', 'product-overview', $args);
        ?>
      </section>
    <?php endif;
    ?>


    <!-- Itineraries Content -->
    <section class="product-page__section-itineraries" id="itineraries">
      <?php
      get_template_part('template-parts/content', 'product-itineraries-tour', $args);
      ?>
    </section>

    <!-- Accommodations Content -->
    <section class="product-page__section-accommodation" id="accommodations">
      <!-- H2 Title -->
      <h2 class="page-divider page-divider--padding u-margin-bottom-medium">
        Accommodations
      </h2>
      <?php
      $show_areas = get_field('show_areas');
      if ($show_areas) :
        get_template_part('template-parts/content', 'product-explore', $args); //common areas gallery
      endif;

      get_template_part('template-parts/content', 'product-cabins-tour', $args);
      ?>
    </section>


    <?php $show_testimonials = get_field('show_testimonials');
    if ($show_testimonials) :
    ?>

      <!-- Reviews -->
      <section class="product-page__section-reviews u-margin-top-medium">
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


  </main>





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

<?php get_footer() ?>