<?php

/**
 * custom meta Box - Callback 
 */
function custom_meta_box_4_callback( $post ) {
  $featured = get_post_meta( $post->ID );
  ?>
  <p>
    <div class="sm-row-content">
      <label for="meta-textbox_4_top_ten_shareholders">
        <?php _e( 'Shareholding', 'custom_meta_box_4-textdomain' )?>
          <input type="text" name="meta-textbox_4_top_ten_shareholders" id="meta-textbox_4_top_ten_shareholders" value="<?php if ( isset ( $featured['meta-textbox_4_top_ten_shareholders'] ) ){ echo $featured['meta-textbox_4_top_ten_shareholders'][0] ; } ?>" />
      </label>
    </div>
  </p>
  <?php
}

/**
 * Saves the custom meta input
 */
function custom_meta_box_4_save( $post_id ) {
 
  // Checks save status
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

  // Exits script depending on save status
  if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
    return;
  }

  // Checks for input and saves
  if( isset( $_POST[ 'meta-textbox_4_top_ten_shareholders' ] ) ) {
    update_post_meta( $post_id, 'meta-textbox_4_top_ten_shareholders', $_POST[ 'meta-textbox_4_top_ten_shareholders' ] );
  } else {
    update_post_meta( $post_id, 'meta-textbox_4_top_ten_shareholders', '' );
  } 
}

?>