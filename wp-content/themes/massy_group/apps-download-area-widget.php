<?php

class apps_download_area_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'apps_download_area_widget',
			// widget name
			__('Apps Download Area Widget', ' apps_download_area_widget_domain'),
			// widget description
			array( 'description' => __( 'Apps Download Area Widget On Homepage', 'apps_download_area_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		?>

		<div class="col-lg-8 shadowBox">
	        <div class="row py-3">
	          <div class="col-md-4 downloadText borderBoldRight">
	            <h3 class="mt-3 mb-5">Download Our Apps NOW!</h3>
	          </div>
	          <div
	            class="col-md-4 borderBoldRight text-center downloadButtons"
	          >
	            <img src="<?php echo get_template_directory_uri()?>/assets/images/massyApp.png" alt="Massy App" />
	            <div>
	              <a href="<?=$instance[ 'massystores_appstore_link' ]?>" target="_blank" class="mr-2">
	                <img
	                  src="<?php echo get_template_directory_uri()?>/assets/images/applestore.png"
	                  alt="Apple Store"
	                />
	              </a>
	              <a href="<?=$instance[ 'massystores_playstore_link' ]?>" target="_blank">
	                <img
	                  src="<?php echo get_template_directory_uri()?>/assets/images/googleplay.png"
	                  alt="Play Store"
	                />
	              </a>
	            </div>
	          </div>
	          <div class="col-md-4 downloadButtons text-center">
	            <img
	              src="<?php echo get_template_directory_uri()?>/assets/images/massyConnect.png"
	              alt="Massy Connect"
	            />
	            <div>
	              <a href="<?=$instance[ 'massyconnect_appstore_link' ]?>" target="_blank" class="mr-2">
	                <img
	                  src="<?php echo get_template_directory_uri()?>/assets/images/applestore.png"
	                  alt="Apple Store"
	                />
	              </a>
	              <a href="<?=$instance[ 'massyconnect_playstore_link' ]?>" target="_blank">
	                <img
	                  src="<?php echo get_template_directory_uri()?>/assets/images/googleplay.png"
	                  alt="Play Store"
	                />
	              </a>
	            </div>
	          </div>
	        </div>
	    </div>

		<?php
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'massystores_appstore_link' ] ) )
			$massystores_appstore_link = $instance[ 'massystores_appstore_link' ];
		else
			$massystores_appstore_link = __( '#', 'apps_download_area_widget_domain' );
		if ( isset( $instance[ 'massystores_playstore_link' ] ) )
			$massystores_playstore_link = $instance[ 'massystores_playstore_link' ];
		else
			$massystores_playstore_link = __( '#', 'apps_download_area_widget_domain' );
		if ( isset( $instance[ 'massyconnect_appstore_link' ] ) )
			$massyconnect_appstore_link = $instance[ 'massyconnect_appstore_link' ];
		else
			$massyconnect_appstore_link = __( '#', 'apps_download_area_widget_domain' );
		if ( isset( $instance[ 'massyconnect_playstore_link' ] ) )
			$massyconnect_playstore_link = $instance[ 'massyconnect_playstore_link' ];
		else
			$massyconnect_playstore_link = __( '#', 'apps_download_area_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'massystores_appstore_link' ); ?>"><?php _e( 'MassyStores App Store Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'massystores_appstore_link' ); ?>" name="<?php echo $this->get_field_name( 'massystores_appstore_link' ); ?>" type="text" value="<?php echo esc_attr( $massystores_appstore_link ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'massystores_playstore_link' ); ?>"><?php _e( 'MassyStores Play Store Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'massystores_playstore_link' ); ?>" name="<?php echo $this->get_field_name( 'massystores_playstore_link' ); ?>" type="text" value="<?php echo esc_attr( $massystores_playstore_link ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'massyconnect_appstore_link' ); ?>"><?php _e( 'MassyConnect App Store Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'massyconnect_appstore_link' ); ?>" name="<?php echo $this->get_field_name( 'massyconnect_appstore_link' ); ?>" type="text" value="<?php echo esc_attr( $massyconnect_appstore_link ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'massyconnect_playstore_link' ); ?>"><?php _e( 'MassyConnect Play Store Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'massyconnect_playstore_link' ); ?>" name="<?php echo $this->get_field_name( 'massyconnect_playstore_link' ); ?>" type="text" value="<?php echo esc_attr( $massyconnect_playstore_link ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['massystores_appstore_link'] = ( ! empty( $new_instance['massystores_appstore_link'] ) ) ? strip_tags( $new_instance['massystores_appstore_link'] ) : '';
		$instance['massystores_playstore_link'] = ( ! empty( $new_instance['massystores_playstore_link'] ) ) ? strip_tags( $new_instance['massystores_playstore_link'] ) : '';
		$instance['massyconnect_appstore_link'] = ( ! empty( $new_instance['massyconnect_appstore_link'] ) ) ? strip_tags( $new_instance['massyconnect_appstore_link'] ) : '';
		$instance['massyconnect_playstore_link'] = ( ! empty( $new_instance['massyconnect_playstore_link'] ) ) ? strip_tags( $new_instance['massyconnect_playstore_link'] ) : '';
		return $instance;
	}
}
