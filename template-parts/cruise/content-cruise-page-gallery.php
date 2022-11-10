<?php
$images = get_field('hero_gallery');
$deckPlans = get_field('deck_plans');
$cabins = $args['cabins'];




?>

<!-- Product Gallery Modal -->
<div class="modal modal--gallery" id="pageGalleryModal">
    <div class="modal__gallery-content">

        <!-- Top Section -->
        <div class="modal__gallery-content__top">
            <button class="btn-text-icon close-modal-button">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
            <span id="pageGalleryModalTitle">Title</span>
            <span id="pageGalleryModalCount">Count</span>
        </div>

        <!-- Main Slider -->
        <div class="modal__gallery-content__main">
            <div class="modal__gallery-content__main__slider swiper noselect" id="modal-gallery-main">
                <div class="swiper-wrapper">

                    <?php
                    $count = 1; // Main
                    foreach ($images as $image) : ?>
                        <div class="modal__gallery-content__main__slider__item swiper-slide" slideIndex="<?php echo $count; ?>" imageId="<?php echo $image['id']; ?>" title="<?php echo $image['title']; ?>">
                            <img <?php afloat_image_markup($image['id'], 'landscape-medium', array('landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
                        </div>
                    <?php $count++;
                    endforeach; ?>

                    <?php // Cabins (DF)
                    foreach ($cabins as $cabin) :
                        $images = get_field('images', $cabin);
                        $display_name = get_field('display_name', $cabin);
                        foreach ($images as $image) :
                    ?>
                            <div class="modal__gallery-content__main__slider__item swiper-slide" slideIndex="<?php echo $count; ?>" imageId="<?php echo $image['id']; ?>" title="<?php echo $display_name; ?>">
                                <img <?php afloat_image_markup($image['id'], 'landscape-medium', array('landscape-medium', 'portrait-large', 'portrait-medium')); ?>>
                            </div>
                    <?php $count++;
                        endforeach;
                    endforeach; ?>

                    <?php // Deckplans
                    foreach ($deckPlans as $image) : ?>
                        <div class="modal__gallery-content__main__slider__item swiper-slide" slideIndex="<?php echo $count; ?>" imageId="<?php echo $image['id']; ?>" title="<?php echo $image['title']; ?>">
                            <img <?php afloat_image_markup($image['id'], 'full', array('full')); ?>>
                        </div>
                    <?php $count++;
                    endforeach; ?>

                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <!-- Nav Slider -->
        <div class="modal__gallery-content__nav">

            <div class="modal__gallery-content__nav__slider swiper noselect" id="modal-gallery-nav">
                <div class="swiper-wrapper">

                    <?php // Main 
                    foreach ($images as $image) : ?>
                        <div class="modal__gallery-content__nav__slider__item swiper-slide">
                            <img <?php afloat_image_markup($image['id'], 'landscape-small', array('landscape-small')); ?>>
                        </div>
                    <?php endforeach; ?>

                    <?php // Cabins (DF)
                    foreach ($cabinImages as $image) : ?>
                        <div class="modal__gallery-content__nav__slider__item swiper-slide">
                            <img src="<?php echo afloat_dfcloud_image($image['url'], 320, 180); ?>">
                        </div>
                    <?php endforeach; ?>

                    <?php // Deckplan
                    foreach ($deckPlans as $image) : ?>
                        <div class="modal__gallery-content__nav__slider__item swiper-slide">
                            <img <?php afloat_image_markup($image['id'], 'landscape-small', array('landscape-small')); ?>>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>