   <?php

    $breadcrumb = get_field('breadcrumb');


    //For Auto-Copy -----------
    //page variables
    $searchType = $args['searchType'];
    $destinationId = $args['destinationId'];
    $regionId = $args['regionId'];

    //preselections
    $selectedTravelTypes = $args['travelTypes'];
    $selectedExperiences = $args['experiences'];
    $selectedDestinations = $args['destinations'];
    $selectedDepartures = $args['departures'];

    $locationDisplayText = "";
    $conditionalDisplayText = "expertly crafted by our destination specialists. 
    The tours here are just examples of what we can create for you – all our tour packages 
    are bespoke and completely customizable to your tastes and budget";

    $travelTypeDisplayText = "tours";

    if ($searchType == 'destination') {
        $locationDisplayText = get_field('navigation_title', $destinationId);
    } else if ($searchType == 'region') {
        $locationDisplayText = get_field('navigation_title', $regionId);
    }

    if ($selectedDestinations != null) {
        $locationDisplayText = get_field('navigation_title', $selectedDestinations[0]);    //select first one         
    }

    if ($selectedTravelTypes != null) {

        if ($selectedTravelTypes[0] == 'rfc_cruises') {
            $travelTypeDisplayText = "cruises";
        }
        if ($selectedTravelTypes[0] == 'rfc_lodges') {
            $travelTypeDisplayText = "lodges";
        }
        if ($selectedTravelTypes[0] == 'charter_cruises') {
            $travelTypeDisplayText = "charter cruises";
        }



        $conditionalDisplayText = "hand-picked by our destination specialists. 
        Operated by only the most trusted of partners, these " . $travelTypeDisplayText . " have been 
        carefully selected for their authentic design, customer service excellence, 
        and extraordinary itineraries.";
    }


    $autoCopy = "<p>Looking for the best " . get_field('title_text')
        . "? Choose from the finest " . $travelTypeDisplayText . " available in " . $locationDisplayText . ", " . $conditionalDisplayText . "
        </p>";


    ?>
   <!-- Intro -->
   <div class="search-intro">
       <ol class="search-intro__breadcrumb">
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
       <h1 class="search-intro__title">
           <span><?php echo get_field('title_text') ?></span>
           <svg>
               <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
           </svg>
       </h1>
       <div class="search-intro__text" style="display: block;">
           <?php
            if ($searchType == 'top') {
                echo get_field('intro_snippet_top');
            } else {
                $hasCustomText = get_field('intro_snippet_custom_text');

                if ($hasCustomText) {
                    echo get_field('intro_snippet');
                } else {
                    echo $autoCopy;
                }
            }


            ?>
       </div>
   </div>