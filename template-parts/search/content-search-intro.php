   <?php

    $breadcrumb = get_field('breadcrumb');

    $regionId = $args['region'];
    $regionPost = ($regionId != null) ? get_post($regionId) : null;
    $regionTitle = get_field('navigation_title', $regionPost);


    ?>
   <!-- Intro -->
   <section class="search-intro" id="search-page-intro">
       <div class="search-intro__content">
           <ol class="search-intro__content__breadcrumb">
               <li>
                   <a href="<?php echo home_url() ?>">Home</a>
               </li>
               <?php
                if ($breadcrumb) :
                    foreach ($breadcrumb as $b) :
                        if ($b['link'] != null) : ?>
                           <li>
                               <a href=" <?php echo $b['link']  ?>"><?php echo $b['title'] ?></a>
                           </li>
                       <?php else : ?>
                           <li>
                               <?php echo $b['title'] ?>
                           </li>
               <?php endif;
                    endforeach;
                endif; ?>

           </ol>
           <h1 class="search-intro__content__title">
               <span><?php echo get_field('title_text') ?></span>
               <svg>
                   <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
               </svg>
           </h1>
           <div class="search-intro__content__text" style="display: block;">
               <?php
                echo get_field('intro_snippet');
                ?>
           </div>
       </div>
   </section>