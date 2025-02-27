<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
wp_enqueue_script('page-product-modal-gallery', get_template_directory_uri() . '/js/page-product-modal-gallery.js', array('jquery'), false, true);
wp_enqueue_script('page-product-modal-deckplans', get_template_directory_uri() . '/js/page-product-modal-deckplans.js', array('jquery'), false, true);
wp_enqueue_script('page-product-dates', get_template_directory_uri() . '/js/page-product-dates.js', array('jquery'), false, true);
wp_enqueue_script('page-product-cruise-itineraries', get_template_directory_uri() . '/js/page-product-cruise-itineraries.js', array('jquery'), false, true);
wp_enqueue_script('page-product-cabins', get_template_directory_uri() . '/js/page-product-cabins.js', array('jquery'), false, true);

get_header();

$ship = get_post();
$regions = getShipRegions($ship);
$initialRegion = checkPageRegion();
$primaryRegion = getPrimaryRegion();
$productName = get_the_title();
$itineraries = getShipItineraries($ship, $initialRegion);
$departures = getDepartureList($ship, null, false, $initialRegion);
$lowestOverallPrice = getLowestDepartureListPrice($departures);
$bestOverallDiscount = getBestDepartureListDiscount($departures);
$deals = getDealsFromDepartureList($departures, false);
$specialDepartures = getDealsFromDepartureList($departures, true);
$curentYear = date("Y");
$yearSelections = createYearSelection($curentYear, 3);
$reviews = get_field('reviews');


$test2 = getShipItineraries($ship);

console_log('test2');
console_log($regions );
console_log($test2 );

console_log($itineraries );
console_log($departures);



// cabin posts
$args = array(
  'posts_per_page' => -1,
  'post_type' => 'rfc_cabins',
);
$args['meta_query'][] = array(
  'key' => 'ship',
  'value' => $ship->ID
);
$cabins = get_posts($args);

usort($cabins, 'custom_sort');

// cabins custom sorting function
function custom_sort($a, $b) {
  $ranking_a = get_field('ranking', $a->ID);
  $ranking_b = get_field('ranking', $b->ID);
  if ($ranking_a === null && $ranking_b === null) {
      return 0; // Both values are null, consider them equal
  } elseif ($ranking_a === null) {
      return 1; // Null values should come after non-null values
  } elseif ($ranking_b === null) {
      return -1; // Non-null value should come before null values
  }
  return $ranking_a - $ranking_b;
}


$args = array(
  'productName' => $productName,
  'lowestOverallPrice' => $lowestOverallPrice,
  'bestOverallDiscount' => $bestOverallDiscount,
  'itineraries' => $itineraries,
  'departures' => $departures,
  'deals' => $deals,
  'specialDepartures' => $specialDepartures,
  'curentYear' => $curentYear,
  'yearSelections' => $yearSelections,
  'cabins' => $cabins,
  'footerCtaDivider' => true,
  'initialRegion' => $initialRegion,
  'regions' => $regions,
  'primaryRegion' => $primaryRegion,

);

//Itinerary JS Array
$itineraryObjects = [];
foreach ($itineraries as $itinerary) {
  $itineraryObjects[] = getItineraryObject($itinerary);
}

wp_localize_script(
  'page-product-cruise-itineraries',
  'page_vars',
  array(
    'itineraryObjects' =>  $itineraryObjects,
  )
);

?>

<!-- Product Page Container -->
<main id="main-content">

  <!-- Hero -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-hero', $args);
  ?>

  <!-- Modal Product Gallery -->
  <?php
  get_template_part('template-parts/product/content', 'product-gallery', $args);
  ?>

  <!-- Overview -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-overview', $args);
  ?>

  <!-- Modal Deckplan Gallery -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-deckplan-gallery', $args);
  ?>

  <!-- Cabins -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-cabins', $args);
  ?>

  <!-- Cabins Modal-->
  <?php
  get_template_part('template-parts/product/content', 'product-cabins-modal', $args);
  ?>

  <!-- itineraries -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-itineraries', $args);
  ?>

  <!-- Dates -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-dates', $args);
  ?>

  <!-- Deals -->
  <?php
  if ($deals || $specialDepartures) :
    get_template_part('template-parts/product/content', 'product-deals', $args);
  endif;
  ?>
  <!-- Reviews -->
  <?php
  if ($reviews) :
    get_template_part('template-parts/cruise/content', 'cruise-reviews', $args);
  endif
  ?>

  <!-- Related -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-related', $args);
  ?>

  <!-- Footer CTA  -->
  <?php
  get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
  ?>

</main>

<!-- Inquire Modal -->
<?php
get_template_part('template-parts/product/content', 'product-inquiry-modal', $args);
?>

<!-- Regions -->
<?php
if (count($regions) > 1) :
  get_template_part('template-parts/cruise/content', 'cruise-region-modal', $args);
endif
?>

<?php get_footer() ?>