<?php
$hero_image = get_field('hero_image');
$hero_title = get_field('hero_title');
$hero_snippet = get_field('hero_snippet');
$introduction = get_field('introduction');
$intro_title = get_field('intro_title');

$agent_image = get_field('agent_image');
$agent_title = get_field('agent_title');
$agent_snippet = get_field('agent_snippet');

?>

<section class="agency-hero">
    <div class="agency-hero__content">
        <div class="agency-hero__content__text">
            <h1 class="agency-hero__content__text__title">
                <?php echo $hero_title ?>
            </h1>
            <div class="agency-hero__content__text__snippet">
                <?php echo $hero_snippet ?>
            </div>
        </div>

        <div class="agency-hero__content__image">
            <img <?php afloat_image_markup($hero_image['id'], 'featured-medium'); ?>>
        </div>
    </div>
</section>


<section class="agency-intro">
    <div class="agency-intro__content">
        <div class="agency-intro__content__title">
            <?php echo $intro_title ?>
        </div>
        <div class="agency-intro__content__main">
            <?php echo $introduction ?>
        </div>
    </div>
</section>

<section class="agency-person">

    <div class="agency-person__content">
        <div class="agency-person__content__image-area">
            <img <?php afloat_image_markup($agent_image['id'], 'featured-medium'); ?>>

        </div>
        <div class="agency-person__content__text">
            <div class="agency-person__content__text__title">
                <?php echo $agent_title ?>
            </div>
            <div class="agency-person__content__text__snippet">
                <?php echo $agent_snippet ?>
            </div>
        </div>

    </div>

</section>