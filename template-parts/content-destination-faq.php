<?php
$rows = get_field('faqs');
?>

<div class="destination-faq">
    <h2 class="destination-faq__header page-divider">
        FAQ
    </h2>
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