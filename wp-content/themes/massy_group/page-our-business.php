
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner" style="background: url('<?=wp_get_attachment_url( get_post_thumbnail_id() )?>');">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">Our Businesses</h2>
      </div>
    </div>
  </div>

  <!-- our business -->
  <?php get_sidebar('our-business'); ?>

  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- news & update -->
  <?php get_sidebar('news-and-updates'); ?>

  <!-- career section -->
  <?php get_sidebar('career-opportunities'); ?>

  <!-- How we performance section -->
  <?php get_sidebar('performance-section-main'); ?>
</main>

<?php get_footer(); ?>
