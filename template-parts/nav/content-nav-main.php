<?php

$show_translate_nav = get_field('show_translate_nav', 'options');
$destinations = get_field('destinations', 'options');



$alwaysActiveHeader = checkActiveHeader();
$headerClasses = renderHeaderClasses();


?>



<!-- Desktop Header -->
<!-- Header -->
<header class="header <?php echo $headerClasses; ?>" id="header">

    <!-- Top Level Nav -->
    <div class="header__main <?php echo ($alwaysActiveHeader == true) ? 'active' : ''; ?>">

        <div class="header__main__content">
            <!-- Logo -->
            <div class="header__main__content__logo-area">
                <a href="<?php echo get_home_url(); ?>" class="header__main__content__logo-area__logo">
                    <?php
                    $logo = get_theme_mod('custom_logo');
                    $image = wp_get_attachment_image_src($logo, 'full');
                    $image_url = $image[0];
                    ?>
                    <img src="<?php echo $image_url ?>" alt="<?php echo get_bloginfo('name') ?>" />
                </a>
            </div>
            <div class="header__main__content__search">

                <!-- Search Element -->
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

            <!-- Main Nav -->
            <nav class="header__main__content__nav">

                <ul class="header__main__content__nav__list">
                    <li class="header__main__content__nav__list__item">
                        <span class="header__main__content__nav__list__item__link" navelement="destinations">Destinations</span>
                    </li>
                    <li class="header__main__content__nav__list__item">
                        <span class="header__main__content__nav__list__item__link" navelement="ships">Ships</span>
                    </li>
                    <li class="header__main__content__nav__list__item">
                        <span class="header__main__content__nav__list__item__link" navelement="guides">Guides</span>
                    </li>
                </ul>
                <div class="header__main__content__nav__mega">
                    <div class="header__main__content__nav__mega__panel" panel="destinations">
                        <?php foreach ($destinations as $d) :
                            $image =  get_field('feature_image', $d);
                            $title =  get_field('navigation_title', $d);
                        ?>
                            <div class="destination-nav-item">
                                <div class="destination-nav-item__image-area">
                                    <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                </div>
                                <div class="destination-nav-item__title">
                                    <?php echo $title ?>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                    <div class="header__main__content__nav__mega__panel" panel="ships">
                        Ships
                    </div>
                </div>


            </nav>




            <!-- Right Side -->
            <div class="header__main__content__right">

                <!-- Contact Mail -->
                <a href="<?php echo get_home_url(); ?>/contact" class="header__main__content__right__contact-link">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
                    </svg>

                </a>
                <!-- Contact Phone -->
                <div class="header__main__content__right__phone-desktop divider-left">
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
                    <div class="header__main__content__right__language divider-left">
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






    <!-- Itinerary Nav -->
    <?php if (get_post_type() == 'rfc_itineraries') :
        get_template_part('template-parts/nav/content', 'nav-itinerary');
    endif; ?>

    <!-- Destination Nav -->
    <?php
    if (is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-cruise.php') || is_page_template('template-destinations-region.php')) :
        get_template_part('template-parts/nav/content', 'nav-destination');
    endif; ?>

</header>

<!-- Cruise Nav -->
<?php if (get_post_type() == 'rfc_cruises') :
    get_template_part('template-parts/nav/content', 'nav-cruise');
endif; ?>