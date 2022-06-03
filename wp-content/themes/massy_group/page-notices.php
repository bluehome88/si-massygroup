
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
  <?php
    $page = get_post(get_queried_object_id());
    $content = $page->post_content;  
    // $page_desc = wp_filter_nohtml_kses($page->post_content);
  ?>
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
          <div class="main_content_inner flex-column p-0 mb-0">
            <div class="aboutTextWrapper">
              
              <?php
                $notices_data = array();
                $args = array('post_type' => 'dlm_download', 'dlm_download_category' => 'shareholder-center-notices', 'posts_per_page' => -1, 'meta_key' => 'notice-document-year', 'orderby' => 'meta_value', 'order' => 'DESC');
                $the_query = new WP_Query( $args ); 
                if ( $the_query->have_posts() ) :
                  while ( $the_query->have_posts() ) : $the_query->the_post();
                    $year = get_post_meta( get_the_ID(), 'notice-document-year', true );
                    if(!array_key_exists($year, $notices_data)){
                      $notices_data[$year] = array();
                    }
                    $notices_data[$year][]= '<a href="'.get_bloginfo( 'url' ).'/download/'.get_the_ID().'">'.get_the_title().'</a>';
                  endwhile;
                  wp_reset_postdata();  
                endif;
                if(count($notices_data) > 0){
                  ?>
                  <div class="row">
                    <?php
                    foreach ($notices_data as $year => $docs) {
                      ?>
                      <div class="col-md-6">
                        <h4 class="mb-2"><?=$year?></h4>
                        <?php
                        foreach ($docs as $doc) {
                          echo $doc.'<br><br>';
                        }
                        ?>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                  <?php
                }
              ?>
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
