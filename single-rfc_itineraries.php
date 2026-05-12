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

$precalculated_departures = get_field('precalculated_departures');
$departures = $precalculated_departures ? $precalculated_departures : getDepartureListItinerary($itinerary);

// $ships = getShipsFromDepartureList($departures);
// $lowestOverallPrice = getLowestDepartureListPrice($departures);
// $bestOverallDiscount = getBestDepartureListDiscount($departures);

$precalculated_ships = get_field('precalculated_ships', $itinerary);
$ships = $precalculated_ships ? $precalculated_ships : getShipsFromItineraries($itinerary);

$precalculated_price_low = get_field('precalculated_price_low', $itinerary);
$lowestPrice = $precalculated_price_low ? $precalculated_price_low : getLowestDepartureListPrice($departures);

$precalculated_best_discount = get_field('precalculated_best_discount', $itinerary);
$bestOverallDiscount = $precalculated_best_discount ? $precalculated_best_discount : getBestDepartureListDiscount($departures);


$deals = getDealsFromDepartureList($departures, false);
$specialDepartures = getDealsFromDepartureList($departures, true);


$curentYear = date("Y");
$yearSelections = createYearSelection($curentYear, 3);
$shipSizeRange = getItineraryShipSize($ships);
$embarkation_point = get_field('embarkation_point');
$disembarkation_point = get_field('disembarkation_point');
$itineraryInfoObject = createItineraryInfoObject($itinerary);


$itineraryMapObjects = [];
foreach ($itineraryInfoObject->itineraryObjects as $itineraryObject) {
  $itineraryMapObjects[] = $itineraryObject->mapObject;
}


wp_localize_script(
  'page-itinerary',
  'page_vars',
  array(
    'itineraryMapObjects' =>  $itineraryMapObjects,
  )
);


$cabins = []; // all possible cabins across all ships for the itinerary, used for filtering and display in the cabins modal
if ($ships) {
    $shipIds = array_map(fn($s) => $s->ID, $ships);
    $metaQuery = array('relation' => 'OR');
    foreach ($shipIds as $shipId) {
        $metaQuery[] = array(
            'key'     => 'ship',
            'value'   => $shipId,
            'compare' => '='
        );
    }
    $cabins = get_posts(array(
        'post_type'      => 'rfc_cabins',
        'posts_per_page' => -1,
        'meta_query'     => array($metaQuery),
    ));
}



$args = array(
  'ships' => $ships,
  'cabins' => $cabins,
  'extra_activities' => $extra_activities,
  'productName' => $productName,
  'lowestOverallPrice' => $lowestPrice,
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