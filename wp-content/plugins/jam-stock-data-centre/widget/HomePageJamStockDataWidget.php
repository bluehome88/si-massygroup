<?php

namespace JamStockDataCentre\Widgets;

class HomePageJamStockDataWidget extends \WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'homepage_jam_stock_data_widget',
			// widget name
			__('HomePage Jam Stock Data Widget', 'homepage_jam_stock_data_widget_domain'),
			// widget description
			array( 'description' => __( 'Jam Stock Data Widget For Homepage', 'homepage_jam_stock_data_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		global $wpdb;
		$stock_data = array();
		$html = '';
		$jse_data_table = $wpdb->prefix . "jam_stock_data";

		$jse_data_results = $wpdb->get_results("SELECT jsdt.value 
		  FROM $jse_data_table AS jsdt
		  ORDER BY jsdt.id DESC
		  LIMIT 1");

		/* Group Income Statement Information data by year */
		foreach ($jse_data_results as $record){
			$stock_data['jse_opening'] = $record->value;
		}

		$ttse_data_table = $wpdb->prefix . "stock_data";

		$ttse_data_results = $wpdb->get_results("SELECT sdt.value 
		  FROM $ttse_data_table AS sdt
		  ORDER BY sdt.id DESC
		  LIMIT 1");

		/* Group Income Statement Information data by year */
		foreach ($ttse_data_results as $record){
			$stock_data['ttse_opening'] = $record->value;
		}

      	$html .= '
      	<div class="col-lg-4 stockDetails">
			<h2>Latest Stock Price</h2>
	        <h4>Company trading name:</h4>
	        <p>'.$instance[ 'title' ].'</p>
	        <br/>
	        <h4>Stock Prices:</h4>
	        <p>TTSE: $'.$stock_data['ttse_opening'].'</p>
	        <p>JSE: $'.$stock_data['jse_opening'].'</p>
		</div>
		';

        echo $html;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
		else
			$title = __( 'Default Title', 'homepage_jam_stock_data_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Company Trading Name:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}
