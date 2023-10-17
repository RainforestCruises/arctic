<?php
$resultCategories = $args['resultCategories'];
$count = 0;
foreach ($resultCategories as $resultCategory) :
    if ($resultCategory['Count'] == 0) {
        continue;
    } else {
        $count++;
    }
?>
    <div class="search-category-title">
        <?php echo $resultCategory['CategoryName'] ?>
    </div>

    <?php foreach ($resultCategory['Items'] as $item) : ?>
        <div class="nav-search-item nav-search-item--result" data-url="<?php echo $item['Url']; ?>">
            <div class="nav-search-item__image-area">
                <?php if ($item['Image'] == null) : ?>
                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
                    </svg>
                <?php else : ?>
                    <img <?php afloat_image_markup($item['Image']['id'], 'square-small'); ?>>
                <?php endif; ?>
            </div>
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

<?php endforeach; ?>

<?php if ($count == 0) : ?>
    <div class="search-category-title">
        No results, try a different search term
    </div>
<?php endif; ?>