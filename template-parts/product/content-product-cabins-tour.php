<?php

$properties = get_field('properties');
$hotels = get_field('hotels');

?>



<!-- Cruises & Lodges -->
<?php if ($properties) : ?>
    <div class="product-cabins u-margin-bottom-medium">

        <h3 class="xsub-divider xsub-divider--dark u-margin-bottom-small">
            Cruises & Lodges
        </h3>

        <?php foreach ($properties as $property) : ?>
            <?php
            $propertyPost = get_post($property);
            $featured_image = get_field('featured_image',  $property);
            $propertyTitle = get_the_title($property);
            $propertySnippet = get_field('top_snippet',  $property);
            $number_of_cabins = get_field('number_of_cabins',  $property);
            $vessel_capacity = get_field('vessel_capacity',  $property);
            $isCruise = (get_post_type($property) == 'rfc_cruises' ? true : false);
            ?>

            <!-- Product Card -->
            <div class="product-cabins__cabin ">
                <div class="product-cabins__cabin__image-area">
                    <img <?php afloat_image_markup($featured_image['id'], 'featured-large'); ?>>
                </div>
                <div class="product-cabins__cabin__content">
                    <div class="product-cabins__cabin__content__title ">
                        <h4><?php echo $propertyTitle; ?></h4>
                    </div>
                    <div class="product-cabins__cabin__content__snippet">
                        <?php echo $propertySnippet; ?>
                    </div>
                    <div class="product-cabins__cabin__content__attributes">
                        <!-- Capacity -->
                        <div class="product-cabins__cabin__content__attributes__item">
                            <div class="product-cabins__cabin__content__attributes__item__data">
                                <div class="product-cabins__cabin__content__attributes__item__data__icon">
                                    <?php if (get_post_type($p) != 'rfc_lodges') : ?>
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                        </svg>
                                    <?php else : ?>
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-bed-23"></use>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div class="product-cabins__cabin__content__attributes__item__data__text">
                                    <?php echo $vessel_capacity; ?> Guests
                                    <div class="sub-attribute">
                                        <?php echo $number_of_cabins; ?> Cabins
                                    </div>
                                </div>

                            </div>
                        </div>

                        <a href="<?php echo get_permalink($propertyPost) ?>" target="_blank" class="btn-outline btn-outline--small btn-outline--dark">
                            View
                        </a>
                    </div>



                </div>
            </div>


            <!-- New -->


        <?php endforeach; ?>



    </div>
<?php endif; ?>

<!-- Hotels -->
<?php if ($hotels) :
    $hotel_snippet = get_field('hotels_snippet');
?>
    <div class="product-hotels">

        <h3 class="xsub-divider xsub-divider--dark u-margin-bottom-small">
            Hotel Options
        </h3>
        <?php if ($hotel_snippet != "") : ?>
            <div class="sub-divider-text">
                <p><?php echo get_field('hotels_snippet') ?></p>
            </div>
        <?php endif ?>


        <div class="product-hotels__slider" id="hotels-slider">
            <?php foreach ($hotels as $hotel) : ?>
                <?php
                $hotelPost = get_post($hotel);
                $featured_image = get_field('featured_image',  $hotelPost);
                $hotelTitle = get_field('navigation_title',  $hotelPost);
                $priceLevelPost = get_field('price_level',  $hotelPost);
                $hotelLocations = get_field('locations', $hotelPost);

                $hotelCity = null;
                if ($hotelLocations) {
                    $hotelCity = $hotelLocations[0];
                }

                $hotelPriceLevel = null;
                if ($priceLevelPost) {
                    $hotelPriceLevel = get_the_title($priceLevelPost);
                }

                ?>

                <div class="card-square">
                    <div class="card-square__title-group">
                        <div class="card-square__title-group__level">
                            <?php echo $hotelPriceLevel; ?>
                        </div>
                        <div>
                            <h4 class="card-square__title-group__name">
                                <?php echo  $hotelTitle ?>
                            </h4>
                            <div class="card-square__title-group__subtext">
                                <?php echo get_field('navigation_title', $hotelCity) ?>
                            </div>
                        </div>

                    </div>
                    <div class="card-square__image-area">
                        <img <?php afloat_image_markup($featured_image['id'], 'square-medium'); ?> alt="">

                    </div>

                </div>

            <?php endforeach; ?>
        </div>


        <!-- <div class="product-cabins__note">
            <div class="attention-box">
                <?php $destination = get_field('destination'); ?>
                <p>All itineraries are completely customizable. Contact our travel specialists to build your perfect vacation</p>
            </div>
        </div> -->

    </div>

<?php
endif; ?>