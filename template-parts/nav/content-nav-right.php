   <?php
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $show_translate_nav = get_field('show_translate_nav', 'options');

    if (is_plugin_active('currency-switcher/index.php')) {
        global $WPCS;
        $currencies = $WPCS->get_currencies();
        $current_currency = $WPCS->current_currency;
        console_log($current_currency);
    }



    if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) {
        $languages = trp_custom_language_switcher();
        $current_language = get_locale();
    }


    ?>


   <!-- Contact Mail -->
   <a href="<?php echo get_home_url(); ?>/contact" class="nav-main__content__right__contact-link">
       <svg>
           <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
       </svg>
   </a>
   <!-- Contact Phone -->
   <div class="nav-main__content__right__hover-item divider-left">
       <svg>
           <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-phone-call"></use>
       </svg>
       <span class="hover-item-popover phone">
           <div class="hover-item-popover__container">
               <div class="hover-item-popover__container__arrow"></div>
               <div class="hover-item-popover__container__content">
                   <div class="hover-item-popover__container__content__phone">
                       <div class="hover-item-popover__container__content__phone__title">
                           Give Us a Call
                       </div>
                       <div class="hover-item-popover__container__content__phone__subtitle">
                           Mon - Fri, 9am - 7pm
                       </div>
                       <a class="hover-item-popover__container__content__phone__number" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>">
                           <?php echo get_field('phone_number', 'options'); ?>
                       </a>
                   </div>

               </div>
           </div>
       </span>
   </div>
   <!-- Global -->
   <?php if (is_plugin_active('currency-switcher/index.php') || (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true)) : ?>
       <div class="nav-main__content__right__hover-item <?php echo (is_plugin_active('currency-switcher/index.php') == true) ? "nav-main__content__right__hover-item--currency" : "" ?> divider-left">
           <div class="hover-item">
               <svg>
                   <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-globe"></use>
               </svg>
               <?php if (is_plugin_active('currency-switcher/index.php')) : ?>
                   <span class="currency-name-display"><?php echo $current_currency; ?></span>
               <?php endif; ?>
           </div>

           <span class="hover-item-popover">
               <div class="hover-item-popover__container">
                   <div class="hover-item-popover__container__arrow"></div>

                   <!-- Currency -->
                   <div class="currency-select-area" style="margin-bottom: 1.5rem"></div>

                   <!-- Language -->
                   <?php if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
                       <div class="hover-item-popover__container__content">
                           <div class="hover-item-popover__container__content__header">
                               Choose Language
                           </div>
                           <div class="hover-item-popover__container__content__buttons" data-no-translation>
                               <?php foreach ($languages as $item) :
                                    $isCurrent = $item['language_code'] == $current_language;
                                ?>
                                   <a class="btn-primary btn-primary--icon btn-primary--small btn-primary--inverse <?php echo $isCurrent ? "active" : ""; ?>" href="<?php echo $item['current_page_url'] ?>">
                                       <?php echo $item['language_name'] ?>
                                   </a>
                               <?php endforeach; ?>
                           </div>
                       </div>
                   <?php endif; ?>
               </div>
           </span>
       </div>

   <?php endif; ?>


   <!-- Burger Menu -->
   <div class="burger-button" id="burger-menu">
       <span class="burger-button__bar "></span>
   </div>



   <!-- Hidden Form -->
   <form class="currency-form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="currency-form">
   </form>