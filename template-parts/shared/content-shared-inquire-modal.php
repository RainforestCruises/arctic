<?php
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');
$productName = $args['productName'];
?>

<div class="modal" id="inquireModal">
    <div class="modal__content inquire-form"">

        <div class=" inquire-form__top">
        <button class="btn-text-icon close-modal-button ">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
            Close
        </button>
    </div>
    <div class="inquire-form__content">

        <div class="inquire-form__content__intro">
            <div class="inquire-form__content__intro__title">
                Interested in the <?php echo $productName; ?>?
            </div>
            <div class="inquire-form__content__intro__subtext">
                Please fill in the form and we’ll get back to you ASAP.
            </div>
        </div>

        <div class="inquire-form__content__form">
            <?php
            if (is_plugin_active('wpforms/wpforms.php')) {
                wpforms_display($primary_contact_form_id);
            } else {
                echo 'Forms Plugin Missing';
            }
            ?>
        </div>
        <!-- Outro -->
        <div class="inquire-form__content__outro">
            You can also send us a message directly at <a href="mailto:cruise@antarcticacruises.com">cruise@antarcticacruises.com</a>
        </div>

    </div>
</div>
</div>