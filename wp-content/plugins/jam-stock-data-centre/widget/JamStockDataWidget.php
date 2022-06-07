<?php

namespace JamStockDataCentre\Widgets;

class JamStockDataWidget extends \WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'jam_stock_data_widget',
			// widget name
			__('Jam Stock Data Widget', 'jam_stock_data_widget_domain'),
			// widget description
			array( 'description' => __( 'Jam Stock Data Chart For Investor Screens', 'jam_stock_data_widget_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		global $wpdb;
		$stock_data = array();
		$html = '';
		$stock_data_table = $wpdb->prefix . "jam_stock_data";

		$stock_data_results = $wpdb->get_results("SELECT jsdt.timestamp,jsdt.value,jsdt.change_value,jsdt.change_percentage 
		  FROM $stock_data_table AS jsdt
		  ORDER BY jsdt.timestamp ASC");

		/* Group Income Statement Information data by year */
		$min_value = 100000;
		foreach ($stock_data_results as $record){
			$stock_data[] = "[$record->timestamp,$record->value]";
			if( $min_value > $record->value )
				$min_value = $record->value;
		}

		$current = end($stock_data_results);
		$previous = $stock_data_results[count($stock_data_results) -2];
		$html .= '
			<div class="d-flex chartWrapper">
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
	            	<div id="jseChart"></div>
	          	</div>
	        </div>';

        echo $html;

        ?>

        <script type="text/javascript">

        	if (document.getElementById('jseChart')) {
			  var width = document.querySelector('.chart-container').offsetWidth;
			  // console.log(width);
			  document.addEventListener('DOMContentLoaded', function () {
			    Highcharts.stockChart('jseChart', {
					rangeSelector: {
						enabled: true,
						inputEnabled: false,
						selected: 1
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
						linearGradient: [0, 0, 0, 300],
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
