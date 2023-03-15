<?php
$title = get_the_title();
$query = get_post(get_the_ID());
$content = apply_filters('the_content', $query->post_content);
$toc = generateIndex($content)['index'];
?>

<!-- Guide Nav -->
<nav class="nav-guide small-width">


    <!-- mobile content (button) -->
    <div class="nav-guide__content">
        <div class="nav-guide__content__title">
            Jump To Section
        </div>
        <div class="nav-guide__content__icon">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
            </svg>
        </div>
    </div>

    <!--mobile menu expand-->
    <nav class="nav-guide__menu-area">
        <div class="nav-guide__menu-area__menu">
        <?php echo $toc; ?>
        </div>
        
    </nav>
</nav>