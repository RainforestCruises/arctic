<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-cruise', get_template_directory_uri() . '/js/page-cruise.js', array('jquery'), false, true);
wp_enqueue_script('page-cruise-itineraries', get_template_directory_uri() . '/js/page-cruise-itineraries.js', array('jquery'), false, true);

get_header();


$cruise_data = get_field('cruise_data');
$itineraryPosts = get_field('itineraries');
$departures = createDepartureList($cruise_data, $itineraryPosts);
$productName = get_the_title();
$vessel_capacity = get_field('vessel_capacity');
$lowestPrice = lowest_property_price($cruise_data, 0, $currentYear, true);


$args = array(
  'productName' => $productName,
  'lowestPrice' => $lowestPrice,
  'cruise_data' => $cruise_data,
  'vessel_capacity' => $vessel_capacity,
  'itineraryPosts' => $itineraryPosts,
  'departures' => $departures,
);


//Itinerary JS Array
$itineraryObjects = [];
$itineraries = get_field('itineraries');
foreach ($itineraries as $itinerary) {
  $days = get_field('itinerary', $itinerary);

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


  // Itinerary Object
  $itineraryObject = [
    'destinationPoints' => $destinationPoints,
    'destinationLines' => $destinationLines,
    'postId' => $itinerary->ID,
  ];
  $itineraryObjects[] = $itineraryObject;
}

wp_localize_script(
  'page-cruise-itineraries',
  'page_vars_cruise_itineraries',
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

  <!-- Overview -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-overview', $args);
  ?>

  <!-- Cabins -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-cabins', $args);
  ?>

  <!-- itineraries -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-itineraries', $args);
  ?>

  <!-- Dates -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-dates', $args);
  ?>

  <!-- Reviews -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-reviews', $args);
  ?>

  <!-- Related -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-related', $args);
  ?>


</main>


<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'shared-inquire-modal', $args);
?>





<!-- #site-wrapper end-->
<?php get_footer() ?>