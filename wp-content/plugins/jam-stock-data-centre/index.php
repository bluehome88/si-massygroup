<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * The plugin bootstrap file
 *
 * @link              TODO
 * @since             1.0.0
 * @package           Jam Stock Data Centre
 *
 * @wordpress-plugin
 * Plugin Name:       Jam Stock Data Centre
 * Description:       Tool for massygroup Jam Stock Data
 * Version:           1.0.0
 * Author:            Yakov Vlacic
 */

if ( version_compare( PHP_VERSION, '5.3.7', '<' ) ) {
    add_action( is_network_admin() ? 'network_admin_notices' : 'admin_notices', create_function( '', 'echo \'<div class="updated"><h3>Jamaica Financial Data Entry</h3><p>To install the plugin - <strong>PHP 5.3.7</strong> or higher is required.</p></div>\';' ) );
} else {
    include_once __DIR__ . '/autoload.php';

    function jsdc_plugin_activation(){
        call_user_func( array( '\JamStockDataCentre\Lib\Installer', 'setup' ) );
    }

    function jsdc_plugin_deactivation(){
        call_user_func( array( '\JamStockDataCentre\Lib\Installer', 'deactivation' ) );
    }

    register_activation_hook(__FILE__,'jsdc_plugin_activation');
    register_deactivation_hook(__FILE__,'jsdc_plugin_deactivation');

    $jsdc = new \JamStockDataCentre\Lib\Plugin;
    $jsdc->run();
}