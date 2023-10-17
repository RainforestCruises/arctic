<?php
$resultsObject = getNavSearchResults("", true);
?>

<!-- Initial Search Menu -->
<div class="nav-search-menu-initial" id="nav-control-menu-initial">
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

<!-- Search Menu -->
<div class="nav-search-menu" id="nav-control-menu-search"></div>