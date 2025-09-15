<?php
$hero_featured_image = get_field('hero_featured_image');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_video_card = get_field('hero_video_card');
$video_title = get_field('video_title');
$video_subtitle = get_field('video_subtitle');
$regionsArgs = array(
    'post_type' => 'rfc_regions',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
);
$regions = get_posts($regionsArgs);
?>

<section class="home-hero-regional" id="top">

    <!-- Background -->
    <div class="home-hero-regional__bg-image">
        <img <?php afloat_image_markup($hero_featured_image['id'], 'landscape-full', array('landscape-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small'), false); ?> class="optimole-initial">
    </div>

    <!-- Hero Content -->
    <div class="home-hero-regional__content">

        <!-- Primary -->
        <div class="home-hero-regional__content__primary">
            <div class="home-hero-regional__content__primary__title-group">
                <h1 class="home-hero-regional__content__primary__title-group__title">
                    <?php echo $hero_title ?>
                </h1>
                <div class="home-hero-regional__content__primary__title-group__sub">
                    <?php echo $hero_subtitle; ?>
                </div>
            </div>
            <div class="home-hero-regional__content__primary__region-area">
                <?php foreach ($regions as $region) :
                    $image = get_field('image', $region);
                    $home_page =  get_field('home_page', $region);
                    $title = get_the_title($region);
                ?>
                    <div class="overlay-card small inverse shadow">
                        <div class="overlay-card__image-area">
                            <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                        </div>
                        <a class="overlay-card__content" href="<?php echo get_permalink($home_page); ?>">
                            <div class="overlay-card__content__title-section">
                                <h3 class="overlay-card__content__title-section__title">
                                    <?php echo $title; ?>
                                </h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="home-hero-regional__content__primary__region-slider">
                <!-- Swiper -->
                <div class="swiper" id="hero-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($regions as $region) :
                            $image = get_field('image', $region);
                            $home_page =  get_field('home_page', $region);
                            $title = get_the_title($region);
                        ?>
                            <div class="overlay-card small inverse shadow swiper-slide">
                                <div class="overlay-card__image-area">
                                    <img <?php afloat_image_markup($image['id'], 'portrait-small'); ?>>
                                </div>
                                <a class="overlay-card__content" href="<?php echo get_permalink($home_page); ?>">
                                    <div class="overlay-card__content__title-section">
                                        <h3 class="overlay-card__content__title-section__title">
                                            <?php echo $title; ?>
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Nav Buttons -->
                <div class="home-hero-regional__content__primary__region-slider__nav">
                    <div class="swiper-button-prev swiper-button-prev--dark hero-slider-btn-prev">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                        </svg>
                    </div>
                    <div class="swiper-button-next swiper-button-next--dark hero-slider-btn-next">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Area -->
        <div class="home-hero-regional__content__video-area">
            <div class="home-hero-regional__content__video-area__video">
                <video class="home-hero-regional__content__video-area__video__source" muted autoplay loop id="hero-video-card">
                    <source src="<?php echo esc_url($hero_video_card); ?>" type="video/mp4">
                </video>
                <div class="home-hero-regional__content__video-area__video__overlay">
                    <h3><?php echo $video_title ?></h3>
                    <p><?php echo $video_subtitle ?></p>
                </div>
                <div class="home-hero-regional__content__video-area__video__cta">
                    <button class="video-play-button dark">
                        <div class="video-play-button__icon-area">
                            <div class="video-play-button__icon-area__inner">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-button-play"></use>
                                </svg>
                            </div>
                        </div>
                        <div class="video-play-button__text">
                            Watch The Video
                        </div>
                    </button>
                </div>
            </div>

        </div>

    </div>
</section>



<!-- Video Modal -->
<div class="modal modal--video stop-video" id="videoModal">
    <div class="modal__video">

        <!-- Top Section -->
        <div class="modal__video__top">
            <span id="videoModalCount"></span>
            <span id="videoModalTitle"></span>
            <button class="btn-text btn-text--bg close-modal-button stop-video">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main -->
        <div class="modal__video__main">
            <div style="padding:56.25% 0 0 0;position:relative;">
                <iframe id="modal-video-iframe" src="<?php echo get_field('vimeo_link') ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Antarctica Cruises"></iframe>
            </div>
        </div>

    </div>
</div>