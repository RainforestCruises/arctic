<?php
$footer_links = get_field('footer_links', 'options');
$logo_main = get_field('logo_main', 'options');
$phone_number = get_field('phone_number', 'options');
$phone_number_numeric = get_field('phone_number_numeric', 'options');

$privacy_link = get_field('privacy_link', 'options');
$terms_link = get_field('terms_link', 'options');

$newsletter_form_id = get_field('newsletter_form_id', 'options');
$footerClasses = renderFooterClasses();
?>



<!-- Footer -->
<footer class="footer <?php echo $footerClasses; ?>">
    <div class="footer__content">
        <div class="footer__content__main">

            <div class="footer__content__main__newsletter">
                <a class="footer__content__main__newsletter__brand" href="<?php echo get_home_url(); ?>">
                    <img src="<?php echo $logo_main['url']; ?>" class="nav-main__content__left__logo-area__logo-main" alt="<?php echo get_bloginfo('name') ?>" />
                </a>
                <div class="footer__content__main__newsletter__subtext">
                    Get expert advice, travel news, and more straight to your inbox
                </div>
                <div class="footer__content__main__newsletter__cta">
                    <button class="cta-primary" id="newsletter-subscribe-button">Sign Up for Our Newsletter</button>
                </div>
            </div>

            <div class="footer__content__main__contact">
                <div class="footer__content__main__contact__title">
                    Sales & Reservations
                </div>
                <div class="footer__content__main__contact__text">
                    <div> 
                        <a href="tel:<?php echo $phone_number_numeric; ?>">
                            <?php echo $phone_number; ?>
                        </a>
                    </div>
                    <div>Email: <a href="mailto:cruise@antarcticacruises.com">cruise@antarcticacruises.com</a></div>
                </div>

                <div class="footer__content__main__contact__title">
                    Antarctica Cruises
                </div>
                <div class="footer__content__main__contact__text">
                    <div>1680 Michigan Avenue, Suite 700</div>
                    <div>Miami Beach, FL 33139</div>
                </div>
            </div>

            <ul class="footer__content__main__links">
                <?php foreach ($footer_links as $item) : ?>
                    <li>
                        <a href="<?php echo get_permalink($item); ?>"> <?php echo get_the_title($item) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
        <div class="footer__content__bottom">
            <div class="footer__content__bottom__legal">
                <div class="footer__content__bottom__legal__item">
                    &#169; <?php echo date('Y') ?> Antarctica Cruises
                </div>
                <div class="footer__content__bottom__legal__item">
                    <a href="<?php echo $terms_link ?>">Terms</a>
                </div>
                <div class="footer__content__bottom__legal__item">
                    <a href="<?php echo $privacy_link ?>">Privacy</a>
                </div>
            </div>
            <div class="footer__content__bottom__access">
                <div class="footer__content__bottom__access__language">
                    English
                </div>
                <div class="footer__content__bottom__access__social">
                    <a href="<?php echo get_field('facebook_link', 'options'); ?>" class="footer__content__bottom__access__social__link">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-facebook"></use>
                        </svg>
                    </a>
                    <a href="<?php echo get_field('instagram_link', 'options'); ?>" class="footer__content__bottom__access__social__link">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-instagram"></use>
                        </svg>
                    </a>
                    <a href="<?php echo get_field('twitter_link', 'options'); ?>" class="footer__content__bottom__access__social__link">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-twitter"></use>
                        </svg>
                    </a>
                    <a href="<?php echo get_field('pinterest_link', 'options'); ?>" class="footer__content__bottom__access__social__link">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-pinterest"></use>
                        </svg>
                    </a>
                    <a href="<?php echo get_field('youtube_link', 'options'); ?>" class="footer__content__bottom__access__social__link">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-youtube"></use>
                        </svg>
                    </a>
                    <a href="<?php echo get_field('linked_in_link', 'options'); ?>" class="footer__content__bottom__access__social__link">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-linkedin"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>


</footer>


<!-- Newsletter Modal -->
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
<!-- End Newsletter Modal -->
<?php wp_footer(); ?>

</body>


</html>