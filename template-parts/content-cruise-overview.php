<?php

$map_image = get_field('map_image');
$ship = get_field('ship');

$ship_featured_image = get_field('featured_image', $ship);
$ship_snippet = get_field('top_snippet', $ship);
$cruise_data = $args['cruiseData'];
?>
<section class="cruise-overview" id="overview">

    <div class="cruise-overview__content">

        <!-- Grid  -->
        <div class="cruise-overview__content__grid">

            <!-- Overview (Highlights, Transport, Text) -->
            <div class="cruise-overview__content__grid__overview">

                <!-- Highlights -->
                <div class="cruise-overview__content__grid__overview__highlights">
                    <h3 class="arctic-heading-3">Overview</h3>
                    <ul class="cruise-overview__content__grid__overview__highlights__list">
                        <?php if (have_rows('highlights')) : ?>
                            <?php while (have_rows('highlights')) : the_row(); ?>
                                <li>

                                    <span>&#8212;</span><?php echo get_sub_field('highlight'); ?>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>


                <!-- Text -->
                <div class="cruise-overview__content__grid__overview__text ">
                    <?php echo get_field('overview_content') ?>
                </div>
            </div>


            <!-- Secondary -->
            <div class="cruise-overview__content__grid__secondary">
                
                <div class="specs">
                    <div class="specs__title">
                        Specifications
                    </div>

                    <div class="specs__grid">


                    <!-- Guests -->
                    <div class="specs__grid__item">
                        <div class="specs__grid__item__title">
                            Guests
                        </div>
                        <div class="specs__grid__item__text">
                            <?php echo get_field('vessel_capacity') ?>
                        </div>
                    </div>

                    <!-- Crew -->
                    <div class="specs__grid__item">
                        <div class="specs__grid__item__title">
                            Staff & Crew
                        </div>
                        <div class="specs__grid__item__text">
                            <?php echo get_field('crew') ?>
                        </div>
                    </div>

                    <!-- Zodiacs -->
                    <div class="specs__grid__item">
                        <div class="specs__grid__item__title">
                        Zodiacs
                        </div>
                        <div class="specs__grid__item__text">
                            <?php echo get_field('zodiacs') ?>
                        </div>
                    </div>

                     <!-- Year Built -->
                     <div class="specs__grid__item">
                        <div class="specs__grid__item__title">
                        Year Built
                        </div>
                        <div class="specs__grid__item__text">
                            <?php echo get_field('year_built') ?>
                        </div>
                    </div>
                    
                    <!-- Ice Class -->
                    <div class="specs__grid__item">
                        <div class="specs__grid__item__title">
                        Ice Class
                        </div>
                        <div class="specs__grid__item__text">
                            <?php echo get_field('ice_class') ?>
                        </div>
                    </div>
                    
                    <!-- Length -->
                    <div class="specs__grid__item">
                        <div class="specs__grid__item__title">
                        Length
                        </div>
                        <div class="specs__grid__item__text">
                            <?php echo get_field('length') ?>
                        </div>
                    </div>
                    
                    <!-- Breadth -->
                    <div class="specs__grid__item">
                        <div class="specs__grid__item__title">
                        Breadth
                        </div>
                        <div class="specs__grid__item__text">
                            <?php echo get_field('breadth') ?>
                        </div>
                    </div>
                    
                    <!-- Draft -->
                    <div class="specs__grid__item">
                        <div class="specs__grid__item__title">
                        Draft
                        </div>
                        <div class="specs__grid__item__text">
                            <?php echo get_field('draft') ?>
                        </div>
                    </div>
                    
                    <!-- Speed -->
                    <div class="specs__grid__item">
                        <div class="specs__grid__item__title">
                            Cruising Speed
                        </div>
                        <div class="specs__grid__item__text">
                            <?php echo get_field('speed') ?>
                        </div>
                    </div>


                    </div>
                    
                    
                 

                </div>

            </div>


        </div>



    </div>
</section>