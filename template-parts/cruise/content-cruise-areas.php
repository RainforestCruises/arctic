<?php
$cruise_data = $args['cruise_data'];
$cabins = $cruise_data['CabinDTOs'];
$images = get_field('areas_gallery');


?>
<section class="cruise-areas" id="areas">



    <div class="cruise-areas__content">

        <div class="title-single">
            Explore
        </div>

        <!-- Cabins slider -->
        <div class="cruise-areas__content__grid">
            <a href="<?php echo esc_url($images[0]['url']); ?>">
                <img <?php afloat_image_markup($images[0]['id'], 'featured-large'); ?>>
            </a>
            <div class="cruise-areas__content__grid__small-grid">
                <?php
                $i = 0;
                foreach ($images as $image) : ?>
                    <?php if ($i > 0 && $i < 5) : ?>
                        <a href="<?php echo esc_url($image['url']); ?>">
                            <img <?php afloat_image_markup($image['id'], 'featured-small'); ?>>
                        </a>
                    <?php endif; ?>

                <?php
                    $i++;
                endforeach; ?>
            </div>

        </div>

    </div>
</section>