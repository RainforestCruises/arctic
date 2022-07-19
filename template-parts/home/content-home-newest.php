<?php
$newest_ships = get_field('newest_ships');
?>


<div class="home-newest">
    <div class="home-newest__content">

        <!-- Title Group -->
        <div class="title-single">
            Newest Cruises in the Antarctic
        </div>

        <div class="home-newest__content__slider" id="newest-cruises-slider">


            <?php foreach ($newest_ships as $ship) :
                $image =  get_field('hero_image', $ship);
                $title = get_the_title($ship);
                $link = get_the_permalink($ship);
            ?>

                <a class="overlay-card" href="<?php echo $link; ?>">
                    <div class="overlay-card__image-area">
                        <img <?php afloat_image_markup($image['id'], 'wide-slider-medium'); ?>>
                    </div>
                    <div class="overlay-card__content">
                        <div class="overlay-card__content__title-section">
                            <div class="overlay-card__content__title-section__sub">
                                $2995 Per Person
                            </div>
                            <div class="overlay-card__content__title-section__title">
                                <?php echo $title ?>
                            </div>
                        </div>
                        <div class="overlay-card__content__cta">
                            <button class="cta-primary cta-primary--white">
                                View Details
                            </button>
                        </div>
                    </div>
                </a>

            <?php endforeach; ?>


        </div>

    </div>


</div>