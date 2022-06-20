<?php
$navTitle = "";
$destinationType = "";

$accommodationDisplayText = 'Lodges';

if (is_page_template('template-destinations-destination.php') || is_page_template('template-destinations-region.php')) {
    $accommodationDisplayText = get_field('accommodations_label');

    if ($accommodationDisplayText == null) {
        $accommodationDisplayText = 'Lodges';
    }
}


if (is_page_template('template-destinations-region.php')) :
    $r = get_field('region_post');
    $navTitle = get_field('navigation_title', $r);
    $destinationType = "region";
elseif (is_page_template('template-destinations-destination.php')) :
    $d = get_field('destination_post');
    $navTitle = get_field('navigation_title', $d);
    $destinationType = "destination";
else :
    $d = get_field('destination_post');
    $navTitle = get_field('navigation_title', $d);
    $destinationType = "cruise";
endif; ?>

<nav class="nav-secondary" id="nav-secondary">
    <div class="nav-secondary__main">
        <div class="nav-secondary__main__title-area">
            <a class="nav-secondary__main__title-area__title" id="nav-secondary-title" href="#top">
                <?php echo $navTitle ?>
            </a>
            <button class="nav-secondary__main__title-area__button" id="nav-secondary-button">
                <div class="nav-secondary__main__title-area__button__icon-area">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                    </svg>
                </div>
                <div class="nav-secondary__main__title-area__button__text-area">
                    <?php echo $navTitle ?>
                </div>

            </button>

        </div>
        <ul class="nav-secondary__main__links">

            <!-- Order depending on template type -->
            <?php if ($destinationType == 'region' || $destinationType == 'destination') { ?>
                <li>
                    <a href="#packages">Packages</a>
                </li>
                <?php if ($destinationType == 'destination') {
                    $hide_cruises = get_field('hide_cruises');
                    if (!$hide_cruises) { ?>
                        <li>
                            <a href="#cruises">Cruises</a>
                        </li>
                    <?php }
                } else { ?>
                    <li>
                        <a href="#cruises">Cruises</a>
                    </li>
                <?php } ?>

                <?php if ($destinationType == 'destination' || $destinationType == 'region') {
                    $hide_accommodations = get_field('hide_accommodations');
                    if (!$hide_accommodations) { ?>
                        <li>
                            <a href="#accommodation"><?php echo $accommodationDisplayText ?></a>
                        </li>
                    <?php }
                } else { ?>
                    <li>
                        <a href="#accommodation"><?php echo $accommodationDisplayText ?></a>
                    </li>
                <?php } ?>

            <?php } else if ($destinationType == 'cruise') { ?>
                <li>
                    <a href="#cruises">Cruises</a>
                </li>
                <li>
                    <a href="#packages">Packages</a>
                </li>
            <?php } ?>

            <li>
                <a href="#travel-guide">Travel Guide</a>
            </li>
            <?php if (get_field('show_testimonials') == true) { ?>
                <li>
                    <a href="#testimonials">Testimonials</a>
                </li>
            <?php } ?>
            <li href="#faq">
                <a href="#faq">FAQ</a>
            </li>
        </ul>
        <div class="nav-secondary__main__cta">
            <button class="btn-cta-round btn-cta-round--small " id="nav-secondary-cta">
                Inquire
            </button>
        </div>
    </div>
</nav>



<!--mobile menu expand-->
<nav class="nav-secondary-mobile ">
    <ul class="nav-secondary-mobile__list">

        <!-- Order depending on template type -->
        <?php if ($destinationType == 'region' || $destinationType == 'destination') { ?>
            <li class="nav-secondary-mobile__list__item">
                <a href="#packages" class="nav-secondary-mobile__list__item__link">Packages</a>
            </li>
            <?php if ($destinationType == 'destination') {
                $hide_cruises = get_field('hide_cruises');
                if (!$hide_cruises) { ?>
                    <li class="nav-secondary-mobile__list__item">
                        <a href="#cruises" class="nav-secondary-mobile__list__item__link">Cruises</a>
                    </li>
                <?php }
            } else { ?>
                <li class="nav-secondary-mobile__list__item">
                    <a href="#cruises" class="nav-secondary-mobile__list__item__link">Cruises</a>
                </li>
            <?php } ?>

            <?php if ($destinationType == 'destination' || $destinationType == 'region') {
                $hide_accommodations = get_field('hide_accommodations');
                if (!$hide_accommodations) { ?>
                    <li class="nav-secondary-mobile__list__item">
                        <a href="#accommodation" class="nav-secondary-mobile__list__item__link"><?php echo $accommodationDisplayText ?></a>
                    </li>
                <?php }
            } else { ?>
                <li class="nav-secondary-mobile__list__item">
                    <a href="#accommodation" class="nav-secondary-mobile__list__item__link"><?php echo $accommodationDisplayText ?></a>
                </li>
            <?php } ?>

        <?php } else if ($destinationType == 'cruise') { ?>
            <li class="nav-secondary-mobile__list__item">
                <a href="#cruises" class="nav-secondary-mobile__list__item__link">Cruises</a>
            </li>
            <li class="nav-secondary-mobile__list__item">
                <a href="#packages" class="nav-secondary-mobile__list__item__link">Packages</a>
            </li>
        <?php } ?>

        <li class="nav-secondary-mobile__list__item">
            <a href="#travel-guide" class="nav-secondary-mobile__list__item__link">Travel Guide</a>
        </li>

        <?php if (get_field('show_testimonials') == true) { ?>
            <li class="nav-secondary-mobile__list__item">
                <a href="#testimonials" class="nav-secondary-mobile__list__item__link">Testimonials</a>
            </li>
        <?php } ?>
        <li class="nav-secondary-mobile__list__item" href="#faq">
            <a href="#faq" class="nav-secondary-mobile__list__item__link">FAQ</a>
        </li>

    </ul>
</nav>