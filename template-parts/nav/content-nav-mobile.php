<?php
$landing_pages = get_field('landing_pages', 'options');
$ships = get_field('ships', 'options');
$guides = get_field('guides', 'options');
$logo = get_field('logo_main', 'options');

?>

<!-- Mobile Menu -->
<nav class="nav-mobile">

    <!-- Top level Menu -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--top" menuid="top">

        <div class="nav-mobile__content-panel__static">
            <div class="nav-mobile__content-panel__static__brand">
                <img src="<?php echo $logo['url']; ?>" alt="<?php echo get_bloginfo('name') ?>" />
            </div>
        </div>
        <div class="nav-mobile__content-panel__main">
            <a class="nav-button nav-forward" menuLinkTo="menu-cruises">
                <div class="nav-button__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    Cruises
                </div>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                </svg>
            </a>
            <a class="nav-button nav-forward" menuLinkTo="menu-ships">
                <div class="nav-button__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    Ships
                </div>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                </svg>
            </a>
            <a class="nav-button nav-forward" menuLinkTo="menu-guides">
                <div class="nav-button__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-read-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    Guides
                </div>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                </svg>
            </a>
            <a class="nav-button mobile-link" href="<?php echo get_home_url(); ?>/deals">
                <div class="nav-button__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-discount-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    Deals
                </div>
            </a>
            <a class="nav-button mobile-link" href="<?php echo get_home_url(); ?>/about">
                <div class="nav-button__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-c-question-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    About
                </div>
            </a>
            <a class="nav-button mobile-link" href="<?php echo get_home_url(); ?>/contact">
                <div class="nav-button__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    Contact
                </div>
            </a>
            <a class="nav-button mobile-link phone" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>">
                <div class="nav-button__icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-phone-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    <?php echo get_field('phone_number', 'options'); ?>
                </div>

            </a>
        </div>



    </div>


    <!-- Menu Cruises (Landing Pages) -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="menu-cruises">
        <div class="nav-mobile__content-panel__static">
            <div class="nav-mobile__content-panel__static__heading">
                Cruises
            </div>
            <a class="nav-button nav-back" menuLinkTo="top">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                </svg>
                <div class="nav-button__text">
                    Back
                </div>
            </a>
        </div>
        <div class="nav-mobile__content-panel__main">
            <?php foreach ($landing_pages as $group) :
                $group_title = $group['group'];
                $items = $group['items'];
            ?>
                <div class="nav-mobile__content-panel__main__group-title">
                    <?php echo $group_title; ?>
                </div>
                <?php foreach ($items as $item) :
                    $url = get_permalink($item);
                    $title = get_the_title($item);
                    $hero_slider =  get_field('hero_slider', $item); // first slide image
                    $hero_image = $hero_slider[0]['image'];
                ?>
                    <a href="<?php echo $url; ?>" class="nav-button mobile-link">
                        <div class="nav-button__icon">
                            <img <?php afloat_image_markup($hero_image['id'], 'square-small', array('square-small')); ?>>
                        </div>
                        <div class="nav-button__text">
                            <?php echo $title; ?>
                        </div>
                    </a>

                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>


    </div>

    <!-- Menu Ships -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="menu-ships">
        <div class="nav-mobile__content-panel__static">
            <div class="nav-mobile__content-panel__static__heading">
                Ships
            </div>
            <a class="nav-button nav-back" menuLinkTo="top">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                </svg>
                <div class="nav-button__text">
                    Back
                </div>
            </a>
        </div>
        <div class="nav-mobile__content-panel__main">
            <?php foreach ($ships as $group) :
                $group_title = $group['group'];
                $items = $group['items'];
            ?>
                <div class="nav-mobile__content-panel__main__group-title">
                    <?php echo $group_title; ?>
                </div>
                <?php foreach ($items as $item) :
                    $url = get_permalink($item);
                    $title = get_the_title($item);
                    $hero_gallery = get_field('hero_gallery', $item);
                    $ship_image = $hero_gallery[0];
                ?>

                    <a href="<?php echo $url; ?>" class="nav-button mobile-link">
                        <div class="nav-button__icon">
                            <img <?php afloat_image_markup($ship_image['id'], 'square-small', array('square-small')); ?>>
                        </div>
                        <div class="nav-button__text">
                            <?php echo $title; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>



    <!-- Menu Guides -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="menu-guides">
        <div class="nav-mobile__content-panel__static">
            <div class="nav-mobile__content-panel__static__heading">
                Guides
            </div>
            <a class="nav-button nav-back" menuLinkTo="top">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                </svg>
                <div class="nav-button__text">
                    Back
                </div>
            </a>
        </div>
        <div class="nav-mobile__content-panel__main">
            <?php foreach ($guides as $group) :
                $group_title = $group['group'];
                $items = $group['items'];
            ?>
                <div class="nav-mobile__content-panel__main__group-title">
                    <?php echo $group_title; ?>
                </div>
                <?php foreach ($items as $item) :
                    $guide_post = $item['guide_post'];
                    $url = get_permalink($guide_post);
                    $title = $item['title'];
                    $featured_image = get_field('featured_image', $guide_post)
                ?>
                    <a href="<?php echo $url; ?>" class="nav-button mobile-link">
                        <div class="nav-button__icon">
                            <img <?php afloat_image_markup($featured_image['id'], 'square-small', array('square-small')); ?>>
                        </div>
                        <div class="nav-button__text">
                            <?php echo $title; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>





</nav>