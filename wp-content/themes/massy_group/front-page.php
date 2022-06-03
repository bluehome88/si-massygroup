
<?php get_header(); ?>

<main>
  <div class="owl-carousel carousel">
    <?php
      $itr = 1;
      $animation_class = '';
      $args = array('post_type' => 'massysliders', 'massy_slider_category' => 'front-page', 'orderby' => 'date', 'order' => 'DESC');
      $the_query = new WP_Query( $args ); 
      if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post();
          
            if($itr == 1) { $animation_class = 'animateIn'; }
            ?>
            <div class="slider-inner slideItem d-flex justify-content-end align-items-end" style="background-image: url('<?=wp_get_attachment_url( get_post_thumbnail_id() )?>');">
              <div class="container">
                <div class="d-flex justify-content-end align-items-end">
                  <div class="bottomBox <?=$animation_class?>">
                    <div class="boxInner">
                      <h3><?=get_post_meta( get_the_ID(), 'slider_card_top_left_text', true );?></h3>
                      <h2><?=get_post_meta( get_the_ID(), 'slider_card_main_heading', true );?></h2>
                      <p>
                        <?=get_post_meta( get_the_ID(), 'slider_card_sub_heading', true );?>
                      </p>
                    </div>
                    <div class="d-flex justify-content-end">
                      <a href="<?php echo get_permalink( get_page_by_path('about-us') ); ?>">Learn more</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          <?php
          $itr = $itr + 1;
          $animation_class = '';   
        endwhile;
        wp_reset_postdata();  
      else:
        _e( 'Sorry, no slider images found' );
      endif;
    ?>
  </div>

  <!-- news & update -->
  <?php get_sidebar('news-and-updates'); ?>

  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- stock widget and apps download area -->
  <?php get_sidebar('stock-widget-and-apps-download-area-section'); ?>

  <!-- our business -->
  <?php get_sidebar('our-business'); ?>     

  <!-- career section -->
  <?php get_sidebar('career-opportunities'); ?>

  <!-- How we performance section -->
  <?php get_sidebar('performance-section-main'); ?>
</main>

<?php get_footer(); ?>
