<?php
$team = get_field('team');
$headerText = get_field('team_header');
?>
<section class="about-team" id="section-team">
    <div class="about-team__content">
        <h2 class="about-team__content__title">
            <?php echo $headerText ?>
        </h2>
        <div class="about-team__content__grid">
            <?php
            if ($team) :
                foreach ($team as $member) :
                    $hasPhone = $member['phone_display'] == "" ? false : true;
                    $hasBioPage = $member['bio_page_link'] == null ? false : true;
                    $image =  $member['image'];
            ?>
                    <div class="team-card">
                        <div class="team-card__image-area">
                            <?php if ($hasBioPage) : ?>
                                <a href="<?php echo $member['bio_page_link']; ?>">
                                    <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                                </a>
                            <?php else : ?>
                                <img <?php afloat_image_markup($image['id'], 'square-small'); ?>>
                            <?php endif; ?>
                        </div>
                        <div class="team-card__content">
                            <h3 class="team-card__content__name">
                                <?php if ($hasBioPage) : ?>
                                    <a href="<?php echo $member['bio_page_link']; ?>">
                                        <?php echo $member['name'] ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo $member['name'] ?>
                                <?php endif; ?>
                            </h3>
                            <div class="team-card__content__position">
                                <?php echo $member['position'] ?>
                            </div>
                            <?php if ($hasPhone) : ?>
                                <a class="team-card__content__phone" style="font-size: 1.3rem" href="tel:<?php echo $member['phone_number']; ?>">
                                    <?php echo $member['phone_display']; ?>
                                </a>
                            <?php endif ?>
                            <?php if ($hasBioPage) : ?>
                                <div class="team-card__content__meet">
                                    <a class="btn-pill btn-pill--inverse" href="<?php echo $member['bio_page_link']; ?>">
                                        Meet Me
                                    </a>

                                </div>

                            <?php endif ?>
                        </div>
                    </div>

            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>