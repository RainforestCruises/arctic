<?php
$hero_featured_image = get_field('hero_featured_image');
$hero_points = get_field('hero_points');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$category_landing_pages = get_field('category_landing_pages', 'options');
$hero_deals = get_field('hero_deals');

?>

<section class="home-hero2" id="section-top">

    <div class="home-hero2__bg-image">
        <img <?php afloat_image_markup($hero_featured_image['id'], 'landscape-full', array('landscape-full', 'landscape-large', 'landscape-medium', 'landscape-small', 'portrait-small'), false); ?> class="optimole-initial">

    </div>

    <!-- Hero Content -->
    <div class="home-hero2__content">

        <div class="home-hero2__content__primary">
            <div class="home-hero2__content__primary__title">
                <?php echo $hero_title ?>
            </div>
            <div class="home-hero2__content__primary__snippet">
                <?php echo $hero_subtitle; ?>
            </div>

        </div>

        <div class="home-hero2__content__secondary">

            <div class="home-hero2__content__secondary__item-area">
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
            <div class="home-hero2__content__secondary__video-area">
                <div class="video-card">
                    <video class="video-card__video" muted loop id="hero-video-card">
                        <source src="<?php echo esc_url("http://localhost/arcticwp/wp-content/uploads/2023/02/antarctica-tiny-video-v2.mp4"); ?>" type="video/mp4">
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

        <!-- Main Slider -->
        <div class="modal__video__main">
            <div style="padding:56.25% 0 0 0;position:relative;">
                <iframe id="modal-video-iframe" src="https://player.vimeo.com/video/795375830?h=207334d477&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Antarctica Cruises"></iframe>
            </div>
            <script src="https://player.vimeo.com/api/player.js"></script>
        </div>

    </div>
</div>