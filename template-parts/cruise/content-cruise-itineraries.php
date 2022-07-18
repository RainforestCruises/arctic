<?php
$itinerary_data = $args['itinerary_data'];
$departures = $itinerary_data['Departures'];
$itineraries = get_field('itineraries');

$curentYear = date("Y");

?>
<section class="cruise-itineraries" id="itineraries">
    <div class="cruise-itineraries__content">

        <div class="title-group">
            <div class="title-group__title">
                Itineraries
            </div>
            <div class="title-group__sub">
                There are <?php echo count($itineraries); ?> itineraries available
            </div>
        </div>
        <div class="cruise-itineraries__content__slider" id="itineraries-slider">
            <?php foreach ($itineraries as $i) :
                $hero_image = get_field('hero_image', $i);
                $title = get_the_title($i);
                $top_snippet = get_field('top_snippet', $i);
            ?>

                <a class="itinerary-card" href="<?php echo get_permalink($i); ?>">
                    <div class="itinerary-card__image-area">
                        <img <?php afloat_image_markup($hero_image['id'], 'vertical-small', array('vertical-small')); ?>>
                    </div>
                    <div class="itinerary-card__content">
                        <div class="itinerary-card__content__title">
                            <?php echo $title; ?>
                        </div>
                        <div class="itinerary-card__content__description">
                            <?php echo $top_snippet; ?>
                        </div>
                        <div class="itinerary-card__content__price-group">
                            <div class="itinerary-card__content__price-group__amount">
                                $2,955
                            </div>
                            <div class="itinerary-card__content__price-group__text">
                                Per Person
                            </div>
                        </div>
                        <div class="itinerary-card__content__bottom">
                            <div class="itinerary-card__content__bottom__departures">
                            <div class="itinerary-card__content__bottom__departures__fineprint">
                                    Next departures
                                </div>
                                <div class="itinerary-card__content__bottom__departures__items">
                                    <div class="itinerary-card__content__bottom__departures__items__item">
                                        Jun 1
                                    </div>
                                    <div class="itinerary-card__content__bottom__departures__items__item">
                                        Jun 6
                                    </div>
                                    <div class="itinerary-card__content__bottom__departures__items__item">
                                        Jun 21
                                    </div>
                                </div>
                               
                            </div>

                            <div class="itinerary-card__content__bottom__cta">

                                <button class="cta-text-icon">
                                    Explore
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>


                    </div>

                </a>

            <?php endforeach; ?>
        </div>


    </div>
</section>