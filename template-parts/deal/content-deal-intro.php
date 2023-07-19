<?php
$deal = get_post();
$shipsWithDeal = getShipsWithDeal($deal);
$terms_and_conditions = get_field('terms_and_conditions');
$description = get_field('description');
$is_special_departure = get_field('is_special_departure');

?>



<!-- Intro -->
<section class="deal-intro" id="section-intro">

    <div class="deal-intro__content">
        <div class="deal-intro__content__grid">

            <div class="deal-intro__content__grid__terms">

                <h2 class="title-single">
                    About
                </h2>
                <?php echo ($description)  ?>


                <?php if ($terms_and_conditions) : ?>
                    <h2 class="title-single">
                        Terms & Conditions
                    </h2>
                    <ul class="highlight-list">
                        <?php foreach ($terms_and_conditions as $term) : ?>
                            <li>
                                <span>&#8212;</span>
                                <?php echo $term['condition'] ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="deal-intro__content__grid__ships">
                <h2 class="title-single">
                    <?php echo $is_special_departure ? "Ships With This Special Departure" : "Ships With This Deal" ; ?>             
                </h2>
                <!-- Ships Grid -->
                <?php foreach ($shipsWithDeal as $ship) :
                    $hero_gallery = get_field('hero_gallery', $ship);
                    $ship_image = $hero_gallery[0];
                    $shipTitle = get_the_title($ship);
                    $service_level = get_field('service_level', $ship);
                    $subtitleDisplay = get_the_title($service_level) . ", " . get_field('vessel_capacity', $ship) . ' Guests';
                    $top_snippet = get_field('top_snippet', $ship);
                ?>
                    <!-- Ship -->
                    <a class="tiny-card" href="<?php echo get_permalink($ship);  ?>">
                        <!-- Title Group -->
                        <div class="tiny-card__section">
                            <div class="avatar">
                                <div class="avatar__image-area">
                                    <img <?php afloat_image_markup($ship_image['id'], 'portrait-small', array('portrait-small')); ?>>
                                </div>
                                <div class="avatar__title-group">
                                    <div class="avatar__title-group__title">
                                        <?php echo $shipTitle; ?>
                                    </div>
                                    <div class="avatar__title-group__sub">
                                        <?php echo $top_snippet; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tiny-card__section">

                            <!-- CTA -->
                            <button class="btn-primary btn-primary--icon btn-primary--small">
                                Explore
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                            </button>
                        </div>
                    </a>

                <?php endforeach; ?>
            </div>

        </div>


    </div>
</section>