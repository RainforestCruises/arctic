<?php


$posts = $args['deals'];



?>



<div class="deals-featured">
    <h2 class="deals-featured__title">
        <?php echo get_field('featured_slider_title') ?>
    </h2>
    <div class="deals-featured__slider" id="featured-slider">
            <?php
            if ($posts) :

                foreach ($posts as $p) :
                    $featured_image = get_field('featured_image', $p);
                    $applicable_to = get_field('applicable_to', $p);

                    $imageID = '';
                    if ($featured_image) {
                        $imageID = $featured_image['ID'];
                    }


                    $guideCategories = get_field('categories', $p);


                    $isoClasses = '';
                    if ($guideCategories) {
                        foreach ($guideCategories as $c) {
                            $isoClasses = $isoClasses . ' ' . $c->post_name;
                        };
                    };

            ?>


                    <div class="deal-slide <?php echo $isoClasses ?>">
                        <div class="deal-slide__image-area">
                            <img <?php afloat_image_markup($imageID, 'featured-medium'); ?>>
                        </div>
                        <div class="deal-slide__bottom">
                            <ul class="deal-slide__bottom__category">
                                <?php if ($guideCategories) :
                                    foreach ($guideCategories as $c) : ?>
                                        <li>
                                            <?php
                                            $catTitle = get_the_title($c);
                                            echo trim($catTitle);
                                            ?>
                                        </li>
                                <?php endforeach;
                                endif;  ?>
                            </ul>
                            <div class="deal-slide__bottom__title">
                                <h3>
                                    <?php echo get_field('navigation_title', $p); ?>
                                </h3>

                            </div>
                            <div class="deal-slide__bottom__snippet">
                                <?php echo get_field('description', $p); ?>
                            </div>
                            <?php if ($applicable_to == 'broadCategory') :
                                $serp_link = get_field('serp_link', $p);
                            ?>
                                <div class="deal-slide__bottom__cta">
                                    <a class="goto-button goto-button--dark" href="<?php echo $serp_link ?>">
                                        View All
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                        </svg>
                                    </a>
                                </div>
                            <?php elseif ($applicable_to == 'travelProducts') :
                                $travelProducts = get_field('products', $p);

                            ?>

                                <div class="deal-slide__bottom__cta deal-slide__bottom__cta--multiple">
                                    <span>Applicable To: </span>
                                    <?php foreach ($travelProducts as $product) : ?>
                                        <a  href="<?php echo the_permalink($product) ?>">
                                            <?php echo get_the_title($product); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


            <?php
                endforeach;
            endif;
            ?>

        </div>


</div>