<section class="guide-main">

  <div class="guide-main__content">

    <!-- Copy Content -->
    <div class="guide-main__content__copy">
      <?php $query = get_post(get_the_ID());
      $content = apply_filters('the_content', $query->post_content);
      echo generateIndex($content)['html']; ?>
    </div>

    <?php
    $author = get_field('author');
    if ($author  != null) :
      $image = get_field('image', $author);
      $description = get_field('description', $author);

      $name = get_the_title($author);
      $website = get_field('website', $author);
      $twitter = get_field('twitter', $author);

    ?>
      <div class="guide-main__content__author">
        <div class="guide-main__content__author__title">
          About the Author
        </div>
        <div class="guide-main__content__author__info">
          <div class="guide-main__content__author__info__image">
            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
          </div>
          <div class="guide-main__content__author__info__text">
            <div class="guide-main__content__author__info__text__name">
              <?php echo $name; ?>
            </div>
            <div class="guide-main__content__author__info__text__description">
              <?php echo $description; ?>
            </div>
            <?php if ($website) : ?>
              <a class="guide-main__content__author__info__text__social" href="<?php echo $website; ?>" target="_blank" rel="noopener">
                <svg>
                  <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-globe"></use>
                </svg>
                <?php echo $website; ?>
            </a>
            <?php endif; ?>
            <?php if ($twitter) : ?>
              <a class="guide-main__content__author__info__text__social" href="<?php echo 'https://x.com/' . $twitter; ?>" target="_blank" rel="noopener">
                <svg>
                  <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-twitter-x"></use>
                </svg>
                @<?php echo $twitter; ?>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>

</section>