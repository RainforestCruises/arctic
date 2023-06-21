<?php
$dealName = get_field('navigation_title');
$description = get_field('description');
$featured_image = get_field('featured_image');
$has_expiry_date = get_field('has_expiry_date');
$expiry_date =  get_field('expiry_date');
$categoryPost = get_field('category');
$categoryTitle = get_the_title($categoryPost);
$top_level_deals_page =  get_field('top_level_deals_page', 'options');

?>

<section class="deal-hero">
    <!-- Desktop BG Image -->
    <div class="deal-hero__bg-image">
        <img <?php afloat_image_markup($featured_image['id'], 'wide-full', array('wide-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?>>
    </div>

    <div class="deal-hero__content">


        <div class="deal-hero__content__title-group">
            <div class="deal-hero__content__title-group__category">
                <!-- Breadcrumb -->
                <ol class="breadcrumb-list">
                    <li>
                        <a href="<?php echo $top_level_deals_page; ?>">All Deals</a>
                    </li>
                </ol>

            </div>
            <h1 class="deal-hero__content__title-group__title">
                <?php echo $dealName ?>
            </h1>
            <?php if ($has_expiry_date) : ?>
                <div class="deal-hero__content__title-group__urgency">
                    <svg class="deal-hero__content__title-group__urgency__icon">
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-stopwatch"></use>
                    </svg>
                    <div class="deal-hero__content__title-group__urgency__title">
                        Offer Valid Until <?php echo date("F j, Y", strtotime($expiry_date)); ?>
                        <div class="deal-hero__content__title-group__urgency__title__sub">
                            <?php echo getDaysUntilExpiry($expiry_date) ?> Days Remaining
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="deal-hero__content__bottom">
            <a class="btn-scroll-overlay btn-scroll-overlay--down" id="down-arrow-button" href="#section-intro">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </a>
        </div>

    </div>


</section>