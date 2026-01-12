<?php
global $wp;
$current_url = home_url(add_query_arg(array(), $wp->request));
$show_translate_nav = get_field('show_translate_nav', 'options');

// currency
if (is_plugin_active('currency-switcher/index.php')) {
    global $WPCS;
    $currencies = $WPCS->get_currencies();
    $current_currency = $WPCS->current_currency;
    $current_symbol = "$";
    foreach ($currencies as $item) :
        $isCurrent = $item['name'] == $current_currency;
        if ($isCurrent) {
            $current_symbol = $item['symbol'];
        }
    endforeach;
}

// language
if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) {
    $languages = trp_custom_language_switcher();
    $current_language = get_locale();
    $current_language_name = "English";
    foreach ($languages as $item) :
        $isCurrent = $item['language_code'] == $current_language;
        if ($isCurrent) {
            $current_language_name = $item['language_name'];
        }
    endforeach;
}


$footer_links = get_field('footer_links', 'options');
$logo_minimal = get_field('logo_minimal', 'options');
$slogan_image = get_field('slogan_image', 'options');


console_log($logo_minimal);
console_log('slogan');

console_log($slogan_image);

$phone_number = get_field('phone_number', 'options');
$phone_number_numeric = get_field('phone_number_numeric', 'options');
$email = get_field('email', 'options');

$privacy_link = get_field('privacy_link', 'options');
$terms_link = get_field('terms_link', 'options');
$newsletter_text = get_field('newsletter_text', 'options');

$newsletter_form_id = get_field('newsletter_form_id', 'options');
$footerClasses = renderFooterClasses();
?>



<!-- Footer -->
<footer class="footer <?php echo $footerClasses; ?>">
    <div class="footer__content">
        <div class="footer__content__main">

            <div class="footer__content__main__newsletter">
                <a class="footer__content__main__newsletter__brand" href="<?php echo get_home_url(); ?>">
                    <img src="<?php echo $logo_minimal['url']; ?>" alt="<?php echo get_bloginfo('name') ?>" />
                </a>
                <div class="footer__content__main__newsletter__subtext">
                    <?php echo $newsletter_text; ?>

                </div>
                <div class="footer__content__main__newsletter__cta">
                    <button class="btn-primary newsletter-subscribe-button">Join Our Newsletter</button>
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
                    <div>Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
                </div>

                <div class="footer__content__main__contact__title">
                    Antarctica Cruises
                </div>
                <div class="footer__content__main__contact__text">
                    <div>1680 Michigan Avenue, Suite 700</div>
                    <div>Miami Beach, FL 33139</div>
                    <div>Licensed Florida Seller Of Travel #ST38603</div>
                    <div>IATAN Accredited Agency #10716451</div>
                </div>
            </div>

            <ul class="footer__content__main__links">
                <?php foreach ($footer_links as $footer_link) : ?>
                    <li>
                        <a href="<?php echo $footer_link['item'] ?>"> <?php echo $footer_link['display'] ?></a>
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
            <div class="footer__content__bottom__slogan">
            <img src="<?php echo $slogan_image['url']; ?>" alt="<?php echo get_bloginfo('name') ?>" />
        </div>
            <div class="footer__content__bottom__access">
                <div class="footer__content__bottom__access__localization">

                    <button class="btn-text btn-text--icon-left localization-open-button">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-globe"></use>
                        </svg>
                        <div>
                            <?php if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
                                <span><?php echo $current_language_name; ?></span>
                            <?php endif; ?>
                            <?php if (is_plugin_active('currency-switcher/index.php')) : ?>
                                <span class="currency-name-display"><?php echo $current_currency; ?></span>
                            <?php endif; ?>
                        </div>
                    </button>
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
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-twitter-x"></use>
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


<!-- Localization Modal -->
<div class="modal modal--minimal" id="localizationModal">

    <div class="modal__content">
        <div class="modal__content__top">
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    Change Locale Settings
                </div>
            </div>
            <button class="btn-text btn-text--bg close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>
        <div class="modal__content__main">

            <!-- Currency -->
            <div class="currency-select-area" style="margin-bottom: 1.5rem"></div>
            <!-- Language -->
            <?php if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
                <div class="hover-item-popover__container__content">
                    <div class="hover-item-popover__container__content__header">
                        Choose Language
                    </div>
                    <div class="hover-item-popover__container__content__buttons" data-no-translation>
                        <?php foreach ($languages as $item) :
                            $isCurrent = $item['language_code'] == $current_language;
                        ?>
                            <a class="btn-primary btn-primary--inverse <?php echo $isCurrent ? "active" : ""; ?>" href="<?php echo $item['current_page_url'] ?>">
                                <?php echo $item['language_name'] ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>


<!-- Newsletter Modal -->
<div class="modal modal--minimal" id="newsletterModal">

    <div class="modal__content">
        <div class="modal__content__top">
            <div class="modal__content__top__nav">

            </div>
            <button class="btn-text btn-text--bg close-modal-button">
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