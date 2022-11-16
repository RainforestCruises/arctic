<?php
$title = get_field('display_name');
?>

<!-- Itinerary Nav -->
<nav class="nav-secondary small-width">
    <div class="nav-secondary__content">
        <div class="nav-secondary__content__title">
            <a href="#section-top" class="nav-secondary__content__title__link">
                <?php echo $title; ?>
            </a>
        </div>
        <div class="nav-secondary__content__links">

            <a href="#section-itinerary" class="nav-secondary__content__links__link">
                Itinerary
            </a>
            <a href="#section-map" class="nav-secondary__content__links__link">
                Map
            </a>
            <a href="#section-dates" class="nav-secondary__content__links__link">
                Dates
            </a>       
        </div>
        <div class="nav-secondary__content__cta">
            <button class="nav-secondary__content__cta__button btn-pill btn-pill--dark generic-inquire-cta">
                Inquire
            </button>
        </div>
    </div>
</nav>