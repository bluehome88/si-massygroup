<?php


class JsdcAutoloader
{
    public static function libsLoader($className)
    {
    	if(strpos($className, 'JamStockDataCentre') !== false){
	    	if (strpos($className, 'Lib') !== false) {
	    		$class = str_replace('\\', '/', $className);
	    		$class_array = explode('/', $class);
			 	$location =  WP_PLUGIN_DIR .'/jam-stock-data-centre/lib/'.$class_array[2] . '.php';  
			 	if (is_file($location)) {
		        	require_once($location);
		    	} 
			}
		}
	}

	public static function widgetLoader($className)
    {
    	if(strpos($className, 'JamStockDataCentre') !== false){
	    	if (strpos($className, 'Widgets') !== false) {

	    		$class = str_replace('\\', '/', $className);
	    		$class_array = explode('/', $class);
			 	$location =  WP_PLUGIN_DIR .'/jam-stock-data-centre/widget/'.$class_array[2] . '.php';  
			 	if (is_file($location)) {
		        	require_once($location);
		    	} 
			}
		}
	}
}

spl_autoload_register('JsdcAutoloader::libsLoader');
spl_autoload_register('JsdcAutoloader::widgetLoader');
?>