<?php
/*Template Name: Test*/
wp_enqueue_script('page-test', get_template_directory_uri() . '/js/page-test.js', array('jquery'), false, true);

?>

<?php
get_header();


$slider = get_field('hero');
?>



<!-- Generic Page Container -->
<div class="test-page">

    <section class="test-page__section-hero">

        <!--  Hero -->
        <div class="test-hero">
            <div class="test-hero__bg " id="test-hero__bg">


                <!-- Slider -->
                <?php
                $slideCount = 0;
                foreach ($slider as $s) :
                    $sliderImage = $s['image'];
                    $sliderTitle = $s['title'];
                ?>
                
                    <div class="test-hero__bg__slide" >
                        <?php if ($sliderImage) : ?>                             
                            <img <?php afloat_image_markup($sliderImage['id'], 'full-hero-large'); ?> alt="">
                        <?php endif; ?>
                    </div>

                <?php
                    $slideCount++;
                endforeach; ?>

            </div>






        </div>


    </section>
    <section class="test-page__section-intro">
        Intro</section>

</div>




<?php get_footer(); ?>

<script>
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>