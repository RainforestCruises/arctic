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

    <div class="btn-pill-hero" id="mobile-map-return-cta">
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

    <!-- Map -->
    <div class="home-hero__map" id="hero-map"></div>

    <!-- Content -->
    <div class="home-hero__content">

        <!-- Content Slider -->
        <div class="home-hero__content__slider">

            <?php
            $slideCount = 0;
            foreach ($hero_slider as $s) :
                $title = $s['title'];
                $subtitle = $s['subtitle'];

                $destination = $s['destination']; //destination or region post
                $destinationPostId = $destination->ID;
                $is_toplevel = $s['is_toplevel'];
                $tab_items = $s['tab_items'];

            ?>

                <!-- Content Slide -->
                <div class="hero-content-slide <?php echo $is_toplevel ? "regional" : ""; ?>" postid="<?php echo $destinationPostId ?>" slidenumber="<?php echo $slideCount; ?>">
                    <h1 class="hero-content-slide__subtitle">
                        <?php echo $subtitle ?>
                    </h1>
                    <div class="hero-content-slide__title">
                        <?php echo $title ?>
                    </div>

                    <!-- Content -->
                    <div class="hero-content-slide__content">


                        <!-- Tabs -->
                        <?php if (!$is_toplevel) : ?>
                            <div class="hero-content-slide__content__tabs">

                                <?php
                                $tabIndex = 0;
                                foreach ($tab_items as $tab) :
                                    $content_type = $tab['content_type'];

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

                                    <?php if ($content_type == 'about') : ?>
                                        <button class="hero-content-slide__content__tabs__button btn-pill-hero btn-pill-hero--circular active" slideindex="<?php echo $slideCount; ?>" tabindex="<?php echo $tabIndex; ?>">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-06"></use>
                                            </svg>
                                        </button>
                                    <?php else : ?>
                                        <button class="hero-content-slide__content__tabs__button btn-pill-hero" slideindex="<?php echo $slideCount; ?>" tabindex="<?php echo $tabIndex; ?>">
                                            <?php echo $title; ?>
                                        </button>
                                    <?php endif; ?>

                                <?php $tabIndex++;
                                endforeach; ?>

                            </div>
                        <?php endif; ?>
                        <!-- End Tabs -->

                        <!-- Panels -->
                        <div class="hero-content-slide__content__panels">

                            <?php if ($is_toplevel) :
                                $snippet = $s['snippet'];
                            ?>
                                <div class="hero-content-slide__content__panels__static" slideindex="<?php echo $slideCount; ?>" tabindex="<?php echo $tabIndex; ?>">
                                    <?php echo $snippet; ?>
                                    <div class="hero-content-slide__content__panels__static__cta">
                                        <div class="btn-pill-hero" id="mobile-map-cta">
                                            Explore Map
                                        </div>
                                    </div>

                                </div>

                                <?php else :
                                $tabIndex = 0;
                                foreach ($tab_items as $tab) :
                                    $content_type = $tab['content_type'];
                                    $snippet = $tab['snippet'];
                                ?>

                                    <?php if ($content_type == 'about') : ?>
                                        <!-- Panel text -->
                                        <div class="hero-content-slide__content__panels__panel panel-text active" slideindex="<?php echo $slideCount; ?>" tabindex="<?php echo $tabIndex; ?>">
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
                                        <div class="hero-content-slide__content__panels__panel panel-series" slideindex="<?php echo $slideCount; ?>" tabindex="<?php echo $tabIndex; ?>">
                                            <?php
                                            foreach ($items as $i) :
                                                $image =  get_field('hero_image_portrait', $i);
                                                $title = get_the_title($i);
                                                $link = get_the_permalink($i);
                                            ?>

                                                <a class="resource-card small inverse shadow" href="<?php echo $link; ?>">
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

                                    <?php endif; ?>

                            <?php $tabIndex++;
                                endforeach;

                            endif; ?>


                        </div>

                    </div>
                </div>
                <!-- End Content Slide -->




            <?php $slideCount++;
            endforeach; ?>




        </div>



    </div>





</div>