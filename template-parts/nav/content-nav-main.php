<?php
$route_landing_pages = get_field('route_landing_pages', 'options');
$style_landing_pages = get_field('style_landing_pages', 'options');

$guides = get_field('guides', 'options');

$queryArgs = array(
    'post_type' => 'rfc_cruises',
    'posts_per_page' => -1,
    'meta_key' => 'search_rank',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
);
$ships = get_posts($queryArgs);

$small = [];
$medium = [];
$large = [];
foreach ($ships as $s) {
    $capacity = get_field('vessel_capacity', $s);
    if ($capacity <= 80) {
        $small[] = $s;
    } else if ($capacity <= 150 && $capacity > 80) {
        $medium[] = $s;
    } else {
        $large[] = $s;
    }
}

$alwaysActiveMainNav = checkActiveHeader();
?>

<!-- Nav Main -->
<div class="nav-main <?php echo ($alwaysActiveMainNav == true) ? 'active' : ''; ?>">
    <div class="nav-main__content">

        <!-- Left (logo) -->
        <div class="nav-main__content__left">
            <a href="<?php echo get_home_url(); ?>" class="nav-main__content__left__logo-area">
                <?php
                $logo = get_field('logo_main', 'options');
                $logoMinimal = get_field('logo_minimal', 'options');
                ?>
                <img src="<?php echo $logo['url']; ?>" class="nav-main__content__left__logo-area__logo-main" alt="<?php echo get_bloginfo('name') ?>" />
                <img src="<?php echo $logoMinimal['url']; ?>" class="nav-main__content__left__logo-area__logo-minimal" alt="<?php echo get_bloginfo('name') ?>" />
            </a>
        </div>

        <!-- Center -->
        <div class="nav-main__content__center">



            <!-- Nav Links -->
            <nav class="nav-main__content__center__nav">

                <ul class="nav-main__content__center__nav__list">
                    <li class="nav-main__content__center__nav__list__item" navelement="categorical">
                        Cruises
                    </li>
                    <li class="nav-main__content__center__nav__list__item" navelement="ships">
                        Ships
                    </li>
                    <li class="nav-main__content__center__nav__list__item" navelement="guides">
                        Guides
                    </li>

                </ul>

            </nav>

            <!-- Nav Mega (abs position)-->
            <div class="nav-mega">

                <!-- Cruises Panel -->
                <div class="nav-mega__panel" panel="categorical">
                    <div class="nav-mega__panel__categorical">

                        <!-- Routes -->
                        <div class="nav-mega__panel__categorical__group">
                            <div class="nav-mega__panel__categorical__group__title">
                                Popular Routes
                            </div>
                            <div class="nav-mega__panel__categorical__group__items">
                                <?php foreach ($route_landing_pages as $page) :
                                    $hero_slider =  get_field('hero_slider', $page);
                                    $image = $hero_slider[0]['image'];
                                    $title =  get_the_title($page);
                                ?>
                                    <a class="mega-category-item" href="<?php echo get_permalink($page); ?>">

                                        <div class="mega-category-item__image-area">
                                            <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                        </div>
                                        <div class="mega-category-item__title">
                                            <?php echo $title ?>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>

                        </div>

                        <!-- Styles -->
                        <div class="nav-mega__panel__categorical__group">
                            <div class="nav-mega__panel__categorical__group__title">
                                Travel Styles
                            </div>
                            <div class="nav-mega__panel__categorical__group__items">
                                <?php foreach ($style_landing_pages as $page) :
                                    $hero_slider =  get_field('hero_slider', $page);
                                    $image = $hero_slider[0]['image'];
                                    $title =  get_the_title($page);
                                ?>
                                    <a class="mega-category-item" href="<?php echo get_permalink($page); ?>">

                                        <div class="mega-category-item__image-area">
                                            <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                        </div>
                                        <div class="mega-category-item__title">
                                            <?php echo $title ?>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Ships Panel -->
                <div class="nav-mega__panel " panel="ships">
                    <div class="nav-mega__panel__ships">
                        <!-- Small -->
                        <div class="nav-mega__panel__ships__group">
                            <div class="nav-mega__panel__ships__group__title">
                                Under 80 Passengers
                            </div>
                            <div class="nav-mega__panel__ships__group__items">
                                <?php foreach ($small as $ship) :
                                    $hero_gallery = get_field('hero_gallery', $ship);
                                    $title = get_the_title($ship);
                                    $itineraries = get_field('itineraries', $ship);
                                    $itineraryDisplay = count($itineraries) . ' Itineraries, ' . itineraryRange($itineraries, "-") . " Days";
                                    $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests';

                                ?>
                                    <a class="mega-item" href="<?php echo get_permalink($ship); ?>">
                                        <div class="mega-item__image-area">
                                            <img <?php afloat_image_markup($hero_gallery[0]['id'], 'square-small'); ?>>
                                        </div>
                                        <div class="mega-item__title-group">
                                            <div class="mega-item__title-group__title">
                                                <?php echo $title ?>
                                            </div>
                                            <div class="mega-item__title-group__sub">
                                                <?php echo $itineraryDisplay ?>
                                            </div>
                                            <div class="mega-item__title-group__sub">
                                                <?php echo $guestsDisplay ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Medium -->
                        <div class="nav-mega__panel__ships__group">
                            <div class="nav-mega__panel__ships__group__title">
                                80 - 150 Passengers
                            </div>
                            <div class="nav-mega__panel__ships__group__items">
                                <?php foreach ($medium as $ship) :
                                    $hero_gallery = get_field('hero_gallery', $ship);
                                    $title = get_the_title($ship);
                                    $itineraries = get_field('itineraries', $ship);
                                    $itineraryDisplay = count($itineraries) . ' Itineraries, ' . itineraryRange($itineraries, "-") . " Days";
                                    $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests';

                                ?>
                                    <a class="mega-item" href="<?php echo get_permalink($ship); ?>">
                                        <div class="mega-item__image-area">
                                            <img <?php afloat_image_markup($hero_gallery[0]['id'], 'square-small'); ?>>
                                        </div>
                                        <div class="mega-item__title-group">
                                            <div class="mega-item__title-group__title">
                                                <?php echo $title ?>
                                            </div>
                                            <div class="mega-item__title-group__sub">
                                                <?php echo $itineraryDisplay ?>
                                            </div>
                                            <div class="mega-item__title-group__sub">
                                                <?php echo $guestsDisplay ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Large -->
                        <div class="nav-mega__panel__ships__group">
                            <div class="nav-mega__panel__ships__group__title">
                                150+ Passengers
                            </div>
                            <div class="nav-mega__panel__ships__group__items">
                                <?php foreach ($large as $ship) :
                                    $hero_gallery = get_field('hero_gallery', $ship);
                                    $title = get_the_title($ship);
                                    $itineraries = get_field('itineraries', $ship);
                                    $itineraryDisplay = count($itineraries) . ' Itineraries, ' . itineraryRange($itineraries, "-") . " Days";
                                    $guestsDisplay = get_field('vessel_capacity', $ship) . ' Guests';

                                ?>
                                    <a class="mega-item" href="<?php echo get_permalink($ship); ?>">
                                        <div class="mega-item__image-area">
                                            <img <?php afloat_image_markup($hero_gallery[0]['id'], 'square-small'); ?>>
                                        </div>
                                        <div class="mega-item__title-group">
                                            <div class="mega-item__title-group__title">
                                                <?php echo $title ?>
                                            </div>
                                            <div class="mega-item__title-group__sub">
                                                <?php echo $itineraryDisplay ?>
                                            </div>
                                            <div class="mega-item__title-group__sub">
                                                <?php echo $guestsDisplay ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guides Panel -->
                <div class="nav-mega__panel" panel="guides">
                    <div class="nav-mega__panel__guides">

                        <?php foreach ($guides as $g) :
                            $guide_group = $g['guide_group'];
                            $guide_group_icon = $g['guide_group_icon'];
                            $items = $g['items'];
                        ?>

                            <!-- Group -->
                            <div class="nav-mega__panel__guides__group">
                                <div class="nav-mega__panel__guides__group__title">
                                    <?php echo $guide_group_icon ?>
                                    <?php echo $guide_group ?>

                                </div>

                                <!-- Items -->
                                <div class="nav-mega__panel__guides__group__items">
                                    <?php foreach ($items as $i) :
                                        $title = $i['title'];
                                        $guide_post = $i['guide_post'];
                                        $featured_image = get_field('featured_image', $guide_post)
                                    ?>

                                        <a class="mega-item no-border" href="<?php echo get_permalink($guide_post); ?>">
                                            <div class="mega-item__image-area">
                                                <img <?php afloat_image_markup($featured_image['id'], 'square-small'); ?>>
                                            </div>
                                            <div class="mega-item__title-group">
                                                <div class="mega-item__title-group__title">
                                                    <?php echo $title ?>
                                                </div>

                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

            </div>

        </div>

        <!-- Right -->
        <div class="nav-main__content__right">

            <!-- Right Widget-->
            <?php get_template_part('template-parts/nav/content', 'nav-right'); ?>

        </div>

    </div>
</div>