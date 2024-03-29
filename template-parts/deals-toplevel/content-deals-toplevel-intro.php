<?php

$hero_images = get_field('hero_images');
$hero_title = get_field('hero_title');
$intro_title =  get_field('intro_title');

$intro_text =  get_field('intro_text');
$expand = strlen($intro_text) > 1250 ? true : false;
$intro_text_limited = substr($intro_text, 0, 1250);
if($expand){
    $intro_text_limited .= '...';
}

?>

<!-- Overview / Highlights -->
<section class="deals-toplevel-intro" id="section-intro">

    <div class="deals-toplevel-intro__content">

        <!-- Grid  -->
        <div class="deals-toplevel-intro__content__grid">

            <!-- Main Overview (Highlights, Transport, Text) -->
            <div class="deals-toplevel-intro__content__grid__overview">
                <h2 class="title-single">
                    <?php echo $intro_title; ?>
                </h2>
                <!-- Text -->
                <div class="deals-toplevel-intro__content__grid__overview__text ">
                    <?php echo $intro_text_limited; ?>
                </div>
                <div class="product-overview__content__grid__overview__expand">
                    <?php if ($expand) : ?>
                        <button class="btn-text" id="expand-content">
                            Read More
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>

            </div>


            <!-- Side Section -->
            <div class="deals-toplevel-intro__content__grid__secondary">

                <div class="quote-grid__image-area">
                    <img class="quote-grid__image-area__primary" <?php afloat_image_markup($hero_images[1]['id'], 'portrait-medium', array('portrait-medium', 'portrait-small')); ?>>
                    <img class="quote-grid__image-area__secondary" <?php afloat_image_markup($hero_images[2]['id'], 'portrait-small', array('portrait-small')); ?>>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- Content Modal -->
<div class="modal" id="contentModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    About <?php echo $hero_title; ?>
                </div>
            </div>
            <button class="btn-text btn-text--bg close-modal-button">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main">
            <?php echo $intro_text; ?>
        </div>
    </div>
</div>