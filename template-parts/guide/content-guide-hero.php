<?php
$top_level_guides_page = get_field('top_level_guides_page', 'options');
$minutes_to_read  = get_field('minutes_to_read');
$updated = get_the_modified_date('F jS, Y');
$image  = get_field('featured_image');
$intro_snippet  = get_field('intro_snippet');
$categories  = get_field('categories');
$displayCategory = "";

if ($categories) {
    $firstCategoryPost = $categories[0];
    $displayCategory = get_the_title($firstCategoryPost);
}


$query = get_post(get_the_ID());
$content = apply_filters('the_content', $query->post_content);
$toc = generateIndex($content)['index'];
$show_site_notice = get_field('show_site_notice', 'options');

?>



<!-- Hero Section -->
<section class="guide-hero <?php echo ($show_site_notice ? "site-notice-variant" : "") ?>">

    <div class="guide-hero__content">

        <div class="guide-hero__content__title-area">
            <ul class="guide-hero__content__title-area__category breadcrumb-list">
                <li>
                    <a href="<?php echo $top_level_guides_page ?>">Travel Guide</a>
                </li>
                <li>
                    <?php echo $displayCategory ?>
                </li>

            </ul>
            <h1 class="guide-hero__content__title-area__title">
                <?php echo get_field('navigation_title'); ?>
            </h1>

            <div class="guide-hero__content__title-area__stats">
                <div>
                    <?php echo $updated; ?>
                </div>
                <div>
                    &#8226;
                </div>
                <div>
                    <?php echo $minutes_to_read; ?> min read
                </div>
            </div>
        </div>


        <?php
        $author = get_field('author');
        if ($author  != null) :
            $image = get_field('image', $author);
            $description = get_field('description', $author);

            $name = get_the_title($author);
            $website = get_field('website', $author);
            $twitter = get_field('twitter', $author);

        ?>
            <div class="guide-hero__content__author">

                <div class="guide-hero__content__author__image">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                </div>
                <div class="guide-hero__content__author__text">
                    <div class="guide-hero__content__author__text__name">
                        By <?php echo $name; ?>
                    </div>
                    <div class="guide-hero__content__author__text__social">
                        <?php if ($website) : ?>
                            <a class="guide-hero__content__author__text__social__item" href="<?php echo $website; ?>" target="_blank" rel="noopener">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-globe"></use>
                                </svg>
                                <?php echo $website; ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($twitter) : ?>
                            <a class="guide-hero__content__author__text__social__item" href="<?php echo 'https://x.com/' . $twitter; ?>" target="_blank" rel="noopener">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-twitter-x"></use>
                                </svg>
                                @<?php echo $twitter; ?>
                            </a>
                        <?php endif; ?>

                    </div>

                </div>

            </div>
        <?php endif; ?>


        <div class="guide-hero__content__image-area">
            <img <?php afloat_image_markup($image['ID'], 'landscape-large', array('landscape-large', 'landscape-medium', 'landscape-small')); ?>>
        </div>

        <div class="guide-hero__content__toc">
            <div class="guide-hero__content__toc__header">
                Jump to Section
            </div>
            <?php echo $toc; ?>
        </div>

    </div>
</section>

<section class="guide-menu-area">
    <div class="guide-menu-area__content">

        <div class="guide-menu">
            <div class="guide-menu__button">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-plus"></use>
                </svg>
                Sections
            </div>
            <div class="guide-menu__menu">
                <?php echo $toc; ?>
            </div>

        </div>

    </div>

</section>