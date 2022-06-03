<?php

class news_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'news_widget',
			// widget name
			__('News Widget', ' news_widget_domain'),
			// widget description
			array( 'description' => __( 'News block in News & Articles section', 'news_widget_domain' ), )
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
		$counter = 1;
		$html = '<div class="row">';
		$class = '';
		$args = array( 'post_type' => 'newsitems', 'posts_per_page' => '3', 'meta_key'=> 'meta-checkbox', 'meta_value' => 'yes');
		$the_query = new WP_Query( $args ); 
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$excerpt = wp_strip_all_tags( get_the_excerpt(), true );
				$excerpt = substr($excerpt, 0, 100);
				$excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
				if ( $counter == 1 ) :
					$html .= '
					<div class="col-lg-6">
						<a href="'.get_the_permalink().'">
				          <img src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'" alt="News Thumbnail" />
				          <p class="date">NEWS <span>'.get_the_date().'</span></p>
				          <h4 class="newTitle mb-4">'.get_the_title().'</h4>
			          	</a>
			        </div>';
			    else:
			        if ( $counter == 2 ) :
				    	$html .= '<div class="col-lg-6">';
				    endif;
			        $html .= '
			          <div '.$class.'>
			            <a href="'.get_the_permalink().'">
				            <div class="d-flex flex-wrap flex-sm-nowrap">
				              <img
				                src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'"
				                alt="News Thumbnail"
				                class="newsImage"
				              />
				              <div>
				                <p class="date">NEWS <span>'.get_the_date().'</span></p>
				                <h4 class="newTitle">'.get_the_title().'</h4>
				                <p class="newsDeccription">
				                  “...'.$excerpt.'...”
				                </p>
				              </div>
				            </div>
			            </a>
			          </div>';
			    endif;
			    $counter = $counter + 1;
			    if ( $counter > 2 ) :
			    	$class = 'class="mt-3"';
			    endif;
			endwhile;
			if ( $counter > 2 ) :
			    $html .= '</div>';
			endif;
			wp_reset_postdata();	
		else:
			_e( 'Sorry, no posts matched your criteria.' );
		endif;

		$html .= '</div>';
		$html .= '
	      <div class="mt-5 d-flex justify-content-center">
	        <a href="'.get_permalink( get_page_by_path($instance['url']) ).'" class="learnMore">VIEW ALL</a>
	      </div>';
		echo $html;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'url' ] ) )
			$url = $instance[ 'url' ];
		else
			$url = __( '#', 'news_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL Slug:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		return $instance;
	}
}
