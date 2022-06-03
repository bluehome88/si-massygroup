
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
          <div class="shareHolder shown" id="ShareHolder">
            
            <!-- faq section -->
            <div class="FAQ">
              <h3 class="faq_head">FAQs and Enquiries</h3>
              <div class="accordion" id="accordionExample">
                
                <?php
                  $itr = 1;
                  $args = array( 'post_type' => 'faqsandenquiries', 'orderby' => 'date', 'order' => 'DESC');
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
                              <?=get_the_content()?>
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
            <div class="contact__sect">
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
