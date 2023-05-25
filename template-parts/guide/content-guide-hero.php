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

?>



<!-- Hero Section -->
<section class="guide-hero">

    <div class="guide-hero__content">

        <div class="guide-hero__content__title-area">
            <div class="guide-hero__content__title-area__category">
                <?php echo $displayCategory ?>
            </div>
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