<?php
$resultsObject = $args['resultsObject'];

$resultCount = $args['resultCount'];
$pageNumber = $args['pageNumber'];
$viewType = $args['viewType']; 
console_log($resultsObject);
?>

<div class="search-results-area">
    <div class="search-results-area__top-section" id="search-results-top">
        <div class="search-results-area__top-section__result-count">
            <div class="search-results-area__top-section__result-count__findings" id="response-count">
                Found <?php echo $resultCount; ?> <?php echo ($resultCount == 1) ? 'result' : 'results'; ?>
                <span id="page-number">
                    <?php echo ($pageNumber > 1) ? " (Page " . $pageNumber . ")" : ""; ?>
                </span>
            </div>
            <div class="search-results-area__top-section__result-count__subtext">
                Prices are displayed in USD per person with full occupancy
            </div>
        </div>

        <div class="search-results-area__top-section__view-type">
            <div class="view-type-control">
                <button class="<?php echo $viewType == 'search-itineraries' ? 'active' : ''?>" id="view-itineraries">
                    Itineraries
                </button>
                <button class="<?php echo $viewType == 'search-ships' ? 'active' : ''?>" id="view-ships">
                    Ships
                </button>
                <button class="<?php echo $viewType == 'search-departures' ? 'active' : ''?>" id="view-departures">
                    Departures
                </button>
            </div>
        </div>

        <div class="search-results-area__top-section__controls" id="sort-control">
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

    <div class="search-results-area__grid <?php echo $viewType; ?>" id="response">
        <?php get_template_part('template-parts/search/content', 'search-listing', $resultsObject); ?>
    </div>

</div>