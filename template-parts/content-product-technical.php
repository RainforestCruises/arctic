<!-- Technical Info -->


<?php
$deck_plan = get_field('deck_plan');
$features = get_field('features');
$show_equipment = get_field('show_equipment');
$equipment = get_field('equipment');
$hide_equipment_fineprint = get_field('hide_equipment_fineprint');

?>

<div class="product-technical">
    <h3 class="xsub-divider">
        Technical Information
    </h3>
    <div class="product-technical__content">
        <div class="product-technical__content__image-area <?php echo ($show_equipment) ? "" : "half-width" ?>">
            <h4 class="product-technical__content__image-area__title">
               <?php echo (get_post_type() == 'rfc_lodges')  ? 'Property Layout' : 'Deck Plan' ?>
            </h4>
            <a class="product-technical__content__image-area" id="deckplan-image" href="<?php echo esc_url($deck_plan['url']); ?>" title="Deckplan">

                <img src="<?php echo esc_url($deck_plan['url']); ?>" alt="<?php echo get_post_meta($deck_plan['id'], '_wp_attachment_image_alt', TRUE) ?>">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-enlarge"></use>
                </svg>
            </a>
        </div>

        <div class="product-technical__content__columns">
            <!-- Features -->
            <div class="product-technical__content__columns__info">

                <!-- Features -->
                <h4 class="product-technical__content__columns__info__title">
                    Features
                </h4>
                <ul class="product-technical__content__columns__info__list">


                    <!-- Connecting Cabins -->
                    <?php if ($features['connecting_cabins']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Connecting cabins
                            </span>
                        </li>
                    <?php endif; ?>

                    <!-- Cabins with Balconies -->
                    <?php if ($features['cabins_with_balconies']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Cabins with balconies
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Air conditioning -->
                    <?php if ($features['air_conditioning']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Air conditioning
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Deck Shower -->
                    <?php if ($features['deck_shower']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Deck shower
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Pool / Jacuzzi -->
                    <?php if ($features['pool_jacuzzi']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Pool / Jacuzzi
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Excercise room -->
                    <?php if ($features['excercise_room']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Excercise room
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Massage room -->
                    <?php if ($features['massage_room']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Massage room
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Lecture room -->
                    <?php if ($features['lecture_room']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Lecture room
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Cinema -->
                    <?php if ($features['cinema']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Cinema
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Wheelchair access -->
                    <?php if ($features['wheelchair_access']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Wheelchair access
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Camera Room -->
                    <?php if ($features['camera_room']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Camera room
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- WIFI available -->
                    <?php if ($features['wifi_available']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                WIFI available
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Kosher Meals -->
                    <?php if ($features['kosher_meals']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Kosher Meals
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Children's Playroom -->
                    <?php if ($features['childrens_playroom']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Children's playroom
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Medical staff -->
                    <?php if ($features['medical_staff']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Medical staff
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Solar Energy -->
                    <?php if ($features['solar_energy']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Solar Energy
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- spa -->
                    <?php if ($features['spa']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Spa
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Onsite Tour Desk -->
                    <?php if ($features['onsite_tour_desk']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Onsite tour desk
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Souvenir shop -->
                    <?php if ($features['souvenir_shop']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Souvenir shop
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Mosquito netting -->
                    <?php if ($features['mosquito_netting']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Mosquito netting
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Hot Showers -->
                    <?php if ($features['hot_showers']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Hot showers
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- All Inclusive -->
                    <?php if ($features['all_inclusive']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                All inclusive
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Heating -->
                    <?php if ($features['heating']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Heating
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Family Room Triple or Quadruple -->
                    <?php if ($features['family_room']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Family Room (Triple or Quadruple)
                            </span>
                        </li>
                    <?php endif; ?>
                    <!-- Charging areas for electronic equipment -->
                    <?php if ($features['charging_areas']) : ?>
                        <li class="product-technical__content__columns__info__list__item">
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                            </svg>
                            <span>
                                Charging areas for electronic equipment
                            </span>
                        </li>
                    <?php endif; ?>
                </ul>
                <!-- End Features -->

            </div>

            <!-- Equipment -->
            <?php if ($show_equipment) : ?>
                <div class="product-technical__content__columns__info">

                    <h4 class="product-technical__content__columns__info__title">
                        Equipment
                    </h4>

                    <ul class="product-technical__content__columns__info__list">
                        <!-- Diving gear -->
                        <?php if ($equipment['diving_gear']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Diving gear
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Satellite phone -->
                        <?php if ($equipment['satellite_phone']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Satellite phone
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Diving platform -->
                        <?php if ($equipment['diving_platform']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Diving platform
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Nitrox -->
                        <?php if ($equipment['nitrox']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Nitrox
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Snorkeling gear -->
                        <?php if ($equipment['snorkeling_gear']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Snorkeling gear
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Wetsuits -->
                        <?php if ($equipment['wetsuits']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Wetsuits
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Stand up paddle board -->
                        <?php if ($equipment['stand_up_paddle_board']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Stand up paddleboard
                                </span>
                            </li>
                        <?php endif; ?>

                        <!-- Kayaks / Canoes -->
                        <?php if ($equipment['kayaks_canoes']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Kayaks / Canoes
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Wakeboard / Water Ski -->
                        <?php if ($equipment['wakeboard_water_ski']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Wakeboard / Water Ski
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Surf Boards-->
                        <?php if ($equipment['surf_boards']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Surf boards
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Bicycles -->
                        <?php if ($equipment['bicycles']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Bicycles
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Jet Skis-->
                        <?php if ($equipment['jet_skis']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Jet skis
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Fishing Equipment-->
                        <?php if ($equipment['fishing_equipment']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Fishing equipment
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Yoga mats -->
                        <?php if ($equipment['yoga_mat']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Yoga mats
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Flash lights -->
                        <?php if ($equipment['flash_lights']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Flash lights
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Rubber boots -->
                        <?php if ($equipment['rubber_boots']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Rubber boots
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Water Canteen/Bottle -->
                        <?php if ($equipment['water_canteen']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Water canteen/bottle
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Binoculars -->
                        <?php if ($equipment['binoculars']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Binoculars
                                </span>
                            </li>
                        <?php endif; ?>
                        <!-- Insect repellent -->
                        <?php if ($equipment['insect_repellent']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Insect repellent
                                </span>
                            </li>
                        <?php endif; ?>
                          <!-- Poncho -->
                          <?php if ($equipment['poncho']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Poncho
                                </span>
                            </li>
                        <?php endif; ?>
                         <!-- Dry Bags/Plastic bags to protect cameras -->
                         <?php if ($equipment['dry_bags']) : ?>
                            <li class="product-technical__content__columns__info__list__item">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                                </svg>
                                <span>
                                    Dry Bags/Plastic bags to protect cameras
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>

                </div>
            <?php endif; ?>
            <!-- End Equipment -->

            <div class="product-technical__content__columns__fineprint">
                <?php 
             
                echo ($hide_equipment_fineprint) ? "" : "** Use of certain equipment at additional cost, ask for details" ; 
                ?> 
            </div>
        </div>


    </div>


</div>