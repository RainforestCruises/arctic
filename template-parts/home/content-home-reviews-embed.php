<?php
$reviews_embed = get_field('reviews_embed');
$reviews_title = get_field('reviews_title');
$reviews_embed = get_field('reviews_embed') ? get_field('reviews_embed') : 'RH3cuTh8lx7zF6hfFPe5QBVZJ7ouEcyo0RZU5knC31z2Ilo3CZ';

?>



<section class="slider-block" id="reviews">
    <div class="slider-block__content block-top-divider">
        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">
            <!-- Title -->
            <h2 class="title-single">
                <?php echo $reviews_title ?>
            </h2>
        </div>
        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <div data-romw-token="<?php echo $reviews_embed ?>"></div>

        </div>
    </div>
</section>