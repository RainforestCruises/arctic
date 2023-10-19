<?php
$regionsArgs = array(
    'post_type' => 'rfc_regions',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
);
$regions = get_posts($regionsArgs);

$primaryRegion = null;
foreach ($regions as $region) {
    $primary = get_field('primary', $region);
    if ($primary) {
        $primaryRegion = $region;
    }
}

$selectionMonths = [];
$currentMonth = (int)date('m');
$monthLimit = 18;

for ($x = $currentMonth; $x < $currentMonth + $monthLimit; $x++) {

    $object = new stdClass();
    $object->monthName = date('F', mktime(0, 0, 0, $x, 1));
    $object->monthNumber = date('m', mktime(0, 0, 0, $x, 1));
    $object->year = date('Y', mktime(0, 0, 0, $x, 1));
    $object->initiallyShown = true;

    $monthRegions = [];
    foreach ($regions as $region) {
        $season_start = get_field('season_start', $region);
        $season_length = get_field('season_length', $region);
        $season_end = $season_start + $season_length;

        $monthNumberArray = []; // build array of month numbers applicable to this region
        for ($z = $season_start - 1; $z <= $season_end; $z++) {
            $monthNumberArray[] = date('m', mktime(0, 0, 0, $z, 1));
        }

        if (array_search($object->monthNumber, $monthNumberArray)) { // check if the current month number corresponds to the array
            $monthRegions[] = $region->ID;
        }
    }
    $object->monthRegions = $monthRegions;

    if (array_search($primaryRegion->ID, $object->monthRegions) === false) {  // determine if initially shown based on preselected region
        $object->initiallyShown = false;
    }

    if ($object->monthRegions != null) { // exclude months that have no regional match
        $selectionMonths[] = $object;
    }
}

?>


<!-- Nav Dates Manu -->
<div class="nav-dates-menu" id="nav-control-menu-dates">
    <div class="nav-dates-menu__section">
        <div class="nav-dates-menu__section__title">
            Choose your region:
        </div>
        <div class="nav-dates-menu__section__buttons">
            <?php foreach ($regions as $region) :
                $name = get_the_title($region);
                $primary = get_field('primary', $region);
                $regionId = $region->ID;
            ?>
                <button class="btn-pill <?php echo $primary ? 'active' : '' ?>" region="<?php echo $regionId; ?>">
                    <?php echo $name ?>
                </button>
            <?php endforeach; ?>
        </div>

    </div>

    <div class="nav-dates-menu__section">
        <div class="nav-dates-menu__section__title">
            When would you like to go?
        </div>
        <div class="nav-dates-menu__section__slider-area">
            <div class="swiper-button-prev swiper-button-prev--white-border nav-dates-swiper-button-prev">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-left"></use>
                </svg>
            </div>
            <div class="swiper-button-next swiper-button-next--white-border nav-dates-swiper-button-next">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                </svg>
            </div>
            <div class="nav-dates-menu__section__slider-area__slider swiper" id="nav-dates-menu-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($selectionMonths as $m) :
                        $currentItemValue = $m->year . '-' . $m->monthNumber;
                        $matchRegion = $m->initiallyShown == false ? "none" : "flex";
                    ?>
                        <div class="date-card swiper-slide" style="display: <?php echo $matchRegion ?>" date-value="<?php echo $currentItemValue ?>" region-value="<?php echo implode(",", $m->monthRegions); ?>">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-calendar"></use>
                            </svg>
                            <div class="date-card__title">
                                <?php echo $m->monthName; ?>
                            </div>
                            <div class="date-card__subtitle">
                                <?php echo $m->year; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>