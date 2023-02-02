<section class="guide-main">

  <div class="guide-main__content">
    
    <!-- Copy Content -->
    <div class="guide-main__content__copy">
      <?php echo the_content(); ?>
    </div>

    <!-- Disclaimer -->
    <div class="guide-main__content__disclaimer">
      <h5 class="guide-main__content__disclaimer__header">
        Disclaimer
      </h5>
      <?php echo get_field('disclaimer', 'options'); ?>
    </div>
  </div>

</section>