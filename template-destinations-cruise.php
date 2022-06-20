<?php
/*Template Name: Destinations - Cruise*/
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-destination', get_template_directory_uri() . '/js/page-destination.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
  'page-destination',
  'page_vars',
  array(
    'templateUrl' =>  $templateUrl
  )
);
?>

<?php
get_header();
?>

<?php
$destinationType = 'cruise';

$destination = get_field('destination_post');

$activities = get_field('activities_list');
$locations = get_field('locations_list');

$tour_experiences = get_field('tour_experiences');
$sliderContent = get_field('hero_slider');
$title = $destination->post_title;

$sliderLimit = 12;
//TOURS
$tourCriteria = array(
    'posts_per_page' => -1, //must be all to filter best selling
    'post_type' => 'rfc_tours',
    'meta_key' => 'search_rank',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'destinations',
            'value' => '"' . $destination->ID . '"',
            'compare' => 'LIKE'
        )
    )
);
$tours = get_posts($tourCriteria);

//CRUISES
$cruiseCriteria = array(
    'posts_per_page' => $sliderLimit,
    'post_type' => 'rfc_cruises',
    'meta_key' => 'search_rank',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'destinations', // name of custom field
            'value' => '"' . $destination->ID . '"',
            'compare' => 'LIKE'
        )
    )
);
$cruises = get_posts($cruiseCriteria);



//Title (Destination)
$title = $destination->post_title;


$args = array(
    'destination' => $destination,
    'locations' => $locations,
    'activities' => $activities,

    'tours' => $tours,
    'tour_experiences' => $tour_experiences,
    'cruises' => $cruises,
    'sliderContent' => $sliderContent,
    'title' => $title,
    'destinationType' => $destinationType,

);

?>

<!-- Hero -->
<main class="destination-page">
    <section class="destination-page__section-hero" id="top">
        <?php
        get_template_part('template-parts/content', 'destination-hero', $args);
        ?>
    </section>

    <!-- Cruises -->
    <section class="destination-page__section-main" >
        <?php
        get_template_part('template-parts/content', 'destination-main-cruise', $args);
        ?>
    </section>


    <!-- Tours-->
    <section class="destination-page__section-secondary">
        <?php
        get_template_part('template-parts/content', 'destination-secondary-cruise', $args);
        ?>
    </section>


    <!-- Travel Guides -->
    <section class="destination-page__section-travel-guides" id="travel-guide">
        <?php
        get_template_part('template-parts/content', 'destination-guides', $args);
        ?>
    </section>

    
    <!-- Testimonials -->
    <?php if (get_field('show_testimonials') == true) { ?>
    <section class="destination-page__section-testimonials" id="testimonials">
        <?php
        get_template_part('template-parts/content', 'destination-testimonials', $args);
        ?>
    </section>
    <?php } ?>

    <!-- FAQ -->
    <section class="destination-page__section-faq" id="faq">
        <?php
        get_template_part('template-parts/content', 'destination-faq', $args);
        ?>
    </section>

</main>

<!-- Contact Modal -->
<?php
get_template_part('template-parts/content', 'shared-contact-modal', $args);
?>

<?php get_footer(); ?>

