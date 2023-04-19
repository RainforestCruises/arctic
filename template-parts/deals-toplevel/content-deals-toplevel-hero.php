<?php
$hero_image = get_field('hero_image');
$title = get_field('title');
$subtitle = get_field('subtitle');
?>

<section class="deals-toplevel-hero">

    <!-- BG Image -->
    <div class="deals-toplevel-hero__bg-image">
        <img <?php afloat_image_markup($hero_image['id'], 'wide-full', array('wide-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?>>
    </div>

    <!-- Content -->
    <div class="deals-toplevel-hero__content">
        <div class="deals-toplevel-hero__content__title-group">
            <div class="deals-toplevel-hero__content__title-group__category">
                All Deals
            </div>
            <div class="deals-toplevel-hero__content__title-group__title">
                <?php echo $title ?>
            </div>
            <div class="deals-toplevel-hero__content__title-group__sub">
                <?php echo $subtitle ?>
            </div>
        </div>
    </div>

</section>