<?php
$introduction_title = get_field('introduction_title');
$introduction_text = get_field('introduction_text');
$agent_gallery = get_field('agent_gallery');

?>

<section class="bio-introduction">
    <div class="bio-introduction__content">

        <div class="bio-introduction__content__image-area">
            <div class="image-collage">
                <img class="image-collage__primary" <?php afloat_image_markup($agent_gallery[1]['id'], 'portrait-medium', array('portrait-medium', 'portrait-small')); ?>>
                <img class="image-collage__secondary" <?php afloat_image_markup($agent_gallery[2]['id'], 'portrait-small', array('portrait-small')); ?>>
            </div>
        </div>

        <div class="bio-introduction__content__quote-area">
            <!-- Title -->
            <h2 class="title-single">
                <?php echo $introduction_title; ?>
            </h2>
            <?php echo $introduction_text; ?>
            <svg class="bio-introduction__content__quote-area__quote">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
            </svg>


        </div>

    </div>



</section>