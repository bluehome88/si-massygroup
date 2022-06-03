
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

      <!-- Chart -->
      <!-- <div class="main_content_inner" style="margin-bottom: 58px;">
        <div
          class="d-flex justify-content-between align-items-start w-100 chartTopInner"
        >
          <div class="chartDetails">
            <h3>$59.94</h3>
            <p class="redText">-0.01 -0.02</p>
            <div class="timeStamp text-right">
              <p>Last updated: Aug 21 2019 12:00 am AST</p>
              <p>Business/Consumer Services: <span>-1.30</span></p>
            </div>
            <div class="prevRecored">
              <p>Previous Close</p>
              <p>$54.95</p>
            </div>
          </div>
          <div class="chart-container">
            <div id="myChart"></div>
          </div>
        </div>
      </div> -->

      <div class="d-flex main_section_wrapper">
        <div class="Sidebar">
          <?=custom_investor_menu();?>
        </div>
        <div class="main_Content">
          <div class="main_content_inner flex-column p-0 mb-0">
            <div class="aboutTextWrapper">
              <div class="row">
                <?php
                $args = array('post_type' => 'dlm_download', 'dlm_download_category' => 'annual-reports', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'DESC');
                $the_query = new WP_Query( $args ); 
                if ( $the_query->have_posts() ) :
                  while ( $the_query->have_posts() ) : $the_query->the_post();
                    ?>
                    <div class="col-md-6 mt-3">
                      <div>
                        <div style="width: 205px; height: 282px;">
                          <img style="width: 100%; height: 100%; /*object-fit: cover;*/" src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="image" style="width: 100%; height: 100%; object-fit: cover;" />
                        </div>
                        <a class="ml-4" href="<?=get_bloginfo( 'url' ).'/download/'.get_the_ID()?>"><?=get_the_title()?></a>

                        

                      </div>
                    </div>
                    <?php
                  endwhile;
                  wp_reset_postdata();  
                else:
                  _e( 'Sorry, no posts matched your criteria.' );
                endif;
                ?>
              </div>
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