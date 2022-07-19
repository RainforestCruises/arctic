<?php
$productTitle = get_the_title();

?>

<nav class="nav-secondary" id="nav-secondary">
    <div class="nav-secondary__main">
        <div class="nav-secondary__main__title-area">
            <a class="nav-secondary__main__title-area__title" id="nav-secondary-title" href="#top">
                <?php echo $productTitle ?>
            </a>
            <button class="nav-secondary__main__title-area__button" id="nav-secondary-button">
                <div class="nav-secondary__main__title-area__button__icon-area">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                    </svg>
                </div>
                <div class="nav-secondary__main__title-area__button__text-area">
                    <?php echo $productTitle ?>
                </div>

            </button>

        </div>
        <ul class="nav-secondary__main__links">
            <li>
                <a href="#overview">Overview</a>
            </li>
            <li>
                <a href="#amenities">Amenities</a>
            </li>
            <li>
                <a href="#itineraries">Itineraries</a>
            </li>
            <li>
                <a href="#extras">Extras</a>
            </li>
            <li>
                <a href="#reviews">Reviews</a>
            </li>
        </ul>
        <div class="nav-secondary__main__cta">
            <button class="btn-cta-round btn-cta-round--small" id="nav-secondary-cta">
                Inquire
            </button>
        </div>
    </div>
</nav>



<!--mobile menu expand-->
<nav class="nav-secondary-mobile ">
    <ul class="nav-secondary-mobile__list">
        <li class="nav-secondary-mobile__list__item">
            <a class="nav-secondary-mobile__list__item__link" href="#overview">Overview</a>
        </li>
        <li class="nav-secondary-mobile__list__item">
            <a class="nav-secondary-mobile__list__item__link" href="#amenities">Amenities</a>
        </li>
        <li class="nav-secondary-mobile__list__item">
            <a class="nav-secondary-mobile__list__item__link" href="#itineraries">Itineraries</a>
        </li>
        <li class="nav-secondary-mobile__list__item">
            <a class="nav-secondary-mobile__list__item__link" href="#extras">Extras</a>
        </li>
        <li class="nav-secondary-mobile__list__item">
            <a class="nav-secondary-mobile__list__item__link" href="#reviews">Reviews</a>
        </li>
    </ul>
</nav>