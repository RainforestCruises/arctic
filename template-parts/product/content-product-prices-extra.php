<?php
$currentYear = $args['currentYear'];
$charter_view = $args['charter_view'];
$policies = get_field('policies');
$charter_policies = get_field('charter_policies');

$overall_policies = $policies['overall_policies'];
$display_yearly = $policies['display_yearly'];

$display_policies = get_field('display_policies');
$display_special_note = get_field('display_special_note');

?>




<div class="popup" id="page-modal">
    <div class="modal-content">
        <div class="modal-content__wrapper">
            <button class="modal-content__wrapper__close-button close-button" tabindex="0">
            </button>

            <div class="product-prices-extra">
                <?php if ($charter_view == false) : ?>
                    <!-- Policies -->
                    <?php if ($display_policies) : ?>
                        <div class="product-prices-extra__policies <?php echo ($display_yearly == false) ? ('product-prices-extra__policies--single-layout') : ('false'); ?>">
                            <div class="product-prices-extra__policies__list-group product-prices-extra__policies__list-group--overall">
                                <div class="product-prices-extra__policies__list-group__title heading-3 heading-3--underline">
                                    Pricing Policies
                                </div>
                                <ul class="list-svg">

                                    <?php if ($overall_policies != false) :
                                        foreach ($overall_policies as $p) { ?>
                                            <li>
                                                <svg>
                                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                                </svg>
                                                <span><?php echo $p['policy']; ?></span>
                                            </li>
                                    <?php
                                        }
                                    endif;
                                    ?>
                                </ul>
                            </div>
                            <?php if ($display_yearly == true) { ?>
                                <div class="product-prices-extra__policies__list-group product-prices-extra__policies__list-group--first">
                                    <h3 class="product-prices-extra__policies__list-group__title-overall heading-3 heading-3--underline">
                                        <?php echo $currentYear; ?>
                                    </h3>
                                    <ul class="list-svg">
                                        <?php
                                        $current_year_policies = $policies['current_year_policies'];
                                        if ($current_year_policies != false) :
                                            foreach ($current_year_policies as $p) { ?>
                                                <li>
                                                    <svg>
                                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                                    </svg>
                                                    <span><?php echo $p['policy']; ?></span>
                                                </li>
                                        <?php
                                            }
                                        endif;
                                        ?>
                                    </ul>
                                </div>
                                <div class="product-prices-extra__policies__list-group product-prices-extra__policies__list-group--second">
                                    <h3 class="product-prices-extra__policies__list-group__title heading-3 heading-3--underline">
                                        <?php echo ($currentYear + 1); ?>
                                    </h3>
                                    <ul class="list-svg">
                                        <?php
                                        $next_year_policies = $policies['next_year_policies'];
                                        if ($next_year_policies != false) :
                                            foreach ($next_year_policies as $p) { ?>
                                                <li>
                                                    <svg>
                                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                                    </svg>
                                                    <span><?php echo $p['policy']; ?></span>
                                                </li>
                                        <?php
                                            }
                                        endif;
                                        ?>
                                    </ul>
                                </div>

                            <?php } ?>


                        </div>
                    <?php endif; ?>


                    <!-- Note Bot-->
                    <?php if ($display_special_note) : ?>
                        <div class="product-prices-extra__note">
                            <div class="product-prices-extra__note__title heading-3 heading-3--underline">
                                Special Pricing Information
                            </div>
                            <?php echo get_field('special_note_content') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Charter -->
                <?php else : ?>

                    <div class="product-prices-extra__policies product-prices-extra__policies--single-layout">
                        <div class="product-prices-extra__policies__list-group product-prices-extra__policies__list-group--overall">
                            <div class="product-prices-extra__policies__list-group__title heading-3 heading-3--underline">
                                Charter Pricing Policies
                            </div>
                            <ul class="list-svg">

                                <?php if ($charter_policies != false) :
                                    foreach ($charter_policies as $p) : ?>
                                        <li>
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                            <span><?php echo $p['policy']; ?></span>
                                        </li>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </ul>
                        </div>



                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>

</div>