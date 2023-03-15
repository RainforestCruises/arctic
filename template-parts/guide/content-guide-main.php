<section class="guide-main">

  <div class="guide-main__content">

    <!-- Copy Content -->
    <div class="guide-main__content__copy">
      <?php $query = get_post(get_the_ID());
      $content = apply_filters('the_content', $query->post_content);
      echo generateIndex($content)['html']; ?>
    </div>


  </div>

</section>