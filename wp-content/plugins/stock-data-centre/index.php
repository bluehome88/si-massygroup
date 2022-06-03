<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The plugin bootstrap file
 *
 * @link              TODO
 * @since             1.0.0
 * @package           Stock Data Centre
 *
 * @wordpress-plugin
 * Plugin Name:       Stock Data Centre
 * Plugin URI:        TODO
 * Description:       Tool for massygroup stock data
 * Version:           1.0.0
 * Author:            Hamza Sattar
 * Author URI:        http://hamza.it
 */

if ( version_compare( PHP_VERSION, '5.3.7', '<' ) ) {
    add_action( is_network_admin() ? 'network_admin_notices' : 'admin_notices', create_function( '', 'echo \'<div class="updated"><h3>Financial Data Entry</h3><p>To install the plugin - <strong>PHP 5.3.7</strong> or higher is required.</p></div>\';' ) );
} else {
	include_once __DIR__ . '/autoload.php';

	function sdc_plugin_activation(){
		call_user_func( array( '\StockDataCentre\Lib\Installer', 'setup' ) );
	}

	function sdc_plugin_deactivation(){
		call_user_func( array( '\StockDataCentre\Lib\Installer', 'deactivation' ) );
	}

	register_activation_hook(__FILE__,'sdc_plugin_activation');
	register_deactivation_hook(__FILE__,'sdc_plugin_deactivation');

    $sdc = new \StockDataCentre\Lib\Plugin;
    $sdc->run();
}