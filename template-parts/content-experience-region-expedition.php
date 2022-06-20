<?php
$currentYear = date("Y");
$destinations = get_field('destinations');
$count = 0;

?>



<?php foreach ($destinations as $d) :
    $destination_post = $d['destination_post'];
    $hide_tours = $d['hide_tours'];
    $count++;

    $tours = $d['tours'];
?>

    <div class="experience-region">
        <div class="experience-region__content">
            <div class="experience-region__content__accent-title">
                <?php echo get_field('navigation_title', $destination_post) ?>
            </div>
            <div class="experience-region__content__text">

                <div class="experience-region__content__text__title-group">
                    <div class="experience-region__content__text__title-group__subtitle">
                        <?php echo $d['subtitle'] ?>
                    </div>
                    <h2 class="experience-region__content__text__title-group__title">
                        <?php echo $d['title'] ?>
                    </h2>
                </div>
                <div class="experience-region__content__text__snippet">
                    <?php echo $d['snippet'] ?>
                </div>

                <div class="experience-region__content__text__cta">
                    <a class="btn-cta-square" href="<?php echo $d['explore_link'] ?>"">
                    <span>
                    Explore
                    </span>             
                        <svg>
                            <use xlink:href=" <?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="experience-region__content__image">
                <!-- responsive -->
                <img <?php afloat_image_markup($d['image']['id'], 'vertical-medium'); ?>>

            </div>
        </div>
        <?php if ($hide_tours == false) : ?>
            <div class="experience-region__slider-area">

                <div class="experience-region__slider-area__slider" id="region-slider-<?php echo $count; ?>">
                    <?php
                    if ($tours) :
                        foreach ($tours as $tour) :
                            $t = $tour['tour_post'];
                            $tag = $tour['tag'];
                            $best_selling = get_field('best_selling', $t);
                            $hero_image = get_field('best_selling_image', $t);
                            $countries  = get_field('destinations', $t);
                            $price_packages = get_field('price_packages', $t);
                            $lowest = lowest_tour_price($price_packages, $currentYear);
                    ?>

                            <!-- Tour Card -->
                            <a class="wide-slider-card" href="<?php echo get_permalink($t); ?>">

                                <div class="wide-slider-card__image">
                                    <?php if ($hero_image) : ?>
                                        <img <?php afloat_image_markup($hero_image['id'], 'wide-slider-medium'); ?>>
                                    <?php endif; ?>
                                </div>


                                <div class="wide-slider-card__content">
                                    <div class="wide-slider-card__content__tag-area">
                                        <div class="wide-slider-card__content__tag-area__tag">
                                            <?php echo $tag; ?>
                                        </div>

                                    </div>

                                    <div class="wide-slider-card__content__text-area">
                                        <div class="wide-slider-card__content__text-area__country">
                                            <?php foreach ($countries as $c) :
                                                $isCountry = get_field('is_country', $c);
                                                if ($isCountry) : ?>
                                                    <li>
                                                        <?php echo get_the_title($c); ?>
                                                    </li>

                                            <?php endif;
                                            endforeach; ?>
                                        </div>
                                        <h3 class="wide-slider-card__content__text-area__title">
                                            <?php echo get_field('tour_name', $t) ?>
                                        </h3>
                                        <div class="wide-slider-card__content__text-area__info">
                                            <div class="wide-slider-card__content__text-area__info__length">
                                                <?php echo get_field('length', $t) ?>-Day Tour
                                            </div>
                                            <div class="wide-slider-card__content__text-area__info__price">
                                                From <?php echo "$" . number_format($lowest, 0); ?> <span>USD</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                    <?php
                        endforeach;
                    endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>