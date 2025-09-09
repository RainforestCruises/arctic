<?php
$tips = get_field('tips');

?>



<section class="grid-block narrow section-padding">
    <div class="grid-block__content">
        <!-- Top - Title/Nav -->
        <div class="grid-block__content__top">
            <!-- Title -->
            <h2 class="title-single center">
                My Top Tips
            </h2>
        </div>

        <!-- Grid Area -->
        <div class="grid-block__content__grid grid3">
            <?php if ($tips) :
                foreach ($tips as $tip) :
                    $description = $tip['description'];
                    $icon = $tip['icon'];
            ?>

                    <!-- favorite -->
                    <div class="bio-tip">
                        <div class="bio-tip__icon">
                            <?php echo $icon; ?>
                        </div>
                        <div class="bio-tip__description">
                            <?php echo $description; ?>
                        </div>
                    </div>
            <?php
                endforeach;
            endif; ?>
        </div>

    </div>
</section>