    <?php
    $areaImages = get_field('areas_gallery');
    ?>



    <h3 class="xsub-divider xsub-divider--dark u-margin-bottom-small">
        Social Areas
    </h3>

    <!-- Common Areas Gallery -->
    <div class="product-areas">
        <div class="product-areas__slider-nav">
            <?php
            if ($areaImages) : ?>
                <?php foreach ($areaImages as $areaImage) : ?>
                    <div class="product-areas__slider-nav__item">
                        <?php echo esc_html($areaImage['title']); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="product-areas__slider">
            <?php
            if ($areaImages) : ?>
                <?php foreach ($areaImages as $areaImage) : ?>
                    <div class="product-areas__slider__item">
                        <img <?php afloat_image_markup($areaImage['id'], 'featured-large'); ?>>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    