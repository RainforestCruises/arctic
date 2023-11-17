<?php
$resultsObject = getNavSearchResults("", true);
?>

<div class="nav-search-modal" id="navSearchModal">
    <div class=" nav-search-modal__top">
        <div class="nav-search-modal__top__nav">
            <button class="btn-pill btn-pill--icon active" id="navSearchModalMainTab">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
                </svg>
                Explore
            </button>
            <button class="btn-pill btn-pill--icon" id="navSearchModalDatesTab">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-calendar"></use>
                </svg>
                Dates
            </button>

        </div>
        <button class="btn-text btn-text--bg" id="navSearchModalClose">
            Close
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        </button>
    </div>

    <!-- Explore Search -->
    <div class="nav-search-modal__main" id="navSearchModalMain">
        <div class="nav-search-modal__main__input-area">

            <!-- Input Group -->
            <div class="nav-search-modal__main__input-area__input-group" id="navSearchModalInputArea">
                <input type="text" id="navSearchModalInput" placeholder="Search Itineraries, Ships, Routes, Months...">
                <div class="lds-ring">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <button class="nav-control-clear-button" id="navSearchModalClearButton">
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-cross"></use>
                    </svg>
                </button>
            </div>

            <div class="nav-search-modal__main__input-area__cta">
                <button class="btn-primary navSearchModalSubmitButton">
                    Search
                </button>
            </div>

        </div>


        <div class="nav-search-modal__main__results-area" id="navSearchModalResults">

        </div>
        <div class="nav-search-modal__main__results-area-initial active" id="navSearchModalResultsInitial">
            <?php foreach ($resultsObject['resultCategories'] as $resultCategory) : ?>
                <div class="nav-search-menu-initial__category">
                    <div class="nav-search-menu-initial__category__title">
                        <?php echo $resultCategory['CategoryName'] ?>
                    </div>
                    <div class="nav-search-menu-initial__category__group">
                        <?php foreach ($resultCategory['Items'] as $item) : ?>
                            <div class="nav-search-item <?php echo ($item['Image'] == null) ? "nav-search-item--no-avatar" : "nav-search-item--avatar" ?>" data-url="<?php echo $item['Url']; ?>">

                                <?php if ($item['Image'] != null) : ?>
                                    <div class="nav-search-item__image-area">
                                        <img <?php afloat_image_markup($item['Image']['id'], 'square-small'); ?>>
                                    </div>
                                <?php endif; ?>

                                <div class="nav-search-item__title-group">
                                    <div class="nav-search-item__title-group__title">
                                        <?php echo $item['Title'] ?>
                                    </div>
                                    <div class="nav-search-item__title-group__sub">
                                        <?php echo $item['Subtitle'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <div class="nav-search-modal__dates" id="navSearchModalDates">

    </div>
</div>
<!-- 
<div class="nav-search-modal-cta" id="navSearchModalBottomCta">
    <button id="navSearchModalSubmitButton">
        Search
    </button>
</div> -->