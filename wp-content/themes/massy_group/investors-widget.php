<?php

class investors_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'investors_widget',
			// widget name
			__('Investors Widget', ' investors_widget_domain'),
			// widget description
			array( 'description' => __( 'Investors block in Who we are section', 'investors_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// echo $args['before_widget'];
		// //if title is present
		// if ( ! empty( $title ) )
		// echo $args['before_title'] . $title . $args['after_title'];
		// //output
		// echo __( 'Greetings from Hostinger.com!', 'aboutus_widget_domain' );
		// echo $args['after_widget'];

		echo '<div class="col-md-6 investors" data-aos="slide-left" data-aos-offset="200">
		      <h3 class="sec_subHead">'.$title.'</h3>
		      <div class="row">
		        <div class="col-md-6 pr-0">
		          <img
		            src="'.get_template_directory_uri().'/assets/images/investor.png"
		            alt="investors"
		            class="sectionImage"
		          />
		        </div>
		        <div class="col-md-6 pl-0">
		          <div class="d-flex flex-column justify-content-between align-items-center content_right h-100">
		            <p class="mt-3">'.$instance['desc'].'</p>
		            <a href="'.get_permalink( get_page_by_path($instance['url']) ).'" class="learnMore blue">learn more</a>
		          </div>
		        </div>
		      </div>
		    </div>';
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
		else
			$title = __( 'Default Title', 'investors_widget_domain' );
		if ( isset( $instance[ 'desc' ] ) )
			$desc = $instance[ 'desc' ];
		else
			$desc = __( 'Default Desc', 'investors_widget_domain' );
		if ( isset( $instance[ 'url' ] ) )
			$url = $instance[ 'url' ];
		else
			$url = __( '#', 'investors_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" rows="4" cols="50" ><?php echo esc_attr( $desc ); ?></textarea>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL Slug:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		return $instance;
	}
}
