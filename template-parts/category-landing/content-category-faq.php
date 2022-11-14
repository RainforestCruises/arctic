<?php
$faqs = get_field('faqs');
?>


<section class="slider-block" section="section-faqs">
    <div class="slider-block__content">

        <!-- Top - Title/Nav -->
        <div class="slider-block__content__top">

            <!-- Title -->
            <div class="slider-block__content__top__title">
                <div class="title-single">
                    Ships
                </div>
            </div>

 
        </div>

        <div class="destination-faq__grid-container">
        <?php
        if ($rows) {
            foreach ($rows as $row) {
                $question = $row['question'];
                $answer = $row['answer'];
        ?>
                <!-- FAQ -->
                <div class="destination-faq__grid-container__faq">
                    <div class="destination-faq__grid-container__faq__question">
                        <h3><?php echo $question; ?></h3>
                        <div class="plus-minus-toggle plus-collapsed"></div>
                    </div>
                    <div class="destination-faq__grid-container__faq__answer" style="display: none;">
                    <?php echo $answer; ?>
                    </div>
                </div>

        <?php
            }
        } ?>
    </div>
    </div>
</section>