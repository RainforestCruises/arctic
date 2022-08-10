    <!-- Newest Cruises  -->
    <?php
    get_template_part('template-parts/home/content', 'home-newest');
    ?>

    <!-- Destinations -->
    <?php
    get_template_part('template-parts/home/content', 'home-destinations');
    ?>
    <img <?php afloat_image_markup($map_image['id'], 'vertical-large', array('vertical-large')); ?>>


    <div class="main-slider-slide__secondary__panels__static__cta">
        <div class="btn-pill-hero" id="mobile-map-cta">
            Explore Map
        </div>
    </div>