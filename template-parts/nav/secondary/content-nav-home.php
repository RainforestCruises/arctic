<?php
$region = get_field('region');
$title = $region ? get_field('navigation_title', $region) : "Antarctica Cruises";
$show_route = get_field('show_route');

?>




<!-- Cruise Nav -->
<nav class="nav-secondary">

    <!-- desktop content -->
    <div class="nav-secondary__content">
        <div class="nav-secondary__content__title-area">
            <a href="#top" class="nav-secondary__content__title-area__link">
                <?php echo $title; ?>
            </a>
        </div>
        <div class="nav-secondary__content__links">

            <?php if ($show_route) : ?>
                <a href="#routes" class="nav-secondary__content__links__link">
                    Routes
                </a>
            <?php endif; ?>

            <a href="#cruises" class="nav-secondary__content__links__link">
                Cruises
            </a>
            <?php if ($region) : ?>
                <a href="#styles" class="nav-secondary__content__links__link">
                    Themes
                </a>
            <?php endif; ?>
            <a href="#quote" class="nav-secondary__content__links__link">
                Experience
            </a>
            <a href="#ships" class="nav-secondary__content__links__link">
                Ships
            </a>

            <a href="#guide" class="nav-secondary__content__links__link">
                Guide
            </a>

        </div>
        <div class="nav-secondary__content__cta product-template">
            <button class="nav-secondary__content__cta__button btn-pill btn-pill--inverse generic-inquire-cta">
                Inquire
            </button>
        </div>
    </div>

    <!-- mobile content (button) -->
    <div class="nav-secondary__content-mobile">
        <div class="nav-secondary__content-mobile__title">
            <?php echo $title ?>
        </div>
        <div class="nav-secondary__content-mobile__icon">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
            </svg>
        </div>
    </div>

    <!--mobile menu expand-->
    <nav class="nav-secondary__mobile-menu">
        <ul class="nav-secondary__mobile-menu__list">


            <?php if ($show_route) : ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a class="nav-secondary__mobile-menu__list__item__link" href="#routes">Routes</a>
                </li>
            <?php endif; ?>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#cruises">Cruises</a>
            </li>
            <?php if ($region) : ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a class="nav-secondary__mobile-menu__list__item__link" href="#styles">Themes</a>
                </li>
            <?php endif; ?>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#quote">Experience</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#ships">Ships</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#guide">Guide</a>
            </li>
        </ul>
    </nav>
</nav>