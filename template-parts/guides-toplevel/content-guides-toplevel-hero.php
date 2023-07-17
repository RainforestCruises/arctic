<?php
$intro_snippet = get_field('intro_snippet');
$pageTitle = get_the_title();

$categories = get_posts(array(
    'post_type' => 'rfc_guide_categories',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));
$show_site_notice = get_field('show_site_notice', 'options');

?>

<section class="guides-toplevel-hero <?php echo ($show_site_notice ? "site-notice-variant" : "") ?>">
    <div class="guides-toplevel-hero__content">
        <!-- Breadcrumb -->
        <ol class="guides-toplevel-hero__content__breadcrumb">
            <li>
                <a href="<?php echo home_url() ?>">&#8592 Return Home</a>
            </li>

        </ol>
        <h1 class="guides-toplevel-hero__content__title">
            <?php echo $pageTitle ?>
        </h1>

        <div class="guides-toplevel-hero__content__subtext">
            <?php echo $intro_snippet ?>
        </div>

        <div class="guides-toplevel-hero__content__search-area">
            <input type="text" placeholder="Search Guide..." id="quicksearch">
        </div>
        <div class="guides-toplevel-hero__content__categories filters-button-group">
            <button data-filter="*" class="filter-button filter-button-all selected">
                All
            </button>
            <?php foreach ($categories as $c) : ?>
                <button data-filter="<?php echo '.' . $c->post_name ?>" class="filter-button">
                    <?php echo get_the_title($c) ?>
                </button>
            <?php endforeach; ?>

        </div>


    </div>
</section>