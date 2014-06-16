<?php
defined('GOLD') or exit('Access denied');

abstract class Base_Controller {	
	protected $request_url;	
	protected $controller;	
	protected $params;	
	protected $styles;	
	protected $scripts;
	protected $page;
   protected $error;
	
	public function route() {      //метод переадресации на нужный контролер
		if(class_exists($this->controller)) {			
			$ref = new ReflectionClass($this->controller);
            
			if($ref->hasMethod('request')) {				
				if($ref->isInstantiable()) {
					$class = $ref->newInstance();
					$method = $ref->getMethod('request');
					$method->invoke($class,$this->get_params());
				}
			}			
		}
		else {
			throw new Exception('Такой страницы не существует',' - Контроллер - '.$this->controller);
		}
	}	
	public function init() {		
		global $conf;		
		if(isset($conf['styles'])) {
			foreach($conf['styles'] as $style) {
				$this->styles[] = trim($style,'/');
			}
		}
		if(isset($conf['scripts'])) {
			foreach($conf['scripts'] as $script) {
				$this->scripts[] = trim($script,'/');
			}
		}		
	}	
	protected function get_controller() {
		return $this->controller;
	}	
	protected function get_params() {
		return $this->params;
	}	
	protected function input($param = array()) {	}
    	
	protected function output() {	}
    	
	public function request($param = array()) {
		$this->init();
		$this->input($param);
		$this->output();
		
		if(!empty($this->error)) {
			$this->write_error($this->error);
		}		
		$this->get_page();
	}
	
	public function get_page() {
		echo $this->page;
	}
	
	protected function render($path,$param = array()) {		
		extract($param);
		
		ob_start();
		
		if(!include($path.'.php')) {
			throw new Exception('Данного шаблона нет');
		}		
		return ob_get_clean();
	}
   
	public function check_auth() {
		try{
		        
			$cookie = Model_User::get_instance();
			$cookie->check_id_user();
			$cookie->validate_cookie();
			//exit();
		}
		catch(Exception $e) {
			$this->error = "Ошибка авторизации пользователя | ";
			$this->error .= $e->getMessage();
              
			header("Location:" . SITE_URL . "login");
			exit();
		}
   }
	
	public function clear_str($var) {		
		if(is_array($var)) {
			$row = array();
			foreach($var as $key=>$item) {
				$row[$key] = trim(strip_tags($item));
			}			
			return $row;
		}
		return trim(strip_tags($var));  // Удаляет пробелы, HTML и PHP-теги из строки
	}
	
	public function clear_int($var) {
		return (int)$var;
	}
	
	public function is_post() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			return TRUE;
		}
		return FALSE;
	}	
	public function write_error($err) {
		$time = date("d-m-Y G:i:s");
		
		$str = "Fault: ".$time." - ".$err."\n\r";
		file_put_contents("log.txt",$str,FILE_APPEND);
	}
   public function print_arr($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
   /* ===Редирект=== */
   public function redirect(){
       $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITE_URL;
       header("Location: $redirect");
       exit;
   }
   /*=== Получение географических координат по адресу ===*/
   public function get_coordinats ($adres) {
		$markers = 0;
		$markers_lng = 0;
		define("MAPS_HOST", "maps.googleapis.com");
		$base_url = "http://" . MAPS_HOST . "/maps/api/geocode/json?sensor=false"; 
		$request_url = $base_url . "&address=" . urlencode($adres); 

		$json = file_get_contents($request_url); 
		$resultArr = json_decode($json, true);
		if (is_object($resultArr) || is_array($resultArr)) {
			$markers = $resultArr['results'][0]['geometry']['location']['lat'];
			$markers_lng = $resultArr['results'][0]['geometry']['location']['lng'];
		}
      
      $res = array($markers, $markers_lng);
      return $res;
   }
}