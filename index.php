<?php
    //для запрет прямого обращения
    define('GOLD', TRUE);
    
    session_start();
    
    // подключение файла конфигурации
    require_once 'config.php';
        
    // внесение изменений в интерпритатор php для подключаемых файлов
    set_include_path(get_include_path()
                    				.PATH_SEPARATOR.CONTROLLER
                    				.PATH_SEPARATOR.MODEL
                    				.PATH_SEPARATOR.FUN
    				);
                    
    function __autoload($class_name) {	
    	if(!include_once ($class_name . ".php")) {		
    		try {
    			throw new Exception($class_name.' - Не правильный файл для подключения');
    		}
    		catch(Exception $e) {
    			echo $e->getMessage();
    		}
    	}
    //    echo $class_name . "<br />";
    }
    try{
    	$obj = Route_Controller::get_instance();
    	$obj->route();
    }
    catch(Exception $e) {
    	return;
    }
  