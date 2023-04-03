<?php if ($image) : ?>
    <img <?php afloat_image_markup($image['id'], 'square-thumb', array('square-thumb')); ?>>
<?php endif; ?>











<?php
if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
    <div class="nav-main__content__right__language divider-left">
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_translate_24px"></use>
        </svg>
        <span>

            <?php echo do_shortcode("[language-switcher]"); ?>
        </span>
    </div>
<?php endif; ?>




<?php echo do_shortcode("[wpcs show_flags=0 width='160px' txt_type='desc']") ?>








<section class="sliding-testimonials">
    <h2 class="contact-page__testimonial-title">
        What Our Customers are Saying About Us
    </h2>
    <div class="sliding-testimonials__slider" id="testimonials-slider">
        <?php
        $testimonials = get_field('testimonials', 'options');

        if ($testimonials) :
            foreach ($testimonials as $testimonial) :
                $t = $testimonial['snippet'];
                $t_person = $testimonial['person_name'];
                $t_image = $testimonial['image'];
        ?>
                <!-- Slide -->
                <!-- Testimonial -->
                <div class="sliding-testimonial">
                    <div class="sliding-testimonial__content">
                        <div class="sliding-testimonial__content__snippet">
                            <?php echo $t ?>
                        </div>
                        <div class="sliding-testimonial__content__person">
                            - <?php echo $t_person ?>
                        </div>
                    </div>

                    <div class="sliding-testimonial__image-area ">
                        <img <?php afloat_image_markup($t_image['id'], 'vertical-medium'); ?>>
                    </div>
                </div>

        <?php
            endforeach;

        endif; ?>
    </div>
</section>