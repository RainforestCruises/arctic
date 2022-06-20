<?php get_header(); ?>
<main class="error404-page">
    <section class="error404-page__content">
        <h2 class="error404-page__content__title">
            Whoops!
        </h2>
        <h1 class="error404-page__content__subtitle">
            404 Page Not Found
        </h1>

        <div class="error404-page__content__image-area">
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
            </svg>
        </div>

        <div class="error404-page__content__snippet">
            Looks like this page went on vacation.
        </div>
        <div class="error404-page__content__links">
            Try our <a href="<?php echo get_home_url(); ?>">homepage</a> instead.
        </div>

    </section>

</main>
<?php get_footer(); ?>