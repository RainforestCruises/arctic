<?php
$faqs = get_field('faqs');
?>



<section class="grid-block" section="section-ships">
    <div class="grid-block__content block-top-divider">

        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">

            <!-- Title -->
            <div class="title-single">
                FAQ
            </div>

        </div>



        <div class="category-faq">
            <?php foreach ($faqs as $row) :
                $question = $row['question'];
                $answer = $row['answer'];
            ?>
                <!-- FAQ -->
                <div class="category-faq__group">
                    <div class="category-faq__group__question">
                        <h3><?php echo $question; ?></h3>
                        <div class="plus-minus-toggle plus-collapsed"></div>
                    </div>
                    <div class="category-faq__group__answer" style="display: none;">
                        <?php echo $answer; ?>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>


    </div>
</section>