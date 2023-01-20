<?php
$landing_pages = get_field('landing_pages', 'options');
$ships = get_field('ships', 'options');
$guides = get_field('guides', 'options');


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
                    <div class="nav-mega__panel__grid">
                        <?php foreach ($landing_pages as $group) :
                            $group_title = $group['group'];
                            $items = $group['items'];
                        ?>
                            <div class="nav-mega__panel__grid__group">
                                <div class="nav-mega__panel__grid__group__title">
                                    <?php echo $group_title; ?>
                                </div>
                                <div class="nav-mega__panel__grid__group__items">
                                    <?php foreach ($items as $item) :
                                        $url = get_permalink($item);
                                        $hero_title = get_field('hero_title', $item);
                                        $hero_images =  get_field('hero_images', $item);
                                    ?>
                                        <a class="mega-category-item" href="<?php echo $url; ?>">
                                            <div class="mega-category-item__image-area">
                                                <img <?php afloat_image_markup($hero_images[0]['id'], 'square-small', array('square-small')); ?>>
                                            </div>
                                            <div class="mega-category-item__title">
                                                <?php echo $hero_title ?>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Ships Panel -->
                <div class="nav-mega__panel " panel="ships">
                    <div class="nav-mega__panel__grid">
                        <?php foreach ($ships as $group) :
                            $group_title = $group['group'];
                            $items = $group['items'];
                        ?>
                            <div class="nav-mega__panel__grid__group">
                                <div class="nav-mega__panel__grid__group__title">
                                    <?php echo $group_title; ?>
                                </div>
                                <div class="nav-mega__panel__grid__group__items items-grid-4">
                                    <?php foreach ($items as $item) :
                                        $url = get_permalink($item);
                                        $title = get_the_title($item);
                                        $hero_gallery = get_field('hero_gallery', $item);
                                        $ship_image = $hero_gallery[0];
                                        $itineraries = get_field('itineraries', $ship);
                                        $itineraryDisplay = count($itineraries) . ' Itineraries, ' . itineraryRange($itineraries, "-") . " Days";
                                        $guestsDisplay = get_field('vessel_capacity', $item) . ' Guests';
                                    ?>
                                        <a class="mega-item" href="<?php echo $url; ?>">
                                            <div class="mega-item__image-area">
                                                <img <?php afloat_image_markup($ship_image['id'], 'square-small'); ?>>
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
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Guides Panel -->
                <div class="nav-mega__panel" panel="guides">
                    <div class="nav-mega__panel__grid column-2">

                        <?php foreach ($guides as $g) :
                            $group = $g['group'];
                            $items = $g['items'];
                        ?>

                            <!-- Group -->
                            <div class="nav-mega__panel__grid__group">
                                <div class="nav-mega__panel__grid__group__title">
                                    <?php echo $group ?>
                                </div>

                                <!-- Items -->
                                <div class="nav-mega__panel__grid__group__items items-grid-2">
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