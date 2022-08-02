<?php
$show_translate_nav = get_field('show_translate_nav', 'options');
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

$alwaysActiveHeader = checkActiveHeader();
$headerClasses = renderHeaderClasses();
?>

<!-- Header -->
<header class="header <?php echo $headerClasses; ?>" id="header">

    <!-- Nav Main -->
    <div class="nav-main  <?php echo ($alwaysActiveHeader == true) ? 'active' : ''; ?>">
        <div class="nav-main__content">

            <!-- Left (logo) -->
            <div class="nav-main__content__left">
                <a href="<?php echo get_home_url(); ?>" class="nav-main__content__left__logo-area">
                    <?php
                    $logo = get_theme_mod('custom_logo');
                    $image = wp_get_attachment_image_src($logo, 'full');
                    $image_url = $image[0];
                    ?>
                    <img src="<?php echo $image_url ?>" alt="<?php echo get_bloginfo('name') ?>" />
                </a>
            </div>

            <!-- Center -->
            <div class="nav-main__content__center">
                <!-- Search Element -->
                <div class="nav-main__content__center__search-area">              
                    <div class="search-element">
                        <div class="search-element__inputs">
                            <div class="search-element__inputs__item">
                                Where
                            </div>
                            <div class="search-element__inputs__item">
                                When
                            </div>
                            <div class="search-element__inputs__item">
                                Style
                            </div>
                        </div>
                        <div class="search-element__cta">

                            <button class="search-element__cta__button" type="submit" form="home-search-form">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
                                </svg>
                            </button>

                        </div>
                    </div>
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

                <!-- Nav Mega -->
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


            <!-- Right (contact) -->
            <div class="nav-main__content__right">

                <!-- Contact Mail -->
                <a href="<?php echo get_home_url(); ?>/contact" class="nav-main__content__right__contact-link">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
                    </svg>

                </a>
                <!-- Contact Phone -->
                <div class="nav-main__content__right__phone-desktop divider-left">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-phone-call"></use>
                    </svg>
                    <span class="phone-popover">

                        <div class="phone-popover__container">
                            <div class="phone-popover__container__arrow"></div>
                            <div class="phone-popover__container__content">
                                <div class="phone-popover__container__content__header">
                                    Give Us a Call
                                </div>
                                <a class="phone-popover__container__content__number" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>">
                                    <?php echo get_field('phone_number', 'options'); ?>
                                </a>

                            </div>

                        </div>

                    </span>

                </div>
                <!-- Language Switch -->
                <?php
                if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
                    <div class="nav-main__content__right__language divider-left">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_translate_24px"></use>
                        </svg>
                        <span>

                            <?php echo do_shortcode("[language-switcher]"); ?>
                        </span>
                    </div>
                <?php endif; ?>
                <!-- Burger Menu -->
                <div class="burger-button" id="burger-menu">
                    <span class="burger-button__bar "></span>
                </div>

            </div>

        </div>
    </div>

</header>

<!-- Itinerary Nav -->
<?php if (get_post_type() == 'rfc_itineraries') :
    get_template_part('template-parts/nav/content', 'nav-itinerary');
endif; ?>

<!-- Destination Nav -->
<?php
if (is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-cruise.php') || is_page_template('template-destinations-region.php')) :
    get_template_part('template-parts/nav/content', 'nav-destination');
endif; ?>

<!-- Cruise Nav -->
<?php if (get_post_type() == 'rfc_cruises') :
    get_template_part('template-parts/nav/content', 'nav-cruise');
endif; ?>

<div class="nav-backdrop"></div>