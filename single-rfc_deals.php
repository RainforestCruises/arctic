<?php
wp_enqueue_script('page-deal-single', get_template_directory_uri() . '/js/page-deal-single.js', array('jquery'), false, true);
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);


get_header();

$deal = get_post();
$dealName = get_field('navigation_title');



// //cabin posts
// $args = array(
//     'posts_per_page' => -1,
//     'post_type' => 'rfc_cabins',
// );
// $args['meta_query'][] = array(
//     'key' => 'ship',
//     'value' => $ship->ID
// );
// $cabins = get_posts($args);


$args = array(
    'dealName' => $dealName,
);



?>

<!-- Deal Page Container -->
<main id="main-content">

    <!-- Hero -->
    <?php
    get_template_part('template-parts/deal/content', 'deal-hero', $args);
    ?>

    <!-- Intro -->
    <?php
    get_template_part('template-parts/deal/content', 'deal-intro', $args);
    ?>

    <!-- Main -->
    <?php
    get_template_part('template-parts/deal/content', 'deal-main', $args);
    ?>


    <!-- Footer CTA  -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-footer-cta');
    ?>


</main>


<!-- Inquire Modal -->
<?php
get_template_part('template-parts/shared/content', 'shared-basic-inquiry-modal', $args);
?>


<?php get_footer() ?>