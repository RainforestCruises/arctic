<?php
/*Template Name: Home*/

wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home.js', array('jquery'), false, true);
wp_enqueue_script('map-sample', get_template_directory_uri() . '/js/map-sample.js', array(), false, true);

$templateUrl = get_template_directory_uri();
wp_localize_script(
  'page-home',
  'page_vars',
  array(
    'templateUrl' =>  $templateUrl
  )
);

get_header();

$newsletter_image = get_field('newsletter_image');
$newsletter_title = get_field('newsletter_title');
$newsletter_snippet = get_field('newsletter_snippet');

?>


<main>

  <!-- Hero -->
  <?php
  get_template_part('template-parts/home/content', 'home-hero');
  ?>

  <!-- Newest Cruises  -->
  <?php
  get_template_part('template-parts/home/content', 'home-newest');
  ?>

  <!-- Destinations -->
  <?php
  get_template_part('template-parts/home/content', 'home-destinations');
  ?>
  <!-- Map -->
  <?php
   get_template_part('template-parts/home/content', 'home-map');
  ?>



</main>

<!-- Full Search Mobile -->
<div class="home-full-search" id="home-full-search">
  <?php $logo_vertical = get_field('logo_vertical', 'options'); ?>

  <!-- Destination -->
  <div class="home-full-search__destination">
    <div class="home-full-search__destination__top">

      <div class="home-full-search__destination__top__cancel" id="mobile-search-close">
        Cancel
      </div>

    </div>


  </div>

  <!-- Dates -->
  <div class="home-full-search__dates">
    <div class="home-full-search__dates__top">
      <div class="home-full-search__dates__top__back" id="mobile-search-back">
        <svg>
          <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
        </svg>
      </div>
    </div>


  </div>

</div>

<!-- Full Search Mobile - CTA -->
<div class="home-full-search-cta">
  <button class="home-full-search-cta__button" type="submit" form="home-search-form">
    <span>
      SEARCH ALL DATES
    </span>
  </button>
</div>

<!-- Full Search Mobile - Loading -->
<div class="home-full-search-loading">
  <?php $logo_vertical = get_field('logo_vertical', 'options'); ?>
  <img class="home-full-search-loading__logo" src="<?php echo $logo_vertical['url']; ?>">

  <div class="lds-ring lds-ring--large">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
  </img>
</div>


<!-- Form Hidden -->
<form class="home-search-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="home-search-form">
  <input type="hidden" name="action" value="homeSearch">
  <input type="hidden" name="formDates" id="formDates" value="">
  <input type="hidden" name="formDestination" id="formDestination" value="">
</form>


<?php get_footer(); ?>