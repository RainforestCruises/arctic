<section class="newsletter">
    <div class="newsletter__content">
        <h2 class="newsletter__content__title">
            <?php 
            if(is_page_template('template-deals-toplevel.php')){
                echo 'Find Out About Great Deals'; 
            } else {
                echo get_field('newsletter_title', 'options'); 
            }
            
            ?>
        </h2>
        <div class="newsletter__content__text">
            <?php echo get_field('newsletter_snippet', 'options'); ?>
        </div>
        <div class="newsletter__content__email">
            <button class="newsletter__content__email__button" id="newsletterButton">
                Enter your email
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                </svg>
            </button>
        </div>
    </div>
    <div class="newsletter__image">
        <?php $newsletter_image = get_field('newsletter_image', 'options'); ?>
        <img <?php afloat_image_markup($newsletter_image['id'], 'vertical-medium'); ?>>

    </div>
</section>


<!-- Newsletter Modal -->
<?php
$newsletter_form_id = get_field('newsletter_form_id', 'options');
?>
<div class="popup" id="newsletterModal">
    <div class="contact">
        <div class="contact__wrapper">
            <button class="contact__wrapper__close-button close-button" tabindex="0">
            </button>
            <div class="contact__wrapper__intro">
                <div class="contact__wrapper__intro__title">
                    Join Our Newsletter
                </div>

                <div class="contact__wrapper__intro__introtext">
                    Please fill in the form beneath and you’ll be added to our newsletter.
                </div>
            </div>

            <div class="contact__wrapper__form">
                <?php

                //Check if WpForms is active
                if (is_plugin_active('wpforms/wpforms.php')) {
                    wpforms_display($newsletter_form_id);
                } else {
                    echo 'Forms Plugin Missing';
                }

                ?>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Modal -->