<?php
$inclusions = get_field('inclusions');
$exclusions = get_field('exclusions');

?>

<!-- Inclusions -->
<section class="grid-block narrow" id="section-inclusions">
    <div class="grid-block__content  block-top-divider">

        <div class="grid-block__content__top">
            <h2 class="title-single">
                What's Included
            </h2>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid1">

            <!-- Inclusions List -->
            <ul class="itinerary-inclusions">
                <?php foreach ($inclusions as $inclusion) : ?>
                    <li class="itinerary-inclusions__item">
                        <div class="itinerary-inclusions__item__content">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <?php echo $inclusion['item'] ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<!-- Exclusions -->
<section class="grid-block narrow" id="section-inclusions">
    <div class="grid-block__content  block-top-divider">

        <div class="grid-block__content__top">
            <div class="title-single">
                What's Excluded
            </div>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid1">

            <!-- Exclusions List -->
            <ul class="itinerary-inclusions">
                <?php foreach ($exclusions as $exclusion) : ?>
                    <li class="itinerary-inclusions__item">
                        <div class="itinerary-inclusions__item__content">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                            </svg>
                            <?php echo $exclusion['item'] ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>