<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The plugin bootstrap file
 *
 * @link              TODO
 * @since             1.0.0
 * @package           Financial Data Entry
 *
 * @wordpress-plugin
 * Plugin Name:       Financial Data Entry
 * Plugin URI:        TODO
 * Description:       Tool for massygroup financial data entry
 * Version:           1.0.0
 * Author:            Hamza Sattar
 * Author URI:        http://hamza.it
 */

if ( version_compare( PHP_VERSION, '5.3.7', '<' ) ) {
    add_action( is_network_admin() ? 'network_admin_notices' : 'admin_notices', create_function( '', 'echo \'<div class="updated"><h3>Financial Data Entry</h3><p>To install the plugin - <strong>PHP 5.3.7</strong> or higher is required.</p></div>\';' ) );
} else {
	include_once __DIR__ . '/autoload.php';

	function plugin_activation(){
		call_user_func( array( '\FinancialDataEntry\Lib\Installer', 'setup' ) );
	}

	function plugin_deactivation(){
		call_user_func( array( '\FinancialDataEntry\Lib\Installer', 'deactivation' ) );
	}

	register_activation_hook(__FILE__,'plugin_activation');
	register_deactivation_hook(__FILE__,'plugin_deactivation');

    $fde = new \FinancialDataEntry\Lib\Plugin;
    $fde->run();
}