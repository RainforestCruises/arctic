<?php
$intro_image = get_field('intro_image');
$intro_testimonials = get_field('intro_testimonials');

?>





<div class="home-intro">
    <div class="home-intro__top">
        <div class="home-intro__top__image-area">
            <img <?php afloat_image_markup($intro_image['id'], 'vertical-medium'); ?> class="home-intro__top__img">
            
        </div>

        <div class="home-intro__top__content">
            <div class="home-intro__top__content__pretitle">
                <?php echo get_field('intro_pretitle'); ?>
            </div>
            <h2 class="home-intro__top__content__title">
                <?php echo get_field('intro_title'); ?>
            </h2>
            <div class="home-intro__top__content__testimonials">
                <?php if ($intro_testimonials) :
                    $i_image = $intro_testimonials[0]['avatar'];
                    $i_snippet = $intro_testimonials[0]['snippet'];
                ?>
                    <div class="home-intro__top__content__testimonials__testimonial">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
                        </svg>
                        <div class="home-intro__top__content__testimonials__testimonial__snippet">
                            <?php echo $i_snippet; ?>
                        </div>
                        <div class="home-intro__top__content__testimonials__testimonial__name">
                            - Jeremy Clubb, Founder
                        </div>
                        <img class="home-intro__top__content__testimonials__testimonial__image" src="<?php echo esc_url($i_image['url']); ?>" alt="<?php echo get_post_meta($i_image['id'], '_wp_attachment_image_alt', TRUE) ?>">

                    </div>

                <?php endif; ?>
            </div>

        </div>
    </div>
    <div class="home-intro__bottom">
        <div class="home-intro__bottom__feature">
            <div class="home-intro__bottom__feature__icon">
                <?php echo get_field('first_icon'); ?>
            </div>
            <h3 class="home-intro__bottom__feature__title">
                <?php echo get_field('first_title'); ?>
            </h3>
            <div class="home-intro__bottom__feature__snippet">
                <?php echo get_field('first_snippet'); ?>
                
            </div>
        </div>
        <div class="home-intro__bottom__feature">
            <div class="home-intro__bottom__feature__icon">
                <?php echo get_field('second_icon'); ?>
            </div>
            <h3 class="home-intro__bottom__feature__title">
                <?php echo get_field('second_title'); ?>
            </h3>
            <div class="home-intro__bottom__feature__snippet">
                <?php echo get_field('second_snippet'); ?>
            </div>
        </div>
        <div class="home-intro__bottom__feature">
            <div class="home-intro__bottom__feature__icon">
                <?php echo get_field('third_icon'); ?>
            </div>
            <h3 class="home-intro__bottom__feature__title">
                <?php echo get_field('third_title'); ?>
            </h3>
            <div class="home-intro__bottom__feature__snippet">
                <?php echo get_field('third_snippet'); ?>
            </div>
        </div>
    </div>


</div>