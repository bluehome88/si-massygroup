<?php

class performance_section_list_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'performance_section_list_widget',
			// widget name
			__('Performance Section List Widget', 'performance_section_list_widget_domain'),
			// widget description
			array( 'description' => __( 'Used for List Performance Section', 'performance_section_list_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		
		$i = 0;
		$html = '<div class="d-flex flex-wrap align-items-center items_wrapper">';
		$args = array('post_type' => 'dlm_download', 'posts_per_page' => 5, 'dlm_download_category' => 'annual-reports', 'orderby' => 'date', 'order' => 'DESC');
		$the_query = new WP_Query( $args ); 
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$delay = $i * 50;
		        $html .= '
				<div class="item" data-aos="fade-up" data-aos-delay="<?=$delay?>">
					<img src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'" alt="image" />
				    <a href="'.get_bloginfo( 'url' ).'/download/'.get_the_ID().'">VIEW '.get_the_title().'</a>
			    </div>';
				$i = $i + 1;
			endwhile;
			wp_reset_postdata();	
		else:
			_e( 'Sorry, no posts matched your criteria.' );
		endif;

		$html .= '</div>';
		echo $html;
    
	}

	public function form( $instance ) {
	
	}

	public function update( $new_instance, $old_instance ) {
	
	}
}
