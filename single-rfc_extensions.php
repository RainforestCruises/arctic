<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
wp_enqueue_script('page-product-modal-gallery', get_template_directory_uri() . '/js/page-product-modal-gallery.js', array('jquery'), false, true);
wp_enqueue_script('page-interactive-map', get_template_directory_uri() . '/js/page-interactive-map.js', array('jquery'), false, true);
get_header();

$extension = get_post();
$isExtension = get_post_type() == 'rfc_extensions';

$initialRegion = checkPageRegion();
$primaryRegion = getPrimaryRegion();
$productName = get_field('display_name');
$show_notification = get_field('show_notification');
$accommodation = get_field('accommodation')  ?: [];



$embarkation_point = get_field('embarkation_point');
$disembarkation_point = get_field('disembarkation_point');
$itineraryInfoObject = createItineraryInfoObject($extension);


$itineraryMapObjects = [];
foreach ($itineraryInfoObject->itineraryObjects as $itineraryObject) {
  $itineraryMapObjects[] = $itineraryObject->mapObject;
}


wp_localize_script(
  'page-interactive-map',
  'page_vars',
  array(
    'itineraryMapObjects' =>  $itineraryMapObjects,
    'themeUrl' =>  get_template_directory_uri(),
  )
);


$args = array(
  'ships' => [],
  'cabins' => [],
  'departures' => [],
  'deals' => [],
  'specialDepartures' => [],
  'curentYear' => date('Y'),
  'yearSelections' => [],
  'shipSizeRange' => null,
  'extra_activities' => $accommodation,
  'productName' => $productName,
  'itineraryInfoObject' => $itineraryInfoObject,
  'footerCtaDivider' => true,
  'initialRegion' => $initialRegion,
  'primaryRegion' => $primaryRegion,
  'isExtension' => $isExtension,
  'lowestOverallPrice' => get_field('price'),
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



  <!-- Extras -->
  <?php
  if ($accommodation) :
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


<?php $show_notification == true ? get_template_part('template-parts/product/content', 'product-notification-modal', $args) : null; ?>


<?php get_footer() ?>