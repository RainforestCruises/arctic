<?php

$difference = get_field('difference');
$headerText = get_field('difference_header');
?>
<section class="about-difference" id="section-difference">
    <div class="about-difference__content">
        <h2 class="about-difference__content__title">
            <?php echo $headerText ?>
        </h2>
        <div class="about-difference__content__slider-area">
            <div class="about-difference__content__slider-area__slider" id="difference-slider">
                <?php
                if ($difference) :
                    foreach ($difference as $slide) :

                ?>

                        <div class="difference-card">
                            <div class="difference-card__bg">
                                <?php $image =  $slide['image'] ?>
                                <img <?php afloat_image_markup($image['id'], 'full-hero-large'); ?>>

                            </div>
                            <div class="difference-card__content">
                                <h3 class="difference-card__content__title">
                                    <?php echo $slide['title'] ?>
                                </h3>
                                <div class="difference-card__content__snippet">
                                    <?php echo $slide['snippet'] ?>
                                </div>
                            </div>
                        </div>

                <?php
                    endforeach;
                endif;

                ?>
            </div>

        </div>
    </div>
</section>