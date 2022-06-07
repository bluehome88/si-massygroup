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

		// get jse value
		$jse_data_results = $wpdb->get_results("SELECT jsdt.timestamp,jsdt.value 
		  FROM $stock_data_table AS jsdt
		  ORDER BY jsdt.id DESC
		  LIMIT 1");

		$jse_value = $jse_data_results[0]->value;
		$latest_date = $jse_data_results[0]->timestamp;

		// get ttse value
		$stock_data_table = $wpdb->prefix . "stock_data";
		$ttse_data_results = $wpdb->get_results("SELECT sdt.timestamp,sdt.value 
		  FROM $stock_data_table AS sdt
		  ORDER BY sdt.id DESC
		  LIMIT 1");
		$ttse_value = $ttse_data_results[0]->value;

      	$html .= '
      	<p class="mt-4 mb-2 font-weight-light">
		  Latest Share Price TTSE: $'.$ttse_value.'
		</p>
      	<p class="font-weight-light">
		  Latest Share Price JSE: $'.$jse_value.'
		</p>
		<p class="font-weight-light">Last Updated '.date('M d Y', $latest_date/1000).'</p>';

        echo $html;
	}

	public function form( $instance ) {
		
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		return $instance;
	}
}
