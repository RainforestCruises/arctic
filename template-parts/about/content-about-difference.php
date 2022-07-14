<?php

$difference = get_field('difference');
$headerText = get_field('difference_header');
?>

<div class="about-difference">
    <h2 class="about-difference__title">
        <?php echo $headerText ?>
    </h2>
    <div class="about-difference__slider-area">
        <div class="about-difference__slider-area__slider" id="difference-slider">
            <?php
            if ($difference) :
                foreach ($difference as $slide) :

            ?>

                    <div class="difference-card">
                        <div class="difference-card__bg">
                            <?php $image =  $slide['image'] ?>
                            <img <?php afloat_image_markup($image['id'], 'full-hero-large'); ?> >

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