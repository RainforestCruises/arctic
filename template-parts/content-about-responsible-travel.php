<?php

$partners_image = get_field('partners_image');
$continents = get_field('continents');

?>
<div class="about-partners">
    <div class="about-partners__content">
        <div class="about-partners__content__title">
            <h2>Local Community School Projects</h2>
            

            <div class="about-partners__content__title__image-area">
                <img src="<?php echo $partners_image['url']; ?>" alt="logo" />
            </div>
        </div>
        <div class="about-partners__content__snippet">
            <?php echo get_field('partners_snippet'); ?>
        </div>
    </div>
    <div class="about-partners__continents">
        <?php foreach ($continents as $c) : ?>
            <div class="about-partners__continents__item">
                <h3 class="about-partners__continents__item__header">
                    <?php echo $c['header']; ?>
                </h3>
                <div class="about-partners__continents__item__text">
                    <?php echo $c['content']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>