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
		$min_value = 100000;
		foreach ($stock_data_results as $record){
			$stock_data[] = "[$record->timestamp,$record->value]";
			if( $min_value > $record->value )
				$min_value = $record->value;
		}

		$current = end($stock_data_results);
		$previous = $stock_data_results[count($stock_data_results) -2];
		$classText = "greenText";
		if( $current->value < $previous->value )
			$classText = "redText";
		$html .= '
			<div class="d-flex chartWrapper">
				<div class="chartDetails">
	            	<h3>$'.$current->value.'</h3>
	            	<p class="'.$classText.'">$'.$current->change_value.' ( '.$current->change_percentage.'% )</p>
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
	            	<div id="ttseChart"></div>
	          	</div>
	       	</div>';

        echo $html;

        ?>

        <script type="text/javascript">

        	if (document.getElementById('ttseChart')) {
			  var width = document.querySelector('.chart-container').offsetWidth;
			  // console.log(width);
			  document.addEventListener('DOMContentLoaded', function () {
			    Highcharts.stockChart('ttseChart', {
			      rangeSelector: {
						enabled: true,
						inputEnabled: false,
						selected: 0
					},
					navigator: {
						enabled: false
					},
					credits: {
						enabled: false
					},
					tooltip: {
						enabled: true,
						formatter: function() {
							var date = this.x;
							var price = this.y;

							var a = new Date( date );
							var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
							var year = a.getUTCFullYear();
							var month = months[a.getUTCMonth()];
							var date = a.getUTCDate();
							var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
							var dayOfWeek = days[a.getUTCDay()]

							date = dayOfWeek + ", " + month +" " + date + ", " + year;

							return '<p>' + date + '</p><br/><p style="font-size:16px;">Price: <b>$' + price + '</b></p>' ;
						}
					},
			        zoom: {
			        	enabled: false,
			        },
     			    scrollbar: {
			        	enabled: false,
			      	},
					yAxis: [{
						title: {
							text: 'Price'
						},
						lineWidth: 2,
						min: <?php echo $min_value-0.1 ; ?>
					}],
					xAxis: [{
						title: {
							text: 'Date'
						}
					}],
				  exporting: false,
			      series: [
			        {
			          name: 'MASSY',
			          data: [<?php echo join($stock_data, ',') ?>],
			          type: 'area',
			          color: '#0095DA',
			          tooltip: {
			            valueDecimals: 2,
			          },
			          marker: {
			          	enabled: true,
			          	radius: 3
			          },
			          fillColor: {
						linearGradient: [0, 0, 0, 400],
						stops: [
						  [0, '#0095DA'],
						  [1, 'rgba(255,255,255,0)']
						]}
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
			                height: 400,
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
