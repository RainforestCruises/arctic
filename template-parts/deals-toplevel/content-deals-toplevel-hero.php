<?php
$hero_images = get_field('hero_images');
$hero_title = get_field('hero_title');
$subtitle = get_field('subtitle');
$show_site_notice = get_field('show_site_notice', 'options');
$sections = get_field('sections');

?>

<section class="deals-toplevel-hero" id="top">

    <!-- BG Image -->
    <div class="deals-toplevel-hero__bg-image">
        <img <?php afloat_image_markup($hero_images[0]['id'], 'wide-full', array('wide-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small')); ?>>
    </div>

    <!-- Content -->
    <div class="deals-toplevel-hero__content <?php echo ($show_site_notice ? "site-notice-variant" : "") ?>">
        <div class="deals-toplevel-hero__content__title-group">

            <h1 class="deals-toplevel-hero__content__title-group__title">
                <?php echo $hero_title ?>
            </h1>
            <div class="deals-toplevel-hero__content__title-group__sub">
                <?php echo $subtitle ?>
            </div>
        </div>


    </div>

</section>

<!-- Nav section -->
<section class="landing-nav" id="nav">
    <div class="landing-nav__content">

        <!-- Nav Links -->
        <div class="landing-nav__content__links">
            <?php
            $categoryCount = 0;
            foreach ($sections as $section) :
                $category = get_page_template_slug() == "template-deals-toplevel.php" ? $section['category'] : $section['region'];
                $items = get_page_template_slug() == "template-deals-toplevel.php" ? getDealsInCategory($category) : getExtensionsInRegion($category);
                $titleSlug = slugify(get_the_title($category));
                if (!$items) continue; // skip if no deals found for category
            ?>
                <a href="#<?php echo $titleSlug; ?>" class="landing-nav__content__links__link"><?php echo get_the_title($category) ?></a>

            <?php endforeach; ?>

            <?php if (get_page_template_slug() == "template-deals-toplevel.php") : ?>
                <a href="#group" class="landing-nav__content__links__link">Group</a>
            <?php endif; ?>

        </div>

        <div class="landing-nav__content__info">



            <!-- CTA Button -->
            <div class="landing-nav__content__info__cta">
                <button class="btn-primary btn-primary--icon generic-inquire-cta">
                    Inquire
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>