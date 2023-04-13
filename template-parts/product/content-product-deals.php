<?php
$deals = $args['deals'];
$subtitleDisplay = count($deals) == 1 ? "There is 1 deal available on select departures" : "Explore these " . count($deals) . " deals on select departures";
?>

<section class="slider-block narrow" id="section-deals">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-group__title">
                    Deals
                </div>
                <div class="title-group__sub">
                    <?php echo $subtitleDisplay ?>
                </div>
            </div>

            <!-- Nav Buttons -->
            <div class="slider-block__content__top__nav">
                <div class="swiper-button-prev swiper-button-prev--white-border deals-slider-btn-prev">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next swiper-button-next--white-border deals-slider-btn-next">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Slider Area -->
        <div class="slider-block__content__slider">
            <!-- Swiper -->
            <div class="swiper" id="deals-slider">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($deals as $deal) :
                        $id = $deal->ID;
                        $image = get_field('featured_image', $deal);
                        $title = get_field('navigation_title', $deal);
                        $description = get_field('description', $deal);
                        $has_expiry_date = get_field('has_expiry_date', $deal);
                        $expiry_date =  get_field('expiry_date', $deal);
                    ?>
                        <div class="deal-card swiper-slide">
                            <!-- Title Group -->
                            <div class="deal-card__section">
                                <div class="avatar avatar--small">
                                    <div class="avatar__image-area">
                                        <img <?php afloat_image_markup($image['id'], 'square-thumb', array('square-thumb')); ?>>
                                    </div>
                                    <div class="avatar__title-group">
                                        <div class="avatar__title-group__title">
                                            <?php echo  $title; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="deal-card__description">
                                <?php echo $description ?>
                            </div>

                            <div class="deal-card__urgency">
                                <svg class="deal-card__urgency__icon">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-stopwatch"></use>
                                </svg>
                                <div class="deal-card__urgency__text">
                                    <?php if ($has_expiry_date) :
                                        echo 'Offer expires in ' . getDaysUntilExpiry($expiry_date) . ' days';
                                     else :
                                        echo 'Limited time offer';
                                     endif; ?>
                                </div>
                                <div class="deal-card__urgency__cta">
                                    <button class="cta-square-icon deal-cta" dealId="<?php echo $id ?>">
                                        Details
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal" id="dealsModal">
    <div class="modal__content">

        <!-- Top Modal Content -->
        <div class="modal__content__top">
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    Deal Information
                </div>
            </div>
            <button class="btn-text-icon close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main" id="dealsModalMainContent">

            <?php
            foreach ($deals as $deal) :
                $id = $deal->ID;
                $image = get_field('featured_image', $deal);
                $title = get_field('navigation_title', $deal);
                $description = get_field('description', $deal);
                $show_terms = get_field('show_terms', $deal);
                $terms_and_conditions = get_field('terms_and_conditions', $deal);
                $has_expiry_date = get_field('has_expiry_date', $deal);
                $expiry_date =  get_field('expiry_date', $deal);
            ?>

                <div class="product-deals-modal-item" dealId="<?php echo $id; ?>">
                    <div class="product-deals-modal-item__title-group">
                        <div class="product-deals-modal-item__title-group__title">
                            <?php echo $title; ?>
                        </div>
                        <div class="product-deals-modal-item__title-group__sub">

                        </div>
                    </div>
                    <div class="product-deals-modal-item__image-area">
                        <img <?php afloat_image_markup($image['id'], 'landscape-small', array('landscape-small', 'portrait-small')); ?>>
                    </div>

                    <div class="product-deals-modal-item__description">
                        <?php echo $description; ?>
                    </div>
                    <?php if ($show_terms) : ?>
                        <h4>Terms & Conditions</h4>
                        <ul class="highlight-list">
                            <?php foreach ($terms_and_conditions as $term) : ?>
                                <li>
                                    <span style="margin-right: 1rem;">&#8212;</span>
                                    <?php echo $term['condition'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if ($has_expiry_date) : ?>
                        <div class="product-deals-modal-item__urgency">
                            <svg class="product-deals-modal-item__urgency__icon">
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-stopwatch"></use>
                            </svg>
                            <div class="product-deals-modal-item__urgency__title">
                                Offer Valid Until <?php echo date("F j, Y", strtotime($expiry_date)); ?>
                                <div class="product-deals-modal-item__urgency__title__sub">
                                    <?php echo getDaysUntilExpiry($expiry_date) ?> Days Remaining
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>


        </div>
    </div>
</div>