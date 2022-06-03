<?php


class SdcAutoloader
{
	// protected $prefix = 'AwsomeJobPortal';
    public static function libsLoader($className)
    {
    	if(strpos($className, 'StockDataCentre') !== false){
	    	if (strpos($className, 'Lib') !== false) {
	    		$class = str_replace('\\', '/', $className);
	    		$class_array = explode('/', $class);
			 	$location =  WP_PLUGIN_DIR .'/stock-data-centre/lib/'.$class_array[2] . '.php';  
			 	if (is_file($location)) {
		        	require_once($location);
		    	} 
			}
		}
	}

	public static function widgetLoader($className)
    {
    	if(strpos($className, 'StockDataCentre') !== false){
	    	if (strpos($className, 'Widgets') !== false) {

	    		$class = str_replace('\\', '/', $className);
	    		$class_array = explode('/', $class);
			 	$location =  WP_PLUGIN_DIR .'/stock-data-centre/widget/'.$class_array[2] . '.php';  
			 	if (is_file($location)) {
		        	require_once($location);
		    	} 
			}
		}
	}
}

spl_autoload_register('SdcAutoloader::libsLoader');
spl_autoload_register('SdcAutoloader::widgetLoader');
?>