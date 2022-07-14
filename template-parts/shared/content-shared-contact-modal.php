<!-- Contact Modal -->
<?php 
$isProduct = false;
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');

if(get_post_type() == 'rfc_cruises' || get_post_type() == 'rfc_lodges' || get_post_type() == 'rfc_tours'){
    $isProduct = true;

}
?>
<div class="popup" id="contactModal">
    <div class="contact">
        <div class="contact__wrapper">
            <button class="contact__wrapper__close-button close-button" tabindex="0">
            </button>
            <div class="contact__wrapper__intro">
                <div class="contact__wrapper__intro__title">
                    Interested in <?php echo $isProduct ? "the " : "" ?> <?php echo (get_post_type() == 'rfc_tours') ? get_field("tour_name") .  " Tour" :  get_the_title(); ?>?
                </div>
                <div class="contact__wrapper__intro__departure" id="contactModalDepartureText">
                    
                </div>
                <div class="contact__wrapper__intro__introtext">
                    Please fill in the form beneath and we’ll get back to you ASAP.
                </div>
            </div>

            <div class="contact__wrapper__form">
                <?php 
                

                if (is_plugin_active('wpforms/wpforms.php')) {
                    wpforms_display($primary_contact_form_id);
                } else {
                    echo 'Forms Plugin Missing';
                }
                
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Modal -->