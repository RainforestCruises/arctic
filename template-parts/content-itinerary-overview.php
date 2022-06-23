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
                <h3 class="heading-3 heading-3--underline">Highlights</h3>
                <ul class="list-svg list-svg--large">
                    <?php if (have_rows('highlights')) : ?>
                        <?php while (have_rows('highlights')) : the_row(); ?>
                            <li>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                                </svg>
                                <span><?php echo get_sub_field('highlight'); ?></span>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Text -->
            <div class="itinerary-overview__grid__content__text ">
                <h3 class="heading-3 heading-3--underline">Overview</h3>
                <?php echo get_field('overview_content') ?>
            </div>
        </div>



        <div class="itinerary-overview__grid__map-area">
            <img <?php afloat_image_markup($map_image['id'], 'vertical-large', array('vertical-large')); ?>>
        </div>
        <div class="itinerary-overview__grid__ship-area">

            <a class="itinerary-overview__grid__ship-area__ship" href="<?php echo get_permalink($ship); ?>">
                <div class="itinerary-overview__grid__ship-area__ship__avatar">
                    <img <?php afloat_image_markup($ship_featured_image['id'], 'square-small', array('square-small')); ?>>
                </div>
                <div class="itinerary-overview__grid__ship-area__ship__name">
                    <div class="itinerary-overview__grid__ship-area__ship__name__title">
                        Explore the <?php echo get_the_title($ship); ?>
                    </div>
                    <div class="itinerary-overview__grid__ship-area__ship__name__sub">
                        <?php echo $ship_snippet; ?>
                    </div>
                </div>
            </a>
            <div class="itinerary-overview__grid__ship-area__title">
                Accommodations
            </div>
            <div class="itinerary-overview__grid__ship-area__slider">

                <?php 
                $cabinCount = 0;
                $cabins = $cruise_data['CabinDTOs'];
                foreach ($cabins as $cabin) :
                ?>

                    <a class="arctic-card-square-small">
                        <div class="arctic-card-square-small__image">
                            <img src=<?php echo afloat_dfcloud_image($cabin['ImageDTOs'][0]['ImageUrl']) ; ?>>
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