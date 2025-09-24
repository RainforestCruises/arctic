<?php
$introduction_title = get_field('introduction_title');
$introduction_text = get_field('introduction_text');

?>

<section class="slider-block narrow">
    <div class="slider-block__content block-top-divider" style="padding-bottom: 8rem !important; padding-top: 6rem !important; display: flex; flex-direction: column; align-items: center">
        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">
            <!-- Title -->
            <h2 class="title-single center">
                <?php echo $introduction_title; ?>
            </h2>
        </div>
        <!-- Slider Area -->
        <div class="slider-block__content__text" style="max-width: 90rem;">
            <?php echo $introduction_text; ?>
            <svg class="slider-block__content__text__quote">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
            </svg>
        </div>
    </div>
</section>