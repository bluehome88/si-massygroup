
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner aboutBanner">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">about us</h2>
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
      <p class="leadingText" data-aos="fade-up">
      
      <!-- who we are section -->
      <?php get_sidebar('about-us-description'); ?>
      
      </p>
      <div class="d-flex main_section_wrapper">
        <div class="Sidebar">
          <?=custom_about_menu();?>
        </div>
        <div class="main_Content">
          <div class="main_content_inner flex-column p-0 mb-0">
            <div>
              <iframe class="aboutUsImage aboutUsVideo" width="560" height="480" src="<?=get_post_meta( get_the_ID(), 'video_link_1', true );?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              <!-- <img
                src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>"
                alt="about image"
                class="aboutUsImage"
              /> -->
            </div>
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
