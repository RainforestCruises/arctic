<?php
$queryArgs = array(
    'post_type' => 'rfc_travel_guides',
    'posts_per_page' => -1,
);

$posts = get_posts($queryArgs);
?>

<section class="guides-toplevel-main">
    <div class="guides-toplevel-main__content">
        <div class="guides-toplevel-main__content__results" id="results">

            <?php
            if ($posts) :
                foreach ($posts as $p) :
                    $featured_image = get_field('featured_image', $p);
                    $imageID = '';
                    if ($featured_image) {
                        $imageID = $featured_image['ID'];
                    }
                    $guideCategories = get_field('categories', $p);
                    $isoClasses = '';
                    if ($guideCategories) {
                        foreach ($guideCategories as $c) {
                            $isoClasses = $isoClasses . ' ' . $c->post_name;
                        };
                    };

            ?>

                    <div class="guide-item <?php echo $isoClasses ?>">
                        <a class="guide-item__image-area" href="<?php echo the_permalink($p) ?>">
                            <img <?php afloat_image_markup($imageID, 'featured-medium'); ?>>
                        </a>
                        <div class="guide-item__bottom">
                            <ul class="guide-item__bottom__category">
                                <?php if ($guideCategories) :
                                    foreach ($guideCategories as $c) : ?>
                                        <li>
                                            <?php
                                            $catTitle = get_the_title($c);
                                            echo trim($catTitle);
                                            ?>
                                        </li>
                                <?php endforeach;
                                endif;  ?>
                            </ul>
                            <a class="guide-item__bottom__title" href="<?php echo the_permalink($p) ?>">

                                <h3>
                                    <?php echo get_field('navigation_title', $p); ?>
                                </h3>

                            </a>
                            <div class="guide-item__bottom__snippet">
                                <?php
                                echo get_the_excerpt($p);
                                ?>
                            </div>
                            <div class="guide-item__bottom__cta">
                                <a class="goto-button goto-button--dark" href="<?php echo the_permalink($p) ?>">
                                    Read More
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>


            <?php
                endforeach;
            endif;
            ?>
        </div>
        <div class="guides-toplevel-main__content__no-results" id="no-results-message">
            No travel guides available. Please select another category.
        </div>
    </div>



</section>