<?php
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');
$title = get_the_title();
$phone_number = get_field('phone_number', 'options');
$phone_number_numeric = get_field('phone_number_numeric', 'options');
$email = get_field('email', 'options');

// search title should be the h1
$templateName = get_page_template_slug();
if ($templateName == 'template-search.php') {
    $title = get_field('title_text');
}

// exception title for top level search page
$top_level_search_page = get_field('top_level_search_page', 'options');
if ($top_level_search_page == get_permalink()) {
    $title = 'Polar Expeditions';
};

?>


<div class="modal" id="inquireModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
            </div>

            <button class="btn-text btn-text--bg close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main">

            <!-- Inquire Form -->
            <div class="inquire-form">
                <div class="inquire-form__intro">
                    <div class="inquire-form__intro__title">
                        Interested in <?php echo $title; ?>?
                    </div>
                    <div class="inquire-form__intro__selection">

                    </div>

                    <div class="inquire-form__intro__icon">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-headset"></use>
                        </svg>
                    </div>
                    <h2 class="inquire-form__intro__title">
                        Give us a Call
                    </h2>
                    <div class="inquire-form__intro__subtext">
                        We ❤️ to talk! A brief call with one of our destination specialists is the quickest and easiest way to create your perfect trip.
                    </div>
                    <div class="inquire-form__intro__title">
                        <a href="tel:<?php echo $phone_number_numeric; ?>">
                            <?php echo $phone_number; ?>
                        </a>
                    </div>

                </div>

                <div class="inquire-form__form">
                    <div class="inquire-form__form__subtext">
                        Alternately, please fill in the form and we’ll get back to you ASAP.
                    </div>
                    <?php
                    if (is_plugin_active('wpforms/wpforms.php')) {
                        wpforms_display($primary_contact_form_id);
                    } else {
                        echo 'Forms Plugin Missing';
                    }
                    ?>
                </div>
                <!-- Outro -->
                <div class="inquire-form__outro">
                    You can also send us a message directly at <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                </div>
            </div>

        </div>
    </div>
</div>