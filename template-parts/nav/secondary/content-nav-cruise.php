<?php
$title = get_the_title();
$ship = get_post();
$departures = getDepartureList($ship);
$deals = getDealsFromDepartureList($departures);
$reviews = get_field('reviews');

?>
<!-- Cruise Nav -->
<nav class="nav-secondary small-width">

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
            <a href="#cabins" class="nav-secondary__content__links__link">
                Cabins
            </a>
            <a href="#itineraries" class="nav-secondary__content__links__link">
                Itineraries
            </a>
            <a href="#dates" class="nav-secondary__content__links__link">
                Dates
            </a>
            <?php if ($reviews) : ?>
                <a href="#reviews" class="nav-secondary__content__links__link">
                    Reviews
                </a>
            <?php endif; ?>
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
                <a class="nav-secondary__mobile-menu__list__item__link" href="#highlights">Highlights</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#cabins">Cabins</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#itineraries">Itineraries</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#dates">Dates
                    <?php if ($deals) : ?>
                        <span class="specs-deal" style="margin-left: 2rem;"><?php echo getDealsDisplay($deals); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <?php if ($reviews) : ?>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#reviews">Reviews</a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</nav>