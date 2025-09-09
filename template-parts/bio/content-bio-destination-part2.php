<?php
$destinations = get_field('destinations');
$firstDestinationGroup = array_slice($destinations, 2, 2);
?>


<section class="bio-destination">
    <div class="bio-destination__content">

        <?php foreach ($firstDestinationGroup as $destination) :
            $category = $destination['category'];
            $name = $destination['name'];
            $image = $destination['image'];
            $description = $destination['description'];
            $link = $destination['link'];
        ?>

            <!-- Memorable -->
            <div class="bio-destination-item">
                <div class="bio-destination-item__image">
                    <img <?php afloat_image_markup($image['id'], 'landscape-small'); ?>>
                </div>
                <h2 class="bio-destination-item__title">
                    <?php echo $category; ?>
                </h2>
                <div class="bio-destination-item__name">
                    <?php echo $name; ?>
                </div>
                <div class="bio-destination-item__description">
                    <?php echo $description; ?>
                </div>
                <a class="bio-destination-item__link" href="<?php echo $link; ?>">
                    <span>
                        Discover <?php echo $name; ?>
                    </span>
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                    </svg>
                </a>
            </div>
        <?php endforeach; ?>

    </div>

</section>