   <?php
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $show_translate_nav = get_field('show_translate_nav', 'options');

    if (is_plugin_active('currency-switcher/index.php')) {
        global $WPCS;
        $currencies = $WPCS->get_currencies();
        $current_currency = $WPCS->current_currency;
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
   <div class="nav-main__content__right__hover-item divider-left">
       <svg>
           <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-globe"></use>
       </svg>
       <span class="hover-item-popover">
           <div class="hover-item-popover__container">
               <div class="hover-item-popover__container__arrow"></div>
               <!-- Currency -->
               <?php if (is_plugin_active('currency-switcher/index.php')) : ?>
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


   <!-- Burger Menu -->
   <div class="burger-button" id="burger-menu">
       <span class="burger-button__bar "></span>
   </div>