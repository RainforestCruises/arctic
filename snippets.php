<?php if (!$hideSecondaryRegions) : ?>
        <!-- Product Name Search Filter -->
        <div class="filter">
            <div class="filter__heading">
                <h5 class="filter__heading__text">
                    Product Name
                </h5>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                </svg>
            </div>
            <div class="filter__content" style="padding-right: .5rem; padding-bottom: 3.5rem; padding-top: 0rem;">
                <div class="filter__content__search-area">
                    <input class="filter__content__search-area__input" type="text" id="searchInput" autocomplete="off" value="<?php echo $searchInput; ?>">
                    <button class="filter__content__search-area__clear" id="searchInputClear">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-cross"></use>
                        </svg>
                    </button>
                    <button class="filter__content__search-area__button " id="searchInputButton">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Regions Filter -->
        <div class="filter">
            <div class="filter__heading">
                <h5 class="filter__heading__text">
                    Region
                    <?php $filterCount = count($preselectedRegion) ?>
                    <div class="filter__heading__text__count <?php echo ($filterCount > 0 ? 'show' : '') ?>" id="regionFilterCount">
                        <?php echo $filterCount; ?>
                    </div>
                </h5>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                </svg>
            </div>
            <div class="filter__content">
                <!-- List -->
                <ul class="filter__content__list">
                    <?php
                    $count = 1;
                    foreach ($sidebarRegions as $region) :
                    ?>
                        <li class="filter__content__list__item">
                            <div class="form-checkbox">
                                <input class="checkbox region-checkbox" type="checkbox" id="region-checkbox-<?php echo $count; ?>" value="<?php echo $region->ID ?>" <?php echo ($preselectedRegion != null ? ($region->ID == $preselectedRegion ? 'checked' : '') : '') ?>>
                                <label for="region-checkbox-<?php echo $count; ?>" tabindex="1"><?php echo get_the_title($region) ?></label>
                            </div>
                        </li>
                    <?php $count++;
                    endforeach; ?>

                </ul>
            </div>
        </div>
    <?php endif ?>