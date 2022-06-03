<?php
namespace FinancialDataEntry\Lib;

class Menu{

	public function _renderListView() {
        include_once( WP_PLUGIN_DIR.'/financial-data-entry/admin/views/list.php' );
    }

    public function _renderEditView(){
        include_once( WP_PLUGIN_DIR.'/financial-data-entry/admin/views/edit.php' );
    }
}