
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">search results</h2>
      </div>
    </div>
  </div>

  <!-- Search Results section -->

  <div class="container marginBottom-50">
    
    <h3 class="search-results-count">
      <?php echo $wp_query->found_posts; ?> <?php _e( 'Search Results Found For', 'locale' ); ?>: "<?php the_search_query(); ?>"
    </h3>
    
    <div class="row">
      <?php
        if ( have_posts() ) :
          while ( have_posts() ) : the_post();
            $excerpt = wp_strip_all_tags( get_the_excerpt(), true );
            $excerpt = substr($excerpt, 0, 100);
            $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
            ?>
            <div class="col-md-6 mt-5 pr-md-5 pr-auto">
              <a href="<?=get_the_permalink()?>">
                <div class="d-flex flex-wrap flex-md-nowrap">
                  <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="news" class="newsImage" />
                  <div>
                    <p class="date"><span><?=get_the_date()?></span></p>
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
  </div>

  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- our business -->
  <?php get_sidebar('our-business'); ?>

  <!-- career section -->
  <?php get_sidebar('career-opportunities'); ?>

</main>

<?php get_footer(); ?>
