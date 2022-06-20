<?php
/*Template Name: Deals - Top Level*/
wp_enqueue_script('page-deals-toplevel', get_template_directory_uri() . '/js/page-deals-toplevel.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
    'page-deals-toplevel',
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


$pageTitle = get_the_title();

$categories = get_posts(array(
    'post_type' => 'rfc_deal_categories',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));


$selectedDeals = get_field('featured_deals');
$selectedDestinations = get_field('destinations');


$args = array(
    'deals' => $selectedDeals,
    'destinations' => $selectedDestinations,
);

?>

<main class="deals-page">

    <!-- Content -->
    <section class="deals-page__section-hero">
        <?php
        get_template_part('template-parts/content', 'deals-hero');
        ?>
    </section>

    <section class="deals-page__section-featured">
        <?php
        get_template_part('template-parts/content', 'deals-featured', $args);
        ?>
    </section>

    <section class="deals-page__section-destinations">
        <?php
        get_template_part('template-parts/content', 'deals-destinations', $args);
        ?>
    </section>

    <div class="svg-divider">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
        </svg>
    </div>
    <!-- Newsletter -->
    <section class="experience-page__section-newsletter">
        <?php
        get_template_part('template-parts/content', 'shared-newsletter');
        ?>
    </section>

</main>



<?php get_footer(); ?>