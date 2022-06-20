<?php
$featured_bucket_list_destinations = get_field('featured_second');
$featured_bucket_list_title_subtext = get_field('featured_second_title_subtext');

?>

<div class="home-featured home-featured--bucket-list">
    <div class="home-featured__header">
        <h2 class="home-featured__header__title page-divider">
            Bucket List
        </h2>
        <div class="home-featured__header__sub-text">
            <?php echo $featured_bucket_list_title_subtext ?>
        </div>
    </div>
    <div class="home-featured__content-area">
        <div class="home-featured__content-area__slider" id="featured-bucket">
            <?php if ($featured_bucket_list_destinations) :
                foreach ($featured_bucket_list_destinations as $b) :
                    $b_page = $b['bucket_list']; //get permalink
                    $b_snippet = $b['snippet'];
                    $b_title = $b['title'];
                    $b_image = $b['image'];
                    $b_linktext = $b['link_text'];

            ?>
                    <!-- Cruise Item -->
                    <div class="home-featured-item ">

                        <div class="home-featured-item__content home-featured-item__content--inverse">
                            <h3 class="home-featured-item__content__title">
                                <?php echo $b_title ?>
                            </h3>
                            <div class="home-featured-item__content__text">
                                <?php echo $b_snippet ?>
                            </div>
                            <div class="home-featured-item__content__cta ">
                                <a href="<?php echo $b_page ?>" class="goto-button goto-button--dark  goto-button--small"><?php echo $b_linktext ?>
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <a href="<?php echo $b_page ?>" class="home-featured-item__image-area home-featured-item__image-area--inverse">
                            <img <?php afloat_image_markup($b_image['id'], 'featured-square'); ?>>
                        </a>
                    </div>

            <?php endforeach;
            endif; ?>



        </div>

    </div>
</div>