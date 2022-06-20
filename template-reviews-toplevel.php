<?php
/*Template Name: Reviews - Top Level*/

get_header();
?>



<main class="reviews-page">

    <!-- Intro -->
    <section class="reviews-page__section-hero">


        <div class="reviews-hero">
            <h1 class="reviews-hero__title">
                <?php echo get_field('page_title_text') ?>
            </h1>
            <div class="reviews-hero__subtext">
                <?php echo get_field('intro_snippet') ?>
            </div>            
        </div>

    </section>

    <!-- Reviews Content -->
    <section class="reviews-page__section-content">


        <div class="reviews-content">
                <div data-token="sB4qs94MlVnG05rLfF2EUUiT7tsB6XPh68n78c25jQls4RGP34" class="romw-reviews"></div>
        </div>


    </section>



</main>
<script src="https://reviewsonmywebsite.com/js/embedLoader.js?id=03d30ab029f3709eb7ee" type="text/javascript"></script>


<?php get_footer(); ?>