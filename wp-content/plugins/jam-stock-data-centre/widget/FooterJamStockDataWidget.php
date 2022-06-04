<?php

namespace JamStockDataCentre\Widgets;

class FooterJamStockDataWidget extends \WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'footer_jam_stock_data_widget',
			// widget name
			__('Footer Jam Stock Data Widget', 'footer_jam_stock_data_widget_domain'),
			// widget description
			array( 'description' => __( 'Jam Stock Data Widget For Footer', 'footer_jam_stock_data_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		global $wpdb;
		$stock_data = array();
		$html = '';
		$stock_data_table = $wpdb->prefix . "jam_stock_data";

		$stock_data_results = $wpdb->get_results("SELECT jsdt.timestamp,jsdt.value 
		  FROM $stock_data_table AS jsdt
		  ORDER BY jsdt.id DESC
		  LIMIT 2");

		/* Group Income Statement Information data by year */
		$previous = $stock_data_results[1]->value;
		$current = $stock_data_results[0]->value;
		$latest_date = $stock_data_results[0]->timestamp;

      	$html .= '
      	<p class="mt-4 mb-2 font-weight-light">
		  Latest Share Price JSE: $'.$current.'
		</p>
      	<p class="font-weight-light">
		  Previous Closed Price JSE: $'.$previous.'
		</p>
		<p class="font-weight-light">Last updated '.date('M d Y', $latest_date/1000).'</p>';

        echo $html;
	}

	public function form( $instance ) {
		
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		return $instance;
	}
}
