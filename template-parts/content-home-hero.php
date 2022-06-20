<?php
$queryArgs = array(
    'post_type' => array('rfc_destinations', 'rfc_regions'),
    'meta_key' => 'navigation_title',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'posts_per_page' => -1
);

$destinations = get_posts($queryArgs);

$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_slider = get_field('hero_slider');
$currentYear = date("Y");

?>

<!--  Hero -->
<div class="home-hero">
    <div class="home-hero__bg" id="home-hero__bg">


        <!-- Slider -->
        <?php
        $slideCount = 0;
        foreach ($hero_slider as $s) :
            $sliderImage = $s['image'];
            $sliderTitle = $s['title'];
            $sliderDestination = $s['destination'];
            $sliderDestinationPostId = null;
            if ($sliderDestination) {
                $sliderDestinationPostId = $sliderDestination->ID;
            }

        ?>
            <div class="home-hero__bg__slide" postid="<?php echo $sliderDestinationPostId ?>" slidenumber="<?php echo $slideCount; ?>">
                <?php if ($sliderImage) : ?>
                    <div class="home-hero__bg__slide__image-area">
                        <img <?php afloat_image_markup($sliderImage['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall'), true); ?>>
                        <div class="home-hero__bg__slide__image-area__location" postId="<?php echo $sliderDestinationPostId ?>">
                            <?php echo $sliderTitle; ?>
                        </div>
                    </div>

                <?php endif; ?>
            </div>

        <?php
            $slideCount++;
        endforeach; ?>


    </div>

    <div class="home-hero__content">
        <div class="home-hero__content__title-group">
            <div class="home-hero__content__title-group__title">
                <?php echo $hero_title ?>
            </div>
            <h1 class="home-hero__content__title-group__subtitle">
                <?php echo $hero_subtitle ?>
            </h1>
        </div>

        <!-- Search Area -->
        <div class="home-hero__content__search-area">

            <!-- Search Container -->
            <div class="home-search" id="search-container">

                <!-- Destination -->
                <div class="home-search__destination" id="destination-input-container">
                    <label for="destination-input" class="home-search__destination__label">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-location-pin"></use>
                        </svg>
                    </label>
                    <input class="home-search__destination__input" id="destination-input" value="" placeholder="Where would you like to go?" autocomplete="off">
                    <button class="home-search__destination__clear">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-cross"></use>
                        </svg>
                    </button>

                    <ul class="home-search__destination__list" id="destination-list">
                        <li postid="anywhere" class="anywhere">Anywhere</li>
                        <?php foreach ($destinations as $d) : ?>
                            <li postid="<?php echo $d->ID ?>"><?php echo get_field('navigation_title', $d) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Dates -->
                <div class="home-search__dates">
                    <label for="dates-input" class="home-search__dates__label">
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-calendar-2"></use>
                        </svg>
                    </label>
                    <div class="home-search__dates__input" id="dates-input">
                        When would you like to travel?
                    </div>
                    <div class="home-search__dates__list" id="dates-list">
                        <div class="home-search__dates__list__years">
                            <?php
                            for ($y = 0; $y < 2; $y++) :
                                $loopYear = $currentYear + $y;
                            ?>
                                <div class="home-search__dates__list__years__year <?php echo ($y == 0) ? "selected" : ""; ?>" year="<?php echo $loopYear; ?>">
                                    <?php echo $loopYear; ?>
                                </div>
                            <?php endfor;
                            ?>

                        </div>
                        <ul class="home-search__dates__list__months selected">
                            <li value="01" name="January">Jan</li>
                            <li value="02" name="February">Feb</li>
                            <li value="03" name="March">Mar</li>
                            <li value="04" name="April">Apr</li>
                            <li value="05" name="May">May</li>
                            <li value="06" name="June">Jun</li>
                            <li value="07" name="July">Jul</li>
                            <li value="08" name="August">Aug</li>
                            <li value="09" name="September">Sep</li>
                            <li value="10" name="October">Oct</li>
                            <li value="11" name="November">Nov</li>
                            <li value="12" name="December">Dec</li>
                        </ul>

                    </div>
                </div>

                <!-- CTA Button -->
                <div class="home-search__cta">
                    <button class="home-search__cta__button" id="search-button" type="submit" form="home-search-form">
                        <span>
                            Search
                        </span>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
                        </svg>

                        <div class="lds-ring">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </button>
                </div>

            </div>

            <!-- Search Container / button Mobile -->
            <div class="home-search-mobile">
                <button id="mobile-search-button">
                    Where would you like to go?

                    <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-magnifying-glass"></use>
                    </svg>
                </button>
            </div>

        </div>




    </div>

    <div class="home-hero__bottom">

        <button class="btn-circle btn-circle--small btn-white btn-circle--down" id="scroll-down" href="#intro">
            <svg class="btn-circle--arrow-main">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
            </svg>
            <svg class="btn-circle--arrow-animate">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-down"></use>
            </svg>
        </button>



    </div>




</div>