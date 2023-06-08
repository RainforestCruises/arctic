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
$productName = get_the_title();
$itineraries = getShipItineraries($ship);
$departures = getDepartureList($ship);
$lowestOverallPrice = getLowestDepartureListPrice($departures);
$bestOverallDiscount = getBestDepartureListDiscount($departures);
$deals = getDealsFromDepartureList($departures);

$curentYear = date("Y");
$yearSelections = createYearSelection($curentYear, 3);
$regions = getShipRegions($ship);
$reviews = get_field('reviews');

console_log($itineraries);
//cabin posts
$args = array(
  'posts_per_page' => -1,
  'post_type' => 'rfc_cabins',
);
$args['meta_query'][] = array(
  'key' => 'ship',
  'value' => $ship->ID
);
$cabins = get_posts($args);


$args = array(
  'productName' => $productName,
  'lowestOverallPrice' => $lowestOverallPrice,
  'bestOverallDiscount' => $bestOverallDiscount,
  'itineraries' => $itineraries,
  'departures' => $departures,
  'deals' => $deals,
  'curentYear' => $curentYear,
  'yearSelections' => $yearSelections,
  'cabins' => $cabins,
  'footerCtaDivider' => true
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
  if ($deals) :
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


<?php get_footer() ?>