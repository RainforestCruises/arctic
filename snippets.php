<?php
    if (is_page_template('template-category-landing.php')) :
        get_template_part('template-parts/nav/secondary/content', 'nav-category');
    endif; ?>




                      <!-- Destinations -->
                      <div class="resource-card__content__specs__item">
                                        <div class="resource-card__content__specs__item__icon">
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-pin-e"></use>
                                            </svg>
                                        </div>
                                        <div class="resource-card__content__specs__item__text">
                                            <?php echo $destinations; ?>
                                        </div>
                                    </div>