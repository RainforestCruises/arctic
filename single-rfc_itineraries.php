<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
wp_enqueue_script('page-product-modal-gallery', get_template_directory_uri() . '/js/page-product-modal-gallery.js', array('jquery'), false, true);
wp_enqueue_script('page-product-dates', get_template_directory_uri() . '/js/page-product-dates.js', array('jquery'), false, true);
//wp_enqueue_script('page-product-itinerary-days', get_template_directory_uri() . '/js/page-product-itinerary-days.js', array('jquery'), false, true);
wp_enqueue_script('page-product-itinerary-map', get_template_directory_uri() . '/js/page-product-itinerary-map.js', array('jquery'), false, true);


$ships = get_field('ships');
$itinerary = get_post();
$productName = get_field('display_name');
$days = get_field('itinerary');
$departures = getDepartureList($itinerary);
$lowestPrice = getLowestDepartureListPrice($departures);
$curentYear = date("Y");
$yearSelections = createYearSelection($curentYear, 3);
$shipSizeRange = getItineraryShipSize($ships);

// Destination Point Series
$destinationPoints = []; 
$coordinatePoints = [];

foreach ($days as $day) {

  $destination = $day['destination'];
  $destinationImage = get_field('image', $destination);
  $destinationImageURL = $destinationImage ? wp_get_attachment_image_url($destinationImage['ID'], 'portrait-small') : "";

  $point  = [
    'postid' => $destination->ID,
    'title' => get_field('navigation_title', $destination),
    'description' => get_field('description', $destination),
    'image' => $destinationImageURL,
    'coordinates' => [get_field('longitude', $destination), get_field('latitude', $destination)],
    'zoomLevel' => get_field('zoom_level', $destination),
  ];
  $destinationPoints[] = $point;
  $coordinatePoints[] = $point['coordinates'];
}


// Itinerary Object
$itineraryObject = [
  'destinationPoints' => $destinationPoints,
  'coordinatePoints' => $coordinatePoints,
  'postId' => $itinerary->ID,
];
$itineraryObjects[] = $itineraryObject;

$templateUrl = get_template_directory_uri();

// wp_localize_script(
//   'page-product-itinerary-days',
//   'page_vars_product_itinerary_days',
//   array(
//     'itineraryObjects' =>  $itineraryObjects,
//     'templateUrl' =>  $templateUrl
//   )
// );


wp_localize_script(
  'page-product-itinerary-map',
  'page_vars_product_itinerary_map',
  array(
    'itineraryObjects' =>  $itineraryObjects,
    'templateUrl' =>  $templateUrl
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
  'destinationCount' => count($destinationPoints),

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


</main>
<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'shared-inquire-modal', $args);
?>


<?php get_footer() ?>