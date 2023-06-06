<section class="search-page__intro" id="search-page-intro">
        <?php
        get_template_part('template-parts/search/content', 'search-intro', $args);
        ?>
    </section>

    <div class="search-filter-bar" id="search-filter-bar">
        <button class="search-filter-bar__button search-button" id="search-filter-bar-button">
            Filters
        </button>
    </div>

    <!-- Content -->
    <section class="search-page__content" id="search-page-content">

        <?php
        get_template_part('template-parts/search/content', 'search-sidebar', $args); //page args --> initial preselection
        get_template_part('template-parts/search/content', 'search-results-area', $args); //page args --> initial render
        ?>

    </section>
