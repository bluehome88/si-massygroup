
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner careerBanner">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">careers in Massy</h2>
      </div>
    </div>
  </div>

  <div class="thankyou">
    <div class="container">
       <h3>Thank you for your interest in Massy Group</h3>
       <p>A member of our team will be in touch to let you know the outcome.</p>   
    </div>
   
  </div>

  <!-- news & update -->
  <?php get_sidebar('news-and-updates'); ?>
  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- How we performance section -->
  <?php get_sidebar('performance-section-main'); ?>
</main>

<?php get_footer(); ?>
