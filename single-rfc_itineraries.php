<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
wp_enqueue_script('page-product-modal-gallery', get_template_directory_uri() . '/js/page-product-modal-gallery.js', array('jquery'), false, true);
wp_enqueue_script('page-product-dates', get_template_directory_uri() . '/js/page-product-dates.js', array('jquery'), false, true);
wp_enqueue_script('page-product-itinerary-map', get_template_directory_uri() . '/js/page-product-itinerary-map.js', array('jquery'), false, true);

$itinerary = get_post();

$ships = get_field('ships');
$productName = get_field('display_name');
$days = get_field('itinerary');
$departures = getDepartureList($itinerary);
$lowestOverallPrice = getLowestDepartureListPrice($departures);
$bestOverallDiscount = getBestDepartureListDiscount($departures);

$curentYear = date("Y");
$yearSelections = createYearSelection($curentYear, 3);
$shipSizeRange = getItineraryShipSize($ships);
$embarkation_point = get_field('embarkation_point');
$disembarkation_point = get_field('disembarkation_point');
$itineraryObjects[] = getItineraryObject($itinerary);

wp_localize_script(
  'page-product-itinerary-map',
  'page_vars_product_itinerary_map',
  array(
    'itineraryObjects' =>  $itineraryObjects,
  )
);

get_header();


$args = array(
  'ships' => $ships,
  'productName' => $productName,
  'lowestOverallPrice' => $lowestOverallPrice,
  'bestOverallDiscount' => $bestOverallDiscount,
  'days' => $days,
  'departures' => $departures,
  'curentYear' => $curentYear,
  'yearSelections' => $yearSelections,
  'shipSizeRange' => $shipSizeRange,
  'destinationCount' => count($itineraryObjects[0]['featureList']),
);

?>

<!-- Product Page Container -->
<main class="itinerary-page">

  <!-- Hero -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-hero', $args);
  ?>

  <!-- Modal Product Gallery (from cruise folder)-->
  <?php
  get_template_part('template-parts/cruise/content', 'product-gallery', $args);
  ?>

  <!-- Overview -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-overview', $args);
  ?>

  <!-- Day to Day -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-days', $args);
  ?>

  <!-- Itinerary Map -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-map', $args);
  ?>

  <!-- Dates -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-dates', $args);
  ?>

  <!-- Extras -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-extras', $args);
  ?>

  <!-- Inclusions / Exclusions -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-inclusions', $args);
  ?>

  <!-- Related -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-related', $args);
  ?>
  
  <!-- Footer CTA  -->
  <?php
  get_template_part('template-parts/shared/content', 'shared-footer-cta');
  ?>

</main>

<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'modal-product-inquiry', $args);
?>

<?php get_footer() ?>