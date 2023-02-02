  <?php
    $top_level_guides_page = get_field('top_level_guides_page', 'options');

    $image  = get_field('featured_image');
    $categories  = get_field('categories');
    $displayCategory = "";

    if ($categories) {
        $firstCategoryPost = $categories[0];
        $displayCategory = get_the_title($firstCategoryPost);
    }

    ?>



  <!-- Hero Section -->
  <section class="guide-hero">
      <div class="guide-hero__content">
          <!-- Breadcrumb -->
          <ol class="guide-hero__content__breadcrumb">
              <li>
                  <a href="<?php echo home_url() ?>">Home</a>
              </li>
              <li>
                  <a href="<?php echo $top_level_guides_page; ?>">All Guides</a>
              </li>
          </ol>
          <!-- Title -->
          <h1 class="guide-hero__content__title">
              <?php echo get_field('navigation_title'); ?>
          </h1>
          <!-- Category -->
          <div class="guide-hero__content__category">
              <?php echo $displayCategory ?>
          </div>
          <!-- Image -->
          <div class="guide-hero__content__image">
              <?php if ($image) : ?>
                  <img <?php afloat_image_markup($image['ID'], 'landscape-medium', array('landscape-medium', 'landscape-small')); ?>>
              <?php endif; ?>
          </div>
      </div>
  </section>