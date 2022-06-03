
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

      <!-- Chart -->
      <div class="main_content_inner" style="margin-bottom: 58px;">
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
      </div>

      <div class="d-flex main_section_wrapper">
        <div class="Sidebar">
          <?=custom_investor_menu();?>
        </div>
        <div class="main_Content">
          <div class="shareHolder shown" id="ShareHolder">
            
            <!-- download section -->
            <?php get_sidebar('shareholder-download-section'); ?>
            
            <!-- faq section -->
            <div class="FAQ">
              <h3 class="faq_head">FAQs and Enquiries</h3>
              <div class="accordion" id="accordionExample">
                <?php
                  $itr = 1;
                  $args = array( 'post_type' => 'faqsandenquiries', 'orderby' => 'date', 'order' => 'ASC');
                  $the_query = new WP_Query( $args ); 
                  if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                      ?>
                        <div class="card">
                          <div class="card-header" id="heading<?=$itr?>">
                            <h2 class="mb-0">
                              <button
                                class="btn btn-link btn-block text-left collapse_heading"
                                type="button"
                                data-toggle="collapse"
                                data-target="#collapse<?=$itr?>"
                                aria-expanded="true"
                                aria-controls="collapse<?=$itr?>"
                              >
                                <?=get_the_title()?>
                              </button>
                            </h2>
                          </div>

                          <div
                            id="collapse<?=$itr?>"
                            class="collapse"
                            aria-labelledby="heading<?=$itr?>"
                            data-parent="#accordionExample"
                          >
                            <div class="card-body">
                              <?=wp_strip_all_tags(get_the_content())?>
                            </div>
                          </div>
                        </div>
                      <?php
                      $itr = $itr + 1;
                    endwhile;
                    wp_reset_postdata();
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
