<?php
$guides = get_field('guides');
$guides_title_subtext = get_field('guides_title_subtext')

?>


<section class="grid-block" id="section-newsletter">
    <div class="grid-block__content block-top-divider">

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid1">
            <div class="newsletter">
                <h2 class="newsletter__title">
                    <?php echo get_field('newsletter_title', 'options'); ?>
                </h2>
                <div class="newsletter__text">
                    <?php echo get_field('newsletter_snippet', 'options'); ?>
                </div>
                <div class="newsletter__email">
                    <button class="newsletter__email__button" id="newsletter-subscribe-button">
                        Enter your email
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                        </svg>
                    </button>
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