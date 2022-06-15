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
        add_action( 'rest_api_init', array($this, 'add_custom_stock_prices_api'));
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

    public function add_custom_stock_prices_api(){
        register_rest_route( 'sdc/v1', '/fetch_latest/', array(
          'methods' => 'GET',
          'callback' => array($this, 'update_stock_data'),
        ));
    }

    public function update_stock_data() {
      
      $fetched_data = $this->fetch_latest_stock_entry();
      $prev_stock_data = $this->get_prev_stock_data();

      $last_updated = array_values($prev_stock_data)[0];
      $last_updated_date = date("Y-m-d",($last_updated[0]/1000));

      $fetched_date = date("Y-m-d",strtotime($fetched_data[0]['date']));

      if($fetched_date > $last_updated_date){
        $fetched_data[0]['date'] = strtotime($fetched_data[0]['date']);
        if($this->add_new_entry($fetched_data)){
          $this->update_local_file_storage($fetched_data);
        }
      }
      return true;
    }

    public function fetch_latest_stock_entry(){
      include_once("simplehtmldom/simple_html_dom.php");

      $html = file_get_html('https://www.stockex.co.tt/manage-stock/massy/');
      // get data block
      foreach($html->find('table#index_information') as $row) {
        $item['opening'] = trim($row->find('td', 1)->plaintext);
        $item['change'] = trim($row->find('td', 2)->plaintext);
        $item['change_per'] = trim($row->find('td', 3)->plaintext);
      }

      // get latest date
      foreach($html->find('div#elementor-tab-content-2321') as $content) {
        $date_para = trim($content->find('u', 0)->plaintext);
        $item['date'] = trim(str_replace('Trade Information for', '', $date_para));
      }

      $ret[] = $item;

      // clean up memory
      $html->clear();
      unset($html);

      return $ret;
    }

    public function get_prev_stock_data(){
      global $wpdb;
      $stock_data = array();
      $html = '';
      $stock_data_table = $wpdb->prefix . "stock_data";

      $stock_data_results = $wpdb->get_results("SELECT sdt.timestamp,sdt.value,sdt.change_value,sdt.change_percentage 
        FROM $stock_data_table AS sdt
        ORDER BY sdt.id DESC
        LIMIT 2");

      /* Group Income Statement Information data by year */
      foreach ($stock_data_results as $record){
        $stock_data[] = [$record->timestamp,$record->value,$record->change_value,$record->change_percentage];
      }
      return $stock_data;
    }

    public function add_new_entry($fetched_data){
      global $wpdb;
      $stock_data_table = $wpdb->prefix . "stock_data";
      $timestamp = $fetched_data[0]['date']*1000;
      $value = str_replace('$', '', $fetched_data[0]['opening']);
      $change = str_replace('$', '', $fetched_data[0]['change']);
      $change_per = str_replace('%', '', $fetched_data[0]['change_per']);

      $wpdb->insert( $stock_data_table, array('timestamp' => $timestamp, 'value' => $value, 'change_value' => $change, 'change_percentage' => $change_per));
      return $wpdb->insert_id;
    }

    public function update_local_file_storage($fetched_data){
      $file = get_home_path()."/wp-content/plugins/stock-data-centre/lib/data.json";
      $timestamp = $fetched_data[0]['date']*1000;
      $value = str_replace('$', '', $fetched_data[0]['opening']);
      $change = str_replace('$', '', $fetched_data[0]['change']);
      $change_per = str_replace('%', '', $fetched_data[0]['change_per']);

      $content = ",[$timestamp, $value, $change, $change_per]";
      file_put_contents($file, $content.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    public function plugin_widgets(){
        register_widget( new SDWidget() );
        register_widget( new FSDWidget() );
        register_widget( new HPSDWidget() );
    }
 
}
