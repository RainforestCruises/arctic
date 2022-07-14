  <?php
    $destination = $args['destination'];
    $locations = $args['locations'];
    $sliderContent = $args['sliderContent'];
    $title = $args['title'];

    $destinationType = $args['destinationType'];

    $accommodationDisplayText = 'Lodges';

    if($destinationType == 'destination' || $destinationType == 'region')
        $accommodationDisplayText = get_field('accommodations_label');
        if($accommodationDisplayText == null) {
            $accommodationDisplayText = 'Lodges';
        }
    ?>


  <!-- Destination Hero -->
  <div class="destination-hero">
      <div class="destination-hero__bg-slider" id="destination-hero__bg-slider">
          <?php foreach ($sliderContent as $s) :
                $sliderImage = $s['image'];
            ?>
              <div class="destination-hero__bg-slider__slide">
                  <?php if ($sliderImage) : ?>
                      <div class="destination-hero__bg-slider__slide__image-area">
                        <img <?php afloat_image_markup($sliderImage['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall'), true); ?>>


                      </div>
                  <?php endif; ?>
              </div>

          <?php endforeach; ?>
      </div>
      <div class="destination-hero__content">

          <!-- Breadcrumb -->
          <ol class="destination-hero__content__breadcrumb">
              <li>
                  <a href="<?php echo get_home_url(); ?>">Home</a>
              </li>
              <?php if ($destinationType != 'region') : ?>
                  <li>
                      <a href="<?php echo get_field('breadcrumb_link') ?>"><?php echo get_field('breadcrumb_name') ?></a>
                  </li>
              <?php endif; ?>
              <li>
                  <?php echo get_field('navigation_title', $destination) ?>
              </li>
          </ol>


          <!-- Title -->
          <div class="destination-hero__content__title-group">
              <h1 class="destination-hero__content__title-group__title" id="page-title">
                  <?php echo get_the_title(); ?>
              </h1>
          </div>

          <!-- Nav -->
          <div class="destination-hero__content__page-nav">

              <!-- sticky wrapper -->
              <nav class="destination-hero__content__page-nav__sticky-wrapper" id="template-nav">
                  <div class="page-nav-title" href="#top">
                      <?php echo $title  ?>
                  </div>
                  <!-- <div class="destination-hero__content__page-nav__title" id="template-nav-title" href="#top">
                      <?php echo $title  ?>
                  </div> -->
                  <ul class="destination-hero__content__page-nav__list">
                      <!-- Order depending on template type -->
                      <?php if ($destinationType == 'region' || $destinationType == 'destination') { ?>
                          <li class="destination-hero__content__page-nav__list__item">
                              <a href="#packages" class="destination-hero__content__page-nav__list__item__link page-nav-template">Packages</a>
                          </li>

                          <?php if ($destinationType == 'destination') {
                                $hide_cruises = get_field('hide_cruises');
                                if (!$hide_cruises) { ?>
                                  <li class="destination-hero__content__page-nav__list__item">
                                      <a href="#cruises" class="destination-hero__content__page-nav__list__item__link page-nav-template">Cruises</a>
                                  </li>
                              <?php }
                            } else { ?>
                              <li class="destination-hero__content__page-nav__list__item">
                                  <a href="#cruises" class="destination-hero__content__page-nav__list__item__link page-nav-template">Cruises</a>
                              </li>
                          <?php } ?>


                          <?php if ($destinationType == 'destination'  || $destinationType == 'region') {
                                $hide_accommodations = get_field('hide_accommodations');
                                if (!$hide_accommodations) { ?>
                                  <li class="destination-hero__content__page-nav__list__item">
                                      <a href="#accommodation" class="destination-hero__content__page-nav__list__item__link page-nav-template"><?php echo $accommodationDisplayText ?></a>
                                  </li>
                              <?php }
                            } else { ?>
                              <li class="destination-hero__content__page-nav__list__item">
                                  <a href="#accommodation" class="destination-hero__content__page-nav__list__item__link page-nav-template"><?php echo $accommodationDisplayText ?></a>
                              </li>
                          <?php } ?>


                      <?php } else if ($destinationType == 'cruise') { ?>
                          <li class="destination-hero__content__page-nav__list__item">
                              <a href="#cruises" class="destination-hero__content__page-nav__list__item__link page-nav-template">Cruises</a>
                          </li>
                          <li class="destination-hero__content__page-nav__list__item">
                              <a href="#packages" class="destination-hero__content__page-nav__list__item__link page-nav-template">Packages</a>
                          </li>
                      <?php } ?>



                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#travel-guide" class="destination-hero__content__page-nav__list__item__link page-nav-template">Travel Guide</a>
                      </li>
                      <?php if (get_field('show_testimonials') == true) { ?>
                          <li class="destination-hero__content__page-nav__list__item">
                              <a href="#testimonials" class="destination-hero__content__page-nav__list__item__link page-nav-template">Testimonials</a>
                          </li>
                      <?php } ?>
                      <li class="destination-hero__content__page-nav__list__item">
                          <a href="#faq" class="destination-hero__content__page-nav__list__item__link page-nav-template">FAQ</a>
                      </li>
                  </ul>
                  <div class="page-nav">
                      <div class="page-nav__button">
                          <?php echo $title  ?>
                          <svg>
                              <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                          </svg>
                      </div>
                      <div class="page-nav__cta">
                          <button class="btn-cta-square btn-cta-square--small btn-cta-square--white">
                              Inquire
                          </button>
                      </div>
                  </div>


              </nav>


          </div>
          <div class="destination-hero__content__arrow">
              <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="down-arrow-button" href="#intro">
                  <svg class="btn-circle--arrow-main">
                      <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                  </svg>
                  <svg class="btn-circle--arrow-animate">
                      <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
                  </svg>
              </button>
          </div>

          <div class="destination-hero__content__location">
              <?php
                $slideCount = 0;
                if ($sliderContent) : ?>
                  <div class="destination-hero__content__location__slider" id="destination-hero__content__location__slider">

                      <?php foreach ($sliderContent as $s) : ?>
                          <div class="destination-hero__content__location__slider__item">
                              <div class="destination-hero__content__location__slider__item__title">
                                  <?php echo ($slideCount == 0) ? "" : $s['title']; ?>
                              </div>
                              <div class="destination-hero__content__location__slider__item__text">
                                  <?php echo $s['caption']; ?>
                              </div>
                              <?php if ($s['link'] != null) : ?>
                                  <div class="destination-hero__content__location__slider__item__cta">

                                      <a class="goto-button goto-button--hero goto-button--small hero-link" href="<?php echo $s['link']; ?>">
                                            <?php echo 'View ' . $s['title'] . ' Tours'; ?>
                                 

                                          <svg>
                                              <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                                          </svg>
                                      </a>
                                  </div>
                              <?php endif; ?>
                          </div>
                      <?php
                            $slideCount++;
                        endforeach;
                        ?>

                  </div>
                  <div class="destination-hero__content__location__progress">
                      <div class="destination-hero__content__location__progress__odometer " id="odometer">01</div>
                      <div class="destination-hero__content__location__progress__bar">
                          <div class="progress"></div>
                      </div>


                      <div class="destination-hero__content__location__progress__odometer-top"><?php echo str_pad($slideCount, 2, "0", STR_PAD_LEFT); ?></div>
                  </div>
              <?php endif; ?>
          </div>
      </div>
  </div>