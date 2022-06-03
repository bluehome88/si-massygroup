<?php

namespace StockDataCentre\Lib;
use StockDataCentre\Widgets\StockDataWidget as SDWidget;
use StockDataCentre\Widgets\FooterStockDataWidget as FSDWidget;
use StockDataCentre\Widgets\HomePageStockDataWidget as HPSDWidget;
use StockDataCentre\Lib\Menu as adminMenu;

class Plugin{

    public function run(){

        add_action('admin_menu', array($this, 'add_menu'));
        add_action('widgets_init', array($this, 'plugin_widgets'));
    }

    public function add_menu(){

        $main_page = add_menu_page('Stock Data Centre', 'Stock Data Centre', 'manage_options', 'stock-data-centre', array( new adminMenu(), '_renderListView' ), 'dashicons-chart-line', 23);

        // $edit_page = add_submenu_page('financial-data-entry', 'Edit Financial Entries', 'Edit','manage_options', 'edit-financial-entries', array( new adminMenu(), '_renderEditView' ));

        // add_action( 'load-' . $main_page, array($this,'load_admin_js') );
        // add_action( 'load-' . $edit_page, array($this,'load_admin_js') );
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
        register_widget( new SDWidget() );
        register_widget( new FSDWidget() );
        register_widget( new HPSDWidget() );
    }
 
}
