<?php
$newsletter_cta_title = get_field('newsletter_cta_title', 'options');
$newsletter_cta_subtext = get_field('newsletter_cta_subtext', 'options');
$newsletter_cta_image = get_field('newsletter_cta_image', 'options');
$footerClasses = renderFooterClasses();

?>

<section class="newsletter <?php echo $footerClasses; ?>" id="section-newsletter">
    <div class="newsletter__bg-image">
        <img <?php afloat_image_markup($newsletter_cta_image['id'], 'wide-full'); ?>>
    </div>

    <div class="newsletter__content">

        <div class="newsletter__content__title-group">
            <div class="newsletter__content__title-group__title">
                <?php echo $newsletter_cta_title; ?>
            </div>
            <div class="newsletter__content__title-group__sub">
                <?php echo $newsletter_cta_subtext; ?>
            </div>
            <div class="newsletter__content__title-group__cta">
                <button class="cta-primary newsletter-subscribe-button">
                    Sign Up For Our Newsletter To Get The Latest Antarctica Cruise Deals Straight To Your Inbox!

                </button>
            </div>
        </div>

    </div>
</section>