<?php
$hero_featured_image = get_field('hero_featured_image');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_items = get_field('hero_items');
$show_site_notice = get_field('show_site_notice', 'options');


?>

<section class="home-hero" id="top">

    <div class="home-hero__bg-image">
        <img <?php afloat_image_markup($hero_featured_image['id'], 'landscape-full', array('landscape-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small'), false); ?> class="optimole-initial">
    </div>

    <!-- Hero Content -->
    <div class="home-hero__content <?php echo ($show_site_notice ? "site-notice-variant" : "") ?>">

        <!-- Main Title Group -->
        <div class="home-hero__content__title-area">
            <h1 class="home-hero__content__title-area__title">
                <?php echo $hero_title ?>
            </h1>
            <div class="home-hero__content__title-area__sub">
                <?php echo $hero_subtitle; ?>
            </div>
        </div>

        <!-- Secondary -->
        <div class="home-hero__content__jumplinks">
            <?php foreach ($hero_items as $item) :

                $anchor = $item['anchor_link'];
                $icon = $item['icon'];
                $image = $item['image'];
                $title = $item['title'];
                $subtitle = $item['subtitle'];

                $percentage_savings = $item['percentage_savings'];

            ?>
                <a class="hero-item" href="<?php echo $anchor; ?>">
                    <div class="hero-item__icon-area">
                        <?php echo $icon; ?>
                    </div>
                    <div class="hero-item__title-group">
                        <div class="hero-item__title-group__title">
                            <?php echo $title; ?>
                        </div>
                    </div>
                </a>

            <?php endforeach; ?>
        </div>

    </div>
</section>