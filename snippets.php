
 
 
 
 
 <!-- Cruises  -->
 <?php
    get_template_part('template-parts/home/content', 'home-ships');
    ?>

    <!-- Routes  -->
    <?php
    get_template_part('template-parts/home/content', 'home-routes');
    ?>

    <!-- Itineraries  -->
    <?php
    get_template_part('template-parts/home/content', 'home-itineraries');
    ?>

    <!-- Styles  -->
    <?php
    get_template_part('template-parts/home/content', 'home-styles');
    ?>

    <!-- Quote  -->
    <?php
    get_template_part('template-parts/home/content', 'home-quote');
    ?>


    <!-- Experiences  -->
    <?php
    get_template_part('template-parts/home/content', 'home-experiences');
    ?>

    <!-- Reviews  -->
    <?php
    if ($show_reviews) :
        get_template_part('template-parts/home/content', 'home-reviews');
    endif;
    ?>

    <!-- Guides  -->
    <?php
    get_template_part('template-parts/home/content', 'home-guides');
    ?>


    <!-- Footer CTA  -->
    <?php
    get_template_part('template-parts/shared/content', 'shared-footer-cta', $args);
    ?>