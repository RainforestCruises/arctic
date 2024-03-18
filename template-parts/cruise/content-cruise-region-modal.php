<?php
$regions = $args['regions'];
$initialRegion = $args['initialRegion'];

?>

<!-- Cruise Region Modal -->
<div class="modal modal--minimal" id="regionModal">

    <div class="modal__content">
        <div class="modal__content__top">
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    Change Ship Region
                </div>
            </div>
            <button class="btn-text btn-text--bg close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>
        <div class="modal__content__main">
            <div class="modal-region-content">

                <div class="modal-region-content__header">
                    Set region for <?php echo get_the_title(); ?>
                </div>
                <div class="modal-region-content__buttons">
                    <?php foreach ($regions as $region) :
                        $image = get_field('image', $region);
                        $itineraries = getShipItineraries(get_post(), $region);
                        $itineraryDisplay = count($itineraries) . ' Itineraries, ' . itineraryRange($itineraries, "-") . " Days";
                    ?>

                        <?php if ($region == $initialRegion) : ?>
                            <div class="btn-avatar-info btn-avatar-info--large active">
                                <div class="btn-avatar-info__image-area">
                                    <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                </div>
                                <div class="btn-avatar-info__title-group">
                                    <div class="btn-avatar-info__title-group__title">
                                        <?php echo get_the_title($region); ?>
                                    </div>
                                    <div class="btn-avatar-info__title-group__sub">
                                        <?php echo $itineraryDisplay; ?>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <a class="btn-avatar-info btn-avatar-info--large" href="<?php echo get_the_permalink() . '?region=' . $region->ID ?>">
                                <div class="btn-avatar-info__image-area">
                                    <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                </div>
                                <div class="btn-avatar-info__title-group">
                                    <div class="btn-avatar-info__title-group__title">
                                        <?php echo get_the_title($region); ?>
                                    </div>
                                    <div class="btn-avatar-info__title-group__sub">
                                        <?php echo $itineraryDisplay; ?>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>






                    <?php endforeach; ?>
                </div>

            </div>

        </div>
    </div>
</div>