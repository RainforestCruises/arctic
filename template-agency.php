<?php
/*Template Name: Agency*/

get_header();


?>

<main class="main-content">

    <!-- Hero / All Sections -->
    <?php
    get_template_part('template-parts/agency/content', 'agency-hero');
    ?>


    <?php
    get_template_part('template-parts/agency/content', 'agency-form');
    ?>
</main>



<?php get_footer(); ?>