<?php
/*Template Name: Contact*/
get_header();
$primary_contact_form_id = get_field('primary_contact_form_id', 'options');
$phone_number = get_field('phone_number', 'options');
$phone_number_numeric = get_field('phone_number_numeric', 'options');
$show_site_notice = get_field('show_site_notice', 'options');
$email = get_field('email', 'options');
$top_level_agents_page = get_field('top_level_agents_page', 'options');

$reviews = get_field('reviews');
$maxlength = 320;
?>

<!-- Contact Page Container -->
<section class="contact-page <?php echo ($show_site_notice ? "site-notice-variant" : "") ?>">
    <div class="contact-page__intro">
        <h1 class="contact-page__intro__title">
            Start Your Adventure Today.
        </h1>
        <div class="contact-page__intro__subtitle">
        Call us on the number below to speak to one of our polar specialists, or alternatively please fill in the form beneath and we'll get back to you ASAP.
        </div>
        <div class="contact-page__intro__subtitle" style="margin-top: 1rem;">
            If you are a travel agent, please use the form <a href="<?php echo $top_level_agents_page . '#contact-form' ?>">here</a>.
        </div>F
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
                    wpforms_display($primary_contact_form_id);
                } else {
                    echo 'Forms Plugin Missing';
                }
                ?>

                 <!-- Outro -->
                 <div class="inquire-form__outro">
                    You can also send us a message directly at <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- Reviews -->
<section class="grid-block" style="margin-top: 6rem; margin-bottom: 10rem;" id="reviews">
    <div class="grid-block__content">
        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">
            <!-- Title -->
            <h2 class="title-single" style="text-align: center; margin-bottom: 6rem;">
                What Our Customers are Saying About Us
            </h2>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid3">
            <?php foreach ($reviews as $review) :
                $image = $review['image'];
                $title = $review['title'];
                $date = $review['date'];
                $text = $review['text'];
                $expand = strlen($text) > $maxlength ? true : false;
                $text_limited = substr($text, 0, $maxlength) . ($expand ? '...' : '');
            ?>
                <div class="text-card ">
                    <div class="text-card__avatar">
                        <div class="text-card__avatar__image-area" style="background-color: <?php echo generateBgColor(); ?>;">
                            <?php echo generateInitials($title); ?>
                            <?php if ($image) : ?>
                                <img <?php afloat_image_markup($image['id'], 'square-thumb', array('square-thumb')); ?>>
                            <?php endif; ?>
                        </div>
                        <div class="text-card__avatar__title-group">
                            <div class="text-card__avatar__title-group__title">
                                <?php echo $title; ?>
                            </div>
                            <div class="text-card__avatar__title-group__sub">
                                <?php echo $date; ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-card__text">
                        <?php echo $text_limited; ?>
                    </div>
                    <?php if ($expand) : ?>
                        <div class="text-card__expand">
                            <button class="btn-text" id="expand-content">
                                Read More
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>


<?php get_footer(); ?>