<div class="deals-hero">
    <h1 class="deals-hero__title">
        <?php echo get_field('page_title_text') ?>
    </h1>

    <div class="deals-hero__subtext">
        <?php echo get_field('intro_snippet') ?>
    </div>

    <!-- A -->
    <!-- Triple Row -->
    <div class="deals-hero__row">
        <?php
        $cardImage = get_field('first_item')['image'];
        $cardTitle = get_field('first_item')['title'];
        $cardLink = get_field('first_item')['link'];
        ?>

        <!-- Card 1 -->
        <a class="deal-card" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_image_markup($cardImage, 'featured-large'); ?>>
            </div>
            <div class="deal-card__content">
                <h2 class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </h2>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>

        <?php
        $cardImage = get_field('second_item')['image'];
        $cardTitle = get_field('second_item')['title'];
        $cardLink = get_field('second_item')['link'];
        ?>

        <!-- Card 2 -->
        <a class="deal-card" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_image_markup($cardImage, 'featured-large'); ?>>
            </div>
            <div class="deal-card__content">
                <h2 class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </h2>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>

        <?php
        $cardImage = get_field('third_item')['image'];
        $cardTitle = get_field('third_item')['title'];
        $cardLink = get_field('third_item')['link'];
        ?>
        <!-- Card 3 -->
        <a class="deal-card" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_image_markup($cardImage, 'featured-large'); ?>>
            </div>
            <div class="deal-card__content">
                <h2 class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </h2>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>


    </div>
    <!-- Feature Row -->
    <div class="deals-hero__row">
        <?php
        $cardImage = get_field('feature_item')['image'];
        $cardTitle = get_field('feature_item')['title'];
        $cardLink = get_field('feature_item')['link'];
        ?>

        <!-- Feature-->
        <a class="deal-card deal-card--wide" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_image_markup($cardImage, 'pill-large'); ?>>
            </div>
            <div class="deal-card__content">
                <h2 class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </h2>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>
    </div>

    <!-- B -->
    <!-- Triple Row -->
    <div class="deals-hero__row">
        <?php
        $cardImage = get_field('first_item_b')['image'];
        $cardTitle = get_field('first_item_b')['title'];
        $cardLink = get_field('first_item_b')['link'];
        ?>

        <!-- Card 1 -->
        <a class="deal-card" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_image_markup($cardImage, 'featured-large'); ?>>
            </div>
            <div class="deal-card__content">
                <h2 class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </h2>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>

        <?php
        $cardImage = get_field('second_item_b')['image'];
        $cardTitle = get_field('second_item_b')['title'];
        $cardLink = get_field('second_item_b')['link'];
        ?>

        <!-- Card 2 -->
        <a class="deal-card" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_image_markup($cardImage, 'featured-large'); ?>>
            </div>
            <div class="deal-card__content">
                <h2 class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </h2>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>

        <?php
        $cardImage = get_field('third_item_b')['image'];
        $cardTitle = get_field('third_item_b')['title'];
        $cardLink = get_field('third_item_b')['link'];
        ?>
        <!-- Card 3 -->
        <a class="deal-card" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_image_markup($cardImage, 'featured-large'); ?>>
            </div>
            <div class="deal-card__content">
                <h2 class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </h2>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>


    </div>
    <!-- Feature Row -->
    <div class="deals-hero__row">
        <?php
        $cardImage = get_field('feature_item_b')['image'];
        $cardTitle = get_field('feature_item_b')['title'];
        $cardLink = get_field('feature_item_b')['link'];
        ?>

        <!-- Feature-->
        <a class="deal-card deal-card--wide" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_image_markup($cardImage, 'pill-large'); ?>>
            </div>
            <div class="deal-card__content">
                <h2 class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </h2>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>
    </div>

</div>