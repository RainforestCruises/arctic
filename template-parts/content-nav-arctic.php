<?php
$menu_name = 'arctic_main_menu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);
$menuitems = wp_get_nav_menu_items($menu->term_id);
$show_translate_nav = get_field('show_translate_nav', 'options');

$menu_toplevel = [];
$menu_destinations = [];
$menu_ships = [];

$alwaysActiveHeader = checkActiveHeader(); //return true/false depending on if current template header bar should never be transparent


foreach ($menuitems as $m) {

    //Top Level
    if ($m->menu_item_parent == 0) {
        $menu_toplevel[] = $m;

        //Destinations
        if ($m->post_title == "Destinations") {

            $toplevel_ID = $m->ID;
            foreach ($menuitems as $mm) {


                if ($mm->menu_item_parent == $toplevel_ID) {

                    $navigation_snippet = get_field('navigation_snippet', $mm->object_id);
                    $navigation_image = get_field('navigation_image', $mm->object_id);

                    $destination = array(
                        'id' => $mm->ID,
                        'title' => $mm->title,
                        'url' => $mm->url,
                        'parentId' => $toplevel_ID,
                        'navigation_snippet' => $navigation_snippet,
                        'navigation_image' => $navigation_image,
                    );

                    $menu_destinations[] = $destination;
                }
            }
        } else if ($m->post_title == "Ships") {

            $toplevel_ID = $m->ID;
            foreach ($menuitems as $mm) {

                if ($mm->menu_item_parent == $toplevel_ID) {

                    $navigation_snippet = get_field('top_snippet', $mm->object_id);
                    $navigation_image = get_field('featured_image', $mm->object_id);

                    $ship = array(
                        'id' => $mm->ID,
                        'title' => $mm->title,
                        'url' => $mm->url,
                        'parentId' => $toplevel_ID,
                        'navigation_snippet' => $navigation_snippet,
                        'navigation_image' => $navigation_image,
                    );

                    $menu_ships[] = $ship;
                }
            }
        }
    }
}

console_log($menuitems);

console_log($menu_destinations);
console_log($menu_ships);



?>


<!-- Mobile Menu -->
<nav class="nav-mobile">

    <!-- Language Switch -->
    <?php if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
        <div class="mobile-language-switch">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_translate_24px"></use>
            </svg>
            <span class="mobile-language-switch__trp">
                <?php echo do_shortcode("[language-switcher]"); ?>
            </span>
        </div>
    <?php endif; ?>


    <div class="burger-button close" id="burger-menu-close">
        <span class="burger-button__bar "></span>
    </div>
    <!-- Top level Menu -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--top" menuid="top">

        <?php foreach ($menu_toplevel as $toplevelItem) : ?>
            <?php if ($toplevelItem->object != 'page') : ?>
                <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="<?php echo $toplevelItem->ID ?>">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                    </svg>
                    <span>
                        <?php echo $toplevelItem->title ?>
                    </span>

                </a>
            <?php else : ?>
                <a class="nav-mobile__content-panel__button mobile-link" href="<?php echo $toplevelItem->url ?>"><?php echo $toplevelItem->title ?></a>

            <?php endif; ?>
        <?php endforeach; ?>
        <a class="nav-mobile__content-panel__button mobile-link divider" href="<?php echo get_field('top_level_search_page', 'option'); ?>">Search</a>
        <a class="nav-mobile__content-panel__button mobile-link divider" href="<?php echo get_home_url(); ?>/contact">Contact</a>


        <a class="nav-mobile__content-panel__button mobile-link phone" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>">
            <?php echo get_field('phone_number', 'options'); ?>

        </a>


    </div>


    <!-- Level 2 -->
    <?php foreach ($menu_toplevel as $toplevelItem) : ?>
        <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="<?php echo $toplevelItem->ID ?>">
            <a class="nav-mobile__content-panel__button back-link" menuLinkTo="top">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                </svg>
                <span>
                    Back
                </span>

            </a>



            <?php if ($toplevelItem->title == 'Destinations') : ?>
                <?php foreach ($menu_destinations as $destination) : ?>
                    <a href="<?php echo $destination['url'] ?>" class="nav-mobile__content-panel__button mobile-link">
                        <?php echo $destination['title'] ?>
                    </a>
                <?php endforeach; ?>
            <?php endif ?>

            <?php if ($toplevelItem->title == 'Ships') : ?>
                <?php foreach ($menu_ships as $ship) : ?>
                    <a href="<?php echo $ship['url'] ?>" class="nav-mobile__content-panel__button mobile-link">
                        <?php echo $ship['title'] ?>
                    </a>
                <?php endforeach; ?>
            <?php endif ?>

        </div>
    <?php endforeach; ?>



</nav>

<!-- Desktop Header -->
<!-- Header -->
<header class="header " id="header">

    <!-- Top Level Nav -->
    <div class="header__main <?php echo ($alwaysActiveHeader == true) ? 'active' : ''; ?>">

        <!-- Logo -->
        <div class="header__main__logo-area">
            <a href="<?php echo get_home_url(); ?>" class="header__main__logo-area__logo">
                <?php
                $logo = get_theme_mod('custom_logo');
                $image = wp_get_attachment_image_src($logo, 'full');
                $image_url = $image[0];
                ?>
                <img src="<?php echo $image_url ?>" alt="<?php echo get_bloginfo('name') ?>" />
            </a>
        </div>
        <!-- Main Nav -->
        <nav class="header__main__nav">
            <div class="header__main__nav__list">
                <?php foreach ($menu_toplevel as $toplevelItem) : ?>
                    <li class="header__main__nav__list__item">
                        <?php if ($toplevelItem->object != 'page') : ?>
                            <span class="header__main__nav__list__item__link mega" navelement="<?php echo $toplevelItem->title ?>"><?php echo $toplevelItem->title ?></span>
                        <?php else : ?>
                            <a class="header__main__nav__list__item__link" href="<?php echo $toplevelItem->url ?>" navelement="<?php echo $toplevelItem->title ?>"><?php echo $toplevelItem->title ?></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </div>
        </nav>
        <!-- Right Side -->
        <div class="header__main__right">

            <!-- Search Button -->
            <?php if (!is_page_template('template-search.php')) : ?>
                <div class="header__main__right__search">
                    <a class="nav-search-button" href="<?php echo get_field('top_level_search_page', 'option'); ?>">
                        Search
                    </a>
                </div>
            <?php endif; ?>
            <!-- Contact Mail -->
            <a href="<?php echo get_home_url(); ?>/contact" class="header__main__right__contact-link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
                </svg>

            </a>
            <!-- Contact Phone -->
            <div class="header__main__right__phone-desktop divider-left">
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
                <div class="header__main__right__language divider-left">
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


    <!-- Mega desktop -->
    <div class="nav-mega">
        <!-- Destinations -->
        <div class="nav-mega__nav-arctic nav-mega__nav-arctic--destinations">
            <div class="nav-mega__nav-arctic__menu">
                <div class="nav-mega__nav-arctic__menu__title">
                    Polar Destinations
                </div>
                <ul class="nav-mega__nav-arctic__menu__list">
                    <?php  
                    $panelCount = 0;
                    foreach ($menu_destinations as $destination) : ?>

                        <li class="nav-mega__nav-arctic__menu__list__item">
                            <a href="<?php echo $destination['url'] ?>" panel="<?php echo $destination['id'] ?>" class="nav-mega__nav-arctic__menu__list__item__link <?php echo $panelCount == 0 ? 'initial' : ''; ?>"><?php echo $destination['title'] ?></a>
                        </li>


                    <?php $panelCount++; 
                endforeach; ?>
                </ul>
            </div>
            <div class="nav-mega__nav-arctic__content-area">
                <?php $panelCount = 0;
                foreach ($menu_destinations as $destination) : ?>
                    <div class="nav-mega__nav-arctic__content-area__panel <?php echo $panelCount == 0 ? 'initial' : ''; ?>" panel="<?php echo $destination['id'] ?>">

                        <div class="nav-mega__nav-arctic__content-area__panel__description">
                            <div class="nav-mega__nav-arctic__content-area__panel__description__title">
                                <?php echo $destination['title'] ?>
                            </div>
                            <div class="nav-mega__nav-arctic__content-area__panel__description__snippet">
                                <?php echo $destination['navigation_snippet'] ?>
                            </div>
                            <div class="nav-mega__nav-arctic__content-area__panel__description__cta">
                                <a class="btn-cta-round btn-cta-round--medium" href="<?php echo $destination['url'] ?>">
                                    Explore <?php echo $destination['title'] ?>
                                </a>
                            </div>

                        </div>
                        <div class="nav-mega__nav-arctic__content-area__panel__image-area">
                            <img <?php afloat_image_markup($destination['navigation_image']['ID'], 'featured-square'); ?>>
                        </div>

                    </div>
                <?php $panelCount++;  endforeach; ?>
            </div>
        </div>
        <!-- Ships -->
        <div class="nav-mega__nav nav-mega__nav-arctic--ships">
            <div class="nav-mega__nav-arctic__menu">
                <div class="nav-mega__nav-arctic__menu__title">
                    Cruise Ships
                </div>
                <ul class="nav-mega__nav-arctic__menu__list">
                    <?php $panelCount = 0;
                     foreach ($menu_ships as $ship) : ?>

                        <li class="nav-mega__nav-arctic__menu__list__item">
                            <a href="<?php echo $ship['url'] ?>" panel="<?php echo $ship['id'] ?>" class="nav-mega__nav-arctic__menu__list__item__link <?php echo $panelCount == 0 ? 'initial' : ''; ?>"><?php echo $ship['title'] ?></a>
                        </li>


                    <?php $panelCount++; endforeach; ?>
                </ul>
            </div>
            <div class="nav-mega__nav-arctic__content-area">
                <?php 
                $panelCount = 0;
                foreach ($menu_ships as $ship) : 
                    
                    ?>
                    <div class="nav-mega__nav-arctic__content-area__panel <?php echo $panelCount == 0 ? 'initial' : ''; ?>" panel="<?php echo $ship['id'] ?>">

                        <div class="nav-mega__nav-arctic__content-area__panel__description">
                            <div class="nav-mega__nav-arctic__content-area__panel__description__title">
                                <?php echo $ship['title'] ?>
                            </div>
                            <div class="nav-mega__nav-arctic__content-area__panel__description__snippet">
                                <?php echo $ship['navigation_snippet'] ?>
                            </div>
                            <div class="nav-mega__nav-arctic__content-area__panel__description__cta">
                                <a class="btn-cta-round btn-cta-round--medium" href="<?php echo $ship['url'] ?>">
                                    Explore <?php echo $ship['title'] ?>
                                </a>
                            </div>

                        </div>
                        <div class="nav-mega__nav-arctic__content-area__panel__image-area ship" >
                            <img <?php afloat_image_markup($ship['navigation_image']['ID'], 'featured-medium'); ?>>
                        </div>

                    </div>
                <?php $panelCount++;
            endforeach; ?>
            </div>
        </div>
    </div>

    <div class="nav-mega-overlay"></div>



    <!-- Product Secondary Nav -->
    <?php if (get_post_type() == 'rfc_cruises' || get_post_type() == 'rfc_tours' || get_post_type() == 'rfc_lodges') :
        get_template_part('template-parts/content', 'nav-product');
    endif; ?>



    <!-- Destination Secondary Nav -->
    <?php
    if (is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-cruise.php') || is_page_template('template-destinations-region.php')) :
        get_template_part('template-parts/content', 'nav-destination');
    endif; ?>

</header>