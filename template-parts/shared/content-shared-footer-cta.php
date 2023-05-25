<?php
$footer_cta_title = get_field('footer_cta_title', 'options');
$footer_cta_subtext = get_field('footer_cta_subtext', 'options');
$footer_cta_steps = get_field('footer_cta_steps', 'options');
$footerClasses = renderFooterClasses();
$footerCtaDivider = $args['footerCtaDivider'];
?>

<!-- CTA Pre-Footer -->
<section class="grid-block <?php echo $footerClasses; ?>" id="section-footer">
    <div class="grid-block__content <?php echo $footerCtaDivider ? "block-top-divider" : "";?>">
        <!-- Grid Area -->
        <div class="grid-block__content__grid grid1">
            <div class="footer-cta">

                <!-- Title Area -->
                <div class="footer-cta__title-group">
                    <h2 class="footer-cta__title-group__title">
                        <?php echo $footer_cta_title; ?>
                    </h2>
                    <div class="footer-cta__title-group__sub">
                        <?php echo $footer_cta_subtext; ?>
                    </div>
                </div>

                <!-- Steps -->
                <div class="footer-cta__steps">
                    <?php foreach ($footer_cta_steps as $step) :
                        $icon = $step['icon'];
                        $title = $step['title'];
                        $text = $step['text'];
                    ?>
                        <div class="footer-cta__steps__item">
                            <div class="footer-cta__steps__item__icon-area">
                                <?php echo $icon; ?>
                            </div>
                            <h3 class="footer-cta__steps__item__title">
                                <?php echo $title; ?>
                            </h3>
                            <div class="footer-cta__steps__item__text">
                                <?php echo $text; ?>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>

                <div class="footer-cta__closing">
                    <div class="footer-cta__closing__buttons">
                        <a class="cta-primary cta-primary--inverse" href="<?php echo get_home_url(); ?>/contact">
                        Start Your Adventure Today
                        </a>      
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>



