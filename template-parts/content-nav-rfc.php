<?php
$menu_name = 'main_menu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);
$menuitems = wp_get_nav_menu_items($menu->term_id);
$show_translate_nav = get_field('show_translate_nav', 'options');

$menu_toplevel = [];
$menu_destination_groups = [];
$menu_experiences = [];

$alwaysActiveHeader = checkActiveHeader(); //return true/false depending on if current template header bar should never be transparent

foreach ($menuitems as $m) {

    //Top Level
    if ($m->menu_item_parent == 0) {
        $menu_toplevel[] = $m;


        //Destinations
        if ($m->post_name == "destinations") {
            //$menu_toplevel[] = $m;

            $toplevel_ID = $m->ID;
            foreach ($menuitems as $mm) {

                $destinationGroup_ID = $mm->ID;
                if ($mm->menu_item_parent == $toplevel_ID) {


                    //loop again to get this destination group
                    $destinations = [];
                    foreach ($menuitems as $mmm) {
                        if ($mmm->menu_item_parent == $destinationGroup_ID) {
                            $destination = array(
                                'id' => $mmm->ID,
                                'title' => $mmm->title,
                                'url' => $mmm->url,

                            );

                            $destinations[] = $destination;
                        }
                    }

                    $destinationGroup = array(
                        'id' => $mm->ID,
                        'title' => $mm->title,
                        'url' => $mm->url,
                        'destinations' => $destinations,
                        'parentId' => $toplevel_ID,

                    );

                    $menu_destination_groups[] = $destinationGroup;
                }
            }
        } else if ($m->post_name == "experiences") {

            $toplevel_ID = $m->ID;
            foreach ($menuitems as $mm) {
                if ($mm->menu_item_parent == $toplevel_ID) {


                    $experience = array(
                        'id' => $mm->ID,
                        'title' => $mm->title,
                        'url' => $mm->url
                    );

                    $menu_experiences[] = $experience;
                }
            }
        }
    }
}
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
                <?php foreach ($menu_destination_groups as $destination_group) : ?>
                    <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="<?php echo $destination_group['id'] ?>">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                        </svg>
                        <span>
                            <?php echo $destination_group['title'] ?>
                        </span>

                    </a>
                <?php endforeach; ?>
            <?php endif ?>

            <?php if ($toplevelItem->title == 'Experiences') : ?>
                <?php foreach ($menu_experiences as $experience) : ?>
                    <a href="<?php echo $experience['url'] ?>" class="nav-mobile__content-panel__button mobile-link">
                        <?php echo $experience['title'] ?>
                    </a>
                <?php endforeach; ?>
            <?php endif ?>

        </div>
    <?php endforeach; ?>

    <!-- Level 3 -->
    <?php foreach ($menu_destination_groups as $destination_group) : ?>
        <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuId="<?php echo $destination_group['id'] ?>">
            <a class="nav-mobile__content-panel__button back-link" menuLinkTo="<?php echo $destination_group['parentId'] ?>">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                </svg>
                <span>
                    Back
                </span>

            </a>

            <!-- Cruises -->


            <?php $destinationsMenuArray = $destination_group['destinations']; ?>
            <?php foreach ($destinationsMenuArray as $destinationMenuItem) : ?>
                <a href="<?php echo $destinationMenuItem['url'] ?>" class="nav-mobile__content-panel__button mobile-link"><?php echo $destinationMenuItem['title'] ?></a>
            <?php endforeach; ?>
            <a href="<?php echo $destination_group['url'] ?>" class="nav-mobile__content-panel__button mobile-link divider">

                View All

            </a>
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
                <?php
                foreach ($menu_toplevel as $toplevelItem) :
                    $megaClass = ($toplevelItem->title == 'Destinations' || $toplevelItem->title == 'Experiences') ? 'mega' : 'no-mega';
                ?>
                    <li class="header__main__nav__list__item">
                        <?php if ($toplevelItem->object != 'page') : ?>
                            <span class="header__main__nav__list__item__link <?php echo $megaClass ?>" navelement="<?php echo $toplevelItem->title ?>"><?php echo $toplevelItem->title ?></span>
                        <?php else : ?>
                            <a class="header__main__nav__list__item__link <?php echo $megaClass ?>" href="<?php echo $toplevelItem->url ?>" navelement="<?php echo $toplevelItem->title ?>"><?php echo $toplevelItem->title ?></a>
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
        <div class="nav-mega__nav nav-mega__nav--destinations">
            <?php foreach ($menu_destination_groups as $destination_group) : ?>
                <div class="nav-mega__nav__sub-group">
                    <a class="nav-mega__nav__sub-group__title" href="<?php echo $destination_group['url'] ?>"><?php echo $destination_group['title'] ?></a>
                    <ul class="nav-mega__nav__sub-group__list">
                        <?php $destinationsArray = $destination_group['destinations']; ?>
                        <?php foreach ($destinationsArray as $destinationMenuItem) : ?>
                            <li class="nav-mega__nav__sub-group__item">
                                <a href="<?php echo $destinationMenuItem['url'] ?>" class="nav-mega__nav__sub-group__link"><?php echo $destinationMenuItem['title'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="nav-mega__nav nav-mega__nav--experiences">
            <?php foreach ($menu_experiences as $experiencesItem) : ?>
                <a href="<?php echo $experiencesItem['url'] ?>" class="nav-mega__nav__link"><?php echo $experiencesItem['title'] ?></a>
            <?php endforeach; ?>
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