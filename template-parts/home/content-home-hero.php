<?php
$hero_featured_image = get_field('hero_featured_image');
$hero_points = get_field('hero_points');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$category_landing_pages = get_field('category_landing_pages', 'options');
$hero_items = get_field('hero_items');
$show_site_notice = get_field('show_site_notice', 'options');

?>

<section class="home-hero" id="section-top">

    <div class="home-hero__bg-image">
        <img <?php afloat_image_markup($hero_featured_image['id'], 'landscape-full', array('landscape-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small'), false); ?> class="optimole-initial">
    </div>

    <!-- Hero Content -->
    <div class="home-hero__content <?php echo ($show_site_notice ? "site-notice-variant" : "") ?>">

        <!-- Main Title Group -->
        <div class="home-hero__content__primary">
            <h1 class="home-hero__content__primary__title">
                <?php echo $hero_title ?>
            </h1>
            <div class="home-hero__content__primary__snippet">
                <?php echo $hero_subtitle; ?>
            </div>
        </div>

        <!-- Secondary -->
        <div class="home-hero__content__secondary">


            <!-- Content -->
            <div class="home-hero__content__secondary__content">

                <!-- Video CTA -->
                <div class="home-hero__content__secondary__content__cta">

                    <!-- Play Video Button -->
                    <button class="video-play-button">
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

                <!-- Jump Links -->
                <div class="home-hero__content__secondary__content__items">
                    <?php foreach ($hero_items as $item) :

                        $anchor = $item['anchor_link'];
                        $icon = $item['icon'];
                        $image = $item['image'];
                        $title = $item['title'];
                        $subtitle = $item['subtitle'];

                        $percentage_savings = $item['percentage_savings'];

                    ?>
                        <a class="hero-item" href="<?php echo $anchor; ?>">
                            <div class="hero-item__icon-area">
                                <?php echo $icon; ?>
                            </div>
                            <div class="hero-item__title-group">
                                <div class="hero-item__title-group__title">
                                    <?php echo $title; ?>
                                </div>
                            </div>
                        </a>

                    <?php endforeach; ?>
                </div>

            </div>

            <!-- Video Area -->
            <div class="home-hero__content__secondary__video-area">
                <div class="video-card">
                    <video class="video-card__video" muted loop id="hero-video-card">
                        <source src="<?php echo esc_url(get_field('hero_video_card')); ?>" type="video/mp4">
                    </video>
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
            <button class="btn-text-icon close-modal-button stop-video">
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