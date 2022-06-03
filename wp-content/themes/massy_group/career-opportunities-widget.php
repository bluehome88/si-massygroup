<?php

class career_opportunities_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'career_opportunities_widget',
			// widget name
			__('Career Opportunities Widget', ' career_opportunities_widget_domain'),
			// widget description
			array( 'description' => __( 'Career Opportunities block in Career Opportunities section', 'career_opportunities_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		// $title = apply_filters( 'widget_title', $instance['title'] );
		// echo $args['before_widget'];
		// //if title is present-
		// if ( ! empty( $title ) )
		// echo $args['before_title'] . $title . $args['after_title'];
		// //output
		// echo __( 'Greetings from Hostinger.com!', 'aboutus_widget_domain' );
		// echo $args['after_widget'];

		echo '<div class="text-center" data-aos="fade-up">
		    <h2 class="heading">CAREER OPPORTUNITIES</h2>
		    <p class="career_desc">
		      '.$instance[ 'desc' ].'
		      <span>'.$instance[ 'heading' ].'</span
		      >
		    </p>
		  </div>
		  <div class="container career_inner">
		    <img
		      src="'.get_template_directory_uri().'/assets/images/career1.png"
		      alt=""
		      class="img-fluid mt-3 w-100"
		      data-aos="fade-up"
		    />
		    <a
		      href="'.get_permalink( get_page_by_path($instance['url']) ).'"
		      class="learnMore career_btn"
		      data-aos="fade"
		      data-aos-delay="150"
		      >EXPLORE JOBS</a
		    >
		  </div>';
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'desc' ] ) )
			$desc = $instance[ 'desc' ];
		else
			$desc = __( 'Default Desc', 'career_opportunities_widget_domain' );
		if ( isset( $instance[ 'heading' ] ) )
			$heading = $instance[ 'heading' ];
		else
			$heading = __( 'Default Heading', 'career_opportunities_widget_domain' );
		if ( isset( $instance[ 'url' ] ) )
			$url = $instance[ 'url' ];
		else
			$url = __( '#', 'career_opportunities_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" rows="4" cols="50" ><?php echo esc_attr( $desc ); ?></textarea>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'heading' ); ?>"><?php _e( 'Heading:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'heading' ); ?>" name="<?php echo $this->get_field_name( 'heading' ); ?>" rows="4" cols="50" ><?php echo esc_attr( $heading ); ?></textarea>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL Slug:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
		$instance['heading'] = ( ! empty( $new_instance['heading'] ) ) ? strip_tags( $new_instance['heading'] ) : '';
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		return $instance;
	}
}
