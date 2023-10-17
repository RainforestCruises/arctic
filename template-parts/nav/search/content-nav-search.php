<!-- Nav Search CTA -->
<div class="nav-search-cta" id="nav-cta">
    <div class="nav-search-cta__mobile-icon">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
        </svg>
    </div>
    <div class="nav-search-cta__input">
        <div class="nav-search-cta__input__desktop">
            <div class="nav-search-cta__input__desktop__search">
                Explore Travel
            </div>
            <div class="nav-search-cta__input__desktop__dates">
                Dates
            </div>
        </div>
        <div class="nav-search-cta__input__mobile">
            Explore
        </div>
    </div>
    <div class="nav-search-cta__button">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
        </svg>
    </div>
</div>


<!-- Nav Search Control -->
<div class="nav-search-control" id="nav-control">
    <!-- Control Search -->
    <div class="nav-search-control__input-area nav-search-control__input-area--search inactive" id="nav-control-search">
        <span class="label-span">
            Explore
        </span>
        <input type="text" id="nav-control-search-input">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <button class="nav-control-clear-button" id="nav-control-clear-button">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-cross"></use>
            </svg>
        </button>
    </div>

    <!-- Control Dates -->
    <div class="nav-search-control__input-area nav-search-control__input-area--dates active " id="nav-control-dates">
        Dates
    </div>

    <!--  Button -->
    <div class="nav-search-control__button-area">
        <button class="nav-search-cta__button" id="nav-control-submit-button">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
            </svg>
        </button>
    </div>
</div>





<!-- Search Menu (Initial and Dynamic Response)-->
<?php get_template_part('template-parts/nav/search/content', 'nav-search-menu'); ?>


<!-- Dates Menu-->
<?php get_template_part('template-parts/nav/search/content', 'nav-dates-menu'); ?>


<!-- Hidden Form -->
<form class="search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="nav-search-form">
    <input type="hidden" name="action" value="navSearch">
    <input type="hidden" name="formSearchInput" id="formSearchInput" value="<?php echo $searchInput ?>">
</form>