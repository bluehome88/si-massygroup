<?php

class ourbusiness_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'ourbusiness_widget',
			// widget name
			__('Our Business Widget', ' ourbusiness_widget_domain'),
			// widget description
			array( 'description' => __( 'Our Business block in Our Business section', 'ourbusiness_widget_domain' ), )
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
		$parent_slug = 'our-business';
		$page_id = NULL;
		$html = '';
		$page = get_page_by_path($parent_slug);
		if ($page) {
			$page_id = $page->ID;
		}
		$queried_object = get_queried_object();

		$html .= '<div class="text-center">';
		if ($page_id !== $queried_object->ID) {
			$html .= '<h2 class="heading" data-aos="slide-up">Our Business</h2>';
		}
		$html .= '<p class="Businessdescription" data-aos="slide-up">'.$instance['desc'].'</p>';
		$html .= '</div>';
		
		$page1 = $page2 = $page3 = $page4 = $page5 = $page6 = '';
		$sb_tnail1 = $sb_tnail2 = $sb_tnail3 = $sb_tnail4 = $sb_tnail5 = $sb_tnail6 = '';
		if($instance['url_1']) { 
			$page1 = get_page_by_path($parent_slug.'/'.$instance['url_1']);
            $attachments = get_posts( array(
              'post_type' => 'attachment',
              'posts_per_page' => -1,
              'post_parent' => $page1->ID,
              'exclude'     => get_post_thumbnail_id(),
            ));
            $sb_tnail1 = $attachments[0]->ID;
		}
		if($instance['url_2']) { 
			$page2 = get_page_by_path($parent_slug.'/'.$instance['url_2']);
			$attachments = get_posts( array(
              'post_type' => 'attachment',
              'posts_per_page' => -1,
              'post_parent' => $page2->ID,
              'exclude'     => get_post_thumbnail_id(),
            ));
            $sb_tnail2 = $attachments[0]->ID;
		}
		if($instance['url_3']) { 
			$page3 = get_page_by_path($parent_slug.'/'.$instance['url_3']);
			$attachments = get_posts( array(
              'post_type' => 'attachment',
              'posts_per_page' => -1,
              'post_parent' => $page3->ID,
              'exclude'     => get_post_thumbnail_id(),
            ));
            $sb_tnail3 = $attachments[0]->ID; 
		}
		if($instance['url_4']) { 
			$page4 = get_page_by_path($parent_slug.'/'.$instance['url_4']);
			$attachments = get_posts( array(
              'post_type' => 'attachment',
              'posts_per_page' => -1,
              'post_parent' => $page4->ID,
              'exclude'     => get_post_thumbnail_id(),
            ));
            $sb_tnail4 = $attachments[0]->ID; 
		}
		if($instance['url_5']) { 
			$page5 = get_page_by_path($parent_slug.'/'.$instance['url_5']);
			$attachments = get_posts( array(
              'post_type' => 'attachment',
              'posts_per_page' => -1,
              'post_parent' => $page5->ID,
              'exclude'     => get_post_thumbnail_id(),
            ));
            $sb_tnail5 = $attachments[0]->ID; 
		}
		if($instance['url_6']) { 
			$page6 = get_page_by_path($parent_slug.'/'.$instance['url_6']);
			$attachments = get_posts( array(
              'post_type' => 'attachment',
              'posts_per_page' => -1,
              'post_parent' => $page6->ID,
              'exclude'     => get_post_thumbnail_id(),
            ));
            $sb_tnail6 = $attachments[0]->ID; 
		}
		// var_dump(get_page_by_path($parent_slug.'/'.$instance['url_1']) );
		// die;
		$html.= '
			<div class="container">
			    <div class="category d-flex flex-wrap justify-content-center">';
			    if(isset($instance['title_1']) && !empty($instance['title_1']) && $instance['title_1'] != ''){
			    	$html.= '
			    	<div data-aos="slide-up">
				        <a href="'.get_permalink( get_page_by_path($parent_slug.'/'.$instance['url_1']) ).'">
				          <img src="'.wp_get_attachment_url( $sb_tnail1 ).'" alt="Gas Products" />
				          <p>'.$instance['title_1'].'</p>
				        </a>
			      	</div>';
			    }
			    if(isset($instance['title_2']) && !empty($instance['title_2']) && $instance['title_2'] != ''){
			    	$html.= '
			    	<div data-aos="slide-up" data-aos-delay="50">
				        <a href="'.get_permalink( get_page_by_path($parent_slug.'/'.$instance['url_2']) ).'">
				          <img src="'.wp_get_attachment_url( $sb_tnail2 ).'"
				            alt="Integrated Retail"
				          />
				          <p>'.$instance['title_2'].'</p>
				        </a>
			      	</div>';
			    }
			    if(isset($instance['title_3']) && !empty($instance['title_3']) && $instance['title_3'] != ''){
			    	$html.= '
			    	<div data-aos="slide-up" data-aos-delay="100">
				        <a href="'.get_permalink( get_page_by_path($parent_slug.'/'.$instance['url_3']) ).'">
				          <img
				            src="'.wp_get_attachment_url( $sb_tnail3 ).'"
				            alt="Motors & Machines"
				          />
				          <p>'.$instance['title_3'].'</p>
				        </a>
			      	</div>';
			    }
			    if(isset($instance['title_4']) && !empty($instance['title_4']) && $instance['title_4'] != ''){
			    	$html.= '
			    	<div data-aos="slide-up" data-aos-delay="150">
				        <a href="'.get_permalink( get_page_by_path($parent_slug.'/'.$instance['url_4']) ).'">
				          <img
				            src="'.wp_get_attachment_url( $sb_tnail4 ).'"
				            alt="Integrated Retail"
				          />
				          <p>'.$instance['title_4'].'</p>
				        </a>
			      	</div>';
			    }
			    if(isset($instance['title_5']) && !empty($instance['title_5']) && $instance['title_5'] != ''){
			    	$html.= '
			    	<div data-aos="slide-up" data-aos-delay="200">
				        <a href="'.get_permalink( get_page_by_path($parent_slug.'/'.$instance['url_5']) ).'">
				          <img
				            src="'.wp_get_attachment_url( $sb_tnail5 ).'"
				            alt="Integrated Retail"
				          />
				          <p>'.$instance['title_5'].'</p>
				        </a>
			      	</div>';
			    }
			    if(isset($instance['title_6']) && !empty($instance['title_6']) && $instance['title_6'] != ''){
			    	$html.= '
			    	<div data-aos="slide-up" data-aos-delay="250">
				        <a href="'.get_permalink( get_page_by_path($parent_slug.'/'.$instance['url_6']) ).'">
				          <img
				            src="'.wp_get_attachment_url( $sb_tnail6 ).'"
				            alt="Integrated Retail"
				          />
				          <p>'.$instance['title_6'].'</p>
				        </a>
			      	</div>';
			    }
			    $html .= ' 
			   </div>   
			</div>';

		echo $html;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'desc' ] ) )
			$desc = $instance[ 'desc' ];
		else
			$desc = __( 'Default Desc', 'ourbusiness_widget_domain' );

		if ( isset( $instance[ 'title_1' ] ) )
			$title_1 = $instance[ 'title_1' ];
		else
			$title_1 = __( 'Default Title 1', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'title_2' ] ) )
			$title_2 = $instance[ 'title_2' ];
		else
			$title_2 = __( 'Default Title 2', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'title_3' ] ) )
			$title_3 = $instance[ 'title_3' ];
		else
			$title_3 = __( 'Default Title 3', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'title_4' ] ) )
			$title_4 = $instance[ 'title_4' ];
		else
			$title_4 = __( 'Default Title 4', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'title_5' ] ) )
			$title_5 = $instance[ 'title_5' ];
		else
			$title_5 = __( 'Default Title 5', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'title_6' ] ) )
			$title_6 = $instance[ 'title_6' ];
		else
			$title_6 = __( 'Default Title 6', 'ourbusiness_widget_domain' );

		if ( isset( $instance[ 'url_1' ] ) )
			$url_1 = $instance[ 'url_1' ];
		else
			$url_1 = __( 'Default URL 1', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'url_2' ] ) )
			$url_2 = $instance[ 'url_2' ];
		else
			$url_2 = __( 'Default URL 2', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'url_3' ] ) )
			$url_3 = $instance[ 'url_3' ];
		else
			$url_3 = __( 'Default URL 3', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'url_4' ] ) )
			$url_4 = $instance[ 'url_4' ];
		else
			$url_4 = __( 'Default URL 4', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'url_5' ] ) )
			$url_5 = $instance[ 'url_5' ];
		else
			$url_5 = __( 'Default URL 5', 'ourbusiness_widget_domain' );
		if ( isset( $instance[ 'url_6' ] ) )
			$url_6 = $instance[ 'url_6' ];
		else
			$url_6 = __( 'Default URL 6', 'ourbusiness_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" rows="4" cols="50" ><?php echo esc_attr( $desc ); ?></textarea>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'title_1' ); ?>"><?php _e( 'Title 1:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title_1' ); ?>" name="<?php echo $this->get_field_name( 'title_1' ); ?>" type="text" value="<?php echo esc_attr( $title_1 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url_1' ); ?>"><?php _e( 'URL 1 Slug:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url_1' ); ?>" name="<?php echo $this->get_field_name( 'url_1' ); ?>" type="text" value="<?php echo esc_attr( $url_1 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'title_2' ); ?>"><?php _e( 'Title 2:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title_2' ); ?>" name="<?php echo $this->get_field_name( 'title_2' ); ?>" type="text" value="<?php echo esc_attr( $title_2 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url_2' ); ?>"><?php _e( 'URL 2 Slug:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url_2' ); ?>" name="<?php echo $this->get_field_name( 'url_2' ); ?>" type="text" value="<?php echo esc_attr( $url_2 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'title_3' ); ?>"><?php _e( 'Title 3:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title_3' ); ?>" name="<?php echo $this->get_field_name( 'title_3' ); ?>" type="text" value="<?php echo esc_attr( $title_3 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url_3' ); ?>"><?php _e( 'URL 3 Slug:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url_3' ); ?>" name="<?php echo $this->get_field_name( 'url_3' ); ?>" type="text" value="<?php echo esc_attr( $url_3 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'title_4' ); ?>"><?php _e( 'Title 4:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title_4' ); ?>" name="<?php echo $this->get_field_name( 'title_4' ); ?>" type="text" value="<?php echo esc_attr( $title_4 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url_4' ); ?>"><?php _e( 'URL 4 Slug:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url_4' ); ?>" name="<?php echo $this->get_field_name( 'url_4' ); ?>" type="text" value="<?php echo esc_attr( $url_4 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'title_5' ); ?>"><?php _e( 'Title 5:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title_5' ); ?>" name="<?php echo $this->get_field_name( 'title_5' ); ?>" type="text" value="<?php echo esc_attr( $title_5 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url_5' ); ?>"><?php _e( 'URL 5 Slug:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url_5' ); ?>" name="<?php echo $this->get_field_name( 'url_5' ); ?>" type="text" value="<?php echo esc_attr( $url_5 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'title_6' ); ?>"><?php _e( 'Title 6:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title_6' ); ?>" name="<?php echo $this->get_field_name( 'title_6' ); ?>" type="text" value="<?php echo esc_attr( $title_6 ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url_6' ); ?>"><?php _e( 'URL 6 Slug:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url_6' ); ?>" name="<?php echo $this->get_field_name( 'url_6' ); ?>" type="text" value="<?php echo esc_attr( $url_6 ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
		$instance['title_1'] = ( ! empty( $new_instance['title_1'] ) ) ? strip_tags( $new_instance['title_1'] ) : '';
		$instance['url_1'] = ( ! empty( $new_instance['url_1'] ) ) ? strip_tags( $new_instance['url_1'] ) : '';
		$instance['title_2'] = ( ! empty( $new_instance['title_2'] ) ) ? strip_tags( $new_instance['title_2'] ) : '';
		$instance['url_2'] = ( ! empty( $new_instance['url_2'] ) ) ? strip_tags( $new_instance['url_2'] ) : '';
		$instance['title_3'] = ( ! empty( $new_instance['title_3'] ) ) ? strip_tags( $new_instance['title_3'] ) : '';
		$instance['url_3'] = ( ! empty( $new_instance['url_3'] ) ) ? strip_tags( $new_instance['url_3'] ) : '';
		$instance['title_4'] = ( ! empty( $new_instance['title_4'] ) ) ? strip_tags( $new_instance['title_4'] ) : '';
		$instance['url_4'] = ( ! empty( $new_instance['url_4'] ) ) ? strip_tags( $new_instance['url_4'] ) : '';
		$instance['title_5'] = ( ! empty( $new_instance['title_5'] ) ) ? strip_tags( $new_instance['title_5'] ) : '';
		$instance['url_5'] = ( ! empty( $new_instance['url_5'] ) ) ? strip_tags( $new_instance['url_5'] ) : '';
		$instance['title_6'] = ( ! empty( $new_instance['title_6'] ) ) ? strip_tags( $new_instance['title_6'] ) : '';
		$instance['url_6'] = ( ! empty( $new_instance['url_6'] ) ) ? strip_tags( $new_instance['url_6'] ) : '';
		return $instance;
	}
}
