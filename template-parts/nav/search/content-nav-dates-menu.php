<?php
$hideSecondaryRegions = get_field('hide_secondary_regions', 'options');

$regionsArgs = array(
    'post_type' => 'rfc_regions',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'title',
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => 'exclude_from_nav',
            'value' => '1',
            'compare' => '!='
        ),
        array(
            'key' => 'exclude_from_nav',
            'compare' => 'NOT EXISTS'
        )
    )
);
$regions = get_posts($regionsArgs);
$primaryRegion = getPrimaryRegion();
$initialRegion = checkPageRegion(); // set based on the page template

// selection regions
$selectionRegions = [];
foreach ($regions as $region) {

    $season_start = get_field('season_start', $region);
    $season_length = get_field('season_length', $region);
    $season_end = $season_start + $season_length;
    $region_name = get_the_title($region);


    // region
    $regionObject = [
        'ID' => $region->ID,
        'name' => $region_name,
        'season_start' => intval($season_start),
        'season_length' => intval($season_length),
        'isMultiYear' => $season_end > 12 ? true : false,
        'isPrimary' => $primaryRegion->ID == $region->ID ? true : false,
        'initallyShown' => $primaryRegion->ID == $region->ID ? true : false,
        'seasons' => []
    ];

    // season 
    $currentYear = date("Y");
    $seasonArray = [];


    // if multiyear and now is before ending month, start the count one earlier
    for ($x = ($regionObject['isMultiYear'] && ($season_end - 12) >= (int)date('m')) ? -1 : 0; $x < 2; $x++) :
        $hexId = getRandomHex();
        $initiallyShown = $regionObject['isPrimary'] && $x == 0 ? true : false;

        // months
        $monthArray = [];
        for ($z = $season_start; $z <= $season_end; $z++) {
            $monthObject = [
                'hex' => $hexId,
                'initiallyShown' => $initiallyShown,
                'monthNumber' => date('m', mktime(0, 0, 0, $z, 1)),
                'monthName' => date('F', mktime(0, 0, 0, $z, 1)),
                'monthYear' => date('Y', mktime(0, 0, 0, $z, 1)) + $x
            ];

            // if not current year and past month, and not last year
            if (!($monthObject['monthYear'] == $currentYear && $monthObject['monthNumber'] < (int)date('m')) && !($monthObject['monthYear'] == $currentYear - 1)) {
                $monthArray[] = $monthObject;
            };
        }

        $displayYear = $currentYear + $x;
        $seasonName = $regionObject['isMultiYear']  ? $displayYear . "-" .  ($displayYear + 1) . " Season" : $displayYear . " Season";
        $season = [
            'index' => $x,
            'hex' => $hexId,
            'name' => $seasonName,
            'regionId' => $object->ID,
            'months' => $monthArray,
            'initiallyShown' => $initiallyShown,
        ];

        $seasonArray[] = $season;

    endfor;


    $regionObject['seasons'] = $seasonArray;
    $selectionRegions[] = $regionObject;
}

?>


<!-- Nav Dates Manu -->
<div class="nav-dates-menu" id="nav-control-menu-dates">
    <!-- Content Wrapper -->
    <div style="position: relative;">
        <!-- Loading  -->
        <div class="nav-dates-menu__loading">
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <!-- Sections -->
        <?php if (!$hideSecondaryRegions) : ?>
            <!-- Region Select -->
            <div class="nav-dates-menu__section">
                <div class="nav-dates-menu__section__title">
                    Choose your region:
                </div>
                <div class="nav-dates-menu__section__buttons nav-dates-menu__section__buttons--regions">
                    <?php foreach ($selectionRegions as $region) : ?>
                        <button class="btn-pill <?php echo $region['isPrimary'] ? 'active' : '' ?>" region="<?php echo $region['ID']; ?>">
                            <?php echo $region['name'] ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Season / Year Select -->
        <div class="nav-dates-menu__section">
            <div class="nav-dates-menu__section__title">
                Select season:
            </div>
            <div class="nav-dates-menu__section__buttons nav-dates-menu__section__buttons--seasons">
                <?php foreach ($selectionRegions as $region) :
                    $initialDisplay = $region['isPrimary'] ? "flex" : "none";
                    foreach ($region['seasons'] as $season) : ?>
                        <button class="btn-pill <?php echo $season['index'] == 0 ? 'active' : '' ?>" index="<?php echo $season['index']; ?>" region="<?php echo $region['ID']; ?>" season="<?php echo $season['hex'] ?>" style="display: <?php echo $initialDisplay ?>">
                            <?php echo $season['name'] ?>
                        </button>
                <?php endforeach;
                endforeach; ?>
            </div>
        </div>

        <!-- Month Select -->
        <div class="nav-dates-menu__section">
            <div class="nav-dates-menu__section__title">
                When would you like to go?
            </div>
            <div class="nav-dates-menu__section__months">

                <?php foreach ($selectionRegions as $region) :
                    foreach ($region['seasons'] as $season) :
                        foreach ($season['months'] as $month) :
                            $currentItemValue = $month['monthYear'] . '-' . $month['monthNumber'];

                ?>
                            <div class="date-card" style="display: <?php echo $month['initiallyShown'] ? 'flex' : 'none' ?>" date-value="<?php echo $currentItemValue ?>" season="<?php echo $season['hex']; ?>" region="<?php echo $region['ID']; ?>">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-calendar"></use>
                                </svg>
                                <div class="date-card__title">
                                    <?php echo $month['monthName']; ?>
                                </div>
                                <div class="date-card__subtitle">
                                    <?php echo $month['monthYear'] ?>
                                </div>
                            </div>
                <?php endforeach;
                    endforeach;
                endforeach; ?>
            </div>
        </div>
        <div class="nav-dates-menu__section nav-dates-menu__section--submit">
            <?php foreach ($regions as $region) :
                $showInitial = $initialRegion->ID == $region->ID;
            ?>
                <button class="btn-pill btn-pill--icon nav-control-date-submit-button" defaultLink="<?php echo get_permalink(get_field('top_level_search_page', $region)); ?>" region="<?php echo $region->ID; ?>" style="display: <?php echo $showInitial ? '' : 'none' ?>">
                    Search <?php echo get_the_title($region) ?> Dates
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                    </svg>
                </button>
            <?php endforeach; ?>

        </div>
    </div>


</div>