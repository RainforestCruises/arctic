<?php

$regions = get_field('regions');
$experience = get_field('experience_post');
$is_charter = get_field('is_charter');

$count = 0;

?>



<?php foreach ($regions as $r) :
    $region_post = $r['region_post'];
    $destinations = $r['destinations'];



    $count++;


?>

    <div class="experience-region">
        <div class="experience-region__content">
            <div class="experience-region__content__accent-title">
                <?php echo get_field('navigation_title', $region_post) ?>
            </div>
            <div class="experience-region__content__text">

                <div class="experience-region__content__text__title-group">
                    <div class="experience-region__content__text__title-group__subtitle">
                        <?php echo $r['subtitle'] ?>
                    </div>
                    <h2 class="experience-region__content__text__title-group__title">
                        <?php echo $r['title'] ?>
                    </h2>
                </div>
                <div class="experience-region__content__text__snippet">
                    <?php echo $r['snippet'] ?>
                </div>
                <div class="experience-region__content__text__travel-types">

                    <!-- Cruise Count -->
                    <?php
                    if (!$is_charter) :
                        $cruisesAvailable = cruises_available_region($region_post, $experience, false);
                        if ($cruisesAvailable > 0) : ?>
                            <div class="experience-region__content__text__travel-types__group">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                                </svg>
                                <a href="<?php echo $r['explore_link'] . '?travel_style=rfc_cruises' ?>"><?php echo $cruisesAvailable ?> <?php echo get_the_title($experience) ?> <?php echo ($cruisesAvailable == 1) ? 'Cruise' : 'Cruises'; ?> Available</a>
                            </div>
                        <?php endif;
                    else :
                        $chartersAvailable = cruises_available_region($region_post, null, true);
                        if ($chartersAvailable > 0) : ?>
                            <div class="experience-region__content__text__travel-types__group">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                                </svg>
                                <a href="<?php echo $r['explore_link']  ?>"><?php echo $chartersAvailable ?> Charter <?php echo ($chartersAvailable == 1) ? 'Cruise' : 'Cruises'; ?> Available</a>
                            </div>
                    <?php
                        endif;
                    endif;
                    ?>


                    <?php if (!$is_charter) : ?>

                        <!-- Tour Count -->
                        <?php
                        $toursAvailable = tours_available_region($region_post, $experience);
                        if ($toursAvailable > 0) : ?>
                            <div class="experience-region__content__text__travel-types__group">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                                </svg>
                                <a href="<?php echo $r['explore_link'] . '?travel_style=rfc_tours' ?>"><?php echo tours_available_region($region_post, $experience) ?> <?php echo get_the_title($experience) ?> <?php echo ($toursAvailable == 1) ? 'Tour' : 'Tours'; ?> Available</a>
                            </div>
                        <?php endif; ?>

                        <!-- Lodge Count -->
                        <?php
                        $lodgesAvailable = cruises_available_region($region_post, $experience, false, true);
                        if ($lodgesAvailable > 0) : ?>
                            <div class="experience-region__content__text__travel-types__group">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
                                </svg>
                                <a href="<?php echo $r['explore_link'] . '?travel_style=rfc_lodges' ?>"><?php echo cruises_available_region($region_post, $experience, false, true) ?> <?php echo get_the_title($experience) ?> <?php echo ($lodgesAvailable == 1) ? 'Lodge' : 'Lodges'; ?> Available</a>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>
                </div>
                <div class="experience-region__content__text__cta">
                    <a class="btn-cta-square" href="<?php echo $r['explore_link'] ?>"">
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
                <img <?php afloat_image_markup($r['image']['id'], 'vertical-medium'); ?>>

            </div>
        </div>

        <div class="experience-region__slider-area">

            <div class="experience-region__slider-area__slider" id="region-slider-<?php echo $count; ?>">
                <?php foreach ($destinations as $d) :
                    $cardImage = $d['image'];
                    $destinationPost = $d['destination_post']
                ?>

                    <!-- Tour Card -->
                    <a class="wide-slider-card" href="<?php echo $d['search_link'] ?>">
                        <div class="wide-slider-card__image">
                            <img <?php afloat_image_markup($cardImage['id'], 'wide-slider-medium'); ?>>
                        </div>


                        <div class="wide-slider-card__content">
                            <div class="wide-slider-card__content__tag-area">
                                <?php if ($d['tag'] != "") : ?>
                                    <div class="wide-slider-card__content__tag-area__tag">
                                        <?php echo $d['tag'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="wide-slider-card__content__text-area">
                                <h3 class="wide-slider-card__content__text-area__title">
                                    <?php echo get_field('navigation_title', $destinationPost) ?>
                                </h3>
                                <div class="wide-slider-card__content__text-area__info">
                                    <div class="wide-slider-card__content__text-area__info__length">

                                        <?php
                                        if (!$is_charter) :
                                            $toursAvailable = tours_available($destinationPost, $experience);
                                            $cruisesAvailable = cruises_available_experience($destinationPost, $experience);

                                            echo $toursAvailable . ' ' . ($toursAvailable == 1 ? 'Tour': 'Tours' ) . ' / ' . $cruisesAvailable . ' ' . ($cruisesAvailable == 1 ? 'Cruise': 'Cruises' ) . ' Available';
                                        else :
                                            $charterAvailable = cruises_available_charter($destinationPost);
                                            echo $charterAvailable . ' ' . ($charterAvailable == 1 ? 'Cruise': 'Cruises' ) . ' Available';
                                        endif;
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
<?php endforeach; ?>