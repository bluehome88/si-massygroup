
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner InvestorBanner">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">our investors</h2>
      </div>
    </div>
  </div>

  <!-- Information section -->
  <div class="informationSec">
    <div class="container">
      
      <!-- invetsor description section -->
      <?php get_sidebar('investor-description'); ?>

      <!-- Stock Data Section -->
      <?php get_sidebar('stock-data-section'); ?>

      <div class="d-flex main_section_wrapper">
        <div class="Sidebar">
          <?=custom_investor_menu();?>
        </div>
        <div class="main_Content">
          <div class="shareHolder shown" id="ShareHolder">
            
            <!-- download section -->
            <?php get_sidebar('shareholder-download-section'); ?>
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- How we perform -->
  <?php get_sidebar('performance-section-list'); ?>

  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- news & update -->
  <?php get_sidebar('news-and-updates'); ?>

  <!-- career section -->
  <?php get_sidebar('career-opportunities'); ?>
</main>

<?php get_footer(); ?>
