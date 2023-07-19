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
            <a href="#top" class="nav-secondary__content__title-area__link">
                <?php echo $title; ?>
            </a>
        </div>
        <div class="nav-secondary__content__links">
            <a href="#highlights" class="nav-secondary__content__links__link">
                Highlights
            </a>
            <a href="#itineraries" class="nav-secondary__content__links__link">
                Itineraries
            </a>
            <?php if ($show_topics) : ?>
                <a href="#about" class="nav-secondary__content__links__link">
                    About
                </a>
            <?php endif; ?>
            <?php if ($show_map) : ?>
                <a href="#map" class="nav-secondary__content__links__link">
                    Map
                </a>
            <?php endif; ?>
            <?php if ($show_faq) : ?>
                <a href="#faq" class="nav-secondary__content__links__link">
                    FAQ
                </a>
            <?php endif; ?>
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
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#highlights">Highlights</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#itineraries">Itineraries</a>
            </li>
            <?php if ($show_topics) : ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a class="nav-secondary__mobile-menu__list__item__link" href="#about">About</a>
                </li>
            <?php endif; ?>
            <?php if ($show_map) : ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a class="nav-secondary__mobile-menu__list__item__link" href="#map">Map</a>
                </li>
            <?php endif; ?>
            <?php if ($show_faq) : ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a class="nav-secondary__mobile-menu__list__item__link" href="#faq">FAQ</a>
                </li>
            <?php endif; ?>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#ships">Ships</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#guide">Guide</a>
            </li>
        </ul>
    </nav>
</nav>