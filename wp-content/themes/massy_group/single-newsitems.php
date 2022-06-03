
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner newsBanner">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">news & updates</h2>
      </div>
      <a href="<?=get_permalink( get_page_by_title('News'));?>" class="backBtn">
        <img src="<?php echo get_template_directory_uri()?>/assets/images/backBtn.png" /> BACK TO News</a
      >
    </div>
  </div>

  <!-- news article section -->
  <div class="newsArticle">
    <div class="container">
      <div class="newsDate">
        <p class="date">NEWS <span><?=get_the_date()?></span></p>
      </div>
      <h2 class="NewsArticle_head">
        <?=get_the_title()?>
      </h2>
      <!-- <div class="newsArticleImg">
        <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="article image" />
      </div> -->
      <div class="newsBody">
        <?=apply_filters('the_content', $post->post_content)?>
      </div>
      <div class="text-center">
        <a href="<?=get_permalink( get_page_by_title('News'));?>" class="backBtn margin_top">
          <img src="<?php echo get_template_directory_uri()?>/assets/images/backBtn.png" /> BACK TO News</a
        >
      </div>
    </div>
  </div>

  <!-- How we perform -->
  <?php get_sidebar('performance-section-list'); ?>

  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- career section -->
  <?php get_sidebar('career-opportunities'); ?>
</main>

<?php get_footer(); ?>
