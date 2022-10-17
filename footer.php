<?php
$footer_menus = get_field('footer_menus', 'options');
$privacy_link = get_field('privacy_link', 'options');
$terms_link = get_field('terms_link', 'options');
$footerClasses = renderFooterClasses(); 
?>


<!-- Footer -->
<footer class="footer <?php echo $footerClasses; ?>">

    <div class="footer__content">
        <div class="footer__content__main">
            <?php foreach ($footer_menus as $menu) :
                $header = $menu['header'];
                $items = $menu['items'];
            ?>

                <div class="footer-menu">
                    <div class="footer-menu__header">
                        <?php echo $menu['header']; ?>
                    </div>
                    <ul class="footer-menu__list">
                        <?php foreach ($items as $item) :
                            $link_name = $item['link_name'];
                            $link = $item['link'];
                        ?>
                            <li class="footer-menu__list__item">
                                <a href="<?php echo $link ?>"><?php echo $link_name; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>


            <?php endforeach; ?>
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
<?php wp_footer(); ?>

</body>


</html>