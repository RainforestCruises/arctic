<?php

$agency_contact_form_id = get_field('agency_contact_form_id', 'options');
$agency_email = get_field('agency_email', 'options');

?>

<!-- Divider -->

<div class="svg-divider" style="margin-bottom: 3rem; margin-top: 3rem;">
    <svg>
        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-2"></use>
    </svg>
</div>

<!-- Contact Page Container -->
<section class="contact-page" style="padding-top: 0rem; margin-bottom: 8rem">
    <div class="contact-page__intro">
        <div class="contact-page__intro__subtitle">
            To speak to us about becoming travel industry partners give us a call, or alternatively please fill in the form beneath and we'll get back to you ASAP.
        </div>
    </div>

    <!-- Contact Form / Wrapper -->
    <div class="contact-section">
        <div class="contact-section__wrapper">
            <div class="contact-section__wrapper__intro">

                <div class="contact-section__wrapper__intro__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-headset"></use>
                    </svg>
                </div>
                <h2 class="contact-section__wrapper__intro__title">
                    Give us a Call
                </h2>
                <div class="contact-section__wrapper__intro__subtitle">
                    Our office hours are 6am - 6pm (UTC - 5), Monday - Friday
                </div>
                <div class="contact-section__wrapper__intro__phone">
                    +1 888-585-4780
                    <div style="font-size: 1.4rem;">(option 2)</div>
                </div>
            </div>

            <!-- Form -->
            <div class="contact-section__wrapper__form">

                <?php
                //Check if WpForms is active
                if (is_plugin_active('wpforms/wpforms.php')) {
                    wpforms_display($agency_contact_form_id);
                } else {
                    echo 'Forms Plugin Missing';
                }
                ?>

                <!-- Outro -->
                <div class="inquire-form__outro">
                    You can also send us a message directly at <a href="mailto:b2b@antarcticacruises.com">b2b@antarcticacruises.com</a>
                </div>

            </div>
        </div>
    </div>
</section>