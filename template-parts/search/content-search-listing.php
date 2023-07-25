<?php

$results = $args['results'];
$resultsTotal = $args['resultsCount'];
$pageCount = $args['pageCount'];
$pageNumber = $args['pageNumber'];
$viewType = $args['viewType'];

if ($results) :
    foreach ($results as $result) :
?>

        <?php
        if ($viewType == 'search-itineraries') {
            get_template_part('template-parts/search/content', 'search-list-itinerary', $result);
        } else if ($viewType == 'search-ships') {
            get_template_part('template-parts/search/content', 'search-list-ship', $result);
        } else if ($viewType == 'search-departures') {
            get_template_part('template-parts/search/content', 'search-list-departure', $result);
        }
        ?>



    <?php endforeach;
else : ?>
    <div class="search-no-results">
        <div class="search-no-results__maintext">
            No results for your search criteria
        </div>
        <div class="search-no-results__subtext">
            Try clearing the filters to get more results
        </div>
        <div class="search-no-results__button-area">
            <button class="btn-primary btn-primary--inverse-outline" id="no-results-clear-button">
                Clear Filters
            </button>
        </div>
    </div>
<?php endif; ?>


<!-- Pagination -->
<div class="search-results-area__grid__pagination">
    <?php
    if ($pageCount > 1 && $pageNumber != 'all') : ?>
        <div class="search-results-area__grid__pagination__pages-group">
            <button class="search-results-area__grid__pagination__pages-group__button search-results-area__grid__pagination__pages-group__button--back-button  <?php echo ($pageNumber == 1) ? 'disabled' : ''; ?>">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                </svg>
            </button>
            <?php
            for ($k = 1; $k <= $pageCount; $k++) :
            ?>
                <button class="search-results-area__grid__pagination__pages-group__button <?php echo ($pageNumber == $k) ? 'current' : ''; ?> " value="<?php echo $k ?>">
                    <?php echo $k ?>
                </button>
            <?php endfor;
            ?>
            <button class="search-results-area__grid__pagination__pages-group__button search-results-area__grid__pagination__pages-group__button--next-button <?php echo ($pageNumber == $pageCount) ? 'disabled' : ''; ?>">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                </svg>
            </button>
        </div>
        <div class="search-results-area__grid__pagination__show-all-group">
            <button class="btn-primary btn-primary--inverse-outline" id="show-all-pages-button">
                Show All
            </button>
        </div>
    <?php endif; ?>
</div>


<div id="totalResultsDisplay" style="display: none;" value="<?php echo $resultsTotal ?>"> </div>
<div id="pageNumberDisplay" style="display: none;" value="<?php echo $pageNumber ?>"> </div>
<div id="viewTypeDisplay" style="display: none;" value="<?php echo $viewType ?>"> </div>