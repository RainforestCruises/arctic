   <?php $show_translate_nav = get_field('show_translate_nav', 'options'); ?>

   <!-- Contact Mail -->
   <a href="<?php echo get_home_url(); ?>/contact" class="nav-main__content__right__contact-link">
       <svg>
           <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_mail_outline_24px"></use>
       </svg>

   </a>
   <!-- Contact Phone -->
   <div class="nav-main__content__right__phone-desktop divider-left">
       <svg>
           <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-phone-call"></use>
       </svg>
       <span class="phone-popover">

           <div class="phone-popover__container">
               <div class="phone-popover__container__arrow"></div>
               <div class="phone-popover__container__content">
                   <div class="phone-popover__container__content__header">
                       Give Us a Call
                   </div>
                   <a class="phone-popover__container__content__number" href="tel:<?php echo get_field('phone_number_numeric', 'options'); ?>">
                       <?php echo get_field('phone_number', 'options'); ?>
                   </a>

               </div>

           </div>

       </span>

   </div>
   <!-- Language Switch -->
   <?php
    if (is_plugin_active('translatepress-multilingual/index.php') && $show_translate_nav == true) : ?>
       <div class="nav-main__content__right__language divider-left">
           <svg>
               <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_translate_24px"></use>
           </svg>
           <span>

               <?php echo do_shortcode("[language-switcher]"); ?>
           </span>
       </div>
   <?php endif; ?>
   <!-- Burger Menu -->
   <div class="burger-button" id="burger-menu">
       <span class="burger-button__bar "></span>
   </div>