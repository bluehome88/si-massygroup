<?php

class description_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'description_widget',
			// widget name
			__('Description Widget', 'description_widget_domain'),
			// widget description
			array( 'description' => __( 'Used for Description textarea blocks in pages', 'description_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		// $title = apply_filters( 'widget_title', $instance['title'] );
		// echo $args['before_widget'];
		// //if title is present
		// if ( ! empty( $title ) )
		// echo $args['before_title'] . $title . $args['after_title'];
		// //output
		// echo __( 'Greetings from Hostinger.com!', 'aboutus_widget_domain' );
		// echo $args['after_widget'];
		
		echo $instance['desc'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'desc' ] ) )
			$desc = $instance[ 'desc' ];
		else
			$desc = __( 'Default Desc', 'description_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" rows="4" cols="50" ><?php echo esc_attr( $desc ); ?></textarea>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
		return $instance;
	}
}
