
<?php /* Template Name: information-and-communication */ ?>

<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner" style="background: url('<?=wp_get_attachment_url( get_post_thumbnail_id() )?>');">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <div class="bannerHeading" data-aos="fade-left">
          <h2 data-aos="fade-left">our business</h2>
          <h4 data-aos="fade-left">Information Technology</h4>
        </div>
      </div>
      <a href="<?php echo get_permalink( get_page_by_path('our-business') ); ?>" class="backBtn">
        <img src="<?php echo get_template_directory_uri()?>/assets/images/backBtn.png" /> BACK TO our business</a
      >
    </div>
  </div>

  <?php
    $args = array('post_type' => 'businessproducts', 'business_product_category' => 'information-and-communication-cat', 'orderby' => 'date', 'order' => 'DESC');
    $the_query = new WP_Query( $args ); 
    if ( $the_query->have_posts() ) :
      while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
          <?php
            $attachments = get_posts( array(
              'post_type' => 'attachment',
              'posts_per_page' => -1,
              'post_parent' => $post->ID,
              'exclude'     => get_post_thumbnail_id()
            ));
          ?>
          <!-- product -->
          <div class="productDetails overflow-hidden">
            <div class="container">
              <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                  <img
                    src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>"
                    alt="product gas"
                    class="img-fluid product_Image"
                  />
                </div>
                <div
                  class="col-md-6 d-flex flex-column justify-content-between"
                  data-aos="fade-left"
                >
                  <div>
                    
                    <?php
                    if($attachments){
                      foreach ( $attachments as $attachment ) {
                        ?>
                        <img
                          src="<?=wp_get_attachment_url( $attachment->ID )?>"
                          alt="product logo"
                          class="productSubLogo"
                        />
                        <?php
                      }
                    }
                    ?>
                    <p class="productPara">
                      <?=stripslashes(wp_filter_nohtml_kses(get_the_content()))?>
                    </p>
                  </div>
                  <div>
                    <div class="location">
                      <?php
                        $metas = get_post_meta( get_the_ID(), 'business_products_service_countries', false );
                        if($metas){
                          foreach ( $metas as $meta ) {
                            $meta_arr = explode(',', $meta);
                            if(isset($meta_arr[1])){
                              ?>
                              <a class="mt-alt" href="<?=trim($meta_arr[1])?>" target="_blank">
                                <div class="d-flex align-items-center mt-alt">
                                  <img src="<?php echo get_template_directory_uri()?>/assets/images/detailIcon.png" alt="icon" />
                                  <p class="mb-0 ml-2"><?=$meta_arr[0]?></p>
                                </div>
                              </a>
                            <?php
                            }else{
                              ?>
                              <!-- <a class="mt-alt" href="<?=trim($meta_arr[1])?>" target="_blank"> -->
                                <div class="d-flex align-items-center mt-alt">
                                  <img src="<?php echo get_template_directory_uri()?>/assets/images/detailIcon.png" alt="icon" />
                                  <p class="mb-0 ml-2"><?=$meta_arr[0]?></p>
                                </div>
                              <!-- </a> -->
                              <?php
                            }
                          }
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php   
      endwhile;
      wp_reset_postdata();  
    else:
      _e( 'Sorry, no posts matched your criteria.' );
    endif;
  ?>

  <div class="text-center">
    <a href="<?php echo get_permalink( get_page_by_path('our-business') ); ?>" class="backBtn margin_top">
      <img src="<?php echo get_template_directory_uri()?>/assets/images/backBtn.png" /> BACK TO our business</a
    >
  </div>

  <!-- news & update -->
  <?php get_sidebar('news-and-updates'); ?>

  <!-- career section -->
  <?php get_sidebar('career-opportunities'); ?>

  <!-- How we performance section -->
  <?php get_sidebar('performance-section-main'); ?>
</main>

<?php get_footer(); ?>
