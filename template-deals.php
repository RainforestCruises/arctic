<?php
/*Template Name: Deals - Landing Page*/
wp_enqueue_script('page-travel-guide-landing', get_template_directory_uri() . '/js/page-travel-guide-landing.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php

$landing_page_type = get_field('landing_page_type');

if ($landing_page_type == 'rfc_deal_categories') {
    $breadcrumbLink = get_field('top_level_deals_page', 'options');
    $breadcrumbText = 'All Deals';
} else {
    $breadcrumbLink = get_field('breadcrumb_parent_link');
    $breadcrumbText =  get_field('breadcrumb_parent_text');
}


$destination = get_field('destination');
$region = get_field('region');
$deal_category = get_field('deal_category');
$intro_snippet = get_field('intro_snippet');
$pageTitle = get_the_title();
$categories = [];

//If Deal Category Page Type
if ($landing_page_type == 'rfc_deal_categories') {
    //Deal Posts
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_deals',
        'meta_key' => 'value_rating',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'categories', // name of custom field
                'value' => '"' . $deal_category->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );

    //For Filters (regions + cruise destinations)
    $regions = get_posts(array(
        'post_type' => 'rfc_regions',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));


    //Cruise Destinations -- (if not displaying, must check and uncheck destination 'non-cruise-destination' field)
    $cruiseDestinationsArgs = array(
        'post_type' => 'rfc_destinations',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );

    $cruiseDestinationsArgs['meta_query'][] = array(
        'key'     => 'non_cruise_destination',
        'value'   => '0'
    );
    $cruiseDestinations = get_posts($cruiseDestinationsArgs);
    $categories = array_merge($regions, $cruiseDestinations);
};

//If Destniation Page Type
if ($landing_page_type == 'rfc_destinations') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_deals',
        'meta_key' => 'value_rating',
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

    $categories = get_posts(array(
        'post_type' => 'rfc_deal_categories',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));
};

//If Region Page Type
if ($landing_page_type == 'rfc_regions') {
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'rfc_deals',
        'meta_key' => 'value_rating',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'regions', // name of custom field
                'value' => $region->ID, // strangely will not work with quotes around
                'compare' => 'LIKE'
            )
        )
    );

    $categories = get_posts(array(
        'post_type' => 'rfc_destinations',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'region', // name of custom field
                'value' => $region->ID,
                'compare' => 'LIKE'
            )
        )
    ));
}



$posts = get_posts($args); //Stage I posts



?>

<main class="travel-guide-landing-page">

    <!-- Content -->
    <section class="travel-guide-landing-page__content">
        <!-- Breadcrumb -->
        <ol class="travel-guide-landing-page__breadcrumb">
            <li>
                <a href="<?php echo home_url() ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo $breadcrumbLink; ?>"> <?php echo $breadcrumbText; ?></a>
            </li>

            <li>
                <?php echo get_the_title(); ?>
            </li>
        </ol>
        <h1 class="travel-guide-landing-page__content__title">
            <?php echo $pageTitle ?>
        </h1>

        <div class="travel-guide-landing-page__content__subtext">
            <?php echo $intro_snippet ?>
        </div>

        <div class="travel-guide-landing-page__content__search-area">
            <input type="text" placeholder="Search Deals..." id="quicksearch">
        </div>
        <div class="travel-guide-landing-page__content__categories filters-button-group">
            <button data-filter="*" class="filter-button filter-button-all selected">
                All
            </button>
            <?php foreach ($categories as $c) : ?>
                <button data-filter="<?php echo '.' . $c->post_name ?>" class="filter-button">
                    <?php echo get_the_title($c) ?>
                </button>
            <?php endforeach; ?>

        </div>

        <div class="travel-guide-landing-page__content__results" id="results">

            <?php

            if ($posts) :

                foreach ($posts as $p) :
                    $featured_image = get_field('featured_image', $p);
                    $applicable_to = get_field('applicable_to', $p);
                    $is_selected_dates_only = get_field('is_selected_dates_only', $p);
                    $is_exclusive = get_field('is_exclusive', $p);


                    $imageID = '';
                    if ($featured_image) {
                        $imageID = $featured_image['ID'];
                    }


                    $guideCategories = [];
                    if ($landing_page_type == 'rfc_deal_categories') {
                        $guideRegions = get_field('regions', $p);
                        $guideDestinations = get_field('destinations', $p);

                        $guideTagCategories = array_merge($guideDestinations, $guideRegions); //isoTags
                        $guideCategories = $guideRegions;
                    }
                    if ($landing_page_type == 'rfc_regions') {
                        $guideCategories = get_field('destinations', $p);
                        $guideTagCategories =  $guideCategories;
                    }
                    if ($landing_page_type == 'rfc_destinations') {
                        $guideCategories = get_field('categories', $p);
                        $guideTagCategories =  $guideCategories;
                    }


                    $isoClasses = '';
                    if ($guideTagCategories) {
                        foreach ($guideTagCategories as $c) {
                            $isoClasses = $isoClasses . ' ' . $c->post_name;
                        };
                    };

            ?>


                    <div class="guide-item <?php echo $isoClasses ?>">
                        <div class="guide-item__image-area">
                            <?php if ($is_exclusive) : ?>
                                <span class="exclusiveDeal">
                                    Exclusive Deal
                                </span>
                            <?php endif; ?>
                            <img <?php afloat_image_markup($imageID, 'featured-medium'); ?>>
                        </div>
                        <div class="guide-item__bottom">
                            <ul class="guide-item__bottom__category">
                                <?php if ($guideCategories) :
                                    foreach ($guideCategories as $c) : ?>
                                        <li>
                                            <?php
                                            $catTitle = get_the_title($c);
                                            echo trim($catTitle);
                                            ?>
                                        </li>
                                <?php endforeach;
                                endif;  ?>
                            </ul>
                            <div class="guide-item__bottom__title">
                                <h3>
                                    <?php echo get_field('navigation_title', $p); ?>
                                </h3>

                            </div>
                            <div class="guide-item__bottom__snippet">
                                <?php echo get_field('description', $p); ?>
                            </div>
                            <?php if ($applicable_to == 'broadCategory') :
                                $serp_link = get_field('serp_link', $p);
                            ?>
                                <div class="guide-item__bottom__cta">
                                    <a class="goto-button goto-button--dark" href="<?php echo $serp_link ?>">
                                        View All
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                        </svg>
                                    </a>
                                </div>
                            <?php elseif ($applicable_to == 'travelProducts') :
                                $travelProducts = get_field('products', $p);

                            ?>

                                <div class="guide-item__bottom__cta guide-item__bottom__cta--multiple">
                                    <span>Applicable To: </span>
                                    <?php foreach ($travelProducts as $product) : ?>
                                        <a href="<?php echo the_permalink($product) ?>">
                                            <?php echo get_the_title($product); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


            <?php
                endforeach;
            endif;
            ?>
        </div>
        <div class="travel-guide-landing-page__content__no-results" id="no-results-message">
        No deals available. Please select another category.
        </div>
    </section>

    <div class="svg-divider">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
        </svg>
    </div>

    <!-- Newsletter -->
    <section class="home-page__section-newsletter">
        <?php
        get_template_part('template-parts/content', 'shared-newsletter');
        ?>
    </section>

</main>



<?php get_footer(); ?>