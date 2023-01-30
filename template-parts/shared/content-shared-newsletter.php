<?php
$newsletter_form_id = get_field('newsletter_form_id', 'options');
$footer_cta_title = get_field('footer_cta_title', 'options');
$footer_cta_subtext = get_field('footer_cta_subtext', 'options');
$footer_cta_steps = get_field('footer_cta_steps', 'options');
$phone_number = get_field('phone_number', 'options');
$footerClasses = renderFooterClasses();

?>

<section class="grid-block <?php echo $footerClasses; ?>" id="section-newsletter">
    <div class="grid-block__content">

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid1">
            <div class="footer-cta">

                <!-- Title Area -->
                <div class="footer-cta__title-group">
                    <div class="footer-cta__title-group__title">
                        <?php echo $footer_cta_title; ?>
                    </div>
                    <div class="footer-cta__title-group__sub">
                        <?php echo $footer_cta_subtext; ?>
                    </div>
                </div>

                <div class="footer-cta__steps">
                    <?php foreach ($footer_cta_steps as $step) :
                        $icon = $step['icon'];
                        $title = $step['title'];
                        $text = $step['text'];
                    ?>
                        <div class="footer-cta__steps__item">
                            <div class="footer-cta__steps__item__icon-area">
                                <?php echo $icon; ?>
                            </div>
                            <div class="footer-cta__steps__item__title">
                                <?php echo $title; ?>
                            </div>
                            <div class="footer-cta__steps__item__text">
                                <?php echo $text; ?>
                            </div>


                        </div>

                    <?php endforeach; ?>
                </div>



                <div class="footer-cta__closing">


                    <div class="footer-cta__closing__buttons">
                        <a class="cta-primary cta-primary--inverse" href="<?php echo get_home_url(); ?>/contact">
                            Start Your Adventure Today
                        </a>
              
                    </div>

                    <div class="footer-cta__closing__phone">
                        Or give us a call at: <?php echo $phone_number; ?>
                    </div>

                </div>


            </div>
        </div>

    </div>
</section>




<!-- Newsletter Modal -->
<?php
$newsletter_form_id = get_field('newsletter_form_id', 'options');
?>

<div class="modal" id="newsletterModal">

    <div class="modal__content">
        <div class="modal__content__top">
            <div class="modal__content__top__nav">

            </div>
            <button class="btn-text-icon close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>
        <div class="modal__content__main">
            <div class="inquire-form">
                <div class="inquire-form__intro">
                    <div class="inquire-form__intro__title">
                        Join Our Newsletter
                    </div>

                    <div class="inquire-form__intro__subtext">
                        Please fill in the form beneath and you’ll be added to our newsletter.
                    </div>
                </div>

                <div class="inquire-form__form">
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


</div>
<!-- End Contact Modal -->