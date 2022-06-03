<?php

class date_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'date_widget',
			// widget name
			__('Date Widget', 'date_widget_domain'),
			// widget description
			array( 'description' => __( 'Used for Date blocks in pages', 'date_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		
		$html = "<h3>Top Ten Shareholders as at ";
		$date = date_format(date_create($instance['date']),"F d, Y");
		$html .= $date."</h3>";
		echo $html;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'date' ] ) )
			$date = $instance[ 'date' ];
		else
			$date = __( date("Y-m-d"), 'date_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Date:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="date" value="<?php echo esc_attr( $date ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['date'] = ( ! empty( $new_instance['date'] ) ) ? strip_tags( $new_instance['date'] ) : '';
		return $instance;
	}
}
