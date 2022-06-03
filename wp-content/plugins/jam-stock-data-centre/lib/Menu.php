<?php
namespace StockDataCentre\Lib;

class Menu{

	public function _renderListView() {
        include_once( WP_PLUGIN_DIR.'/stock-data-centre/admin/views/main.php' );
    }

    // public function _renderEditView(){
    //     include_once( WP_PLUGIN_DIR.'/stock-data-centre/admin/views/edit.php' );
    // }
}