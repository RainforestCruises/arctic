<?php

$ships = $args['ships'];
$overview_content = get_field('overview_content');
$activities = get_field('activities');

$max_items = 6;
$firstActivities = array_slice($activities, 0, $max_items);
$expandItems = count($activities) > $max_items ? true : false;

$expand = strlen($overview_content) > 2000 ? true : false;
$overview_content_limited = substr($overview_content, 0, 2000);
if($expand){
    $overview_content_limited .= '...';
}

?>

<!-- Itinerary Overview (highlights) -->
<section class="product-overview" id="highlights">

    <div class="product-overview__content">

        <!-- Grid  -->
        <div class="product-overview__content__grid">

            <!-- Main Overview (Highlights, Transport, Text) -->
            <div class="product-overview__content__grid__overview">

                <!-- Highlights -->
                <div class="product-overview__content__grid__overview__highlights">
                    <h2 class="title-single">Highlights</h2>
                    <ul class="highlight-list">
                        <?php if (have_rows('highlights')) : ?>
                            <?php while (have_rows('highlights')) : the_row(); ?>
                                <li>
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-diamonds-suits"></use>
                                    </svg>
                                    <?php echo get_sub_field('highlight'); ?>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Text -->
                <div class="product-overview__content__grid__overview__text ">
                    <?php echo $overview_content_limited; ?>
                </div>

                <div class="product-overview__content__grid__overview__expand">
                    <?php if ($expand) : ?>
                        <button class="btn-text " id="expand-content">
                            Read More
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>


            <!-- Side Section -->
            <div class="product-overview__content__grid__secondary">

                <!-- Ships Panel -->
                <div class="outline-panel">

                    <!-- Panel Heading -->
                    <div class="outline-panel__heading">
                        <h2 class="outline-panel__heading__text">
                            Ships
                        </h2>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                        </svg>
                    </div>

                    <!-- Panel Content -->
                    <div class="outline-panel__content">

                        <!-- Ships Grid -->
                        <div class="itinerary-ships">
                            <?php foreach ($ships as $ship) :
                                $hero_gallery = get_field('hero_gallery', $ship);
                                $ship_image = $hero_gallery[0];
                            ?>
                                <!-- Ship -->
                                <div class="avatar">

                                    <a class="avatar__image-area" href="<?php echo get_permalink($ship); ?>">
                                        <img <?php afloat_image_markup($ship_image['id'], 'square-thumb', array('square-thumb')); ?>>
                                    </a>
                                    <div class="avatar__title-group">
                                        <h3 class="avatar__title-group__title">
                                            <a href="<?php echo get_permalink($ship); ?>"><?php echo get_the_title($ship); ?></a>
                                        </h3>
                                        <div class="avatar__title-group__sub">
                                            <?php echo get_field('top_snippet', $ship); ?>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

                <!-- Activities Panel -->
                <div class="outline-panel">

                    <!-- Panel Heading -->
                    <div class="outline-panel__heading">
                        <h2 class="outline-panel__heading__text">
                            Standard Activities
                        </h2>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                        </svg>
                    </div>

                    <!-- Panel Content -->
                    <div class="outline-panel__content">
                        <div class="product-overview__content__grid__secondary__items">
                            <?php foreach ($firstActivities as $a) :
                                $activity_post = $a['standard_activity'];
                                $icon = get_field('icon', $activity_post);
                                $title = $a['title_override'] == "" ? get_the_title($activity_post) : $a['title_override'];
                                $subtitle = $a['subtitle'];
                            ?>
                                <div class="icon-item">
                                    <?php echo $icon ?>
                                    <div class="icon-item__title-group">
                                        <div class="icon-item__title-group__title">
                                            <?php echo $title ?>
                                        </div>
                                        <?php if ($subtitle != "") : ?>
                                            <div class="icon-item__title-group__sub">
                                                <?php echo $subtitle ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="outline-panel__content__expand">
                            <?php if ($expandItems) : ?>
                                <button class="btn-text" id="expand-items">
                                    View All <?php echo count($activities); ?> Activities
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</section>


<!-- Content Modal -->
<div class="modal" id="contentModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <h2 class="modal__content__top__nav__title">
                    About the <?php echo get_field('display_name'); ?>
                </h2>
            </div>
            <button class="btn-text btn-text--bg close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main">
            <?php echo $overview_content; ?>
        </div>
    </div>
</div>



<!-- Items Modal -->
<div class="modal" id="itemsModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    <?php echo $productName; ?> Activities
                </div>
            </div>
            <button class="btn-text btn-text--bg close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main" id="contentModalMain">
            <?php foreach ($activities as $a) :
                $activity_post = $a['standard_activity'];
                $icon = get_field('icon', $activity_post);
                $title = $a['title_override'] == "" ? get_the_title($activity_post) : $a['title_override'];
                $subtitle = $a['subtitle'];
            ?>

                <div class="icon-item icon-item--full">
                    <?php echo $icon ?>

                    <div class="icon-item__title-group">
                        <div class="icon-item__title-group__title">
                            <?php echo $title ?>
                        </div>
                        <?php if ($subtitle != "") : ?>
                            <div class="icon-item__title-group__sub">
                                <?php echo $subtitle ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>