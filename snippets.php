<?php foreach ($menu_toplevel as $toplevelItem) : ?>
    <?php if ($toplevelItem->object != 'page') : ?>
        <a class="nav-mobile__content-panel__button nav-mobile__content-panel__button--forward" menuLinkTo="<?php echo $toplevelItem->ID ?>">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
            </svg>
            <span>
                <?php echo $toplevelItem->title ?>
            </span>
        </a>
    <?php else : ?>
        <a class="nav-mobile__content-panel__button mobile-link" href="<?php echo $toplevelItem->url ?>"><?php echo $toplevelItem->title ?></a>
    <?php endif; ?>
<?php endforeach; ?>

<a class="nav-mobile__content-panel__button mobile-link divider" href="<?php echo get_home_url(); ?>/contact">Contact</a>
<a class="nav-mobile__content-panel__button mobile-link phone" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>">
    <?php echo get_field('phone_number', 'options'); ?>

</a>







<a class="mega-item" href="<?php echo get_permalink($ship); ?>">
    <div class="mega-item__image-area">
        <img <?php afloat_image_markup($hero_gallery[0]['id'], 'square-small'); ?>>
    </div>
    <div class="mega-item__title-group">
        <div class="mega-item__title-group__title">
            <?php echo $title ?>
        </div>
        <div class="mega-item__title-group__sub">
            <?php echo $itineraryDisplay ?>
        </div>
        <div class="mega-item__title-group__sub">
            <?php echo $guestsDisplay ?>
        </div>
    </div>
</a>