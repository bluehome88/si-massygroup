<?php

class performance_section_main_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'performance_section_main_widget',
			// widget name
			__('Performance Section Main Widget', 'performance_section_main_widget_domain'),
			// widget description
			array( 'description' => __( 'Used for Main Performance Section', 'performance_section_main_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		
		$i = 1;
		$data_sos = 'fade-right';
		$style_attrs = ' mb-lg-0 mb-4';

		$html = '<div class="row">';
		$args = array('post_type' => 'dlm_download', 'posts_per_page' => 2, 'dlm_download_category' => 'annual-reports', 'orderby' => 'date', 'order' => 'DESC');
		$the_query = new WP_Query( $args ); 
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				if($i == 2) { $data_sos = 'fade-left'; $style_attrs = ''; }
		        $html .= '
				<div class="col-lg-6 <?=$style_attrs?>" data-aos="<?=$data_sos?>">
		          <div class="row">
		            <div
		              class="col-md-6 pr-0 d-flex flex-column justify-content-between order-md-0 order-2"
		            >
		              <div class="mt-md-0 mt-3 text-center">
		                <span>
		                  '.get_the_date().'
		                </span>
		                <p>'.get_the_title().'</p>
		              </div>
		              <a href="'.get_bloginfo( 'url' ).'/download/'.get_the_ID().'" class="view_report mx-auto">view report</a>
		            </div>
		            <div class="col-md-6 text-md-left text-center">
		              <img src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'" alt="what\'s next" />
		            </div>
		          </div>
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
