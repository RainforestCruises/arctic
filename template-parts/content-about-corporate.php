<?php

$badges = get_field('badges');

?>

<div class="about-partners">
    <div class="about-partners__content">
        <h2 class="about-partners__content__title">
            Our Partners 
        </h2>
        <div class="about-partners__content__snippet">
            <?php echo get_field('partners_snippet'); ?>

        </div>
    </div>
</div>

<div class="about-corporate">
    <div class="about-corporate__grey">
        <div class="about-corporate__grey__content">
            <div class="about-corporate__grey__content__corporate-info">
                <h2 class="about-corporate__grey__content__corporate-info__title">
                    Corporate Information
                </h2>
                <div class="about-corporate__grey__content__corporate-info__snippet">
                    <?php echo get_field('corporate_snippet'); ?>
                </div>
            </div>
            <div class="about-corporate__grey__content__contact-details">
                <h3 class="about-corporate__grey__content__contact-details__title">
                    Contact Details
                </h3>
                <div class="about-corporate__grey__content__contact-details__snippet">
                    <?php echo get_field('contact_details'); ?>
                </div>
            </div>
            <div class="about-corporate__grey__content__badge-area">
                <?php foreach ($badges as $badge) : ?>

                    <img <?php afloat_image_markup($badge['id'], 'square-small'); ?> >

                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <div class="about-corporate__image-area">
        <?php $background_image = get_field('background_image'); ?>
        <img <?php afloat_image_markup($background_image['id'], 'full-hero-small'); ?> >

    </div>

</div>