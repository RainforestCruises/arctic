<?php


$destinations = $args['destinations'];



?>



<div class="deals-destinations">
    <h2 class="deals-destinations__title">
        <?php echo get_field('destination_slider_title') ?>
    </h2>
    <div class="deals-destinations__slider" id="destinations-slider">
        <?php if ($destinations) : ?>
            <?php foreach ($destinations as $d) :
                $destinationPost = $d['destination'];
                $slideTitle = get_field('navigation_title', $destinationPost);
                $image = $d['image'];
            ?>
                


                <a href="<?php echo $d['page_link'] ?>" class="card-square">
                    <div class="card-square__title-group">
                        <div class="card-square__title-group__level">
                            
                        </div>
                        <div>
                            <h4 class="card-square__title-group__name">
                                <?php echo  $slideTitle ?>
                            </h4>
                            <div class="card-square__title-group__subtext">
                            <?php  echo deals_available($destinationPost);?> Deals
                            </div>
                        </div>

                    </div>
                    <div class="card-square__image-area">
                        <img <?php afloat_image_markup($image['id'], 'square-medium'); ?> alt="">

                    </div>

                </a>


                 

        <?php endforeach;
        endif; ?>

    </div>


</div>