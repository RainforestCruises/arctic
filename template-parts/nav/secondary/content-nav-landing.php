<?php
$title = get_the_title();
$show_faq = get_field('show_faq');
$show_topics = get_field('show_topics');
$show_map = get_field('show_map');

?>




<!-- Cruise Nav -->
<nav class="nav-secondary">

    <!-- desktop content -->
    <div class="nav-secondary__content">
        <div class="nav-secondary__content__title-area">
            <a href="#section-top" class="nav-secondary__content__title-area__link">
                <?php echo $title; ?>
            </a>
        </div>
        <div class="nav-secondary__content__links">
            <a href="#section-itineraries" class="nav-secondary__content__links__link">
                Itineraries
            </a>
            <?php if ($show_topics) : ?>
                <a href="#section-about" class="nav-secondary__content__links__link">
                    About
                </a>
            <?php endif; ?>
            <?php if ($show_map) : ?>
                <a href="#section-map" class="nav-secondary__content__links__link">
                    Map
                </a>
            <?php endif; ?>
            <?php if ($show_faq) : ?>
                <a href="#section-faq" class="nav-secondary__content__links__link">
                    FAQ
                </a>
            <?php endif; ?>
            <a href="#section-ships" class="nav-secondary__content__links__link">
                Ships
            </a>
            <a href="#section-guide" class="nav-secondary__content__links__link">
                Travel Guide
            </a>

        </div>
        <div class="nav-secondary__content__cta product-template">
            <button class="nav-secondary__content__cta__button btn-pill btn-pill--dark generic-inquire-cta">
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
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-itineraries">Itineraries</a>
            </li>
            <?php if ($show_topics) : ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a class="nav-secondary__mobile-menu__list__item__link" href="#section-about">About</a>
                </li>
            <?php endif; ?>
            <?php if ($show_map) : ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a class="nav-secondary__mobile-menu__list__item__link" href="#section-map">Map</a>
                </li>
            <?php endif; ?>
            <?php if ($show_faq) : ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a class="nav-secondary__mobile-menu__list__item__link" href="#section-faq">FAQ</a>
                </li>
            <?php endif; ?>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-ships">Ships</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-guide">Travel Guide</a>
            </li>
        </ul>
    </nav>
</nav>