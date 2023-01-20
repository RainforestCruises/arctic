<?php
$deckPlans = get_field('deck_plans');

?>

<!-- Product Gallery Modal -->
<div class="modal modal--gallery" id="deckplanGalleryModal">
    <div class="modal__gallery deckplan-images">

        <!-- Top Section -->
        <div class="modal__gallery__top">
            <span id="deckplanGalleryModalCount">1 / <?php echo count($deckPlans); ?></span>
            <span id="deckplanGalleryModalTitle">Deckplan</span>

            <button class="btn-text-icon close-modal-button">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Slider -->
        <div class="modal__gallery__main">
            <div class="modal__gallery__main__slider swiper noselect" id="deckplan-gallery">
                <div class="swiper-wrapper">

                    <?php
                    $count = 1; 
                    foreach ($deckPlans as $image) : ?>
                        <div class="modal__gallery__main__slider__item swiper-slide" title="<?php echo $image['title']; ?>">
                            <img src="<?php echo wp_get_attachment_image_url($image['id'], 'full'); ?>">
                        </div>
                    <?php $count++;
                    endforeach; ?>

                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

    </div>
</div>