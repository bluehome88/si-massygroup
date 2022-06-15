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
        add_action( 'rest_api_init', array($this, 'add_custom_jse_stock_prices_api'));
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

    public function add_custom_jse_stock_prices_api(){
        register_rest_route( 'jsdc/v1', '/fetch_latest/', array(
          'methods' => 'GET',
          'callback' => array($this, 'update_stock_data'),
        ));
    }

    public function update_stock_data() {
      
        $fetched_data = $this->fetch_latest_stock_entry();
        $prev_stock_data = $this->get_prev_stock_data();

        $last_updated = array_values($prev_stock_data)[0];
        $last_updated_date = date("Y-m-d",($last_updated[0]/1000));

        if( $fetched_data[0]['opening'] == $last_updated[1] ){
            return false;
        }

        $fetched_date = date("Y-m-d",strtotime($fetched_data[0]['date']));

        if($fetched_date > $last_updated_date){
          $fetched_data[0]['date'] = strtotime($fetched_data[0]['date']);
          if($this->add_new_entry($fetched_data))
            $this->update_local_file_storage($fetched_data);
        }

        return true;
    }

    public function fetch_latest_stock_entry(){
      include_once("simplehtmldom/simple_html_dom.php");

      $html = str_get_html(file_get_contents( 'https://www.jamstockex.com/trading/instruments/?instrument=massy-jmd' ));
      // get data block

      $container = $html->find('[data-id=54a1ae3]', 0);

      foreach( $container->find('.tw-items-end') as $row) {
          $item['opening'] = (float)substr(trim($row->find('.tw-flex', 0)->plaintext), 1);
          $item['change'] = (float)substr(trim($row->find('.tw-ml-3', 0)->plaintext), 1);
          $item['change_per'] = (float)substr(trim($row->find('.tw-ml-3', 1)->plaintext), 1);

          $item['date'] = date("d-M-y");
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
      $stock_data_table = $wpdb->prefix . "jam_stock_data";

      $stock_data_results = $wpdb->get_results("SELECT jsdt.timestamp,jsdt.value,jsdt.change_value,jsdt.change_percentage 
        FROM $stock_data_table AS jsdt
        ORDER BY jsdt.id DESC
        LIMIT 2");

      /* Group Income Statement Information data by year */
      foreach ($stock_data_results as $record){
        $stock_data[] = [$record->timestamp,$record->value,$record->change_value,$record->change_percentage];
      }
      return $stock_data;
    }

    public function add_new_entry($fetched_data){
      global $wpdb;
      $stock_data_table = $wpdb->prefix . "jam_stock_data";
      $timestamp = $fetched_data[0]['date']*1000;
      $value = str_replace('$', '', $fetched_data[0]['opening']);
      $change = str_replace('$', '', $fetched_data[0]['change']);
      $change_per = str_replace('%', '', $fetched_data[0]['change_per']);

      $wpdb->insert( $stock_data_table, array('timestamp' => $timestamp, 'value' => $value, 'change_value' => $change, 'change_percentage' => $change_per));
      return $wpdb->insert_id;
    }

    public function update_local_file_storage($fetched_data){
      $file = __DIR__."/data.json";
      $timestamp = $fetched_data[0]['date']*1000;
      $value = str_replace('$', '', $fetched_data[0]['opening']);
      $change = str_replace('$', '', $fetched_data[0]['change']);
      $change_per = str_replace('$', '', $fetched_data[0]['change_per']);
      $content = ",[$timestamp, $value, $change, $change_per]";
      file_put_contents($file, $content.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    public function plugin_widgets(){
        register_widget( new JSDWidget() );
        register_widget( new FJSDWidget() );
        register_widget( new HPJSDWidget() );
    }
 
}
