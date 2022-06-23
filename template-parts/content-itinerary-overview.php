<?php

$map_image = get_field('map_image');
$ship = get_field('ship');

$ship_featured_image = get_field('featured_image', $ship);
$ship_snippet = get_field('top_snippet', $ship);
$cruise_data = $args['cruiseData'];

?>

<div class="itinerary-overview">

    <!-- Grid  -->
    <div class="itinerary-overview__grid">

        <!-- Content  -->
        <div class="itinerary-overview__grid__content">

            <!-- Highlights -->
            <div class="itinerary-overview__grid__content__highlights">
                <h3 class="arctic-heading-3">Overview</h3>
                <ul class="itinerary-overview__grid__content__highlights__list">
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
             <div class="itinerary-overview__grid__content__transport ">
                <div class="itinerary-overview__grid__content__transport__title">
                    Itinerary Type: <span>Fly | Cruise</span> 
                </div>
                <div class="itinerary-overview__grid__content__transport__snippet">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium aliquam cum eveniet. Quisquam dolor perferendis soluta, architecto similique facilis 
                </div>
               
            </div>

            <!-- Text -->
            <div class="itinerary-overview__grid__content__text ">
                <?php echo get_field('overview_content') ?>
            </div>
        </div>



        <div class="itinerary-overview__grid__map-area">
            <img <?php afloat_image_markup($map_image['id'], 'vertical-large', array('vertical-large')); ?>>
        </div>
        <div class="itinerary-overview__grid__ship-area">


            <a class="itinerary-overview__grid__ship-area__ship">
                <div class="itinerary-overview__grid__ship-area__ship__avatar">
                    <img <?php afloat_image_markup($ship_featured_image['id'], 'square-small', array('square-small')); ?>>
                </div>
                <div class="itinerary-overview__grid__ship-area__ship__info">
                    <div class="itinerary-overview__grid__ship-area__ship__info__name">
                        <div class="itinerary-overview__grid__ship-area__ship__info__name__title">
                            The <?php echo get_the_title($ship); ?>
                        </div>
                        <div class="itinerary-overview__grid__ship-area__ship__info__name__sub">
                            <?php echo $ship_snippet; ?>
                        </div>
                    </div>
                    <div class="itinerary-overview__grid__ship-area__ship__info__cta">
                        <button class="cta-text-icon">
                            Explore
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </button>

                    </div>

                </div>
            </a>
            <div class="itinerary-overview__grid__ship-area__title">
                Cabin Options
                <div class="itinerary-overview__grid__ship-area__title__sub">
                    Choose from the available X cabin types
                </div>
            </div>
            <div class="itinerary-overview__grid__ship-area__slider">

                <?php
                $cabinCount = 0;
                $cabins = $cruise_data['CabinDTOs'];
                foreach ($cabins as $cabin) :
                ?>

                    <a class="arctic-card-square-small">
                        <div class="arctic-card-square-small__image">
                            <img src=<?php echo afloat_dfcloud_image($cabin['ImageDTOs'][0]['ImageUrl']); ?>>
                        </div>
                        <div class="arctic-card-square-small__content">
                            <div class="arctic-card-square-small__content__title-section">
                                <div class="arctic-card-square-small__content__title-section__sub">
                                    Label
                                </div>
                                <div class="arctic-card-square-small__content__title-section__title">
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