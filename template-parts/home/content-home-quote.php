<?php
$quote_text = get_field('quote_text');
$quote_title = get_field('quote_title');
$quote_images = get_field('quote_images');
?>

<section class="home-quote" id="section-quote">
    <div class="home-quote__content">
        <!-- Grid Area -->
        <div class="home-quote__content__grid">
            <div class="quote-grid">

                <div class="quote-grid__text-area">
                    <div class="quote-grid__text-area__title">
                        <?php echo $quote_title; ?>
                    </div>
                    <div class="quote-grid__text-area__text">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
                        </svg>
                        <?php echo $quote_text; ?>
                    </div>
                </div>



                <div class="quote-grid__image-area">
                    <img class="quote-grid__image-area__primary" <?php afloat_image_markup($quote_images[0]['id'], 'portrait-medium', array('portrait-medium', 'portrait-small')); ?>>
                    <img class="quote-grid__image-area__secondary" <?php afloat_image_markup($quote_images[1]['id'], 'vertical-small', array('vertical-small')); ?>>
                </div>

            </div>


        </div>
    </div>
</section>