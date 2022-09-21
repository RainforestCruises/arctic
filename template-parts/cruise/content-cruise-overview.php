<?php

$deck_plans = get_field('deck_plans');
$amenities = get_field('amenities');
$cruise_data = $args['cruiseData'];
?>
<section class="cruise-overview" id="overview">

    <div class="cruise-overview__content">

        <!-- Grid  -->
        <div class="cruise-overview__content__grid">

            <!-- Main Overview (Highlights, Transport, Text) -->
            <div class="cruise-overview__content__grid__overview">

                <!-- Highlights -->
                <div class="cruise-overview__content__grid__overview__highlights">
                    <h3 class="title-single">Highlights</h3>
                    <ul class="cruise-overview__content__grid__overview__highlights__list">
                        <?php if (have_rows('highlights')) : ?>
                            <?php while (have_rows('highlights')) : the_row(); ?>
                                <li>
                                    <span>&#8212;</span><?php echo get_sub_field('highlight'); ?>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>


                <!-- Text -->
                <div class="cruise-overview__content__grid__overview__text ">
                    <?php echo get_field('overview_content') ?>
                </div>
            </div>


            <!-- Side Section -->
            <div class="cruise-overview__content__grid__secondary">

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
                        <div class="icon-area">
                            <?php foreach ($amenities as $a) : ?>
                                <div class="icon-circle">
                                    <?php echo get_field('icon', $a); ?>
                                    <span class="tooltiptext"><?php echo get_the_title($a); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>

                <!-- CTA / Deckplan -->
                <div class="cruise-overview__content__grid__secondary__cta">

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