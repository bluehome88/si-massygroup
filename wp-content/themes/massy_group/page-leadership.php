
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner leaderBanner" style="background: url('<?=wp_get_attachment_url( get_post_thumbnail_id() )?>');">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">our leadership</h2>
      </div>
    </div>
  </div>
  <?php
    $page = get_post(get_queried_object_id()); 
    $page_desc = stripslashes(wp_filter_nohtml_kses($page->post_content));
    $itr = 1;
  ?>
  <!-- Information section -->
  <div class="informationSec">
    <div class="container">
      <p class="leadingText leaderLeading" data-aos="fade-up">
        <?=$page_desc?>
      </p>
    </div>
  </div>

  <!-- leadership grid section -->
  <div class="container">
    <div class="HowWePerform our_leadership_heading">
      <h2>Board of Directors</h2>
    </div>
    <div class="row leaderShipSection">
      <?php
        $args = array( 'post_type' => 'leadership', 'posts_per_page' => '3', 'leadership_category' => 'board-member', 'meta_key'=> 'meta-checkbox_leadership', 'meta_value' => 'yes', 'orderby' => 'date', 'order' => 'ASC');
        $the_query = new WP_Query( $args ); 
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
              <div class="col-md-6">
                <div class="memberCard" data-toggle="modal" data-target="#exampleModalCenter<?=$itr?>">
                  <div class="memberCardInner">
                    <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="member image" />
                    <h3><?=get_the_title()?> / <span><?=get_post_meta( get_the_ID(), 'meta-textbox_leadership', true );?></span></h3>
                    <p>
                      <?=stripslashes(wp_filter_nohtml_kses( get_the_excerpt(), true ))?>
                    </p>
                  </div>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter<?=$itr?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        Close
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="modal_imageContainer">
                        <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="image" />
                      </div>
                      <div class="modalNameBar">
                        <h4><?=get_the_title()?></h4>
                        <p><?=get_post_meta( get_the_ID(), 'meta-textbox_leadership', true );?></p>
                      </div>

                      <div class="modalDesc">
                        <p><?=get_the_content()?></p>
                      </div>
                    </div>
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
    <div class="d-flex justify-content-center align-items-center flex-wrap margin_negative">
      <?php
        $args = array( 'post_type' => 'leadership', 'posts_per_page' => '50', 'leadership_category' => 'board-member', 'meta_key'=> 'meta-checkbox_leadership', 'meta_value' => 'no', 'orderby' => 'date', 'order' => 'ASC');
        $the_query = new WP_Query( $args ); 
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
              <div class="marginBottom-30">
                <div class="cardMember" data-toggle="modal" data-target="#exampleModalCenter<?=$itr?>">
                  <div class="cardMemberInner">
                    <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="member image" />
                    <div class="leaderTitle">
                      <h3><?=get_the_title()?></h3>
                      <p>
                        <?=get_post_meta( get_the_ID(), 'meta-textbox_leadership', true );?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter<?=$itr?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        Close
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="modal_imageContainer">
                        <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="image" />
                      </div>
                      <div class="modalNameBar">
                        <h4><?=get_the_title()?></h4>
                        <p><?=get_post_meta( get_the_ID(), 'meta-textbox_leadership', true );?></p>
                      </div>

                      <div class="modalDesc">
                        <p><?=get_the_content()?></p>
                      </div>
                    </div>
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

    <div class="HowWePerform our_leadership_heading">
      <h2>Executive Officers</h2>
    </div>
    <div class="d-flex justify-content-center align-items-center flex-wrap margin_negative">
      <?php
        $args = array( 'post_type' => 'leadership', 'posts_per_page' => '50', 'leadership_category' => 'executive-officer', 'orderby' => 'date', 'order' => 'ASC');
        $the_query = new WP_Query( $args ); 
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
              <div class="marginBottom-30">
                <div class="cardMember" data-toggle="modal" data-target="#exampleModalCenter<?=$itr?>">
                  <div class="cardMemberInner">
                    <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="member image" />
                    <div class="leaderTitle">
                      <h3><?=get_the_title()?></h3>
                      <p>
                        <?=get_post_meta( get_the_ID(), 'meta-textbox_leadership', true );?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter<?=$itr?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        Close
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="modal_imageContainer">
                        <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() )?>" alt="image" />
                      </div>
                      <div class="modalNameBar">
                        <h4><?=get_the_title()?></h4>
                        <p><?=get_post_meta( get_the_ID(), 'meta-textbox_leadership', true );?></p>
                      </div>

                      <div class="modalDesc">
                        <p><?=get_the_content()?></p>
                      </div>
                    </div>
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

  <!-- How we perform -->
  <?php get_sidebar('performance-section-list'); ?>

  <!-- news & update -->
  <?php get_sidebar('news-and-updates'); ?>

  <!-- career section -->
  <?php get_sidebar('career-opportunities'); ?>
</main>

<?php get_footer(); ?>