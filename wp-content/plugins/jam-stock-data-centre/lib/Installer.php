<?php

namespace JamStockDataCentre\Lib;

class Installer{
        
    public static function setup(){

        global $wpdb;

        $stock_data = $wpdb->prefix . "jam_stock_data";

        $stock_data_sql = "CREATE TABLE " . $stock_data . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                timestamp bigint(13) unsigned NOT NULL,
                value decimal(13,2) unsigned NOT NULL,
                change_value decimal(5,2),
                change_percentage decimal(5,2),
                business_consumer_services decimal(5,2),
                PRIMARY KEY (id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        
        dbDelta($stock_data_sql);
        
        /* Load Historic Data */
        $historic_data_json = '';
        $myfile = fopen(get_home_path()."/wp-content/plugins/jam-stock-data-centre/lib/data.json", "r") or die("Unable to open file!");

        // Output one line until end-of-file
        while(!feof($myfile)) {
          $historic_data_json .= fgets($myfile);
        }
        fclose($myfile);
        $historic_data_json .= ']';
        $historic_data_array = json_decode($historic_data_json);

        foreach ($historic_data_array as $daily_record) {
            $data_table_key = '';
            $temparr = array();
            foreach ($daily_record as $key => $el) {
                if($key == 0) { $data_table_key = 'timestamp'; }
                if($key == 1) { $data_table_key = 'value'; }
                $temparr[$data_table_key] = $el;
            }
            $wpdb->insert( $stock_data, $temparr);
        }
    }

    public static function deactivation(){
        global $wpdb;
        $stock_data = $wpdb->prefix . "jam_stock_data";

        $wpdb->query("DROP TABLE IF EXISTS $stock_data");
    }
}