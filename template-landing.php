<?php
/*Template Name: Landing*/
wp_enqueue_script('page-landing', get_template_directory_uri() . '/js/page-landing.js', array('jquery'), false, true);
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);

get_header();

$show_faq = get_field('show_faq');
$show_topics = get_field('show_topics');
$show_map = get_field('show_map');

$route = get_field('route_filter');
$style = get_field('style_filter');
$region = get_field('region_filter');



// itinerary / ship content page criteria
$queryArgs = array(
  'post_type'      => 'rfc_itineraries',
  'posts_per_page' => -1,
  'meta_key'       => 'search_rank',
  'orderby'        => 'meta_value_num',
  'order'          => 'DESC',
  'meta_query'     => array(
    'relation' => 'AND', // Relation between different sets of routes and styles -- note: using OR adds a huge delay
  ),
);
// meta query for routes
if ($route) {
  $routeMetaQuery[] = array(
    'key'     => 'route',
    'value'   => serialize(strval($route->ID)),
    'compare' => 'LIKE',
  );
  $queryArgs['meta_query'][] = $routeMetaQuery;
}
// meta query for styles
if ($style) {
  $styleMetaQuery[] = array(
    'key'     => 'styles',
    'value'   => serialize(strval($style->ID)),
    'compare' => 'LIKE',
  );
  $queryArgs['meta_query'][] = $styleMetaQuery;
}
$itineraryPosts = get_posts($queryArgs);

// filter on region
if ($region) {
  foreach ($itineraryPosts as $itinerary) {
    $itinerary_region = getItineraryRegion($itinerary);
    if ($itinerary_region == $region) {
      $itineraries[] = $itinerary;
    }
  }
} else {
  $itineraries = $itineraryPosts;
}

// filter sold out
if($itineraries){
  foreach($itineraries as $itinerary){
    
  }
}

$ships = getShipsFromItineraryList($itineraries);

console_log($itineraries);
console_log($ships);

$args = array(
  'region' => $region,
  'itineraries' => $itineraries,
  'ships' => $ships,
  'footerCtaDivider' => true
);


?>



<main class="main-content">

  <!-- Hero -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-hero', $args);
  ?>

  <!-- Overview / Highlights -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-overview', $args);
  ?>

  <!-- Itineraries  -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-itineraries', $args);
  ?>

  <!-- Topics  -->
  <?php
  if ($show_topics) :
    get_template_part('template-parts/landing/content', 'landing-topics', $args);
  endif;
  ?>

  <!-- Map -->
  <?php
  if ($show_map) :
    get_template_part('template-parts/landing/content', 'landing-map', $args);
  endif;
  ?>

  <!-- Faq  -->
  <?php
  if ($show_faq) :
    get_template_part('template-parts/landing/content', 'landing-faq', $args);
  endif;
  ?>

  <!-- Ships -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-ships', $args);
  ?>

  <!-- Guides  -->
  <?php
  get_template_part('template-parts/landing/content', 'landing-guides', $args);
  ?>

  <!-- Footer CTA  -->
  <?php
  get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
  ?>

</main>

<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'shared-basic-inquiry-modal', $args);
?>




<?php get_footer(); ?>