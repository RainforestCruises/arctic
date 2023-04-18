<?php 
$dealName = get_field('navigation_title');
$featured_image = get_field('featured_image');

?>

<section class="deal-hero">
    <!-- Desktop BG Image -->
    <div class="deal-hero__bg-image">
        <img <?php afloat_image_markup($featured_image['id'], 'wide-full', array('wide-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?>>
    </div>

    <div class="deal-hero__content">

        <div class="deal-hero__content__title-group">
            <div class="deal-hero__content__title-group__title">
                <?php echo $dealName ?>
            </div>
            <div class="deal-hero__content__title-group__sub">
                Test
            </div>
        </div>

    </div>
</section>