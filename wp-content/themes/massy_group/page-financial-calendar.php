
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
            <div class="mainWrapper">
              <div class="cardsContainer">
                <?php
                  $args = array( 'post_type' => 'financialcalendar', 'posts_per_page' => '9', 'meta_key' => 'meta-textbox_financial_calendar', 'orderby' => 'meta_value', 'order' => 'DESC');
                  $the_query = new WP_Query( $args ); 
                  if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                      $excerpt = wp_strip_all_tags( get_the_excerpt(), true );
                      $excerpt = substr($excerpt, 0, 150);
                      $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
                      $date = get_post_meta( get_the_ID(), 'meta-textbox_financial_calendar', true );
                      ?>
                        <div class="custom__card">
                          <div class="card__header">
                            <h2><?=date_format(date_create($date),"d");?> <span><?=date_format(date_create($date),"F Y");?></span></h2>
                          </div>
                          <div class="card__desc">
                            <h4 style="height: 42px;"><?=get_the_title()?></h4>
                            <p>
                              <?=$excerpt?>
                            </p>
                          </div>
                        </div>
                      <?php
                    endwhile;
                    wp_reset_postdata();
                  endif;
                ?>
                <!-- <div class="custom__card">
                  <div class="card__header">
                    <h2>30 <span>November 2019</span></h2>
                  </div>
                  <div class="card__desc">
                    <h4>Tittle here</h4>
                    <p>
                      Sed ut perspiciatis unde omnis iste natus error sit
                      voluptatem accusantium doloremque laudantium.Sed ut
                      perspiciatis unde omnis iste natus.
                    </p>
                  </div>
                </div> -->
              </div>
              <!-- <div class="text-center">
                <button class="loadMore">
                  Load More
                </button>
              </div> -->
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