<?php
$destinations = get_field('destinations', 'options');
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

            <!-- Search Area -->
            <div class="nav-main__content__center__search-area">

                <!-- Nav Search Widget -->
                <?php get_template_part('template-parts/nav/content', 'nav-search'); ?>

            </div>

            <!-- Nav Links -->
            <nav class="nav-main__content__center__nav">

                <ul class="nav-main__content__center__nav__list">
                    <li class="nav-main__content__center__nav__list__item" navelement="destinations">
                        Destinations
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

                <!-- Destinations Panel -->
                <div class="nav-mega__panel " panel="destinations">
                    <div class="nav-mega__panel__destinations">
                        <div class="nav-mega__panel__destinations__items">
                            <?php foreach ($destinations as $d) :
                                $image =  get_field('feature_image', $d);
                                $title =  get_field('navigation_title', $d);
                            ?>
                                <div class="nav-mega__panel__destinations__items__item">
                                    <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                    <div class="nav-mega__panel__destinations__items__item__title-group">

                                        <div class="nav-mega__panel__destinations__items__item__title-group__title">
                                            <?php echo $title ?>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
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
                                    $image = get_field('featured_image', $ship);
                                    $title = get_the_title($ship);
                                    $cruise_data = get_field('cruise_data', $ship);
                                    $sub = itineraryRange($cruise_data, "-") . " Days, Luxury"
                                ?>
                                    <div class="nav-mega__panel__ships__group__items__item">
                                        <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                        <div class="nav-mega__panel__ships__group__items__item__title-group">
                                            <div class="nav-mega__panel__ships__group__items__item__title-group__title">
                                                <?php echo $title ?>
                                            </div>
                                            <div class="nav-mega__panel__ships__group__items__item__title-group__sub">
                                                <?php echo $sub ?>
                                            </div>
                                        </div>
                                    </div>
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
                                    $image = get_field('featured_image', $ship);
                                    $title = get_the_title($ship);
                                    $cruise_data = get_field('cruise_data', $ship);
                                    $sub = itineraryRange($cruise_data, "-") . " Days, Luxury"
                                ?>
                                    <div class="nav-mega__panel__ships__group__items__item">
                                        <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                        <div class="nav-mega__panel__ships__group__items__item__title-group">
                                            <div class="nav-mega__panel__ships__group__items__item__title-group__title">
                                                <?php echo $title ?>
                                            </div>
                                            <div class="nav-mega__panel__ships__group__items__item__title-group__sub">
                                                <?php echo $sub ?>
                                            </div>
                                        </div>
                                    </div>
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
                                    $image = get_field('featured_image', $ship);
                                    $title = get_the_title($ship);
                                    $cruise_data = get_field('cruise_data', $ship);
                                    $sub = itineraryRange($cruise_data, "-") . " Days, Luxury"
                                ?>
                                    <div class="nav-mega__panel__ships__group__items__item">
                                        <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>

                                        <div class="nav-mega__panel__ships__group__items__item__title-group">
                                            <div class="nav-mega__panel__ships__group__items__item__title-group__title">
                                                <?php echo $title ?>
                                            </div>
                                            <div class="nav-mega__panel__ships__group__items__item__title-group__sub">
                                                <?php echo $sub ?>
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guides Panel -->
                <div class="nav-mega__panel active" panel="guides">
                    <div class="nav-mega__panel__guides">

                        <?php foreach ($guides as $g) :
                            $guide_group = $g['guide_group'];
                            $items = $g['items'];
                        ?>

                            <!-- Group -->
                            <div class="nav-mega__panel__guides__group">
                                <div class="nav-mega__panel__guides__group__title">
                                    <?php echo $guide_group ?>
                                </div>

                                <!-- Items -->
                                <div class="nav-mega__panel__guides__group__items">
                                    <?php foreach ($items as $i) :
                                        $title = $i['title'];
                                        $link = $i['link'];
                                    ?>
                                        <div class="nav-mega__panel__guides__group__items__item">
                                            <!-- img -->
                                            <a class="nav-mega__panel__guides__group__items__item__title" href="<?php echo $link; ?>">
                                                <?php echo $title ?>
                                            </a>
                                        </div>
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