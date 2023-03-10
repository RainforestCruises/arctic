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


$table_of_contents  = get_field('table_of_contents');


?>



<!-- Hero Section -->
<section class="guide-hero">

    <div class="guide-hero__content">

        <div class="guide-hero__content__title-area">
            <div class="guide-hero__content__title-area__category">
                <?php echo $displayCategory ?>
            </div>
            <div class="guide-hero__content__title-area__title">
                <?php echo get_field('navigation_title'); ?>
            </div>

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
        <?php if ($table_of_contents) : ?>
            <div class="guide-hero__content__toc">
                <div class="guide-hero__content__toc__header">
                    In This Article:
                </div>
                <ol>
                    <?php foreach ($table_of_contents as $item) : ?>
                        <li>
                            <a href="#<?php echo $item['anchor'] ?>" class="toc-link"><?php echo $item['title'] ?></a>
                        </li>

                    <?php endforeach; ?>
                </ol>
            </div>
        <?php endif; ?>
    </div>
</section>