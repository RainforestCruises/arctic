<?php
$deals = $args['deals'];
$specialDepartures = $args['specialDepartures'];
$combinedDeals = array_merge($deals, $specialDepartures);

$sectionTitle = "";
$subtitleDisplay = "";


if ($deals && !$specialDepartures) {
    $subtitleDisplay = 'Explore ' .  getDealsDisplay($deals) . ' on select dates';
    $sectionTitle = 'Deals';
}

if (!$deals && $specialDepartures) {
    $subtitleDisplay = 'Explore ' . getDealsDisplay($specialDepartures, true) . ' on select dates';
    $sectionTitle = 'Special Departures';
}

if ($deals && $specialDepartures) {
    $subtitleDisplay = 'Explore ' . getDealsDisplay($specialDepartures) . ' and ' . getDealsDisplay($specialDepartures, true) . ' on select dates';
    $sectionTitle = 'Deals & Special Departures';
}

?>

<section class="slider-block narrow" id="deals">
    <div class="slider-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <h2 class="title-group__title">
                    <?php echo $sectionTitle; ?>
                </h2>
                <div class="title-group__sub">
                    <?php echo $subtitleDisplay; ?>
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
                    foreach ($combinedDeals as $deal) :
                        $id = $deal->ID;
                        $image = get_field('featured_image', $deal);
                        $title = get_field('navigation_title', $deal);
                        $has_expiry_date = get_field('has_expiry_date', $deal);
                        $expiry_date =  get_field('expiry_date', $deal);
                        $is_special_departure = get_field('is_special_departure', $deal);

                        $description = get_field('description', $deal);
                        $expand = strlen($description) > 320 ? true : false;
                        $description_limited = substr($description, 0, 320);
                        if ($expand) {
                            $description_limited .= '...';
                        }

                    ?>
                        <div class="deal-card swiper-slide">
                            <!-- Title Group -->
                            <div class="deal-card__section">
                                <div class="avatar avatar--small">
                                    <div class="avatar__image-area">
                                        <img <?php afloat_image_markup($image['id'], 'square-thumb', array('square-thumb')); ?>>
                                    </div>
                                    <div class="avatar__title-group">
                                        <h3 class="avatar__title-group__title" style="margin-bottom: 0;">
                                            <?php echo  $title; ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="deal-card__description">
                                <?php echo $description_limited ?>
                            </div>

                            <div class="deal-card__urgency <?php echo $is_special_departure ? "deal-card__urgency--special" : ""; ?>">
                                <?php if ($is_special_departure) : ?>
                                    <svg class="deal-card__urgency__icon">
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                    </svg>
                                    <div class="deal-card__urgency__text">
                                        Special Departure
                                    </div>
                                <?php else : ?>
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
                                <?php endif; ?>

                                <div class="deal-card__urgency__cta">
                                    <button class="cta-square-icon <?php echo $is_special_departure ? "special-departure-cta" : "" ?> deal-cta" dealId="<?php echo $id ?>">
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
                <div class="modal__content__top__nav__title" id="dealsModalTitle">
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
            foreach ($combinedDeals as $deal) :
                $id = $deal->ID;
                $image = get_field('featured_image', $deal);
                $title = get_field('navigation_title', $deal);
                $description = get_field('description', $deal);
                $terms_and_conditions = get_field('terms_and_conditions', $deal);
                $has_expiry_date = get_field('has_expiry_date', $deal);
                $expiry_date =  get_field('expiry_date', $deal);
                $is_special_departure = get_field('is_special_departure', $deal);

            ?>

                <div class="product-deals-modal-item" dealId="<?php echo $id; ?>">
                    <div class="product-deals-modal-item__title">
                        <?php echo $title; ?>
                    </div>
                    <div class="product-deals-modal-item__image-area">
                        <img <?php afloat_image_markup($image['id'], 'landscape-small', array('landscape-small', 'portrait-small')); ?>>
                    </div>

                    <div class="product-deals-modal-item__description">
                        <?php echo $description; ?>
                    </div>
                    <?php if ($terms_and_conditions) : ?>
                        <h4>Terms & Conditions</h4>
                        <ul class="highlight-list">
                            <?php foreach ($terms_and_conditions as $term) : ?>
                                <li>
                                    <span>&#8212;</span>
                                    <?php echo $term['condition'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="product-deals-modal-item__cta">
                        <div class="product-deals-modal-item__cta__urgency-area">
                            <?php if ($has_expiry_date) : ?>
                                <div class="urgent-deal">
                                    <svg class="urgent-deal__icon">
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-stopwatch"></use>
                                    </svg>
                                    <div class="urgent-deal__title">
                                        Offer Valid Until <?php echo date("F j, Y", strtotime($expiry_date)); ?>
                                        <div class="urgent-deal__title__sub">
                                            <?php echo getDaysUntilExpiry($expiry_date) ?> Days Remaining
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="product-deals-modal-item__cta__button-area">
                            <a class="cta-square-icon" href="<?php echo get_permalink($deal) ?>" target="_blank">
                                <span id="dealsModalCtaText">View Page</span>

                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>



                </div>
            <?php endforeach; ?>


        </div>
    </div>
</div>