<?php
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');
$productName = get_the_title();
?>


<div class="modal" id="inquireModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
            </div>

            <button class="btn-text-icon close-modal-button ">
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
                        Interested in <?php echo $productName; ?>?
                    </div>
                    <div class="inquire-form__intro__selection">
            
                    </div>
                    <div class="inquire-form__intro__subtext">
                        Please fill in the form and we’ll get back to you ASAP.
                    </div>
                </div>

                <div class="inquire-form__form">
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
                    You can also send us a message directly at <a href="mailto:cruise@antarcticacruises.com">cruise@antarcticacruises.com</a>
                </div>
            </div>

        </div>
    </div>
</div>