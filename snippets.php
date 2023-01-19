        <!-- Primary (Title + Description) -->
        <div class="product-hero__content__main__primary">
            <div class="product-hero__content__main__primary__title">
                <?php echo $title ?>
            </div>

            <div class="product-hero__content__main__primary__nav">
                <a href="#section-highlights" class="product-hero__content__main__primary__nav__link">Highlights</a>
                <a href="#section-itinerary" class="product-hero__content__main__primary__nav__link">Itinerary</a>
                <a href="#section-map" class="product-hero__content__main__primary__nav__link">Map</a>
                <a href="#section-dates" class="product-hero__content__main__primary__nav__link">Dates</a>
                <a href="#section-extras" class="product-hero__content__main__primary__nav__link">Extras</a>
            </div>
        </div>







        
<!-- Overview / Highlights -->
<section class="category-overview" id="section-highlights">

<div class="category-overview__content ">

    <!-- Grid  -->
    <div class="category-overview__content__grid">

        <!-- Main Overview (Highlights, Transport, Text) -->
        <div class="category-overview__content__grid__overview">
            <h3 class="title-single">
                <?php echo $intro_title ?>
            </h3>
            <?php echo $intro_text; ?>
        </div>


        <!-- Highlights -->
        <div class="category-overview__content__grid__highlights">

            <h3 class="title-single">Highlights</h3>
            <ul class="highlight-list">
                <?php if ($highlights) : ?>
                    <?php foreach($highlights as $h) : ?>
                        <li>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-diamonds-suits"></use>
                            </svg>
                            <?php echo $h['highlight']; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>


        </div>
    </div>
</div>
</section>