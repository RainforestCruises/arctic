<?php 

//related posts
$queryArgs = array(
    'post_type' => 'rfc_travel_guides',
    'posts_per_page' => 9,
    'post__not_in' => array($post->ID)
  );
  
  // $queryArgsDestination = array();
  // $queryArgsDestination['relation'] = 'OR';
  // $destinations = get_field('destinations');
  // if ($destinations) {
  //   foreach ($destinations as $d) {
  //     $queryArgsDestination[] = array(
  //       'key'     => 'destinations',
  //       'value'   =>  '"' . $d->ID . '"',
  //       'compare' => 'LIKE'
  //     );
  //   }
  // };
  
  // $queryArgs['meta_query'][] = $queryArgsDestination;
  $relatedGuidePosts = get_posts($queryArgs);


?>

<section class="guide-related">
    <div class="guide-related__content">
      <h2 class="guide-related__content__title">
        You May Also Be Interested In
      </h2>
      <div class="guide-related__content__slider-area">
        <div class="guide-related__content__slider-area__slider" id="related-slider">

          <?php
          foreach ($relatedGuidePosts as $relatedPost) :
            $post_featured_image = get_field('featured_image', $relatedPost);
            $imageId = $post_featured_image['id'];
     
          ?>
            <!-- Item -->
            <div class="guide-related__content__slider-area__slider__item">
              <img <?php afloat_image_markup($imageId, 'featured-medium'); ?> class="guide-related__content__slider-area__slider__item__image">
              <div class="guide-related__content__slider-area__slider__item__content">
                <a class="guide-related__content__slider-area__slider__item__content__title" href="<?php echo get_permalink($relatedPost); ?>">
                  <h3>
                    <?php echo get_the_title($relatedPost); ?>
                  </h3>

                </a>
                <div class="guide-related__content__slider-area__slider__item__content__text">
                  <?php echo get_the_excerpt($relatedPost); ?>
                </div>
                <div class="guide-related__content__slider-area__slider__item__content__cta">
                  <a class="goto-button goto-button--small" href="<?php echo get_permalink($relatedPost); ?>">
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
          ?>
        </div>
      </div>

    </div>
  </section>