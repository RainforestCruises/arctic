<?php
$faqs = get_field('faqs');
$faq_title = get_field('faq_title');
$firstFaqs = array_slice($faqs, 0, 6);
$displayLimit = 250;
?>

<section class="grid-block" id="section-faq">
    <div class="grid-block__content block-top-divider">
        <div class="grid-block__content__top">
            <!-- Title -->
            <h2 class="title-single">
                <?php echo $faq_title; ?>
            </h2>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid3">
            <?php
            $count = 0;
            foreach ($firstFaqs as $faq) :
                $question = $faq['question'];
                $answer = $faq['answer'];

                $expand = strlen($answer) > $displayLimit ? true : false;
                $answer_limited = substr($answer, 0, $displayLimit) . ($expand ? '...' : '');
            ?>

                <div class="text-card encapsulated">

                    <h3 class="text-card__title-single">
                        <?php echo $question; ?>
                    </h3>
                    <div class="text-card__text">
                        <?php echo $answer_limited; ?>
                    </div>

                    <?php if ($expand) : ?>
                        <div class="text-card__expand">
                            <button class="btn-text-plain read-all-faqs" section="faq-section-<?php echo $count; ?>">
                                Read More
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php $count++;
            endforeach; ?>

        </div>

        <!-- CTA -->
        <div class="grid-block__content__cta">
            <button class="cta-primary cta-primary--inverse read-all-faqs" section="faq-section-0">
                Read All FAQs
            </button>
        </div>

    </div>
</section>


<div class="modal" id="faqsModal">
    <div class="modal__content">
        <div class=" modal__content__top">
            <!-- Top Modal Content -->
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    All FAQs
                </div>
            </div>
            <button class="btn-text-icon close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>

        <!-- Main Modal Content -->
        <div class="modal__content__main" id="faqsModalMainContent">

            <?php
            $count = 0;
            foreach ($faqs as $faq) :
                $question = $faq['question'];
                $answer = $faq['answer'];
            ?>

                <div class="text-card modal-section" id="<?php echo 'faq-section-' . $count; ?>">

                    <div class="text-card__title-single">
                        <?php echo $question; ?>
                    </div>
                    <div class="text-card__text">
                        <?php echo $answer; ?>
                    </div>

                </div>
            <?php $count++;
            endforeach; ?>

        </div>
    </div>
</div>