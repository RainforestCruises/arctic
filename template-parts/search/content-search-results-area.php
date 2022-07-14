<?php

//first load
$resultsObject = $args['resultsObject'];
$resultCount = $args['resultCount'];
$pageNumber = $args['pageNumber'];

$viewType = $args['viewType']; //for icon active 
$charterFilter = $args['charterFilter']; //for icon active 

?>

<div class="search-results">
    <div class="search-results__top-section" id="search-results-top">
        <div class="search-results__top-section__result-count" id="response-count">
            Found <?php echo $resultCount; ?> <?php echo ($resultCount == 1) ? 'result' : 'results'; ?>
            <span>
                <?php echo (!$charterFilter) ? 'Prices are displayed in USD per person in double occupancy or charter per day ': 'Charter prices are shown in USD price per day' ; ?>
            </span>
        </div>

        <div class="search-results__top-section__page-count" id="page-number">
            <?php echo ($pageNumber > 1) ? "Page " . $pageNumber : ""; ?>
        </div>

        <div class="search-results__top-section__controls" id="sort-control">

            <div class="search-results__top-section__controls__view-options">
                <button id="view-grid-layout" class="<?php echo ($viewType == 'grid') ? 'active': '' ; ?>">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-grid-layout"></use>
                    </svg>
                </button>
                <button id="view-list-layout" class="<?php echo ($viewType == 'list') ? 'active': '' ; ?>">
                    <svg >
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-list-bullet"></use>
                    </svg>
                </button>

            </div>

            <label class="sort-control" for="result-sort">
                <span class="sort-control__label-text">Sort by</span>
                <select class="sort-control__select" id="result-sort" name="result-sort">
                    <option value="popularity">Popularity</option>
                    <option value="high">Price High to Low</option>
                    <option value="low">Price Low to High</option>
                </select>
            </label>
        </div>
    </div>

    <div class="search-results__grid <?php echo ($viewType == 'grid') ? 'gridview': '' ; ?>" id="response">
        <?php
        get_template_part('template-parts/content', 'search-results-content', $resultsObject);
        ?>
    </div>




</div>