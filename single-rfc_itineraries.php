<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
wp_enqueue_script('page-product-modal-gallery', get_template_directory_uri() . '/js/page-product-modal-gallery.js', array('jquery'), false, true);
wp_enqueue_script('page-product-dates', get_template_directory_uri() . '/js/page-product-dates.js', array('jquery'), false, true);


$ships = get_field('ships');
$itinerary = get_post();
$productName = get_field('display_name');
$days = get_field('itinerary');
$departures = createDepartureList($itinerary);
$lowestPrice = getLowestDepartureListPrice($departures);
$curentYear = date("Y");
$yearSelections = createYearSelection($curentYear, 3);
$shipSizeRange = getItineraryShipSize($ships);

console_log($departures);

//Destination Point Series
$destinationPoints = [];
foreach ($days as $day) {

  $destination = $day['destination'];

  $geometry = [
    'type' => "Point",
    'coordinates' => [get_field('longitude', $destination), get_field('latitude', $destination)],
  ];

  $zoomPoint = [
    'longitude' => get_field('longitude', $destination),
    'latitude' => get_field('latitude', $destination),
  ];

  $point  = [
    'title' => get_field('navigation_title', $destination),
    'postid' => $destination->ID,
    'geometry' => $geometry,
    'zoomPoint' => $zoomPoint,
    'zoomLevel' => get_field('zoom_level', $destination),
  ];

  $destinationPoints[] = $point;
}

//Destination Line Series
$destinationLines = [];
$lineObject = [
  'geometry' => [
    'type' => "LineString",
    'coordinates' => [],
  ]
];

foreach ($days as $day) {
  $destination = $day['destination'];
  $lineObject['geometry']['coordinates'][] = [get_field('longitude', $destination), get_field('latitude', $destination)];
}
$destinationLines[] = $lineObject;






get_header();
?>

<?php






$args = array(
  'ships' => $ships,
  'productName' => $productName,
  'lowestPrice' => $lowestPrice,
  'days' => $days,
  'departures' => $departures,
  'curentYear' => $curentYear,
  'yearSelections' => $yearSelections,
  'shipSizeRange' => $shipSizeRange,

);

?>

<!-- Product Page Container -->
<main class="itinerary-page">

  <!-- Hero -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-hero', $args);
  ?>

  <!-- Modal Gallery -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-page-gallery', $args);
  ?>

  <!-- Overview -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-overview', $args);
  ?>

  <!-- Dates -->
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
<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'shared-inquire-modal', $args);
?>



<!-- #site-wrapper end-->
<?php get_footer() ?>