<?php
$dealName = get_field('navigation_title');
$description = get_field('description');
$featured_image = get_field('featured_image');
$has_expiry_date = get_field('has_expiry_date');
$expiry_date =  get_field('expiry_date');
$categoryPost = get_field('category');
$categoryTitle = get_the_title($categoryPost);

?>

<section class="deal-hero">
    <!-- Desktop BG Image -->
    <div class="deal-hero__bg-image">
        <img <?php afloat_image_markup($featured_image['id'], 'wide-full', array('wide-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?>>
    </div>

    <div class="deal-hero__content">

        <div class="deal-hero__content__title-group">
            <div class="deal-hero__content__title-group__category">
                All Deals / <?php echo $categoryTitle ?>
            </div>
            <div class="deal-hero__content__title-group__title">
                <?php echo $dealName ?>
            </div>
            <div class="deal-hero__content__title-group__sub">
                <?php echo $description ?>
            </div>
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

    </div>
</section>