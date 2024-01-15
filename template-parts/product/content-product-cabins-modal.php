<?php
$cabins = $args['cabins'];
?>

<div class="modal" id="cabinModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title" id="cabinModalTitle">
                    Cabin Details
                </div>
            </div>
            <button class="btn-text btn-text--bg close-modal-button ">
                <span class="close-modal-button--close-text">Close</span>
                <span class="close-modal-button--back-text">Back</span>
                <svg class="close-modal-button--close-text">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
                <svg class="close-modal-button--back-text">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main">
            <?php
            foreach ($cabins as $c) :
                $id = $c->ID;
                $title =  get_field('display_name', $c);
                $dimensions =  get_field('dimensions', $c);
                $description =  get_field('description', $c);
                $is_single =  get_field('is_single', $c);
                $capacity =  get_field('capacity', $c);
                $quantity =  get_field('quantity', $c);
                $amenities =  get_field('amenities', $c);
                $beds =  get_field('beds', $c);
                $images = get_field('images', $c);
                $image = $hero_gallery[0];
            ?>
                <div class="cruise-cabins-modal-item" cabinId="<?php echo $id; ?>">
                    <div class="cruise-cabins-modal-item__image-area">
                        <div class="swiper-wrapper">
                            <?php foreach ($images as $image) : ?>
                                <div class="cruise-cabins-modal-item__image-area__item swiper-slide">
                                    <img <?php afloat_image_markup($image['id'], 'landscape-medium'); ?>>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev swiper-button-prev--overlay"></div>
                        <div class="swiper-button-next swiper-button-prev--overlay"></div>
                    </div>

                    <!-- Title -->
                    <?php if (get_post_type() == 'rfc_cruises') : ?>
                        <h2 class="cruise-cabins-modal-item__title">
                            <?php echo $title; ?>
                        </h2>
                    <?php else : ?>
                        <div class="cruise-cabins-modal-item__title">
                            <?php echo $title; ?>
                        </div>
                    <?php endif ?>



                    <div class="cruise-cabins-modal-item__specification">
                        <span>Capacity:</span> <?php echo $capacity; ?>
                    </div>
                    <div class="cruise-cabins-modal-item__specification">
                        <span>Beds:</span> <?php echo $beds; ?>
                    </div>
                    <div class="cruise-cabins-modal-item__specification">
                        <span>Dimensions:</span> <?php echo $dimensions; ?>
                    </div>
                    <div class="cruise-cabins-modal-item__specification" style="margin-bottom: 1.5rem">
                        <span>Number of Cabins:</span> <?php echo $quantity; ?> <?php echo $quantity == 1 ? "Cabin" : "Cabins"; ?>
                    </div>

                    <!-- Subtitle -->
                    <?php if (get_post_type() == 'rfc_cruises') : ?>
                        <h3 class="cruise-cabins-modal-item__subtitle">
                            Features
                        </h3>
                    <?php else : ?>
                        <div class="cruise-cabins-modal-item__subtitle">
                            Features
                        </div>
                    <?php endif ?>


                    <div class="cruise-cabins-modal-item__features">
                        <?php
                        if ($amenities) :
                            foreach ($amenities as $a) :
                                $icon = get_field('icon', $a);
                        ?>
                                <div class="icon-item ">
                                    <?php echo $icon ?>
                                    <div class="icon-item__title-group">
                                        <div class="icon-item__title-group__title">
                                            <?php echo get_the_title($a); ?>
                                        </div>
                                    </div>

                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>


                    <!-- Subtitle -->
                    <?php if (get_post_type() == 'rfc_cruises') : ?>
                        <h3 class="cruise-cabins-modal-item__subtitle">
                            Description
                        </h3>
                    <?php else : ?>
                        <div class="cruise-cabins-modal-item__subtitle">
                            Description
                        </div>
                    <?php endif ?>


                    <div class="cruise-cabins-modal-item__description">
                        <?php echo $description; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>