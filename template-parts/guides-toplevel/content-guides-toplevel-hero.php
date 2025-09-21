<?php
$intro_snippet = get_field('intro_snippet');
$pageTitle = get_the_title();
$region = checkPageRegion();

$page_type = get_field('page_type');
$author = get_field('author');


$home_page = get_field('home_page', $region);

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
                <a href="<?php echo get_permalink($home_page) ?>">&#8592 Return Home</a>
            </li>

        </ol>
        <h1 class="guides-toplevel-hero__content__title">
            <?php echo $pageTitle ?>
        </h1>

        <?php if ($page_type == 'author' && $author != null) :
            $authorImage = get_field('image', $author);
            $authorWebsite = get_field('website', $author);
            $authorTwitter = get_field('twitter', $author);
        ?>
            <div class="guides-toplevel-hero__content__author">
                <div class="guides-toplevel-hero__content__author__avatar">
                    <img src="<?php echo $authorImage['url']; ?>" alt="<?php echo $authorImage['alt']; ?>">
                </div>
                <div class="guides-toplevel-hero__content__author__links">
                    <?php if ($authorWebsite) : ?>
                        <a class="guides-toplevel-hero__content__author__links__social" href="<?php echo $authorWebsite; ?>" target="_blank" rel="noopener">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-globe"></use>
                            </svg>
                            <?php echo $authorWebsite; ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($authorTwitter) : ?>
                        <a class="guides-toplevel-hero__content__author__links__social" href="<?php echo 'https://x.com/' . $authorTwitter; ?>" target="_blank" rel="noopener">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-twitter-x"></use>
                            </svg>
                            @<?php echo $authorTwitter; ?>
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        <?php endif; ?>
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