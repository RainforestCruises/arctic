<?php
$destinations = get_field('destinations');
?>


<div class="home-arctic-newest">
    <div class="home-arctic-newest__title">
        Top Antarctica Destinations
    </div>
    <div class="home-arctic-newest__slider" id="arctic-destinations-slider">


        <?php foreach ($destinations as $d) :
            $destinationPost = $d['destination'];
            $image = $d['image'];
            $link = get_the_permalink($d);
        ?>

            <a class="arctic-card-portrait" href="<?php echo $d['page_link'] ?>">
                <div class="arctic-card-portrait__image">
                    <img <?php afloat_image_markup($image['id'], 'vertical-small'); ?>>
                </div>
                <div class="arctic-card-portrait__content">
                    <div class="arctic-card-portrait__content__title-section">
                        <div class="arctic-card-portrait__content__title-section__sub">
                            <?php echo $d['sub_title'] ?>
                        </div>
                        <div class="arctic-card-portrait__content__title-section__title">
                            <?php echo get_field('navigation_title', $destinationPost) ?>
                        </div>
                    </div>
                
                </div>
            </a>



        <?php endforeach; ?>


    </div>

</div>