<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-itinerary', get_template_directory_uri() . '/js/page-itinerary.js', array('jquery'), false, true);


$ships = get_field('ships');
$itinerary = get_post();
$productName = get_the_title();
$days = get_field('itinerary');
$departures = createItineraryDepartureList($itinerary);
$lowestPrice = getLowestDepartureListPrice($departures);
$curentYear = date("Y");
$yearSelections = createYearSelection($curentYear, 3);
$shipSizeRange = getItineraryShipSize($ships);


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

$templateUrl = get_template_directory_uri();
wp_localize_script(
  'page-itinerary',
  'page_vars_itinerary',
  array(
    'templateUrl' =>  $templateUrl,
    'destinationPoints' =>  $destinationPoints,
    'destinationLines' =>  $destinationLines

  )
);




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