

<?php 

if (is_plugin_active('currency-switcher/index.php')) {
    global $WPCS;
    $currencies = $WPCS->get_currencies();
    $current_currency = $WPCS->current_currency;
}

if (is_plugin_active('currency-switcher/index.php')) : ?>
    <div class="hover-item-popover__container__content">
        <div class="hover-item-popover__container__content__header">
            Choose Currency
        </div>
        <div class="hover-item-popover__container__content__buttons">
            <?php foreach ($currencies as $item) :
                $isCurrent = $item['name'] == $current_currency;
            ?>
                <a class="btn-primary btn-primary--icon btn-primary--small btn-primary--inverse <?php echo $isCurrent ? "active" : ""; ?>" href="<?php echo $current_url . "?currency=" . $item['name'] ?>">
                    <div>
                        <?php echo $item['description']; ?>
                    </div>
                    <div class="subtext">
                        <?php echo $item['name'] ?> &#8212; <?php echo $item['symbol']; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>