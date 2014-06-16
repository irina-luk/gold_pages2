<?php
    defined('GOLD') or exit('Access denied');
    //вывод списка фирм определенной рубрики с кратким описанием
    class Rubriki_Controller extends Base_Client {
    	
    	protected $list_short_objects;
      private $table;
      private $id;
    	
    	protected function input($param) {
    		parent::input();
    		
    		if(isset($param['id'])) {
    			$this->id = $this->clear_int($param['id']);
    		   $this->list_short_objects = $this->ob_m->get_opis_object($this->id);
    		}
    	}
    	
    	protected function output() {
    	 
         //$this->print_arr($this->list_short_objects);
         //exit;
           
            $this->content = $this->render(TEMPLATE . 'rubriki_page', array(
            														'list' => $this->list_short_objects
            														));
    	   
    		$this->page = parent::output();
    		return $this->page;
    	}
    }