<?php
$destinations = get_field('destinations', 'options');
?>

<!-- Nav Search Element -->
<div class="nav-search">
    <div class="nav-search__inputs">

        <!-- Destination -->
        <div class="nav-search__inputs__item" id="destination-input-container">
            Where
        </div>
        <!-- Dates -->
        <div class="nav-search__inputs__item">
            When
        </div>
        <!-- Style -->
        <div class="nav-search__inputs__item">
            Style
        </div>
    </div>
    <div class="nav-search__cta">

        <button class="nav-search__cta__button" type="submit" form="nav-search-form">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
            </svg>
        </button>

    </div>
</div>


<div class="nav-search-control">
    <div class="nav-search-control__inputs">

        <!-- Destination -->
        <div class="nav-search-control__inputs__item" id="destination-input-container">
            Where

        </div>

        <!-- Dates -->
        <div class="nav-search-control__inputs__item">
            When
        </div>
        <!-- Style -->
        <div class="nav-search-control__inputs__item">
            Style
        </div>
    </div>
    <div class="nav-search-control__cta">

        <button class="nav-search-control__cta__button" type="submit" form="nav-search-form">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
            </svg>
        </button>

    </div>
</div>