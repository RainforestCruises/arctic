<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
wp_enqueue_script('page-product-modal-gallery', get_template_directory_uri() . '/js/page-product-modal-gallery.js', array('jquery'), false, true);
wp_enqueue_script('page-product-dates', get_template_directory_uri() . '/js/page-product-dates.js', array('jquery'), false, true);


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

$embarkation_point = get_field('embarkation_point');
$disembarkation_point = get_field('disembarkation_point');


// Destination Point Series
$destinationPoints = [];
$destinationList = [];
$count = 0;
foreach ($days as $day) {

  $destinations = $day['destination']; // multiple destinations
  
  $locationType = '';
  foreach($destinations as $destination) {
    $dayDisplay = dayCountMarkup($day['day_count']);
    $destinationImage =  get_field('image', $destination); //get default image if none provided
    $destinationImageURL = $destinationImage ? wp_get_attachment_image_url($destinationImage['ID'], 'portrait-small') : "";
    $description = get_field('description', $destination) ?? "";

    if($destination == $embarkation_point){
      $locationType = '<span>embarkation</span>';
    }
    if($destination == $disembarkation_point){
      $locationType = '<span>disembarkation</span>';
    }

    $point  = [
      'index' => $count,
      'locationType' => $locationType,
      'postid' => $destination->ID,
      'title' => get_the_title($destination),
      'day' => $dayDisplay,
      'description' => $description,
      'image' => $destinationImageURL,
      'coordinates' => [get_field('longitude', $destination), get_field('latitude', $destination)],
    ];
  
    // to check duplicates
    if (!in_array($destination, $destinationList)) {  
      $destinationPoints[] = $point; // only add non dulpicates
      $count++; //increment index

    } else { // append the day markup
      $match = findObjectById($point['postid'], $destinationPoints, 'postid');
      $matchIndex = $match['index'];
      $destinationPoints[$matchIndex]['day'] .= ', ' . $point['day']; // append the day markup to matched destination
    }
    
    $destinationList[] = $destination; //full list
  }
}

// Itinerary Object
$itineraryObject = [
  'destinationPoints' => $destinationPoints,
  'geojson' => json_decode(get_field('geojson')),
  'startLatitude' => get_field('latitude_start_point'),
  'startLongitude' => get_field('longitude_start_point'),
  'startZoom' => get_field('zoom_level_start_point'),
  'postId' => $itinerary->ID,
];
$itineraryObjects[] = $itineraryObject;


wp_localize_script(
  'page-product-itinerary-map',
  'page_vars_product_itinerary_map',
  array(
    'itineraryObjects' =>  $itineraryObjects,
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
  get_template_part('template-parts/itinerary/content', 'itinerary-daily', $args);
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