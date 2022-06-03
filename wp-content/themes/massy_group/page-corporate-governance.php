
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
          <div class="shareHolder">
            <div class="mainWrapper padding_right-10">
              
              <?php
                $args = array( 'post_type' => 'corporategovernance', 'orderby' => 'date', 'order' => 'ASC');
                $the_query = new WP_Query( $args ); 
                if ( $the_query->have_posts() ) :
                  while ( $the_query->have_posts() ) : $the_query->the_post();
                    ?>
                      <div class="longCard">
                        <h3><?=get_the_title()?></h3>
                        <p>
                          <?=get_the_content()?>
                        </p>
                      </div>
                    <?php
                  endwhile;
                  wp_reset_postdata();
                endif;
              ?>

              <div class="collapsible-section">

                <!-- Top Ten Shareholders Heading -->
                <?php get_sidebar('top-ten-shareholders-heading'); ?>

                <div class="container overflowScroll px-0">
                  <div class="responsive_table">
                    <div class="row align-items-center padding-left-30">
                      <div class="col-4">
                        <h4 class="headingTable">Name</h4>
                      </div>
                      <div class="col-4">
                        <h4 class="headingTable text-center">
                          SHAREHOLDINGS
                        </h4>
                      </div>
                      <div class="col-3">
                        <h4 class="headingTable text-center">
                          PERCENTAGE, %
                        </h4>
                      </div>
                    </div>

                    <div
                      class="accordion accordionCorporate"
                      id="accordionFaq"
                    >

                      <?php
                        $itr = 1;
                        $args = array( 'post_type' => 'toptenshareholder', 'orderby' => 'date', 'order' => 'DESC');
                        $the_query = new WP_Query( $args ); 
                        if ( $the_query->have_posts() ) :
                          while ( $the_query->have_posts() ) : $the_query->the_post();
                            ?>
                              <div class="card">
                                <div id="headingOne">
                                  <h2 class="mb-0">
                                    <button
                                      class="padding-left-30 pr-0 btn btn-link btn-block text-left collapse_heading corporateAccHeading"
                                      type="button"
                                      data-toggle="collapse"
                                      data-target="#collapse<?=$itr?>"
                                      aria-expanded="true"
                                    >
                                      <div class="d-flex">
                                        <div class="col-4 pl-0">
                                          <h4 class="collapsesubbHeading">
                                            <?=get_the_title()?>
                                          </h4>
                                        </div>
                                        <div class="col-4">
                                          <h4
                                            class="collapsesubbHeading text-center"
                                          >
                                            <?=number_format(get_post_meta( get_the_ID(), 'meta-textbox_4_top_ten_shareholders', true ));?>
                                          </h4>
                                        </div>
                                        <div class="col-3">
                                          <h4
                                            class="collapsesubbHeading text-center"
                                          >
                                            <?=get_post_meta( get_the_ID(), 'meta-textbox_5_top_ten_shareholders', true );?>
                                          </h4>
                                        </div>
                                      </div>
                                    </button>
                                  </h2>
                                </div>

                                <div
                                  id="collapse<?=$itr?>"
                                  class="collapse padding-left-30"
                                  aria-labelledby="headingOne"
                                  data-parent="#accordionFaq"
                                >
                                  <div class="card-body">
                                    <p class="collapsible__desc"><?=wp_filter_nohtml_kses(get_the_content())?></p>
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