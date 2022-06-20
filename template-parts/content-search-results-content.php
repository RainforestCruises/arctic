<?php
$results = $args['results'];
$resultsTotal = $args['resultsCount'];
$pageCount = $args['pageCount'];
$pageNumber = $args['pageNumber'];
$viewType = $args['viewType'];
$charterFilter = $args['charterFilter'];
console_log($results);
//if results
if ($results) :
    if ($viewType != 'grid') : //list view
        foreach ($results as $result) :

            $dealPosts = [];
            if ($result->dealAvailable == true) {
                $dealPosts = $result->dealPosts;
            }
            $charterDealPosts = [];
            if ($result->charterDealAvailable == true) {
                $charterDealPosts = $result->charterDealPosts;
            }
?>
            <div class="search-result">
                <a href="<?php echo $result->postUrl;  ?>" class="search-result__image-area">
                    <img <?php afloat_image_markup($result->productImageId, 'featured-medium'); ?>>
                </a>
                <div class="search-result__content">
                    <div class="search-result__content__top">

                        <div class="search-result__content__top__badge-area">
                            <?php if ($result->dealAvailable == true) : ?>
                                <div class="badge-solid badge-solid--small badge-solid--green dealbadge dealbadge-fit current">
                                    Deal
                                    <div class="deal-popover">
                                        <?php foreach ($dealPosts as $d) {
                                            echo '<div>' . get_field('navigation_title', $d) . '</div>';
                                        } ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($result->charterDealAvailable == true) : ?>
                                <div class="badge-solid badge-solid--small badge-solid--green dealbadge dealbadge-charter">
                                    Deal
                                    <div class="deal-popover">
                                        <?php foreach ($charterDealPosts as $d) {
                                            echo '<div>' . get_field('navigation_title', $d) . '</div>';
                                        } ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>


                        <div class="search-result__content__top__title-group">
                            <div class="search-result__content__top__title-group__subtitle">
                                <span class="subtitle-fit <?php echo ($charterFilter == false) ? 'current' : ''; ?>"><?php echo $result->productTypeDisplay ?></span>
                                <span class="subtitle-charter <?php echo ($charterFilter == true) ? 'current' : ''; ?>">Private Charter</span>
                            </div>
                            <h2 class="search-result__content__top__title-group__title">
                                <?php echo $result->productTitle ?>
                            </h2>
                        </div>
                        <div class="search-result__content__top__snippet">
                            <?php echo $result->snippet ?>
                        </div>
                    </div>
                    <div class="search-result__content__bottom">
                        <div class="search-result__content__bottom__details">
                            <div class="search-result__content__bottom__details__group">
                                <span class="search-result__content__bottom__details__group__title">
                                    Regions:
                                </span>
                                <span class="search-result__content__bottom__details__group__text">
                                    <?php
                                    $destinations = $result->destinations;
                                    if ($destinations) :
                                        echo comma_separate_list($destinations);
                                    endif; ?>
                                </span>
                            </div>
                            <div class="search-result__content__bottom__details__group">
                                <span class="search-result__content__bottom__details__group__title">
                                    Destinations:
                                </span>
                                <span class="search-result__content__bottom__details__group__text">
                                    <?php
                                    $locations = $result->locations;
                                    if ($locations) :
                                        echo comma_separate_list($locations);
                                    endif; ?>
                                </span>
                            </div>
                        </div>
                        <div class="search-result__content__bottom__experiences">
                            <!-- Experience Item -->

                            <?php $experiences = $result->experiences;
                            if ($experiences) :
                                foreach ($experiences as $e) :
                                    $experienceSvg = get_field('icon', $e); ?>
                                    <div class="search-result__content__bottom__experiences__item">
                                        <div class="experience-icon">
                                            <?php echo $experienceSvg; ?>
                                            <span class="tooltiptext"><?php echo get_the_title($e); ?></span>
                                        </div>
                                    </div>

                            <?php endforeach;
                            endif; ?>

                        </div>
                    </div>

                </div>
                <div class="search-result__detail">
                    <?php if ($result->postType == 'rfc_cruises') : ?>
                        <div class="search-result__detail__header">
                            <?php if ($result->charterOnly == true) : ?>

                                <div class="search-result__detail__header__tab fit-tab current">
                                    Charter From
                                </div>

                            <?php else : ?>

                                <div class="search-result__detail__header__tab fit-tab <?php echo ($charterFilter == false) ? 'current' : ''; ?>">
                                    Cabins <?php echo ($result->charterAvailable == false) ? 'From' : ''; ?>
                                </div>
                                <?php if ($result->charterAvailable == true) : ?>
                                    <div class="search-result__detail__header__tab charter-tab <?php echo ($charterFilter == true) ? 'current' : ''; ?>">
                                        / Charter
                                    </div>
                                <?php endif; ?>

                            <?php endif; ?>

                        </div>
                    <?php else : ?>
                        <div class="search-result__detail__header">
                            Starting From
                        </div>

                    <?php endif; ?>
                    <!-- FIT Panel -->
                    <?php if ($result->charterOnly == false) : ?>
                        <div class="search-result__detail__panel fit-tab <?php echo ($charterFilter == false) ? 'current' : ''; ?>">
                            <div class="search-result__detail__panel__info">
                                <div class="search-result__detail__panel__info__price-from">

                                    <div class="search-result__detail__panel__info__price-from__price">
                                        <?php echo "$" . number_format($result->lowestPrice, 0);  ?>
                                        <span>
                                            USD
                                        </span>
                                    </div>
                                    <div class="search-result__detail__panel__info__price-from__text">
                                        Per Person
                                    </div>
                                </div>
                                <div class="search-result__detail__panel__info__attributes">

                                    <!-- Length -->
                                    <div class="search-result__detail__panel__info__attributes__item">
                                        <div class="search-result__detail__panel__info__attributes__item__data">
                                            <div class="search-result__detail__panel__info__attributes__item__data__icon">
                                                <svg>
                                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                                </svg>
                                            </div>
                                            <div class="search-result__detail__panel__info__attributes__item__data__text">
                                                <?php echo $result->itineraryLengthDisplay; ?>
                                                <div class="sub-attribute">
                                                    <?php echo $result->itineraryCountDisplay; ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                    <!-- Capacity -->
                                    <?php if ($result->postType != 'rfc_tours') : ?>
                                        <div class="search-result__detail__panel__info__attributes__item">
                                            <div class="search-result__detail__panel__info__attributes__item__data">
                                                <div class="search-result__detail__panel__info__attributes__item__data__icon">
                                                    <svg>
                                                        <?php if ($result->postType == 'rfc_cruises') : ?>
                                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                                        <?php elseif ($result->postType == 'rfc_lodges') : ?>
                                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-bed-23"></use>
                                                        <?php endif; ?>
                                                    </svg>
                                                </div>
                                                <div class="search-result__detail__panel__info__attributes__item__data__text">
                                                    <?php echo $result->vesselCapacityDisplay; ?>
                                                    <div class="sub-attribute">
                                                        <?php echo $result->numberOfCabinsDisplay; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="search-result__detail__panel__cta">
                                <a href="<?php echo $result->postUrl;  ?>" class="btn-cta-round btn-cta-round--small">
                                    View <?php echo $result->productTypeCta; ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($result->postType == 'rfc_cruises') : ?>
                        <!-- Charter Panel -->
                        <div class="search-result__detail__panel charter-tab <?php echo ($result->charterOnly == true || $charterFilter == true) ? 'current' : ''; ?>">
                            <div class="search-result__detail__panel__info">
                                <div class="search-result__detail__panel__info__price-from">

                                    <div class="search-result__detail__panel__info__price-from__price">
                                        <?php echo "$" . number_format($result->lowestCharterPrice, 0);  ?>
                                        <span>
                                            USD
                                        </span>
                                    </div>
                                    <div class="search-result__detail__panel__info__price-from__text">
                                        Per Day
                                    </div>
                                </div>
                                <div class="search-result__detail__panel__info__attributes">

                                    <!-- Length -->
                                    <div class="search-result__detail__panel__info__attributes__item">
                                        <div class="search-result__detail__panel__info__attributes__item__data">
                                            <div class="search-result__detail__panel__info__attributes__item__data__icon">
                                                <svg>
                                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-m-time"></use>
                                                </svg>
                                            </div>
                                            <div class="search-result__detail__panel__info__attributes__item__data__text">
                                                <?php echo $result->itineraryLengthDisplayCharter; ?>
                                                <div class="sub-attribute">
                                                    Flexible
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                    <!-- Capacity -->
                                    <?php if ($result->postType != 'rfc_tours') : ?>
                                        <div class="search-result__detail__panel__info__attributes__item">
                                            <div class="search-result__detail__panel__info__attributes__item__data">
                                                <div class="search-result__detail__panel__info__attributes__item__data__icon">
                                                    <svg>
                                                        <?php if ($result->postType == 'rfc_cruises') : ?>
                                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-boat-front"></use>
                                                        <?php elseif ($result->postType == 'rfc_lodges') : ?>
                                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-bed-23"></use>
                                                        <?php endif; ?>
                                                    </svg>
                                                </div>
                                                <div class="search-result__detail__panel__info__attributes__item__data__text">
                                                    <?php echo $result->vesselCapacityDisplay; ?>
                                                    <div class="sub-attribute">
                                                        <?php echo $result->numberOfCabinsDisplay; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="search-result__detail__panel__cta">
                                <a href="<?php echo ($result->charterOnly == true) ? $result->postUrl : $result->postUrl . '?charter=true';  ?>" class="btn-cta-round btn-cta-round--small">
                                    View Charter
                                </a>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>

            </div>

        <?php endforeach;
    else : //grid view
        foreach ($results as $result) :

            $dealPosts = [];
            if ($result->dealAvailable == true) {
                $dealPosts = $result->dealPosts;
            }
            $charterDealPosts = [];
            if ($result->charterDealAvailable == true) {
                $charterDealPosts = $result->charterDealPosts;
            }

        ?>
            <a href="<?php echo $result->postUrl;  ?>" class="search-result-gridview">
                <div class="search-result-gridview__image-area">
                    <img <?php afloat_image_markup($result->productImageId, 'featured-medium'); ?>>
                </div>
                <ul class="search-result-gridview__destinations">

                    <?php
                    $destinations = $result->destinations;
                    if ($destinations) :
                        foreach ($destinations as $d) :
                            echo '<li>' . get_field('navigation_title', $d) . '</li>';
                        endforeach;
                    endif; ?>

                </ul>


                <div class="search-result-gridview__content-area">
             
                    <div class="search-result-gridview__content-area__left">
                    <?php
                    if (!$charterFilter && !$result->charterOnly && $result->dealAvailable == true) : ?>
                        <div class="badge-solid badge-solid--small badge-solid--green dealbadge dealbadge-fit current">
                            Deal

                        </div>
                    <?php elseif ($result->charterDealAvailable == true) : ?>
                        <div class="badge-solid badge-solid--small badge-solid--green dealbadge dealbadge-charter current">
                            Deal

                        </div>
                    <?php
                    endif;
                    ?>
                        <div class="search-result-gridview__content-area__left__charter-title">
                            <?php echo ($charterFilter) ? 'Private Charter' : $result->productTypeDisplay;  ?>
                        </div>


                        <h2 class="search-result-gridview__content-area__left__title">
                            <?php echo $result->productTitle; ?>
                        </h2>

                    </div>

                    <div class="search-result-gridview__content-area__right">
                        <div class="search-result-gridview__content-area__right__length">
                            <?php
                            if (!$charterFilter && !$result->charterOnly) :
                                echo $result->itineraryLengthDisplay;
                            else :
                                echo $result->vesselCapacityDisplay; //fix for translate
                            endif;
                            ?>
                        </div>

                        <div class="search-result-gridview__content-area__right__price">
                            <?php
                            if (!$charterFilter && !$result->charterOnly) :
                                echo "$" . number_format($result->lowestPrice, 0) . '+';
                            else :
                                echo "$" . number_format($result->lowestCharterPrice, 0) . '+';
                            endif;
                            ?>

                        </div>
                    </div>


                </div>
            </a>

    <?php endforeach;
    endif;
else :
    //else div - no results
    //--button with clear button
    ?>

    <div class="search-no-results">

        <div class="search-no-results__maintext">
            No results for your search criteria
        </div>
        <div class="search-no-results__subtext">
            Try clearing the filters to get more results
        </div>
        <div class="search-no-results__button-area">
            <button class="search-button" id="no-results-clear-button">
                Clear Filters
            </button>
        </div>
    </div>

<?php endif; ?>
<!-- Pagination -->
<div class="search-results__grid__pagination">
    <?php
    if ($pageCount > 1 && $pageNumber != 'all') : ?>
        <div class="search-results__grid__pagination__pages-group">
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--back-button  <?php echo ($pageNumber == 1) ? 'disabled' : ''; ?>">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_left_36px"></use>
                </svg>
            </button>
            <?php
            for ($k = 1; $k <= $pageCount; $k++) :
            ?>
                <button class="search-results__grid__pagination__pages-group__button <?php echo ($pageNumber == $k) ? 'current' : ''; ?> " value="<?php echo $k ?>">
                    <?php echo $k ?>
                </button>
            <?php endfor;
            ?>
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--next-button <?php echo ($pageNumber == $pageCount) ? 'disabled' : ''; ?>">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
                </svg>
            </button>
        </div>
        <div class="search-results__grid__pagination__show-all-group">
            <button class="search-results__grid__pagination__pages-group__button search-results__grid__pagination__pages-group__button--all-button btn-outline btn-outline--small btn-outline--dark">
                Show All
            </button>
        </div>
    <?php endif; ?>
</div>


<div id="totalResultsDisplay" style="display: none;" value="<?php echo $resultsTotal ?>"> </div>
<div id="pageNumberDisplay" style="display: none;" value="<?php echo $pageNumber ?>"> </div>
<div id="viewTypeDisplay" style="display: none;" value="<?php echo $viewType ?>"> </div>
<div id="charterFilter" style="display: none;" value="<?php echo $charterFilter ?>"> </div>