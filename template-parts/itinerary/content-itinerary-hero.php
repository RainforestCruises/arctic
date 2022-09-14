<?php

$title = get_the_title();
$snippet = get_field('top_snippet');
$hero_image = get_field('hero_image');
$desktopImages = array_slice($images, 1);

?>

<!-- Itinerary Hero -->
<section class="product-hero" id="top">
    <!-- Desktop BG Image -->
    <div class="product-hero__bg-image">
        <img <?php afloat_image_markup($hero_image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
    </div>



    <!-- Hero Content -->
    <div class="product-hero__content">
        <div class="product-hero__content__main">
            <!-- Primary (Title + Description) -->
            <div class="product-hero__content__main__primary">
                <div class="product-hero__content__main__primary__title">
                    <?php echo $title ?>
                </div>
                <div class="product-hero__content__main__primary__snippet">
                    <?php echo $snippet; ?>
                </div>
                <div class="product-hero__content__main__primary__nav">
                    <a href="#itinerary" class="product-hero__content__main__primary__nav__link">Itinerary</a>
                    <a href="#dates" class="product-hero__content__main__primary__nav__link">Dates</a>
                    <a href="#services" class="product-hero__content__main__primary__nav__link">Services</a>
                    <a href="#reviews" class="product-hero__content__main__primary__nav__link">Reviews</a>
                </div>
            </div>

            <!-- Secondary (Info + Attributes) -->
            <div class="product-hero__content__main__secondary">

                <!-- Info -->
                <div class="product-hero__content__main__secondary__info">

                    <!-- Starting Price -->
                    <div class="product-hero__content__main__secondary__info__starting-price">
                        <div class="product-hero__content__main__secondary__info__starting-price__title-area">
                            <div class="product-hero__content__main__secondary__info__starting-price__title-area__text">
                                Starting at:
                            </div>
                            <div class="product-hero__content__main__secondary__info__starting-price__title-area__subtext">
                                Per Person
                            </div>
                        </div>
                        <div class="product-hero__content__main__secondary__info__starting-price__amount">
                            <?php echo "$" . number_format(4995, 0); ?>
                            <span class="u-small-text">USD</span>
                        </div>
                    </div>

                    <!-- Inquire CTA Button -->
                    <div class="product-hero__content__main__secondary__info__cta">
                        <button class="cta-primary inquire-cta">
                            Inquire
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
                            </svg>
                        </button>
                    </div>

                </div>

                <!-- Attributes -->
                <div class="product-hero__content__main__secondary__attributes">

                    <!-- Itineraries -->
                    <div class="product-hero__content__main__secondary__attributes__item">
                        <div class="product-hero__content__main__secondary__attributes__item__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                            </svg>
                        </div>
                        <div class="product-hero__content__main__secondary__attributes__item__text">
                            <div class="sub-attribute">
                                Length
                            </div>

                            <?php echo "7 Days"; ?>

                        </div>

                    </div>

                    <!-- Capacity -->
                    <div class="product-hero__content__main__secondary__attributes__item">

                        <div class="product-hero__content__main__secondary__attributes__item__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                            </svg>
                        </div>
                        <div class="product-hero__content__main__secondary__attributes__item__text">
                            <div class="sub-attribute">
                                Ship Size
                            </div>
                            <?php echo '100 Guests'; ?>
                        </div>


                    </div>
                    <!-- Service Level -->
                    <div class="product-hero__content__main__secondary__attributes__item">
                        <div class="product-hero__content__main__secondary__attributes__item__icon">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-3"></use>
                            </svg>
                        </div>
                        <div class="product-hero__content__main__secondary__attributes__item__text">
                            <div class="sub-attribute">
                                Service Level
                            </div>
                            Luxury
                        </div>

                    </div>




                </div>

            </div>
        </div>



    </div>
</section>



<!-- Mobile Info -->
<div class="mobile-info">

    <div class="mobile-info__starting-price">
        <div class="mobile-info__starting-price__title-area">

            <div class="mobile-info__starting-price__title-area__text">
                Starting at:
            </div>
            <div class="mobile-info__starting-price__title-area__subtext">
                Per Person
            </div>
        </div>
        <div class="mobile-info__starting-price__amount">
            <?php echo "$" . number_format(4995, 0); ?>
            <span class="u-small-text">USD</span>
        </div>

    </div>

    <!-- Inquire CTA Button -->
    <div class="mobile-info__cta">
        <button class="cta-primary inquire-cta">
            Inquire
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send"></use>
            </svg>
        </button>
    </div>
</div>

