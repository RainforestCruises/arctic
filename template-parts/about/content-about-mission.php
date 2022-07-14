<div class="about-mission">
    <div class="about-mission__intro">
        <h1 class="about-mission__intro__title">
            <?php echo get_field('title') ?>
        </h1>
        <div class="about-mission__intro__text">
            <?php echo get_field('intro_text') ?>
        </div>
    </div>

    <div class="about-mission__imagery">
        <?php
        $collage_image_1 =  get_field('collage_image_1');
        $collage_image_2 =  get_field('collage_image_2');
        ?>

        <div class="about-mission__imagery__main-image">
            <img <?php afloat_image_markup($collage_image_1['id'], 'featured-large'); ?> >
            <h2 class="about-mission__imagery__main-image__tagline">
                <?php echo get_field('collage_tagline') ?>

            </h2>
        </div>
        <div class="about-mission__imagery__secondary-image">
            <img <?php afloat_image_markup($collage_image_2['id'], 'square-medium'); ?> >

        </div>

        <div class="about-mission__imagery__text-area">

            <div class="about-mission__imagery__text-area__snippet">
                <?php echo get_field('collage_snippet') ?>
            </div>

        </div>

    </div>

    <div class="about-mission__statement">
        <div class="about-mission__statement__start-quote">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
            </svg>
        </div>

        <div class="about-mission__statement__snippet">
            <?php echo get_field('mission_statement') ?>
        </div>
        <div class="about-mission__statement__end-quote">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
            </svg>
        </div>
    </div>
</div>