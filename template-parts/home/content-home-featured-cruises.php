<?php
$featured_cruise_destinations = get_field('featured');
$featured_cruise_subtext = get_field('featured_title_subtext');

?>

<div class="home-featured">
    <div class="home-featured__header">
        <h2 class="home-featured__header__title page-divider">
            Expedition Cruises
        </h2>
        <div class="home-featured__header__sub-text">
            <?php echo $featured_cruise_subtext ?>
        </div>
    </div>
    <div class="home-featured__content-area">
        <div class="home-featured__content-area__slider" id="featured-cruises">
            <?php if ($featured_cruise_destinations) :
                foreach ($featured_cruise_destinations as $c) :
                    $cruise_page = $c['cruise_page']; //get permalink
                    $c_snippet = $c['snippet'];
                    $c_title = $c['title'];
                    $c_image = $c['image'];
                    $c_linktext = $c['link_text'];
            ?>
                    <!-- Cruise Item -->
                    <div class="home-featured-item">

                        <div class="home-featured-item__content">
                            <h3 class="home-featured-item__content__title">
                                <?php echo $c_title ?>
                            </h3>
                            <div class="home-featured-item__content__text">
                                <?php echo $c_snippet ?>
                            </div>
                            <div class="home-featured-item__content__cta">
                                <a href="<?php echo $cruise_page ?>" class="goto-button goto-button--dark goto-button--small"><?php echo $c_linktext ?>
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <a href="<?php echo $cruise_page ?>" class="home-featured-item__image-area">
                        <img  <?php afloat_image_markup($c_image['id'], 'featured-square'); ?>>

                        </a>
                    </div>

            <?php endforeach;
            endif; ?>



        </div>

    </div>
</div>