<!-- Contact Modal -->
<?php
$dealPosts = $args['dealPosts'];
?>
<div class="popup" id="dealsModal">
    <div class="modal-content modal-content--wide">
        <div class="modal-content__wrapper transparent">
            <?php if (count($dealPosts) > 1) : ?>
                <div class="deals-indicator active" id="deals-indicator">1 / 3</div>
            <?php endif; ?>
            <div class="deals-slider" id="deals-slider">
                <?php
                foreach ($dealPosts as $p) :
                    $featured_image = get_field('featured_image', $p);
                    $applicable_to = get_field('applicable_to', $p);
                    $is_selected_dates_only = get_field('is_selected_dates_only', $p);
                    $is_exclusive = get_field('is_exclusive', $p);

                    $imageID = '';
                    if ($featured_image) {
                        $imageID = $featured_image['ID'];
                    }
                ?>

                    <div class="deal-item">
                        <div class="deal-item__image-area">
                            <?php if ($is_exclusive) : ?>
                                <span class="exclusiveDeal">
                                    Exclusive Deal
                                </span>
                            <?php endif; ?>
                            <img <?php afloat_image_markup($imageID, 'featured-medium'); ?>>
                        </div>
                        <div class="deal-item__bottom">

                            <div class="deal-item__bottom__title">
                                <h2>
                                    <?php echo get_field('navigation_title', $p); ?>
                                </h2>

                            </div>
                            <div class="deal-item__bottom__snippet">
                                <?php echo get_field('description', $p); ?>
                            </div>
                            <div class="deal-item__bottom__badge-area">
                                <?php
                                if ($is_selected_dates_only) : ?>
                                    <span class="selectedDates">
                                        ** Available on Select Dates
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>

        </div>
    </div>
</div>
<!-- End Contact Modal -->