<?php
$reviews_embed = get_field('reviews_embed');
?>


<section class="slider-block narrow section-padding">
    <div class="slider-block__content ">
        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">
            <!-- Title -->
            <h2 class="title-single center">
                What My Clients Say
            </h2>
        </div>
        <!-- Slider Area -->
        <div class="slider-block__content__slider">

            <div data-romw-token="<?php echo $reviews_embed ?>"></div>

        </div>
    </div>
</section>