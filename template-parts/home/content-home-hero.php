<?php

$hero_slider = get_field('hero_slider');

$destinationPoints = [];
foreach ($hero_slider as $s) {

    $destination = $s['destination']; //destination or region post
    $destinationPostId = $destination->ID;
    $isRegion = get_post_type($destination) == 'rfc_regions';

    if (!$isRegion) {

        $geometry = [
            'type' => "Point",
            'coordinates' => [get_field('longitude', $destination), get_field('latitude', $destination)],
        ];

        $zoomPoint = [
            'longitude' => get_field('longitude', $destination),
            'latitude' => get_field('latitude', $destination),
        ];

        $point  = [
            'title' => get_field('navigation_title', $destination),
            'postid' => $destination->ID,
            'geometry' => $geometry,
            'zoomPoint' => $zoomPoint,
            'zoomLevel' => get_field('zoom_level', $destination),
        ];

        $destinationPoints[] = $point;
    }
}


wp_enqueue_script('page-home-hero', get_template_directory_uri() . '/js/page-home-hero.js', array(), false, true);
wp_localize_script(
    'page-home-hero',
    'page_vars',
    array(
        'destinationPoints' =>  $destinationPoints
    )
);

?>

<!--  Hero -->
<div class="home-hero hero">

    <div class="btn-pill-hero" id="back-cta">
        Back
    </div>

    <!-- Background Slider -->
    <div class="home-hero__bg">

        <?php
        $slideCount = 0;
        foreach ($hero_slider as $s) :
            $sliderImage = $s['image'];
            $sliderTitle = $s['title'];
            $sliderDestination = $s['destination'];
            $sliderDestinationPostId = null;
            if ($sliderDestination) {
                $sliderDestinationPostId = $sliderDestination->ID;
            }
        ?>
            <div class="home-hero__bg__slide" postid="<?php echo $sliderDestinationPostId ?>" slidenumber="<?php echo $slideCount; ?>">
                <img <?php afloat_image_markup($sliderImage['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall'), false); ?>>
            </div>
        <?php $slideCount++;
        endforeach; ?>
    </div>



    <!-- Base Content (Page Width Full) -->
    <div class="home-hero__content">

        <!-- Map -->
        <div class="home-hero__content__map" id="hero-map"></div>

        <!-- Main Slider -->
        <div class="home-hero__content__main-slider">

            <!-- Region Slide -->
            <!-- Slide 0 -->
            <div class="main-slider-slide" postid="region" slidenumber="0">
                <!-- Loop Regions, TODO: Tabs-->
                <?php
                foreach ($hero_slider as $s) :
                    $is_toplevel = $s['is_toplevel'];
                    if ($is_toplevel) :
                        $region = $s['region'];
                        $regionPostId = $region->ID;
                        $title = $s['title'];
                        $subtitle = $s['subtitle'];
                        $snippet = $s['snippet'];
                ?>

                        <!-- New Tab Content container Here -->
                        <div class="main-slider-slide__primary">
                            <h1 class="main-slider-slide__primary__subtitle">
                                <?php echo $subtitle ?>
                            </h1>
                            <div class="main-slider-slide__primary__title">
                                <?php echo $title ?>
                            </div>
                            <div class="main-slider-slide__primary__snippet">
                                <?php echo $snippet ?>
                            </div>
                        </div>

                        <div class="main-slider-slide__explore-cta">
                            <div class="btn-pill-hero" id="explore-cta">
                                Explore Map
                            </div>
                        </div>

                        <!-- Regional Nav (Tabs) -->
                        <div class="main-slider-slide__region-nav">
                            <div class="main-slider-slide__region-nav__item">
                                Antarctica
                            </div>
                            <div class="main-slider-slide__region-nav__item">
                                Arctic
                            </div>
                        </div>

                <?php endif;
                endforeach; ?>
            </div>
            <!-- End Regions -->


            <!-- Destination Slides -->
            <!-- Loop Destinations -->
            <?php
            $slideCount = 1;
            foreach ($hero_slider as $s) :
                $is_toplevel = $s['is_toplevel'];
                if (!$is_toplevel) :
                    $title = $s['title'];
                    $subtitle = $s['subtitle'];
                    $destination = $s['destination']; //destination
                    $destinationPostId = $destination->ID;
                    $tab_items = $s['tab_items'];
            ?>

                    <!-- Slide -->
                    <div class="main-slider-slide" postid="<?php echo $destinationPostId ?>" slidenumber="<?php echo $slideCount; ?>">
                        <!-- Primary -->
                        <div class="main-slider-slide__primary">
                            <h1 class="main-slider-slide__primary__subtitle">
                                <?php echo $subtitle ?>
                            </h1>
                            <div class="main-slider-slide__primary__title">
                                <?php echo $title ?>
                            </div>
                        </div>


                        <!-- Secondary -->
                        <div class="main-slider-slide__secondary">


                            <!-- Tabs -->
                            <div class="main-slider-slide__secondary__tabs">

                                <?php
                                $tabIndex = 0;
                                foreach ($tab_items as $tab) :
                                    $content_type = $tab['content_type'];

                                    // Icon Tab
                                    if ($content_type == 'about') : ?>
                                        <button class="main-slider-slide__secondary__tabs__button btn-pill-hero btn-pill-hero--circular active" slideindex="<?php echo $slideCount; ?>" tabindex="<?php echo $tabIndex; ?>">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-06"></use>
                                            </svg>
                                        </button>
                                    <?php else : //Text Tab
                                        if ($content_type == 'cruise') {
                                            $title = 'Cruises';
                                        } else if ($content_type == 'itinerary') {
                                            $title = 'Itineraries';
                                        } else if ($content_type == 'experience') {
                                            $title = 'Experiences';
                                        } else if ($content_type == 'location') {
                                            $title = 'Locations';
                                        }
                                    ?>
                                        <button class="main-slider-slide__secondary__tabs__button btn-pill-hero" slideindex="<?php echo $slideCount; ?>" tabindex="<?php echo $tabIndex; ?>">
                                            <?php echo $title; ?>
                                        </button>
                                    <?php endif; ?>

                                <?php $tabIndex++;
                                endforeach; ?>

                            </div>
                            <!-- End Tabs -->

                            <!-- Panels -->
                            <div class="main-slider-slide__secondary__panels">

                                <?php
                                $tabIndex = 0;
                                foreach ($tab_items as $tab) :
                                    $content_type = $tab['content_type'];
                                    if ($content_type == 'about') :
                                        $snippet = $tab['snippet'];
                                ?>
                                        <!-- Panel text -->
                                        <div class="main-slider-slide__secondary__panels__panel panel-text active" slideindex="<?php echo $slideCount; ?>" tabindex="<?php echo $tabIndex; ?>">
                                            <?php echo $snippet; ?>
                                        </div>
                                    <?php else :
                                        $items = [];
                                        if ($content_type == 'cruise') {
                                            $items = $tab['cruises'];
                                        } else if ($content_type == 'itinerary') {
                                            $items = $tab['itineraries'];
                                        } else if ($content_type == 'experience') {
                                            $items = $tab['experiences'];
                                        } else if ($content_type == 'location') {
                                            $items = $tab['locations'];
                                        }
                                    ?>

                                        <!-- Panel Series -->
                                        <div class="main-slider-slide__secondary__panels__panel panel-series" slideindex="<?php echo $slideCount; ?>" tabindex="<?php echo $tabIndex; ?>">
                                            <div class="swiper-wrapper">
                                                <?php
                                                foreach ($items as $item) :
                                                    $image =  get_field('hero_image_portrait', $item);
                                                    $title = get_the_title($item);
                                                    $link = get_the_permalink($item);
                                                ?>

                                                    <a class="swiper-slide resource-card small inverse shadow" href="<?php echo $link; ?>">
                                                        <div class="resource-card__image-area">
                                                            <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                                                        </div>
                                                        <div class="resource-card__content">

                                                            <!-- Title -->
                                                            <div class="resource-card__content__title-group-vertical">
                                                                <div class="resource-card__content__title-group-vertical__title">
                                                                    <?php echo $title; ?>
                                                                </div>
                                                                <div class="resource-card__content__title-group-vertical__sub">
                                                                    Starting at $4,399
                                                                </div>

                                                            </div>


                                                        </div>

                                                    </a>
                                                <?php
                                                endforeach;
                                                ?>
                                            </div>

                                        </div>

                                    <?php endif; ?>

                                <?php $tabIndex++;
                                endforeach;

                                ?>


                            </div>

                        </div>
                    </div>
                    <!-- End Content Slide -->


            <?php $slideCount++;
                endif;
            endforeach; ?>



        </div>

    </div>
</div>