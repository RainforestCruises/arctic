<?php
$hero_images = get_field('hero_images');
$title = get_field('title');
$subtitle = get_field('subtitle');
?>

<section class="deals-toplevel-hero">

    <!-- BG Image -->
    <div class="deals-toplevel-hero__bg-image">
        <img <?php afloat_image_markup($hero_images[0]['id'], 'wide-full', array('wide-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?>>
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

        <div class="deals-toplevel-hero__content__bottom">
            <a class="btn-scroll-overlay btn-scroll-overlay--down" id="down-arrow-button" href="#section-intro">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </a>
        </div>
    </div>
    

</section>