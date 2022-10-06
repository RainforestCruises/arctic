<?php
$title = get_the_title();
?>

<nav class="nav-secondary">
    <div class="nav-secondary__content">
        <div class="nav-secondary__content__title">
            <button class="nav-secondary__content__title__button btn-pill">
                <?php echo $title; ?>
            </button>
        </div>
        <div class="nav-secondary__content__buttons">
            <button class="nav-secondary__content__buttons__button btn-pill">
                Cabins
            </button>
            <button class="nav-secondary__content__buttons__button btn-pill">
                Itineraries
            </button>
            <button class="nav-secondary__content__buttons__button btn-pill">
                Dates
            </button>
            <button class="nav-secondary__content__buttons__button btn-pill">
                Reviews
            </button>
        </div>
        <div class="nav-secondary__content__cta">
            <button class="nav-secondary__content__cta__button btn-pill btn-pill--dark inquire-cta" tab-panel="inquire">
                Inquire
            </button>
        </div>
    </div>
</nav>