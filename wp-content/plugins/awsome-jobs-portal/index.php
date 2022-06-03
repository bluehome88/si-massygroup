<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
session_start();


/**
 * The plugin bootstrap file
 *
 * @link              TODO
 * @since             1.0.0
 * @package           Jobs Portal
 *
 * @wordpress-plugin
 * Plugin Name:       Awsome Jobs Portal
 * Plugin URI:        TODO
 * Description:       A great tool for managing careers on your website
 * Version:           0.1.0
 * Author:            Khurram Nawaz
 * Author URI:        http://khurram.it
 */

if ( version_compare( PHP_VERSION, '5.3.7', '<' ) ) {
    add_action( is_network_admin() ? 'network_admin_notices' : 'admin_notices', create_function( '', 'echo \'<div class="updated"><h3>Awsome Jobs Portal</h3><p>To install the plugin - <strong>PHP 5.3.7</strong> or higher is required.</p></div>\';' ) );
} else {
	include_once __DIR__ . '/autoload.php';

	function jobs_plugin_activation(){
		call_user_func( array( '\AwsomeJobPortal\Lib\Installer', 'setup' ) );
	}

	function jobs_plugin_deactivation(){
		call_user_func( array( '\AwsomeJobPortal\Lib\Installer', 'deactivation' ) );
	}

	register_activation_hook(__FILE__,'jobs_plugin_activation');
	register_deactivation_hook(__FILE__,'jobs_plugin_deactivation');

    $ajp_settings = new \AwsomeJobPortal\Lib\Settings;
    $ajp = new \AwsomeJobPortal\Lib\Plugin;
    $ajp->run();
}