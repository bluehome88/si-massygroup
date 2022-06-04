
<?php /* Template Name: generic-template */ ?>

<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner" style="background: url('<?=wp_get_attachment_url( get_post_thumbnail_id() )?>'">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left"><?= esc_html( get_the_title() )?></h2>
      </div>
    </div>
  </div>
  <?php
    $page = get_post(get_queried_object_id());
    $content = $page->post_content;  
    // $page_desc = wp_filter_nohtml_kses($page->post_content);
  ?>
  <!-- Information section -->
  <div class="informationSec">
    <div class="container">
      
      <div class="d-flex main_section_wrapper">
        
        <div class="main_Content">
          <div class="flex-column p-0 mb-0">
            
            <div class="aboutTextWrapper">
              <?=$content?>
            </div>
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
