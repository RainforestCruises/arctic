<?php

$ships = get_field('ships');
$overview_content = get_field('overview_content');
$activities = get_field('activities');

$expand = strlen($overview_content) > 950 ? true : false;
$overview_content_limited = substr($overview_content, 0, 950) . '...';
?>
<!-- Cruise Overview -->
<section class="cruise-overview" id="section-highlights">

    <div class="cruise-overview__content">

        <!-- Grid  -->
        <div class="cruise-overview__content__grid">

            <!-- Main Overview (Highlights, Transport, Text) -->
            <div class="cruise-overview__content__grid__overview">

                <!-- Highlights -->
                <div class="cruise-overview__content__grid__overview__highlights">
                    <h3 class="title-single">Highlights</h3>
                    <ul class="cruise-overview__content__grid__overview__highlights__list">
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
                <div class="cruise-overview__content__grid__overview__text ">
                    <?php echo $overview_content_limited; ?>
                </div>

                <div class="cruise-overview__content__grid__overview__expand">
                    <?php if ($expand) : ?>
                        <button class="btn-text-icon" id="expand-content">
                            Read More
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>


            <!-- Side Section -->
            <div class="cruise-overview__content__grid__secondary">

                <!-- Ships Panel -->
                <div class="outline-panel">

                    <!-- Panel Heading -->
                    <div class="outline-panel__heading">
                        <h5 class="outline-panel__heading__text">
                            Ships
                        </h5>
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
                                <div class="itinerary-ships__item">

                                    <a class="itinerary-ships__item__avatar" href="<?php echo get_permalink($ship); ?>">
                                        <img <?php afloat_image_markup($ship_image['id'], 'square-small', array('square-small')); ?>>
                                    </a>
                                    <div class="itinerary-ships__item__title-group">
                                        <a class="itinerary-ships__item__title-group__title" href="<?php echo get_permalink($ship); ?>">
                                            <?php echo get_the_title($ship); ?>
                                        </a>
                                        <div class="itinerary-ships__item__title-group__text">
                                            <?php echo get_field('top_snippet', $ship); ?>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

                <!-- activities Panel -->
                <div class="outline-panel">
                    <!-- Panel Heading -->
                    <div class="outline-panel__heading">
                        <h5 class="outline-panel__heading__text">
                            Activities
                        </h5>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                        </svg>
                    </div>
                    <!-- Panel Content -->
                    <div class="outline-panel__content">
                        <div class="ammenities">
                            <?php foreach ($activities as $a) :
                                $activity_post = $a['standard_activity'];
                                $icon = get_field('icon', $activity_post);
                                $title = $a['title_override'] == "" ? get_the_title($activity_post) : $a['title_override'];
                                $subtitle = $a['subtitle'];
                            ?>

                                <div class="ammenities__item">
                                    <?php echo $icon ?>

                                    <div class="ammenities__item__title-group">
                                        <div class="ammenities__item__title-group__title">
                                            <?php echo $title ?>
                                        </div>
                                        <?php if ($subtitle != "") : ?>
                                            <div class="ammenities__item__title-group__sub">
                                                <?php echo $subtitle ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>

               
            </div>
        </div>
    </div>
</section>


<!-- Content Modal -->
<div class="modal" id="contentModal">
    <div class="modal__content"">
        <div class=" modal__content__top">
        <!-- Top Modal Content -->
        <div class="modal__content__top__nav">
            <div class="modal__content__top__nav__title">
                About the <?php echo get_field('display_name'); ?>
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
    <div class="modal__content__main">
        <?php echo $overview_content; ?>
    </div>
</div>
</div>