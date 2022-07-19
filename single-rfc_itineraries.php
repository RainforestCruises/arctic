<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-itinerary', get_template_directory_uri() . '/js/page-itinerary.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
  'page-itinerary',
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
  $itinerary_id = get_field('itinerary_id');

  $itineraries = $cruise_data['Itineraries'];
  $itinerary_data;

  //Get Itinerary from cruise data
  foreach ($itineraries as $i) {
    if ($i['Id'] == $itinerary_id) {
      $itinerary_data = $i;
    }
  }


  //Time Variables
  $currentYear = date("Y");
  $currentMonth = date("m");
  $years = array($currentYear, ($currentYear + 1), ($currentYear + 2));
  $months = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
  $monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");


  $charter_only = get_field('charter_only');
  $charter_available = get_field('charter_available');
  $charter_daily_price = 0;

  if (array_key_exists("LowestCharterPrice", $cruise_data)) {
    $charter_daily_price = $cruise_data['LowestCharterPrice'];
  }


  $vessel_capacity = get_field('vessel_capacity');
  $charter_min_days = get_field('charter_min_days');


  //check URL for charter flag
  $charter_view = false;
  if (isset($_GET['charter'])) {
    if ($_GET['charter'] == "true" && $charter_available == true) {
      $charter_view = true;
    }
  }

  if ($charter_only == true) {
    $charter_view = true;
  }

  $lowestPrice = lowest_property_price($cruise_data, 0, $currentYear, true);



  //Get Deals
  $dealPosts = listDealsForProduct(get_post(), $charter_view);

  $hasDeals = (count($dealPosts) > 0) ? true : false;


  $args = array(
    'lowestPrice' => $lowestPrice,
    'cruiseData' => $cruise_data,
    'itinerary_data' => $itinerary_data,
    'productType' => 'Itinerary',
    'currentYear' => $currentYear,
    'currentMonth' => $currentMonth,
    'years' => $years,
    'months' => $months,
    'monthNames' => $monthNames,
    'charter_view' => $charter_view,
    'charter_available' => $charter_available,
    'charter_daily_price' => $charter_daily_price,
    'vessel_capacity' => $vessel_capacity,
    'charter_min_days' => $charter_min_days,
    'charter_only' => $charter_only,
    'hasDeals' => $hasDeals,
    'dealPosts' => $dealPosts

  );

?>

  <!-- Product Page Container -->
  <main class="itinerary-page">

    <!-- Hero -->
    <?php
    get_template_part('template-parts/itinerary/content', 'itinerary-hero', $args);
    ?>

    <!-- Overview -->
    <?php
    get_template_part('template-parts/itinerary/content', 'itinerary-overview', $args);
    ?>


    <!-- Days -->
    <?php
    get_template_part('template-parts/itinerary/content', 'itinerary-days', $args);
    ?>


    <!-- Departures -->
    <?php
    get_template_part('template-parts/itinerary/content', 'itinerary-departures', $args);
    ?>

    <!-- Requirements -->
    <?php
    get_template_part('template-parts/itinerary/content', 'itinerary-requirements', $args);
    ?>

  <!-- Reviews -->
  <!-- Extras -->
  <!-- Related -->


  </main>


  <!-- Deals Modal -->
  <?php
  if ($hasDeals == true) {
    get_template_part('template-parts/product/content', 'product-deals-modal', $args);
  }
  ?>

  <!-- Contact Modal -->
  <?php
  get_template_part('template-parts/shared/content', 'shared-contact-modal', $args);
  ?>

  <!-- Prices Extra -->
  <?php
  get_template_part('template-parts/product/content', 'product-prices-extra', $args);
  ?>

  <!-- Notification Message-->
  <?php
  $show_notification = get_field('show_notification');
  if ($show_notification) :
    get_template_part('template-parts/product/content', 'product-notification', $args);
  endif;
  ?>


<?php
endwhile;
?>
<!-- #site-wrapper end-->
<?php get_footer() ?>