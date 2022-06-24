<?php
$itinerary_data = $args['itinerary_data'];
$requirements = get_field('requirements');

?>
<section class="itinerary-requirements" id="requirements">
    <div class="itinerary-requirements__content">

        <div class="title-single">
            Things to Know
        </div>

        <div class="itinerary-requirements__content__grid">


            <!-- Col 1 - Guest Requirements -->
            <div class="itinerary-requirements__content__grid__group">
                <div class="itinerary-requirements__content__grid__group__title">
                    Guest Requirements
                </div>
                <ul class="itinerary-requirements__content__grid__group__list">
                    <?php foreach ($requirements as $r) : ?>
                        <li>
                            <span>
                                &#8212;
                            </span>
                            <?php echo $r['text']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Col 2 - Inclusions -->
            <div class="itinerary-requirements__content__grid__group">
                <div class="itinerary-requirements__content__grid__group__title">
                    Inclusions
                </div>
                <ul class="itinerary-requirements__content__grid__group__list">

                    <?php
                    $inclusions = $itinerary_data['Inclusions'];
                    foreach ($inclusions as $i) :
                    ?>
                        <li>
                            <span>
                                &#8212;
                            </span>
                            <?php echo $i['Description'] ?>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>

            <!-- Col 3 - Exclusions -->
            <div class="itinerary-requirements__content__grid__group">
                <div class="itinerary-requirements__content__grid__group__title">
                    Exclusions
                </div>
                <ul class="itinerary-requirements__content__grid__group__list">

                    <?php
                    $exclusions = $itinerary_data['Exclusions'];
                    foreach ($exclusions as $e) :
                    ?>
                        <li>
                            <span>
                                &#8212;
                            </span>
                            <?php echo $e['Description'] ?>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>


        </div>

    </div>
</section>