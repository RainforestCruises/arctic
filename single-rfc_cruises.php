<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
wp_enqueue_script('page-product-cruise-itineraries', get_template_directory_uri() . '/js/page-product-cruise-itineraries.js', array('jquery'), false, true);
wp_enqueue_script('page-product-modal-gallery', get_template_directory_uri() . '/js/page-product-modal-gallery.js', array('jquery'), false, true);
wp_enqueue_script('page-product-dates', get_template_directory_uri() . '/js/page-product-dates.js', array('jquery'), false, true);


get_header();



$ship = get_post();
$productName = get_the_title();
$itineraries = get_field('itineraries');
$departures = getDepartureList($ship);
$lowestPrice = getLowestDepartureListPrice($departures);

$curentYear = date("Y");
$yearSelections = createYearSelection($curentYear, 3);


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
  'lowestPrice' => $lowestPrice,
  'itineraries' => $itineraries,
  'departures' => $departures,
  'curentYear' => $curentYear,
  'yearSelections' => $yearSelections,
  'cabins' => $cabins,

);


//Itinerary JS Array
$itineraryObjects = [];
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
  'page-product-cruise-itineraries',
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


  <!-- Modal Gallery -->
  <?php
  get_template_part('template-parts/cruise/content', 'cruise-page-gallery', $args);
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