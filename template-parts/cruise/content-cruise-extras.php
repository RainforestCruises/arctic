<?php
$extras = get_field('extras');
?>


<div class="product-extras" id="extras">
    <div class="product-extras__content">
        <!-- Title Group -->
        <div class="title-single">
            Extra Services
        </div>
        <!-- Slider -->
        <div class="product-extras__content__slider" id="extras-slider">


            <?php foreach ($extras as $e) :
                $image =  $e['image'];
                $title = $e['title'];
                $amount = $e['amount'];
                $text = $e['text'];
            ?>

                <a class="overlay-card" href="<?php echo $link; ?>">
                    <div class="overlay-card__image-area">
                        <img <?php afloat_image_markup($image['id'], 'wide-slider-medium'); ?>>
                    </div>
                    <div class="overlay-card__content">
                        <div class="overlay-card__content__title-section">
                            <div class="overlay-card__content__title-section__sub">
                                $<?php echo $amount ?> Per Person
                            </div>
                            <div class="overlay-card__content__title-section__title">
                                <?php echo $title ?>
                            </div>
                        </div>
                        <div class="overlay-card__content__cta">
                            <button class="cta-primary cta-primary--white">
                                View Details
                            </button>
                        </div>
                    </div>
                </a>



            <?php endforeach; ?>


        </div>
    </div>


</div>