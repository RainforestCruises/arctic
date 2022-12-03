<?php
if (is_page_template('template-category-landing.php')) :
  get_template_part('template-parts/nav/secondary/content', 'nav-category');
endif; ?>




<!-- Destinations -->
<div class="resource-card__content__specs__item">
  <div class="resource-card__content__specs__item__icon">
    <svg>
      <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-e"></use>
    </svg>
  </div>
  <div class="resource-card__content__specs__item__text">
    <?php echo $destinations; ?>
  </div>
</div>







<div class="travel-guide-related">
  <h2 class="travel-guide-related__title">
    You May Also Be Interested In
  </h2>
  <div class="travel-guide-related__slider-area">
    <div class="travel-guide-related__slider-area__slider" id="related-slider">

      <?php
      foreach ($relatedGuidePosts as $relatedPost) :
        $post_featured_image = get_field('featured_image', $relatedPost);
        $imageId = "";
        if ($post_featured_image) {
          $imageId = $post_featured_image['id'];
        }
      ?>
        <!-- Item -->
        <div class="travel-guide-related__slider-area__slider__item">
          <img <?php afloat_image_markup($imageId, 'featured-medium'); ?> class="travel-guide-related__slider-area__slider__item__image">
          <div class="travel-guide-related__slider-area__slider__item__content">
            <a class="travel-guide-related__slider-area__slider__item__content__title" href="<?php echo the_permalink(); ?>">
              <h3>
                <?php echo the_title(); ?>
              </h3>

            </a>
            <div class="travel-guide-related__slider-area__slider__item__content__text">
              <?php echo the_excerpt(); ?>
            </div>
            <div class="travel-guide-related__slider-area__slider__item__content__cta">
              <a class="goto-button goto-button--small" href="<?php echo the_permalink(); ?>">
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

<button class="cta-square-icon cta-square-icon--inverse departure-price-group-button" departureId="<?php echo $departureId; ?>" year="<?php echo date("Y", $departureStartDate); ?>" departureDate="<?php echo date("M d, Y", $departureStartDate); ?>" itinerary="<?php echo $itineraryPostId; ?>" itineraryTitle="<?php echo $title; ?>">
  View Prices

</button>


      <!-- Search Area -->
      <div class="nav-main__content__center__search-area">
                <!-- Nav Search Widget -->
                <?php get_template_part('template-parts/nav/content', 'nav-search'); ?>
            </div>

            <div class="home-hero2__content__points">
            <?php foreach ($hero_points as $point) : ?>
                <div class="hero-point">
                    <div class="hero-point__title">
                        <?php echo $point['title']; ?>
                    </div>
                    <div class="hero-point__snippet">
                        <?php echo $point['snippet']; ?>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>





          <!-- Itinerary Map -->
  <?php
  get_template_part('template-parts/itinerary/content', 'itinerary-map', $args);
  ?>