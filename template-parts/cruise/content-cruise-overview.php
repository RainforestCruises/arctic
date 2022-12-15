<?php
$productName = $args['productName'];
$deck_plans = get_field('deck_plans');
$amenities = get_field('amenities');
$overview_content = get_field('overview_content');

$expand = strlen($overview_content) > 950 ? true : false;
$overview_content_limited = substr($overview_content, 0, 950) . '...';

?>

<!-- Cruise Overview -->
<section class="product-overview" id="overview">

    <div class="product-overview__content">

        <!-- Grid  -->
        <div class="product-overview__content__grid">

            <!-- Main Overview (Highlights, Transport, Text) -->
            <div class="product-overview__content__grid__overview">

                <!-- Highlights -->
                <div class="product-overview__content__grid__overview__highlights">
                    <h3 class="title-single">Highlights</h3>
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
                        <button class="btn-text-icon" id="expand-content">
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
                        <h5 class="outline-panel__heading__text">
                            Specifications
                        </h5>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                        </svg>
                    </div>

                    <!-- Panel Content -->
                    <div class="outline-panel__content">

                        <!-- Specs Grid -->
                        <div class="specs">

                            <!-- Guests -->
                            <div class="specs__item">
                                <div class="specs__item__title">
                                    Guests
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('vessel_capacity') ?>
                                </div>
                            </div>

                            <!-- Crew -->
                            <div class="specs__item">
                                <div class="specs__item__title">
                                    Staff & Crew
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('crew') ?>
                                </div>
                            </div>

                            <!-- Zodiacs -->
                            <div class="specs__item">
                                <div class="specs__item__title">
                                    Zodiacs
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('zodiacs') ?>
                                </div>
                            </div>

                            <!-- Year Built -->
                            <div class="specs__item">
                                <div class="specs__item__title">
                                    Year Built
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('year_built') ?>
                                </div>
                            </div>

                            <!-- Ice Class -->
                            <div class="specs__item">
                                <div class="specs__item__title">
                                    Ice Class
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('ice_class') ?>
                                </div>
                            </div>

                            <!-- Length -->
                            <div class="specs__item">
                                <div class="specs__item__title">
                                    Length
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('length') ?>
                                </div>
                            </div>

                            <!-- Breadth -->
                            <div class="specs__item">
                                <div class="specs__item__title">
                                    Breadth
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('breadth') ?>
                                </div>
                            </div>

                            <!-- Draft -->
                            <div class="specs__item">
                                <div class="specs__item__title">
                                    Draft
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('draft') ?>
                                </div>
                            </div>

                            <!-- Speed -->
                            <div class="specs__item">
                                <div class="specs__item__title">
                                    Cruising Speed
                                </div>
                                <div class="specs__item__text">
                                    <?php echo get_field('speed') ?>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>

                <!-- Amenities Panel -->
                <div class="outline-panel">
                    <!-- Panel Heading -->
                    <div class="outline-panel__heading">
                        <h5 class="outline-panel__heading__text">
                            Amenities
                        </h5>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                        </svg>
                    </div>
                    <!-- Panel Content -->
                    <div class="outline-panel__content">
                        <div class="ammenities">
                            <?php foreach ($amenities as $a) :
                                $amenity_post = $a['standard_amenity'];
                                $icon = get_field('icon', $amenity_post);
                                $title = $a['title_override'] == "" ? get_the_title($amenity_post) : $a['title_override'];
                                $subtitle = $a['subtitle'];
                            ?>

                                <div class="ammenities__item">
                                    <?php echo $icon ?>

                                    <div class="ammenities__item__title-group">
                                        <div class="ammenities__item__title-group__title">
                                            <?php echo $title ?>
                                        </div>
                                        <?php if ($subtitle != "") : ?>
                                            <div class="ammenities__item__title-group__sub">
                                                <?php echo $subtitle ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>

                <!-- CTA / Deckplan -->
                <div class="product-overview__content__grid__secondary__cta">

                    <?php if ($deck_plans) : ?>
                        <button class="cta-primary cta-primary--inverse" id="deckplan-button" imageId="<?php echo $deck_plans[0]['id']; ?>">
                            View Deckplans
                        </button>
                    <?php endif; ?>

                    <a class="cta-link-icon" href="#">
                        Flexible booking terms
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-shield"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Content Modal -->
<div class="modal" id="contentModal">
    <div class="modal__content"">
        <div class=" modal__content__top">
        <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                About the <?php echo $productName; ?>
                </div>          
            </div>
            <button class="btn-text-icon close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main">
            <?php echo $overview_content; ?>
        </div>
    </div>
</div>