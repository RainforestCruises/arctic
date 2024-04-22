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
            Call us on the number below to speak to one of our polar specialists xx, or alternatively please fill in the form beneath and we'll get back to you ASAP.
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
                    Speak with our specialists for free on
                </div>
                <div class="contact-section__wrapper__intro__phone">
                    <a href="tel:<?php echo $phone_number_numeric; ?>">
                        <?php echo $phone_number; ?>
                    </a>
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
                    You can also send us a message directly at <a href="mailto:<?php echo $agency_email; ?>"><?php echo $agency_email; ?></a>
                </div>

            </div>
        </div>
    </div>
</section>