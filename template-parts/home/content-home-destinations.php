<?php
$destinations = get_field('destinations');
?>


<div class="home-destinations">

    <div class="home-destinations__content">

        <div class="title-single">
            Explore Antarctica
        </div>

        <div class="home-destinations__content__slider" id="destinations-slider">
            <?php foreach ($destinations as $d) :
                $destinationPost = $d['destination'];
                $image = $d['image'];
                $link = get_the_permalink($d);
            ?>

                <a class="overlay-card"  href="<?php echo $d['page_link'] ?>">
                    <div class="overlay-card__image-area">
                        <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                    </div>
                    <div class="overlay-card__content">
                        <div class="overlay-card__content__title-section">
                            <div class="overlay-card__content__title-section__sub">
                                Sub Title
                            </div>
                            <div class="overlay-card__content__title-section__title">
                                <?php echo get_field('navigation_title', $destinationPost) ?>
                            </div>
                        </div>

                    </div>
                </a>

            <?php endforeach; ?>




        </div>
    </div>



</div>