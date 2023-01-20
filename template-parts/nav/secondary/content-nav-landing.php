<?php
$title = get_the_title();
?>

<nav class="nav-secondary">
    <div class="nav-secondary__content">
        <div class="nav-secondary__content__title">
            <a href="#section-top" class="nav-secondary__content__title__link">
                <?php echo $title; ?>
            </a>
        </div>
        <div class="nav-secondary__content__links">
            <a href="#section-ships" class="nav-secondary__content__links__link">
                Ships
            </a>
            <a href="#section-itineraries" class="nav-secondary__content__links__link">
                Itineraries
            </a>
            <a href="#section-guide" class="nav-secondary__content__links__link">
                Travel Guide
            </a>
            <a href="#section-faq" class="nav-secondary__content__links__link">
                FAQ
            </a>
        </div>
        <div class="nav-secondary__content__cta ">
            <button class="nav-secondary__content__cta__button btn-pill btn-pill--dark generic-inquire-cta">
                Inquire
            </button>
        </div>
    </div>
</nav>


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
            <a href="#section-ships" class="nav-secondary__content__links__link">
                Ships
            </a>
            <a href="#section-itineraries" class="nav-secondary__content__links__link">
                Itineraries
            </a>
            <a href="#section-guide" class="nav-secondary__content__links__link">
                Travel Guide
            </a>
            <a href="#section-faq" class="nav-secondary__content__links__link">
                FAQ
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
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-ships">Ships</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-itineraries">Itineraries</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-guide">Travel Guide</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-faq">FAQ</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link cta-link generic-inquire-cta">
                    Inquire
                </a>
            </li>
        </ul>
    </nav>
</nav>