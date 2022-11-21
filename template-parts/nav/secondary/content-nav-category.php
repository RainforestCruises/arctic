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