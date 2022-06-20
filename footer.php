<?php

$menu_name = 'footer_menu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);


$menuitems = wp_get_nav_menu_items($menu->term_id);


$menu_group = [];



?>






<!-- Footer -->
<footer class="footer">
    <div class="footer__first">
        <div class="footer__first__compass">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-04"></use>
            </svg>
        </div>
        <div class="footer__first__social">
            <a href="<?php echo get_field('facebook_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-facebook"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('instagram_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-instagram"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('twitter_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-twitter"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('pinterest_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-pinterest"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('youtube_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-youtube"></use>
                </svg>
            </a>
            <a href="<?php echo get_field('linked_in_link', 'options'); ?>" class="footer__first__social__link">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-logo-linkedin"></use>
                </svg>
            </a>

        </div>
    </div>
    <div class="footer__tagline">
        Where can we take you today?
    </div>
    <div class="footer__explore">
        <div class="footer__explore__cta">
            <a href="<?php echo get_home_url() . '/contact'; ?>" class="footer__explore__cta__button">
                Send a Message
            </a>
            
        </div>
        <div class="footer__explore__phone">
            <?php echo get_field('phone_number', 'options'); ?>
        </div>
    </div>
    <div class="footer__navigation">
        <?php foreach ($menuitems as $m) :

            if ($m->menu_item_parent == 0) : ?>
                <!-- Group -->
                <div class="footer__navigation__group">
                    <div class="footer__navigation__group__title"><?php echo $m->post_title; ?></div>
                    <nav class="footer__navigation__group__nav">
                        <ul class="footer__navigation__group__nav__list">
                            <?php foreach ($menuitems as $mm) :
                                if ($mm->menu_item_parent == $m->ID) :
                            ?>
                                    <li class="footer__navigation__group__nav__list__item">
                                        <a href="<?php echo $mm->url; ?>"><?php echo $mm->title; ?></a>
                                    </li>
                            <?php else :
                                    continue;
                                endif;
                            endforeach; ?>
                        </ul>
                    </nav>
                </div>
        <?php
            else :
                continue;
            endif;
        endforeach; ?>
    </div>
    <div class="footer__logo">
        <?php $logo_vertical = get_field('logo_vertical', 'options'); ?>
        <img src="<?php echo $logo_vertical['url']; ?>" alt="<?php echo get_bloginfo( 'name' ) ?>" />
    </div>
    <div class="footer__copyright">
        &#169; <?php echo date('Y') ?> Rainforest Cruises. All rights reserved.
    </div>
</footer>
<?php wp_footer(); ?>

</body>


</html>