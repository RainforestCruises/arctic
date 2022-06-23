  <!-- Intro -->
  <section class="home-page__section-intro" id="intro">
    <?php
    get_template_part('template-parts/content', 'home-intro');
    ?>
  </section>


    <!-- Destinations -->
    <section class="home-page__section-destinations" id="destinations">
    <?php
    get_template_part('template-parts/content', 'home-destinations');
    ?>
  </section>




  <!-- Itineraries Content -->
  <section class="product-page__section-itineraries" id="itineraries">
      <?php
      get_template_part('template-parts/content', 'product-itineraries', $args);
      ?>
    </section>

    <!-- Accommodations Content -->
    <section class="product-page__section-accommodation" id="accommodations">
      <h2 class="page-divider page-divider--padding u-margin-bottom-medium">
        Accommodations
      </h2>
      <?php
      get_template_part('template-parts/content', 'product-explore', $args); //common areas gallery
      ?>
      <?php
      get_template_part('template-parts/content', 'product-cabins', $args);
      ?>
      <?php
      get_template_part('template-parts/content', 'product-technical', $args);
      ?>
    </section>


    <!-- Reviews -->
    <?php if (get_field('show_testimonials') == true) { ?>
      <section class="product-page__section-reviews">
        <?php
        get_template_part('template-parts/content', 'product-reviews', $args);
        ?>
      </section>
    <?php } ?>

    <!-- Related Travel -->
    <section class="product-page__section-related">
      <?php
      get_template_part('template-parts/content', 'product-related', $args);
      ?>
    </section>

    href="<?php echo get_permalink($ship); ?>"


                     <!-- Extras -->
                <div class="itinerary-hero__bottom__content__info-group__extras">
                    <?php $experiences = get_field('experiences');
                    foreach ($experiences as $e) : ?>
                        <div class="extras-icon">
                            <?php echo get_field('icon', $e); ?>
                            <span class="tooltiptext"><?php echo get_the_title($e); ?></span>
                        </div>

                    <?php endforeach; ?>

                </div>

                <div class="itinerary-hero__bottom__content__info-group__info__starting-price__description">
                            Shared, small group cruise based on DBL occupancy

                        </div>