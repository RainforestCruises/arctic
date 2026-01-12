<?php
$notification_message = get_field('notification_message');

?>

<!-- Cruise Region Modal -->
<div class="modal modal--minimal" id="notificationModal" style="display: flex;">

    <div class="modal__content">
        <div class="modal__content__top">
            <div class="modal__content__top__nav">
                <div class="modal__content__top__nav__title">
                    Important Notice
                </div>
            </div>
            <button class="btn-text btn-text--bg close-modal-button ">
                Close
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            </button>
        </div>
        <div class="modal__content__main">
            <?php echo $notification_message; ?>
        </div>
    </div>
</div>