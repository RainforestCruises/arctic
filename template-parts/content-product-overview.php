<?php
$cruise_data = get_field('cruise_data');
$featured_image = get_field('featured_image');

?>


<div class="product-overview">

    <h2 class="page-divider u-margin-bottom-medium">
        Overview
    </h2>

    <!-- Content  -->
    <div class="product-overview__content">

        <!-- Side / Image & Highlights -->
        <aside class="product-overview__content__side-detail">
            <div class="product-overview__content__side-detail__image-area">
                <?php if ($featured_image) : ?>
                    <img <?php afloat_image_markup($featured_image['id'], 'featured-medium'); ?>>
                <?php endif; ?>
            </div>
            <!-- Highlights -->
            <div class="product-overview__content__side-detail__highlights">
                <h3 class="heading-3 heading-3--underline">Highlights</h3>
                <ul class="list-svg list-svg--large">
                    <?php if (have_rows('highlights')) : ?>
                        <?php while (have_rows('highlights')) : the_row(); ?>
                            <li>
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                                </svg>
                                <span><?php echo get_sub_field('highlight'); ?></span>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </aside>

        <!-- Text -->
        <div class="product-overview__content__text drop-cap-1 ">
            <?php echo get_field('overview_content') ?>
        </div>
    </div>

    <!-- Fade / Read More -->
    <div class="product-overview__fade">
        <button class="btn-outline" id="readmore-button">Read More</button>
    </div>

</div>