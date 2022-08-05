       <!-- OLD -->
       <!-- Tabs -->
       <div class="hero-content-slide__content__tabs">

         <?php
          $tabIndex = 0;
          foreach ($tab_items as $tab) :
            $title = $tab['title'];
            $content_type = $tab['content_type'];
          ?>

           <?php if ($content_type == 'about') : ?>
             <div class="btn-pill-hero btn-pill-hero--circular active" tabindex="<?php echo $tabIndex; ?>">
               <svg>
                 <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass-06"></use>
               </svg>
             </div>
           <?php else : ?>
             <div class="btn-pill-hero" tabindex="<?php echo $tabIndex; ?>">
               <?php echo $title; ?>
             </div>
           <?php endif; ?>

         <?php $tabIndex++;
          endforeach; ?>

       </div>
       <!-- End Tabs -->
       <div class="hero-content-slide__content__panels">

         <?php
          $tabIndex = 0;
          foreach ($tab_items as $tab) :
            $title = $tab['title'];
            $content_type = $tab['content_type'];

            $snippet = $tab['snippet'];

          ?>

           <?php if ($content_type == 'about') : ?>
             <!-- Panel Snippet -->
             <div class="hero-content-slide__content__panels__panel-snippet">
               <?php echo $snippet; ?>
             </div>
           <?php else :
              $items = [];
              if ($content_type == 'cruise') {
                $items = $tab['cruises'];
              } else if ($content_type == 'itinerary') {
                $items = $tab['itineraries'];
              } else if ($content_type == 'experience') {
                $items = $tab['experiences'];
              } else if ($content_type == 'location') {
                $items = $tab['locations'];
              }
            ?>

             <!-- Panel Series -->
             <div class="hero-content-slide__content__panels__panel-series">
               <?php
                foreach ($items as $i) :
                  $title = get_the_title($i);
                ?>
                 <div class="hero-content-slide__content__panels__panel-series__card">
                   <?php echo $title; ?>
                 </div>

               <?php
                endforeach;
                ?>
             </div>

           <?php endif; ?>




         <?php $tabIndex++;
          endforeach; ?>
       </div>