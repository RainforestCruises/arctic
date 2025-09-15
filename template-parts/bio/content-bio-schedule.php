<?php
$agent_schedule_link = get_field('agent_schedule_link');
$agent_image = get_field('agent_image');
$agent_name = get_field('agent_name');
$agent_position = get_field('agent_position');
?>

<section class="bio-schedule">
    <div class="bio-schedule__content">
        <div class="bio-schedule__content__main">
            <div class="bio-schedule__content__main__title">
                Schedule a 1-on-1 Consultation With Me
            </div>
            <div class="bio-schedule__content__main__button">
                <a class="btn-primary" id="schedule-cta" href="<?php echo $agent_schedule_link; ?>">
                    Book a Meeting
                </a>
            </div>
            <div class="bio-schedule__content__main__name">
                <?php echo $agent_name; ?>
            </div>
            <div class="bio-schedule__content__main__position">
                <?php echo $agent_position; ?>
            </div>
        </div>

        <!-- Slider Area -->
        <div class="bio-schedule__content__avatar">
            <img <?php afloat_image_markup($agent_image['id'], 'featured-square'); ?>>

        </div>
    </div>
</section>