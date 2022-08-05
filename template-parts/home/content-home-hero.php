<?php

$hero_slider = get_field('hero_slider');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
?>

<!--  Hero -->
<div class="home-hero hero">

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
                $isRegion = get_post_type($destination) == 'rfc_regions';

                $tab_items = $s['tab_items'];

            ?>

                <!-- Content Slide -->
                <div class="hero-content-slide <?php echo $isRegion ? "regional" : ""; ?>" postid="<?php echo $destinationPostId ?>" slidenumber="<?php echo $slideCount; ?>">
                    <h1 class="hero-content-slide__subtitle">
                        <?php echo $subtitle ?>
                    </h1>
                    <div class="hero-content-slide__title">
                        <?php echo $title ?>
                    </div>

                    <!-- Content -->
                    <div class="hero-content-slide__content">


                        <!-- Tabs -->
                        <div class="hero-content-slide__content__tabs">

                            <?php
                            $tabIndex = 0;
                            foreach ($tab_items as $tab) :
                                $title = $tab['title'];
                                $svg = $tab['svg'];
                                $content_type = $tab['content_type'];
                                $iconTab = $svg != "";
                            ?>

                                <?php if ($iconTab) : ?>
                                    <div class="btn-pill-hero btn-pill-hero--circular active" tabindex="<?php echo $tabIndex; ?>">
                                        <?php echo $svg; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="btn-pill-hero" tabindex="<?php echo $tabIndex; ?>">
                                        <?php echo $title; ?>
                                    </div>
                                <?php endif; ?>

                            <?php $tabIndex++;
                            endforeach; ?>

                        </div>
                        <!-- End Tabs -->
                        <div class="hero-content-slide__content__panels">

                            <?php
                            $tabIndex = 0;
                            foreach ($tab_items as $tab) :
                                $title = $tab['title'];
                                $svg = $tab['svg'];
                                $iconTab = $svg != "";

                                $content_type = $tab['content_type'];
                                $snippet = $tab['snippet'];
                                $item = $tab['cruises']; //wip
                                $item = $tab['itineraries'];
                            ?>

                                <?php if ($content_type == 'snippet') : ?>
                                    <!-- Panel Snippet -->
                                    <div class="hero-content-slide__content__panels__panel-snippet">
                                        <?php echo $snippet; ?> 
                                    </div>
                                <?php else : ?>
                                    <!-- Panel Series -->
                                    <div class="hero-content-slide__content__panels__panel-series">
                                        Series
                                    </div>
                                <?php endif; ?>




                            <?php $tabIndex++;
                            endforeach; ?>
                        </div>

                    </div>
                </div>
                <!-- End Content Slide -->




            <?php $slideCount++;
            endforeach; ?>




        </div>



    </div>





</div>