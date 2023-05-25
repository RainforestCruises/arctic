<?php
$hero_gallery_images = get_field('hero_gallery');
$deckPlans = get_field('deck_plans');
$cabins = $args['cabins'];

?>

<!-- Product Gallery Modal -->
<div class="modal modal--gallery" id="pageGalleryModal">
    <div class="modal__gallery">

        <!-- Top Section -->
        <div class="modal__gallery__top">
            <span id="pageGalleryModalCount">Count</span>
            <span id="pageGalleryModalTitle">Title</span>

            <button class="btn-text-icon close-modal-button">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Slider -->
        <div class="modal__gallery__main">
            <div class="modal__gallery__main__slider swiper noselect" id="modal-gallery-main">
                <div class="swiper-wrapper">

                    <?php
                    $count = 1; // Main
                    foreach ($hero_gallery_images as $image) : ?>
                        <div class="modal__gallery__main__slider__item swiper-slide" slideIndex="<?php echo $count; ?>" imageId="<?php echo $image['id']; ?>" title="<?php echo $image['title']; ?>">
                            <img <?php afloat_image_markup($image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-medium', 'portrait-small')); ?>>
                        </div>
                    <?php $count++;
                    endforeach; ?>

                    <?php // Cabins 
                    foreach ($cabins as $cabin) :
                        $images = get_field('images', $cabin);
                        $display_name = get_field('display_name', $cabin);
                        foreach ($images as $image) :
                    ?>
                            <div class="modal__gallery__main__slider__item swiper-slide" slideIndex="<?php echo $count; ?>" imageId="<?php echo $image['id']; ?>" title="<?php echo $display_name; ?>">
                                <img <?php afloat_image_markup($image['id'], 'landscape-large', array('landscape-large', 'landscape-medium', 'portrait-medium', 'portrait-small')); ?>>
                            </div>
                    <?php $count++;
                        endforeach;
                    endforeach; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <!-- Nav Slider -->
        <div class="modal__gallery__nav">

            <div class="modal__gallery__nav__slider swiper noselect" id="modal-gallery-nav">
                <div class="swiper-wrapper">

                    <?php // Main 
                    foreach ($hero_gallery_images as $image) : ?>
                        <div class="modal__gallery__nav__slider__item swiper-slide">
                            <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>
                        </div>
                    <?php endforeach; ?>

                    <?php // Cabins 
                    foreach ($cabins as $cabin) :
                        $images = get_field('images', $cabin);
                        foreach ($images as $image) :
                    ?>
                            <div class="modal__gallery__nav__slider__item swiper-slide">
                                <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>
                            </div>
                    <?php
                        endforeach;
                    endforeach; ?>


                </div>

            </div>
        </div>
    </div>
</div>