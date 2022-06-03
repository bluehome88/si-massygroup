
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner" style="background: url('<?=wp_get_attachment_url( get_post_thumbnail_id() )?>');">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">News & Updates</h2>
      </div>
    </div>
  </div>
  <?php
  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  ?>
  <!-- copy this section from here  -->
  <!-- news & update -->
  <div class="newsUpdate overflow-hidden">
    <div class="container">
      <div class="newsInner">
        <div class="row">
          <?php
          $counter = 1;
          $html = '';
          $class = '';
          $args = array( 'post_type' => 'newsitems', 'posts_per_page' => '3', 'meta_key'=> 'meta-checkbox', 'meta_value' => 'yes');
          $the_query = new WP_Query( $args ); 
          if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post();
              $excerpt = wp_strip_all_tags( get_the_excerpt(), true );
              $excerpt = substr($excerpt, 0, 100);
              $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
              if ( $counter == 1 ) :
              ?>
                <div class="col-lg-6" data-aos="fade-right">
                  <a href="<?=get_the_permalink()?>">
                    <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="News Thumbnail" />
                    <p class="date">NEWS <span><?=get_the_date()?></span></p>
                    <h4 class="newTitle mb-4"><?=get_the_title()?></h4>
                  </a>
                </div>
              <?php
              else:
                if ( $counter == 2 ) :
                  ?>
                  <div class="col-lg-6" data-aos="fade-left">
                  <?php
                endif;
                ?>
                <div <?=$class?>>
                  <a href="<?=get_the_permalink()?>">
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                      <img
                        src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>"
                        alt="News Thumbnail"
                        class="newsImage"
                      />
                      <div>
                        <p class="date">NEWS <span><?=get_the_date()?></span></p>
                        <h4 class="newTitle"><?=get_the_title()?></h4>
                        <p class="newsDeccription">
                          “...<?=$excerpt?>...”
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
                <?php
              endif;
              $counter = $counter + 1;
              if ( $counter > 2 ) :
                $class = 'class="mt-3"';
              endif;
            endwhile;
            if ( $counter > 2 ) :
              ?>
              </div>
              <?php
            endif;
            wp_reset_postdata();
          else:
          _e( 'Sorry, no posts matched your criteria.' );
          endif;
          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- to here and paste it where you see news and update section -->

  <div class="container marginBottom-50">
    <div class="row">
      <?php
      $args = array( 'post_type' => 'newsitems', 'posts_per_page' => '20', 'meta_key'=> 'meta-checkbox', 'meta_value' => 'no', 'paged' => $paged);
          $the_query = new WP_Query( $args ); 
          if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post();
              $excerpt = wp_strip_all_tags( get_the_excerpt(), true );
              $excerpt = substr($excerpt, 0, 100);
              $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
              ?>
              <div class="col-md-6 mt-5 pr-md-5 pr-auto">
                <a href="<?=get_the_permalink()?>">
                  <div class="d-flex flex-wrap flex-md-nowrap">
                    <div style="width: 190px !important;height: 150px !important;margin-right: 15px;">
                      <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="news" class="newsImage newsSearchImage" />
                    </div>
                    <div>
                      <p class="date">NEWS <span><?=get_the_date()?></span></p>
                      <h4 class="newTitle">
                        <?=get_the_title()?>
                      </h4>
                      <p class="newsDeccription">
                        “...<?=$excerpt?>...”
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
    </div>
    <?php
    if (function_exists("pagination")) {
      pagination($the_query->max_num_pages);
    }
    ?>
  </div>

  <!-- How we perform -->
  <?php get_sidebar('performance-section-list'); ?>

  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- career section -->
  <?php get_sidebar('career-opportunities'); ?>

</main>

<?php get_footer(); ?>
