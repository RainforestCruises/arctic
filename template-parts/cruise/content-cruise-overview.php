<?php
$productName = $args['productName'];
$initialRegion = $args['initialRegion'];

$amenities = get_field('amenities');

$max_items = 6;
$firstAmenities = array_slice($amenities, 0, $max_items);
$expandItems = count($amenities) > $max_items ? true : false;

$overview_content = get_field('overview_content');
$deck_plans = get_field('deck_plans');

$max_length = 1500;
$expand = strlen($overview_content) > $max_length ? true : false;
$overview_content_limited = substr($overview_content, 0, $max_length);
if($expand){
    $overview_content_limited .= '...';
}


$vessel_capacity = get_field('vessel_capacity');
$vessel_capacity_antarctica = get_field('vessel_capacity_antarctica');
$vessel_capacity_fly = get_field('vessel_capacity_fly');


$vessel_capacity_display = $vessel_capacity;
if ($vessel_capacity_antarctica != "" && $vessel_capacity_antarctica != $vessel_capacity) {
    $vessel_capacity_display .= ' (' . $vessel_capacity_antarctica . ' in Antarctica)';
}

if ($vessel_capacity_fly != "" && $vessel_capacity_fly != $vessel_capacity) {
    $vessel_capacity_display .= ' (' . $vessel_capacity_fly . ' on Fly Cruises)';
}


?>

<!-- Cruise Overview (highlights) -->
<section class="product-overview" id="highlights">

    <div class="product-overview__content">

        <!-- Grid  -->
        <div class="product-overview__content__grid">

            <!-- Main Overview (Highlights, Transport, Text) -->
            <div class="product-overview__content__grid__overview">

                <!-- Highlights -->
                <div class="product-overview__content__grid__overview__highlights">
                    <h2 class="title-single">Highlights</h2>
                    <ul class="highlight-list">
                        <?php if (have_rows('highlights')) : ?>
                            <?php while (have_rows('highlights')) : the_row(); ?>
                                <li>
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-diamonds-suits"></use>
                                    </svg>
                                    <?php echo get_sub_field('highlight'); ?>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Text -->
                <div class="product-overview__content__grid__overview__text ">
                    <?php echo $overview_content_limited; ?>
                </div>

                <div class="product-overview__content__grid__overview__expand">
                    <?php if ($expand) : ?>
                        <button class="btn-text" id="expand-content">
                            Read More
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>


            <!-- Side Section -->
            <div class="product-overview__content__grid__secondary">

                <!-- Specs Panel -->
                <div class="outline-panel">

                    <!-- Panel Heading -->
                    <div class="outline-panel__heading">
                        <h2 class="outline-panel__heading__text">
                            Specifications
                        </h2>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                        </svg>
                    </div>

                    <!-- Panel Content -->
                    <div class="outline-panel__content">

                        <!-- Specs Grid -->
                        <ul class="specs">

                            <!-- Guests -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Guests
                                </div>
                                <div class="specs__item__text">
                                    <?php echo $vessel_capacity_display ?>
                                </div>
                            </li>

                            <!-- Crew -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Staff & Crew
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('crew') ?>
                                </div>
                            </li>

                            <!-- Guest to Crew Ratio -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Guide & Crew to Guest Ratios
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('guest_to_crew_ratio') ?>
                                </div>
                            </li>

                            <!-- Guest to Space Ratio -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Guest to Space Ratio
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('guest_to_space_ratio') ?>
                                </div>
                            </li>

                            <!-- Number of Decks -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Number of Decks
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('number_of_decks') ?>
                                </div>
                            </li>

                            <!-- Number of Cabins -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Number of Cabins
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('number_of_cabins') ?>
                                </div>
                            </li>

                            <!-- Zodiacs -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Zodiacs & Loading Bays
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('zodiacs') ?>
                                </div>
                            </li>

                            <!-- Year Built -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Year Built
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('year_built') ?>
                                </div>
                            </li>

                            <!-- Ice Class -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Ice Class
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('ice_class') ?>
                                </div>
                            </li>

                            <!-- Length -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Length
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('length') ?>
                                </div>
                            </li>

                            <!-- Beam -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Beam
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('breadth') ?>
                                </div>
                            </li>

                            <!-- Draft -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Draft
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('draft') ?>
                                </div>
                            </li>

                            <!-- Speed -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Cruising Speed
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('speed') ?>
                                </div>
                            </li>

                            <!-- Stabilizers -->
                            <li class="specs__item">
                                <div class="specs__item__title">
                                    Stabilizers
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('stabilizers') ?>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

                <!-- Amenities Panel -->
                <div class="outline-panel">

                    <!-- Panel Heading -->
                    <div class="outline-panel__heading">
                        <h2 class="outline-panel__heading__text">
                            Amenities
                        </h2>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                        </svg>
                    </div>

                    <!-- Panel Content -->
                    <div class="outline-panel__content">
                        <div class="product-overview__content__grid__secondary__items">
                            <?php foreach ($firstAmenities as $a) :
                                $amenity_post = $a['standard_amenity'];
                                $icon = get_field('icon', $amenity_post);
                                $title = $a['title_override'] == "" ? get_the_title($amenity_post) : $a['title_override'];
                                $subtitle = $a['subtitle'];
                            ?>

                                <div class="icon-item">
                                    <?php echo $icon ?>

                                    <div class="icon-item__title-group">
                                        <div class="icon-item__title-group__title">
                                            <?php echo $title ?>
                                        </div>
                                        <?php if ($subtitle != "") : ?>
                                            <div class="icon-item__title-group__sub">
                                                <?php echo $subtitle ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>
                        <div class="outline-panel__content__expand">
                            <?php if ($expandItems) : ?>
                                <button class="btn-text" id="expand-items">
                                    View All <?php echo count($amenities); ?> Amenities
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <!-- CTA / Deckplan -->
                <div class="product-overview__content__grid__secondary__cta">

                    <?php if ($deck_plans) : ?>
                        <button class="btn-primary btn-primary--inverse-outline" id="deckplan-button">
                            View Deckplans
                        </button>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- Content Modal -->
<div class="modal" id="contentModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <h2 class="modal__content__top__nav__title">
                    About the <?php echo $productName; ?>
                </h2>
            </div>
            <button class="btn-text btn-text--bg close-modal-button">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main" id="contentModalMain">
            <?php echo $overview_content; ?>
        </div>
    </div>
</div>


<!-- Items Modal -->
<div class="modal" id="itemsModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    <?php echo $productName; ?> Amenities
                </div>
            </div>
            <button class="btn-text btn-text--bg close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main">
            <?php foreach ($amenities as $a) :
                $amenity_post = $a['standard_amenity'];
                $icon = get_field('icon', $amenity_post);
                $title = $a['title_override'] == "" ? get_the_title($amenity_post) : $a['title_override'];
                $subtitle = $a['subtitle'];
            ?>

                <div class="icon-item icon-item--full">
                    <?php echo $icon ?>

                    <div class="icon-item__title-group">
                        <div class="icon-item__title-group__title">
                            <?php echo $title ?>
                        </div>
                        <?php if ($subtitle != "") : ?>
                            <div class="icon-item__title-group__sub">
                                <?php echo $subtitle ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>