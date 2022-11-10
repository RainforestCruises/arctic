<?php
$title = get_field('display_name');
?>

<nav class="nav-secondary">
    <div class="nav-secondary__content">
        <div class="nav-secondary__content__title">
            <a href="#section-top" class="nav-secondary__content__title__link">
                <?php echo $title; ?>
            </a>
        </div>
        <div class="nav-secondary__content__links">
            <a href="#section-itineraries" class="nav-secondary__content__links__link">
                Itinerary
            </a>
            <a href="#section-dates" class="nav-secondary__content__links__link">
                Dates
            </a>
            <a href="#section-services" class="nav-secondary__content__links__link">
                Services
            </a>
            <a href="#section-reviews" class="nav-secondary__content__links__link">
                Reviews
            </a>
        </div>
        <div class="nav-secondary__content__cta">
            <button class="nav-secondary__content__cta__button btn-pill btn-pill--dark generic-inquire-cta">
                Inquire
            </button>
        </div>
    </div>
</nav>