<?php
$newest_ships = get_field('newest_ships');
?>


<div class="home-arctic-newest">
    <div class="home-arctic-newest__title">
        Newest Ships Cruising the Antarctica
    </div>
    <div class="home-arctic-newest__slider" id="newest-cruises-slider">


        <?php foreach ($newest_ships as $ship) : 
            $image =  get_field('hero_image', $ship);
            $title = get_the_title($ship);
            $link = get_the_permalink($ship);
            ?>

            <a class="arctic-card-wide" href="<?php echo $link; ?>">
                <div class="arctic-card-wide__image">
                    <img <?php afloat_image_markup($image['id'], 'wide-slider-medium'); ?>>
                </div>
                <div class="arctic-card-wide__content">
                    <div class="arctic-card-wide__content__title-section">
                        <div class="arctic-card-wide__content__title-section__sub">

                        </div>
                        <div class="arctic-card-wide__content__title-section__title">
                            <?php echo $title ?>
                        </div>
                    </div>
                    <div class="arctic-card-wide__content__cta">

                    </div>
                </div>
            </a>

    

        <?php endforeach; ?>


    </div>

</div>