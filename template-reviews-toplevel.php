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
        <div data-romw-token="EFgjaIlLK5iHsds644tfZmrAoCT43DVczPWxRc0emY6YfzXkr0"></div>
        </div>


    </section>



</main>
<script src=" https://reviewsonmywebsite.com/js/v2/embed.js?id=8ed8fd45a2fd062872f56952886c1ec5 " type="text/javascript"></script>

<?php get_footer(); ?>