<?php
$destinations = get_field('destinations');
$destinations_subtext = get_field('destinations_title_subtext');

?>

<div class="home-destinations">
    <div class="home-destinations__header">
        <h2 class="home-destinations__header__title page-divider">
            Exotic Destinations
        </h2>
        <div class="home-destinations__header__sub-text">
            <?php echo $destinations_subtext ?>
        </div>
    </div>

    <div class="home-destinations__destinations-area">

        <div class="home-destinations__destinations-area__slider" id="destinations-slider">
            <?php if ($destinations) : ?>
                <?php foreach ($destinations as $d) :
                    $destinationPost = $d['destination'];
                    $image = $d['image'];
                ?>
                    <a href="<?php echo $d['page_link'] ?>" class="home-destination-card">
                    
                        <img <?php afloat_image_markup($image['id'], 'vertical-small'); ?>>

                        <div class="home-destination-card__title-area">
                            <h3 class="home-destination-card__title-area__title">
                                <?php echo get_field('navigation_title', $destinationPost) ?>
                            </h3>
                            <div class="home-destination-card__title-area__subtitle">
                                <?php echo $d['sub_title'] ?>
                            </div>
                        </div>
                    </a>

            <?php endforeach;
            endif; ?>




        </div>
    </div>

</div>