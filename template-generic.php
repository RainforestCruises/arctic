<?php
/*Template Name: Generic*/
wp_enqueue_script('page-toc', get_template_directory_uri() . '/js/page-toc.js', array('jquery'), false, true);

?>

<?php
get_header();
?>

<?php
$content = get_field('content');
$toc = get_field('table_of_contents');

$toc_content = get_field('toc_content');

?>

<!-- Generic Page Container -->
<div class="generic-page">

    <section class="generic-page__content">
        <h1 class="generic-page__content__title">
            <?php
            echo get_the_title()
            ?>
        </h1>

        <?php
        echo $content;
        ?>


        <?php if ($toc) : ?>
            <div class="generic-page__content__toc">
                <div class="generic-page__content__toc__header">
                    Table of Contents
                </div>
                <ol class="generic-page__content__toc__grid">
                    <?php foreach ($toc as $t) : ?>
                        <li>
                            <a class="toc-link" href="<?php echo $t['anchor'] ?>"><?php echo $t['text'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ol>

            </div>


        <?php
            echo $toc_content;
        endif; ?>

    </section>


</div>


<?php get_footer(); ?>
