<?php
$agent_name = get_field('agent_name');
$agent_position = get_field('agent_position');
$agent_video = get_field('agent_video');
$agent_image = get_field('agent_image');

$agent_introduction = get_field('agent_introduction');
$agent_location = get_field('agent_location');
$agent_email = get_field('agent_email');
$top_level_about_page = get_field('top_level_about_page', 'options');

?>

<section class="bio-hero">
    <div class="bio-hero__content">
        <div class="bio-hero__content__side">

            <!-- Breadcrumb -->
            <ul class="bio-hero__content__side__breadcrumb breadcrumb-list">
                <li>
                    <a href="<?php echo get_home_url(); ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo $top_level_about_page ?>">About</a>
                </li>
                <li>
                    <?php echo $agent_name ?>
                </li>
            </ul>
            <div class="bio-hero__content__side__main">
                <!-- Avatar group -->
                <div class="bio-hero__content__side__main__avatar">
                    <div class="bio-hero__content__side__main__avatar__image">
                        <img <?php afloat_image_markup($agent_image['id'], 'square-small'); ?>>
                    </div>
                    <div class="bio-hero__content__side__main__avatar__text">
                        <div class="bio-hero__content__side__main__avatar__text__name">
                            <?php echo $agent_name; ?>
                        </div>
                        <div class="bio-hero__content__side__main__avatar__text__position">
                            <?php echo $agent_position; ?>
                        </div>
                    </div>
                </div>

                <!-- Introduction -->
                <div class="bio-hero__content__side__main__introduction">
                    <?php echo $agent_introduction; ?>
                </div>

                <a class="bio-hero__content__side__main__attribute" href="mailto:<?php echo $agent_email ?>">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
                    </svg>
                    <?php echo $agent_email; ?>
                </a>
                <div class="bio-hero__content__side__main__attribute">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-location-pin"></use>
                    </svg>
                    <?php echo $agent_location; ?>
                </div>

            </div>


        </div>

        <div class="bio-hero__content__image">
            <div style="padding:177.78% 0 0 0;position:relative;"><iframe src="<?php echo esc_url($agent_video); ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share" referrerpolicy="strict-origin-when-cross-origin" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Meet Juan Pablo"></iframe></div>
            <script src="https://player.vimeo.com/api/player.js"></script>
        </div>
    </div>
</section>