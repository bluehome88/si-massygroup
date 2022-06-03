<?php

/**
 * custom meta Box - Callback 
 */
function custom_meta_box_3_callback( $post ) {
  $featured = get_post_meta( $post->ID );
  ?>
  <p>
    <div class="sm-row-content">
      <label for="meta-textbox_financial_calendar">
        <?php _e( 'Enter Date', 'custom_meta_box_3-textdomain' )?>
          <input type="date" name="meta-textbox_financial_calendar" id="meta-textbox_financial_calendar" value="<?php if ( isset ( $featured['meta-textbox_financial_calendar'] ) ){ echo $featured['meta-textbox_financial_calendar'][0] ; } ?>" />
      </label>
    </div>
  </p>
  <?php
}

/**
 * Saves the custom meta input
 */
function custom_meta_box_3_save( $post_id ) {
 
  // Checks save status
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

  // Exits script depending on save status
  if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
    return;
  }

  // Checks for input and saves
  if( isset( $_POST[ 'meta-textbox_financial_calendar' ] ) ) {
    update_post_meta( $post_id, 'meta-textbox_financial_calendar', $_POST[ 'meta-textbox_financial_calendar' ] );
  } else {
    update_post_meta( $post_id, 'meta-textbox_financial_calendar', '' );
  } 
}

?>