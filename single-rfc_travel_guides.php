<?php
get_header();
wp_enqueue_script('page-travel-guide', get_template_directory_uri() . '/js/page-travel-guide.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
  'page-travel-guide',
  'page_vars',
  array(
    'templateUrl' =>  $templateUrl
  )
);


$image  = get_field('featured_image');
$categories  = get_field('categories');
$displayCategory = "";

if ($categories) {
  $firstCategoryPost = $categories[0];
  $displayCategory = get_the_title($firstCategoryPost);
}


//breadcrumbs
$breadcrumbs  = get_field('breadcrumbs');


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


<!-- Travel Guide Single -->
<main>

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
          <img <?php afloat_image_markup($image['ID'], 'featured-largest', array('featured-largest', 'featured-large')); ?>>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Main Section -->
  <section class="guide-main">
    <div class="guide-main__content">

      <!-- Copy Content -->
      <div class="guide-main__content__copy">
        <?php echo the_content(); ?>
      </div>

      <!-- Disclaimer -->
      <div class="guide-main__content__disclaimer">
        <h5 class="guide-main__content__disclaimer__header">
          Disclaimer
        </h5>
        <?php echo get_field('disclaimer', 'options'); ?>
      </div>

      <!-- Entry Date -->
      <div class="guide-main__content__entry">
        This entry was posted <?php echo get_the_date(); ?>
      </div>

    </div>

  </section>

  <!-- Related Guides -->
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




</main>



<!-- #site-wrapper end-->
<?php get_footer() ?>