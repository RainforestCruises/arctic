<?php

$hero_images = get_field('hero_images');
$hero_title = get_field('hero_title');

$highlights = get_field('highlights');

$intro_text =  get_field('intro_text');
$expand = strlen($intro_text) > 2000 ? true : false;
$intro_text_limited = substr($intro_text, 0, 2000); 
if($expand){
    $intro_text_limited .= '...';
}

?>

<!-- Overview / Highlights -->
<section class="landing-overview" id="highlights">

    <div class="landing-overview__content">

        <!-- Grid  -->
        <div class="landing-overview__content__grid">

            <!-- Main Overview (Highlights, Transport, Text) -->
            <div class="landing-overview__content__grid__overview">

                <!-- Highlights -->
                <div class="landing-overview__content__grid__overview__highlights">
                    <h2 class="title-single">Highlights</h2>
                    <ul class="highlight-list">
                        <?php if ($highlights) : ?>
                            <?php foreach ($highlights as $h) : ?>
                                <li>
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-diamonds-suits"></use>
                                    </svg>
                                    <?php echo removePtags($h['highlight']); ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Text -->
                <div class="landing-overview__content__grid__overview__text ">
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
            <div class="landing-overview__content__grid__secondary">

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
                <h2 class="modal__content__top__nav__title">
                    About <?php echo $hero_title; ?>
                </h2>
            </div>
            <button class="btn-text btn-text--bg close-modal-button">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main" id="contentModalMain">
            <?php echo $intro_text; ?>
        </div>
    </div>
</div>