
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
       <h3>Thank you for joining!</h3>
       <p>We're always on the lookout for talented people with the right experience. Now that you have joined our Talent Network we can let you know about opportunities that could be a great match for your skills and experience.</p>
       <br>
       <p>
         Don't worry. We'll only use your details to contact you about available job opportunities and relevant business updates. But please also keep checking out website for our latest opportunities.
       </p>   
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
