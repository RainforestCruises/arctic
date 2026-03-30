<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
wp_enqueue_script('page-product-modal-gallery', get_template_directory_uri() . '/js/page-product-modal-gallery.js', array('jquery'), false, true);
wp_enqueue_script('page-product-dates', get_template_directory_uri() . '/js/page-product-dates.js', array('jquery'), false, true);
wp_enqueue_script('page-product-cabins', get_template_directory_uri() . '/js/page-product-cabins.js', array('jquery'), false, true);
wp_enqueue_script('page-itinerary', get_template_directory_uri() . '/js/page-itinerary.js', array('jquery'), false, true);


get_header();

$itinerary = get_post();
$initialRegion = checkPageRegion();
$primaryRegion = getPrimaryRegion();
$productName = get_field('display_name');
$show_notification = get_field('show_notification');

$extra_activities = get_field('extra_activities') ?: [];
$optional_activities = array_map(function ($post) {
  return array(
    'image'       => get_field('image', $post->ID),
    'title'       => get_field('title', $post->ID),
    'description' => get_field('description', $post->ID),
    'price'       => get_field('price', $post->ID),
    'price_range_to'  => get_field('price_range_to', $post->ID),

  );
}, get_field('optional_activities') ?: []);

$extra_activities = array_merge($extra_activities, $optional_activities);



//$days = get_field('itinerary');
$departures = getDepartureList($itinerary, null, false, null, true);
$ships = getShipsFromDepartureList($departures);
$lowestOverallPrice = getLowestDepartureListPrice($departures);
$bestOverallDiscount = getBestDepartureListDiscount($departures);
$deals = getDealsFromDepartureList($departures, false);
$specialDepartures = getDealsFromDepartureList($departures, true);


$curentYear = date("Y");
$yearSelections = createYearSelection($curentYear, 3);
$shipSizeRange = getItineraryShipSize($ships);
$embarkation_point = get_field('embarkation_point');
$disembarkation_point = get_field('disembarkation_point');

$itineraryInfoObject = createItineraryInfoObject($itinerary);

console_log($itineraryInfoObject);


$itineraryMapObjects = [];
foreach ($itineraryInfoObject->itineraryObjects as $itinerary) {
  $itineraryMapObjects[] = getItineraryMapObject($itinerary);
}


wp_localize_script(
  'page-itinerary',
  'page_vars',
  array(
    'itineraryMapObjects' =>  $itineraryMapObjects,
  )
);


$cabins = [];
if ($ships) {

  // cabin posts (for all ships)
  $args = array(
    'posts_per_page' => -1,
    'post_type' => 'rfc_cabins',
  );
  $queryArgsShips = array();
  $queryArgsShips['relation'] = 'OR';


  foreach ($ships as $s) {
    $queryArgsShips[] = array(
      'key'     => 'ship',
      'value'   =>  $s->ID,
      'compare' => 'EQUALS'
    );
  }

  $args['meta_query'][] = $queryArgsShips; // match any category
  $cabins = get_posts($args);
};





$args = array(
  'ships' => $ships,
  'cabins' => $cabins,
  'extra_activities' => $extra_activities,
  'productName' => $productName,
  'lowestOverallPrice' => $lowestOverallPrice,
  'bestOverallDiscount' => $bestOverallDiscount,
  'departures' => $departures,
  'deals' => $deals,
  'specialDepartures' => $specialDepartures,
  'curentYear' => $curentYear,
  'yearSelections' => $yearSelections,
  'shipSizeRange' => $shipSizeRange,
  'itineraryInfoObject' => $itineraryInfoObject,
  'footerCtaDivider' => true,
  'initialRegion' => $initialRegion,
  'primaryRegion' => $primaryRegion,
);

?>

<!-- Product Page Container -->
<main class="itinerary-page">

  <!-- Hero -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-hero', $args);
  ?>

  <!-- Modal Product Gallery -->
  <?php
  get_template_part('template-parts/product/content', 'product-gallery', $args);
  ?>

  <!-- Overview -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-overview', $args);
  ?>

  <!-- Day to Day -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-variants', $args);
  ?>

  <!-- Dates -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-dates', $args);
  ?>

  <!-- Deals -->
  <?php
  if ($deals || $specialDepartures) :
    get_template_part('template-parts/product/content', 'product-deals', $args);
  endif;
  ?>


  <!-- Cabins Modal-->
  <?php
  get_template_part('template-parts/product/content', 'product-cabins-modal', $args);
  ?>

  <!-- Extras -->
  <?php
  if ($extra_activities) :
    get_template_part('template-parts/itinerary/content', 'itinerary-extras', $args);
  endif; ?>

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
  get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
  ?>

</main>

<!-- Inquire Modal -->
<?php
get_template_part('template-parts/product/content', 'product-inquiry-modal', $args);
?>

<?php $show_notification == true ? get_template_part('template-parts/product/content', 'product-notification-modal', $args) : null; ?>


<?php get_footer() ?>