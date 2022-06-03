<?php

namespace StockDataCentre\Widgets;

class StockDataWidget extends \WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'stock_data_widget',
			// widget name
			__('Stock Data Widget', 'stock_data_widget_domain'),
			// widget description
			array( 'description' => __( 'Stock Data Chart For Investor Screens', 'stock_data_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		global $wpdb;
		$stock_data = array();
		$html = '';
		$stock_data_table = $wpdb->prefix . "stock_data";

		$stock_data_results = $wpdb->get_results("SELECT sdt.timestamp,sdt.value,sdt.change_value,sdt.change_percentage 
		  FROM $stock_data_table AS sdt
		  ORDER BY sdt.timestamp ASC");

		/* Group Income Statement Information data by year */
		foreach ($stock_data_results as $record){
			$stock_data[] = "[$record->timestamp,$record->value]";
		}

		$current = end($stock_data_results);
		$previous = $stock_data_results[count($stock_data_results) -2];
		$html .= '
			<div class="chartDetails">
            	<h3>$'.$current->value.'</h3>
            	<p class="redText">$'.$current->change_value.' - '.$current->change_percentage.'%</p>
	            <div class="timeStamp text-right">
	              <p>Last updated: '.date('M d Y h:i A', $current->timestamp/1000).'</p>
	              <!-- <p>Business/Consumer Services: <span>-1.30</span></p> -->
	            </div>
	            <div class="prevRecored">
	              <p>Previous Close</p>
	              <p>$'.$previous->value.'</p>
	            </div>
          	</div>
          	<div class="chart-container">
            	<div id="myChart"></div>
          	</div>';

        echo $html;

        ?>

        <script type="text/javascript">

        	if (document.getElementById('myChart')) {
			  var width = document.querySelector('.chart-container').offsetWidth;
			  // console.log(width);
			  document.addEventListener('DOMContentLoaded', function () {
			    Highcharts.stockChart('myChart', {
			      rangeSelector: {
			        selected: 1,
			      },

			      title: {
			        text: null,
			      },
			      subtitle: {
			        text: null,
			      },
			      navigator: {
			        enabled: false,
			      },
			      scrollbar: {
			        enabled: false,
			      },
			      zoom: {
			        enabled: false,
			      },
			      series: [
			        {
			          name: 'MASSY',
			          data: [<?php echo join($stock_data, ',') ?>],
			          navigator: false,
			          tooltip: {
			            valueDecimals: 2,
			          },
			        },
			      ],
			      responsive: {
			        rules: [
			          {
			            condition: {
			              maxWidth: 1400,
			            },
			            chartOptions: {
			              chart: {
			                width: width,
			                height: 300,
			              },
			              subtitle: {
			                text: null,
			              },
			              navigator: {
			                enabled: false,
			              },
			            },
			          },
			        ],
			      },
			    });
			  });
			}	
        </script>

        <?php
	}

	public function form( $instance ) {
		
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		return $instance;
	}
}
