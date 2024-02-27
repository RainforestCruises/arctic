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

$landing_pages = get_field('landing_pages', 'options');
$ships = get_field('ships', 'options');
$guides = get_field('guides', 'options');
$logo = get_field('logo_main', 'options');
$top_level_guides_page = get_field('top_level_guides_page', 'options');
$top_level_deals_page = get_field('top_level_deals_page', 'options');
$top_level_about_page = get_field('top_level_about_page', 'options');
$top_level_search_page = get_field('top_level_search_page', 'options');

?>

<!-- Mobile Menu -->
<nav class="nav-mobile">

    <!-- Top level Menu -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--top" menuid="top">

        <div class="nav-mobile__content-panel__static">
            <div class="nav-mobile__content-panel__static__brand">
                <img src="<?php echo $logo['url']; ?>" alt="<?php echo get_bloginfo('name') ?>" />
            </div>
            <div class="nav-close-button">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </div>
        </div>
        <div class="nav-mobile__content-panel__main">
            <a class="nav-button nav-forward" menuLinkTo="menu-cruises">
                <div class="nav-button__svg-icon">
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
                <div class="nav-button__svg-icon">
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
                <div class="nav-button__svg-icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-read-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    Guide
                </div>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                </svg>
            </a>
            <a class="nav-button mobile-link" href="<?php echo $top_level_deals_page; ?>">
                <div class="nav-button__svg-icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-discount-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    Deals
                </div>
            </a>
            <a class="nav-button mobile-link" href="<?php echo $top_level_about_page; ?>">
                <div class="nav-button__svg-icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-c-question-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    About
                </div>
            </a>
            <a class="nav-button mobile-link" href="<?php echo get_home_url(); ?>/contact">
                <div class="nav-button__svg-icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-send-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    Contact
                </div>
            </a>
            <a class="nav-button mobile-link phone" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>">
                <div class="nav-button__svg-icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-phone-24"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    <?php echo get_field('phone_number', 'options'); ?>
                </div>
            </a>
            <a class="nav-button mobile-link localization-open-button">
                <div class="nav-button__svg-icon">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-globe"></use>
                    </svg>
                </div>
                <div class="nav-button__text">
                    <?php if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
                        <span style="margin-right: 1.5rem;">
                            <?php echo $current_language_name; ?>
                        </span>
                    <?php endif; ?>

                    <?php if (is_plugin_active('currency-switcher/index.php')) : ?>
                       <span class="currency-name-display"><?php echo $current_currency; ?></span> 
                    <?php endif; ?>
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
            <div class="nav-close-button">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
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
                    $hero_title = get_field('hero_title', $item);
                    $hero_images =  get_field('hero_images', $item);
                ?>
                    <a href="<?php echo $url; ?>" class="nav-button mobile-link">
                        <div class="nav-button__img-icon">
                            <img <?php afloat_image_markup($hero_images[0]['id'], 'square-small', array('square-small')); ?>>
                        </div>
                        <div class="nav-button__text">
                            <?php echo $hero_title; ?>
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
            <div class="nav-close-button">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
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
                        <div class="nav-button__img-icon">
                            <img <?php afloat_image_markup($ship_image['id'], 'square-small', array('square-small')); ?>>
                        </div>
                        <div class="nav-button__text">
                            <?php echo $title; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <a class="btn-pill btn-pill--icon mobile-nav-view-all-button" href="<?php echo $top_level_search_page; ?> . ?viewType=search-ships" style="margin: 2rem">
                View All Ships
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </a>

        </div>
    </div>



    <!-- Menu Guides -->
    <div class="nav-mobile__content-panel nav-mobile__content-panel--sub" menuid="menu-guides">
        <div class="nav-mobile__content-panel__static">
            <div class="nav-mobile__content-panel__static__heading">
                Guide
            </div>
            <div class="nav-close-button">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
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
                        <div class="nav-button__img-icon">
                            <img <?php afloat_image_markup($featured_image['id'], 'square-small', array('square-small')); ?>>
                        </div>
                        <div class="nav-button__text">
                            <?php echo $title; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <a class="btn-pill btn-pill--icon mobile-nav-view-all-button" href="<?php echo $top_level_guides_page; ?>" style="margin: 2rem">
                View All Gudies
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </a>
        </div>
    </div>





</nav>