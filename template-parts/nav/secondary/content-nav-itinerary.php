<?php
$title = get_field('display_name');
$itinerary = get_post();
$departures = getDepartureList($itinerary);
$deals = getDepartureListDeals($departures);
?>

<!-- Itinerary Nav -->
<nav class="nav-secondary small-width">

    <!-- desktop content -->
    <div class="nav-secondary__content">
        <div class="nav-secondary__content__title-area">
            <a href="#section-top" class="nav-secondary__content__title-area__link">
                <?php echo $title; ?>
            </a>
        </div>
        <div class="nav-secondary__content__links">
            <a href="#section-highlights" class="nav-secondary__content__links__link">
                Highlights
            </a>
            <a href="#section-itinerary" class="nav-secondary__content__links__link">
                Itinerary
            </a>
            <a href="#section-map" class="nav-secondary__content__links__link">
                Map
            </a>
            <a href="#section-dates" class="nav-secondary__content__links__link">
                Dates
            </a>
            <a href="#section-extras" class="nav-secondary__content__links__link">
                Extras
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
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-highlights">Highlights</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-itinerary">Itinerary</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-map">Map</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-dates">Dates
                    <?php if ($deals) : ?>
                        <span class="specs-deal" style="margin-left: 2rem;"><?php getDealsDisplay($deals); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-extras">Extras</a>
            </li>
        </ul>
    </nav>
</nav>