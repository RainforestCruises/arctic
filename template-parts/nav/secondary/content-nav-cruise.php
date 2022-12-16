<?php
$title = get_the_title();
?>
<!-- Cruise Nav -->
<nav class="nav-secondary small-width">

    <!-- desktop content -->
    <div class="nav-secondary__content">
        <div class="nav-secondary__content__title-area">
            <a href="#section-top" class="nav-secondary__content__title-area__link">
                <?php echo $title; ?>
            </a>
        </div>
        <div class="nav-secondary__content__links">
            <a href="#section-cabins" class="nav-secondary__content__links__link">
                Cabins
            </a>
            <a href="#section-itineraries" class="nav-secondary__content__links__link">
                Itineraries
            </a>
            <a href="#section-dates" class="nav-secondary__content__links__link">
                Dates
            </a>
            <a href="#section-reviews" class="nav-secondary__content__links__link">
                Reviews
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
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-cabins">Cabins</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-itineraries">Itineraries</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-dates">Dates</a>
            </li>
            <li class="nav-secondary__mobile-menu__list__item">
                <a class="nav-secondary__mobile-menu__list__item__link" href="#section-reviews">Reviews</a>
            </li>
        </ul>
    </nav>
</nav>