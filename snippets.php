<div class="home-hero__content__secondary">

<div class="title-single">
    Great Deals on Upcoming Departures
</div>

<div class="home-hero__content__secondary__items">
    <?php foreach ($hero_deals as $deal) :
        $featured_image = get_field('featured_image', $deal);
        $navigation_title = get_field('navigation_title', $deal);
        $description = get_field('description', $deal);

        $image = $deal['image'];
        $title = $deal['title'];
        $percentage_savings = $deal['percentage_savings'];
    ?>
        <div class="information-card">
            <!-- Title Group -->
            <div class="information-card__section">
                <div class="avatar avatar--small">
                    <div class="avatar__image-area">
                        <img <?php afloat_image_markup($image['id'], 'square-small', array('square-small')); ?>>
                    </div>
                    <div class="avatar__title-group">
                        <div class="avatar__title-group__title">
                            <?php echo $title; ?>
                        </div>

                        <div class="avatar__title-group__sub">
                            Up to <span class="green-text"><?php echo $percentage_savings; ?>%</span> savings
                        </div>
                    </div>
                </div>
            </div>

            <div class="information-card__bottom">
                <!-- Price Group -->
                <div class="information-card__bottom__deals">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-energy"></use>
                    </svg>
                    <span>
                        12 Deals
                    </span>
                </div>

                <!-- CTA -->
                <div class="information-card__bottom__cta">
                    <button class="cta-square-icon cta-square-icon--inverse departure-inquire-cta">
                        View All
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
    <div class="home-hero__content__secondary__items__see-more">
        See All 27 Deals
        <button class="btn-icon">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
            </svg>
        </button>
    </div>

</div>


</div>