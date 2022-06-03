<?php

class shareholder_download_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'shareholder_download_widget',
			// widget name
			__('Shareholder Download Widget', 'shareholder_download_widget_domain'),
			// widget description
			array( 'description' => __( 'Used for Download Sectionin Shareholder Center', 'shareholder_download_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		
		$html = '';
		$args = array('post_type' => 'dlm_download', 'posts_per_page' => 3, 'dlm_download_category' => 'shareholder-center-forms', 'orderby' => 'date', 'order' => 'DESC');
		$the_query = new WP_Query( $args ); 
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
		        $html .= '
		        <div class="downloadItem">
				    <h4>'.get_the_title().'</h4>
				    <a href="'.get_bloginfo( 'url' ).'/download/'.get_the_ID().'">Download</a>
				</div>';
			endwhile;
			wp_reset_postdata();	
		else:
			_e( 'Sorry, no posts matched your criteria.' );
		endif;

		echo $html;
	}

	public function form( $instance ) {
	
	}

	public function update( $new_instance, $old_instance ) {
	
	}
}
