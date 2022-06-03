<?php

namespace FinancialDataEntry\Lib;
use FinancialDataEntry\Widgets\FinancialDataWidget as FDWidget;
use FinancialDataEntry\Lib\Menu as adminMenu;

class Plugin{

    public function run(){

        add_action('admin_menu', array($this, 'add_menu'));
        add_action('widgets_init', array($this, 'plugin_widgets'));
        add_action( 'wp_ajax_my_action', array($this, 'my_action'));
    }

    public function add_menu(){

        $main_page = add_menu_page('Financial Data Entry', 'Financial Data Entry', 'manage_options', 'financial-data-entry', array( new adminMenu(), '_renderListView' ), 'dashicons-book-alt', 23);

        $edit_page = add_submenu_page('financial-data-entry', 'Edit Financial Entries', 'Edit','manage_options', 'edit-financial-entries', array( new adminMenu(), '_renderEditView' ));

        add_action( 'load-' . $main_page, array($this,'load_admin_js') );
        add_action( 'load-' . $edit_page, array($this,'load_admin_js') );
    }

    public function load_admin_js(){
        add_action( 'admin_enqueue_scripts', array($this,'enqueue_admin_js') );
    }

    public function enqueue_admin_js(){
        wp_enqueue_style( 'my-style', get_template_directory_uri() . '/style.css');

        // Register the JS file with a unique handle, file location, and an array of dependencies
       wp_register_script( "edit_script", plugins_url( 'assets/js/custom.js', dirname(__FILE__) ), array('jquery') );
       
       // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
       wp_localize_script( 'edit_script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));        
       
       // enqueue jQuery library and the script you registered above
       wp_enqueue_script( 'jquery' );
       wp_enqueue_script( 'edit_script' );
    }

    public function plugin_widgets(){
        register_widget( new FDWidget() );
    }

    function my_action(){
        
        global $wpdb;
        $table_name = $_POST['table'];
        $value = $_POST['value'];
        $id = $_POST['id'];

        $wpdb->query($wpdb->prepare("UPDATE $table_name SET value='$value' WHERE id=$id"));

        ob_clean();
        // echo json_encode($response);
        echo 'success';
        wp_die();
    }
 
}
