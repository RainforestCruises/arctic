  <?php

    $image  = get_field('featured_image');
    $categories  = get_field('categories');
    $displayCategory = "";

    if ($categories) {
        $firstCategoryPost = $categories[0];
        $displayCategory = get_the_title($firstCategoryPost);
    }

    //breadcrumbs
    $breadcrumbs  = get_field('breadcrumbs');


    ?>



  <!-- Hero Section -->
  <section class="guide-hero">
      <div class="guide-hero__content">
          <!-- Breadcrumb -->
          <ol class="guide-hero__content__breadcrumb">
              <li>
                  <a href="<?php echo home_url() ?>">Home</a>
              </li>
              <?php foreach ($breadcrumbs as $b) :
                    $page = $b['page_link'];
                    $display_text = $b['display_text'];
                ?>
                  <li>
                      <a href=" <?php echo get_permalink($page); ?>"><?php echo $display_text; ?></a>
                  </li>
              <?php endforeach; ?>
              <li>
                  <?php echo get_field('navigation_title'); ?>
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