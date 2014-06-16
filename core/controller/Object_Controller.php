<?php
    defined('GOLD') or exit('Access denied');
    //выводит один конкретный объект
    
    class Object_Controller extends Base_Client {
    	
    	protected $one_object;
      private $id;
    	
    	protected function input($param) {
    		parent::input();
    	    		  
    		if(isset($param['id'])) {
    			$this->id = $this->clear_int($param['id']);
    		   $this->one_object = $this->ob_m->get_one_object($this->id);
            setcookie("office", $this->one_object['title'], 0, $_SERVER['REQUEST_URI']);
            setcookie("lat", $this->one_object['lat'], 0);
            setcookie("lng", $this->one_object['lng'], 0);
    		}
    	}
    	
    	protected function output() {
    	 
      //   $this->print_arr($this->one_object);
        // $this->print_arr($_COOKIE);
        // setcookie ("office", "", time() - 3600);
        // setcookie ("lat", "", time() - 3600);
        // setcookie ("lng", "", time() - 3600);
        // exit;
           
            $this->content = $this->render(TEMPLATE . 'one_object_page', array(
            														'one' => $this->one_object,
                                                      'id_rubrika' => $this->id
            														));
    	   
    		$this->page = parent::output();
    		return $this->page;
    	}
    }