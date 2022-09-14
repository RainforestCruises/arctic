<?php

$map_image = get_field('map_image');
$ship = get_field('ship');
$ship_image_gallery = get_field('hero_gallery', $ship);
$ship_featured_image = $ship_image_gallery[0];
$ship_snippet = get_field('top_snippet', $ship);
$cruise_data = $args['cruiseData'];
?>
<section class="itinerary-overview" id="overview">

    <div class="itinerary-overview__content">

        <!-- Grid  -->
        <div class="itinerary-overview__content__grid">

            <!-- Overview (Highlights, Transport, Text) -->
            <div class="itinerary-overview__content__grid__overview">

                <!-- Highlights -->
                <div class="itinerary-overview__content__grid__overview__highlights">
                    <h3 class="arctic-heading-3">Overview</h3>
                    <ul class="itinerary-overview__content__grid__overview__highlights__list">
                        <?php if (have_rows('highlights')) : ?>
                            <?php while (have_rows('highlights')) : the_row(); ?>
                                <li>

                                    <span>&#8212;</span><?php echo get_sub_field('highlight'); ?>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Transport -->
                <div class="itinerary-overview__content__grid__overview__transport ">
                    <div class="itinerary-overview__content__grid__overview__transport__title">
                        Itinerary Type: <span>Fly | Cruise</span>
                    </div>
                    <div class="itinerary-overview__content__grid__overview__transport__snippet">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium aliquam cum eveniet. Quisquam dolor perferendis soluta, architecto similique facilis
                    </div>

                </div>

                <!-- Text -->
                <div class="itinerary-overview__content__grid__overview__text ">
                    <?php echo get_field('overview_content') ?>
                </div>
            </div>


            <!-- Itinerary Map  -->
            <div class="itinerary-overview__content__grid__map-area">
                <div class="itinerary-overview__content__grid__map-area__map" id="itinerary-map">

                </div>
            </div>

            <!-- Ship Area -->
            <div class="itinerary-overview__content__grid__ship-area">


                <!-- Ship Card -->
                <a class="itinerary-overview__content__grid__ship-area__ship" href="<?php echo get_permalink($ship); ?>">
                    <div class="itinerary-overview__content__grid__ship-area__ship__avatar">
                        <img <?php afloat_image_markup($ship_featured_image['id'], 'square-small', array('square-small')); ?>>
                    </div>
                    <div class="itinerary-overview__content__grid__ship-area__ship__info">
                        <div class="itinerary-overview__content__grid__ship-area__ship__info__name">
                            <div class="itinerary-overview__content__grid__ship-area__ship__info__name__title">
                                The <?php echo get_the_title($ship); ?>
                            </div>
                            <div class="itinerary-overview__content__grid__ship-area__ship__info__name__sub">
                                <?php echo $ship_snippet; ?>
                            </div>
                        </div>
                        <div class="itinerary-overview__content__grid__ship-area__ship__info__cta">
                            <button class="cta-text-icon">
                                Explore
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                            </button>

                        </div>

                    </div>
                </a>

                <!-- Cabins Slider -->
                <div class="itinerary-overview__content__grid__ship-area__title">
                    Cabin Options
                    <div class="itinerary-overview__content__grid__ship-area__title__sub">
                        Choose from the available <?php echo count($cruise_data['CabinDTOs']); ?> cabin types
                    </div>
                </div>
                <div class="itinerary-overview__content__grid__ship-area__slider" id="cabins-slider">

                    <?php
                    $cabinCount = 0;
                    $cabins = $cruise_data['CabinDTOs'];
                    foreach ($cabins as $cabin) :
                    ?>

                        <a class="overlay-card small">
                            <div class="overlay-card__image-area">
                                <img src=<?php echo afloat_dfcloud_image($cabin['ImageDTOs'][0]['ImageUrl']); ?>>
                            </div>
                            <div class="overlay-card__content">
                                <div class="overlay-card__content__title-section">
                                    <div class="overlay-card__content__title-section__sub">
                                        Label
                                    </div>
                                    <div class="overlay-card__content__title-section__title">
                                        <?php echo $cabin['Name']; ?>
                                    </div>
                                </div>

                            </div>
                        </a>



                    <?php endforeach; ?>

                </div>
            </div>

        </div>



    </div>
</section>