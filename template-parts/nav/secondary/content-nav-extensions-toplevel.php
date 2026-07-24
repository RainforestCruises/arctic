<?php
$title = get_field('hero_title');
$sections = get_field('sections');


?>




<!-- Cruise Nav -->
<nav class="nav-secondary">

    <!-- desktop content -->
    <div class="nav-secondary__content">
        <div class="nav-secondary__content__title-area">
            <a href="#top" class="nav-secondary__content__title-area__link">
                <?php echo $title; ?>
            </a>
        </div>
        <div class="nav-secondary__content__links">
            <?php
            $categoryCount = 0;
            foreach ($sections as $section) :
                $category = get_page_template_slug() == "template-deals-toplevel.php" ? $section['category'] : $section['region'];
                $items = get_page_template_slug() == "template-deals-toplevel.php" ? getDealsInCategory($category) : getExtensionsInRegion($category);
                $titleSlug = slugify(get_the_title($category));
                if (!$items) continue; // skip if no deals found for category
            ?>
                <a href="#<?php echo $titleSlug; ?>" class="nav-secondary__content__links__link"><?php echo get_the_title($category) ?></a>

            <?php endforeach; ?>

            <?php if (get_page_template_slug() == "template-deals-toplevel.php") : ?>
                <a href="#group" class="nav-secondary__content__links__link">Group</a>
            <?php endif; ?>

        </div>
        <div class="nav-secondary__content__cta product-template">
            <button class="nav-secondary__content__cta__button btn-pill btn-pill--inverse generic-inquire-cta">
                Inquire
            </button>
        </div>
    </div>

    <!-- mobile content (button) -->
    <div class="nav-secondary__content-mobile">
        <div class="nav-secondary__content-mobile__title">
            <?php echo $title ?>
        </div>
        <div class="nav-secondary__content-mobile__icon">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
            </svg>
        </div>
    </div>

    <!--mobile menu expand-->
    <nav class="nav-secondary__mobile-menu">
        <ul class="nav-secondary__mobile-menu__list">
            <?php
            $categoryCount = 0;
            foreach ($sections as $section) :
                $category = get_page_template_slug() == "template-deals-toplevel.php" ? $section['category'] : $section['region'];
                $items = get_page_template_slug() == "template-deals-toplevel.php" ? getDealsInCategory($category) : getExtensionsInRegion($category);
                $titleSlug = slugify(get_the_title($category));
                if (!$items) continue; // skip if no deals found for category
            ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a href="#<?php echo $titleSlug; ?>" class="nav-secondary__mobile-menu__list__item__link"><?php echo get_the_title($category) ?></a>
                </li>
            <?php endforeach; ?>
            <?php if (get_page_template_slug() == "template-deals-toplevel.php") : ?>
                <li class="nav-secondary__mobile-menu__list__item">
                    <a class="nav-secondary__mobile-menu__list__item__link" href="#group">Group</a>
                </li>
            <?php endif; ?>


        </ul>
    </nav>
</nav>