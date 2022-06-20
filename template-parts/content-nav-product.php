<?php
$productTitle = "";
$showOverview = true; //always true for Cruise / Lodge -- optional for Tour

if (get_post_type() == 'rfc_tours') :
    $productTitle = get_field('tour_name');
    $showOverview  = get_field('show_overview');
else :
    $productTitle = get_the_title();
endif;
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
            <?php if ($showOverview) : ?>
                <li>
                    <a href="#overview">Overview</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="#itineraries"><?php echo (get_post_type() != 'rfc_tours') ? ('Itineraries & Prices') : ('Itinerary & Prices'); ?></a>
            </li>
            <li>
                <a href="#accommodations">Accommodations</a>
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
        <?php if ($showOverview) : ?>
            <li class="nav-secondary-mobile__list__item">
                <a class="nav-secondary-mobile__list__item__link" href="#overview">Overview</a>
            </li>
        <?php endif; ?>
        <li class="nav-secondary-mobile__list__item">
            <a class="nav-secondary-mobile__list__item__link" href="#itineraries"><?php echo (get_post_type() != 'rfc_tours') ? ('Itineraries & Prices') : ('Itinerary & Prices'); ?></a>
        </li>
        <li class="nav-secondary-mobile__list__item">
            <a class="nav-secondary-mobile__list__item__link" href="#accommodations">Accommodations</a>
        </li>
    </ul>
</nav>