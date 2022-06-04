
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner" style="background: url('<?=wp_get_attachment_url( get_post_thumbnail_id() )?>');">
    <div class="container h-100">
      <div class="d-flex justify-content-end align-items-center h-100">
        <h2>contact us</h2>
      </div>
    </div>
  </div>

  <div class="Career_Section overflow-hidden">
    <div class="container">
      <p class="headingText" data-aos="fade-up">
        We’re always eager to hear from our valued partners and customers.
      </p>

      <div class="contactForm" data-aos="fade-up" data-aos-delay="150">
        <h4>Have a Question?</h4>
        <?php echo do_shortcode( '[contact-form-7 id="148" title="Contact form 1"]' ); ?>
      </div>
      <div class="text-center" data-aos="fade-up">
        <h2 class="heading">E-mail / Call us</h2>
        <div class="contactDetails">
          <p>
            info@massygroup.com
          </p>
          <p class="colored">
            Trinidad and Tobago<span>1 868 625 3433</span>
          </p>
          <p class="colored">Barbados <span>1 868 625 3433</span></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Join netwerk section -->
  <div class="container">
    <div class="JoinUs">
      <div>
        <img src="<?php echo get_template_directory_uri()?>/assets/images/joinusIcon.png" alt="icon" />
      </div>
      <div class="mid">
        <h3>Join Our Talent Network</h3>
        <p>
          Be notified directly when opportunities suited to your skills and
          experience become available.
        </p>
      </div>
      <div>
        <a href="<?=get_permalink(get_page_by_path('careers/join-our-talent-network'))?>">Register Now</a>
      </div>
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
