<?php
$publications = get_field('publications');
$testimonials = get_field('testimonials');

?>

<div class="home-testimonials">
    <h2 class="home-testimonials__title">
        As Featured In
    </h2>
    <div class="home-testimonials__publications">
        <?php if ($publications) :
            foreach ($publications as $p) :
                $p_image = $p['image'];
        ?>

                <div class="home-testimonials__publications__logo-area">
                    <img src="<?php echo esc_url($p_image['url']); ?>" alt="<?php echo get_post_meta($p_image['id'], '_wp_attachment_image_alt', TRUE) ?>">
                </div>
        <?php endforeach;
        endif; ?>
    </div>
    <h2 class="home-testimonials__title  ">
        Traveler Reviews
    </h2>
    <div class="home-testimonials__testimonials">
        <div class="home-testimonials__testimonials__slider" id="main-testimonials">
            <?php if ($testimonials) :
                $t_count = 0;
                foreach ($testimonials as $t) :
                    $t_image = $t['image'];
                    $t_person_name = $t['person_name'];
                    $t_snippet = $t['snippet'];
            ?>
                    <!-- Testimonial -->
                    <div class="testimonial">
                        <div class="testimonial__content">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-quote"></use>
                            </svg>
                            <div class="testimonial__content__snippet">
                                <?php echo $t_snippet ?>
                            </div>
                            <div class="testimonial__content__person">
                                - <?php echo $t_person_name ?>
                            </div>
                        </div>

                        <div class="testimonial__image-area <?php echo ($t_count % 2 != 0) ? "" : ""; ?>">
                            <img <?php afloat_image_markup($t_image['id'], 'vertical-small'); ?>>
                        </div>
                    </div>

            <?php $t_count++;
                endforeach;
            endif; ?>
        </div>
    </div>
</div>