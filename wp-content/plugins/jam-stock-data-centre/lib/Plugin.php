<?php

namespace JamStockDataCentre\Lib;
use JamStockDataCentre\Widgets\JamStockDataWidget as JSDWidget;
use JamStockDataCentre\Widgets\FooterJamStockDataWidget as FJSDWidget;
use JamStockDataCentre\Widgets\HomePageJamStockDataWidget as HPJSDWidget;
use JamStockDataCentre\Lib\Menu as adminMenu;

class Plugin{

    public function run(){

        add_action('admin_menu', array($this, 'add_menu'));
        add_action('widgets_init', array($this, 'plugin_widgets'));
    }

    public function add_menu(){

        $main_page = add_menu_page('Stock Data Centre - Jam', 'Stock Data Centre - Jam', 'manage_options', 'jam-stock-data-centre', array( new adminMenu(), '_renderListView' ), 'dashicons-chart-line', 23);
    }

    public function load_admin_js(){
        add_action( 'admin_enqueue_scripts', array($this,'enqueue_admin_js') );
    }

    public function enqueue_admin_js(){
        // wp_enqueue_style( 'my-style', get_template_directory_uri() . '/style.css');

        // Register the JS file with a unique handle, file location, and an array of dependencies
       // wp_register_script( "custom_script", plugins_url( 'assets/js/custom.js', dirname(__FILE__) ), array('jquery','highstock','data','exporting','export-data') );
       
       // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
       // wp_localize_script( 'edit_script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));        
       
       // enqueue jQuery library and the script you registered above
       // wp_enqueue_script( 'jquery' );
       // wp_enqueue_script( 'highstock', 'https://code.highcharts.com/stock/highstock.js' );
       //  wp_enqueue_script( 'data', 'https://code.highcharts.com/stock/modules/data.js' );
       //  wp_enqueue_script( 'exporting', 'https://code.highcharts.com/stock/modules/exporting.js' );
       //  wp_enqueue_script( 'export-data', 'https://code.highcharts.com/stock/modules/export-data.js' );
       // wp_enqueue_script( 'custom_script' );
    }

    public function plugin_widgets(){
        register_widget( new JSDWidget() );
        register_widget( new FJSDWidget() );
        register_widget( new HPJSDWidget() );
    }
 
}
