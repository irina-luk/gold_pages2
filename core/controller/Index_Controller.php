<?php
    defined('GOLD') or exit('Access denied');
    
    class Index_Controller extends Base_Client {
    	
    	protected $list;
    	
    	protected function input() {
    		//////
    		parent::input();
    		
    		$this->title .= " | Главная";
    		
    		$this->list = $this->ob_m->get_list_navigator();
    	}
    	
    	protected function output() {
    	   
    //     $this->print_arr($this->list);
    //     exit;
           
            $this->content = $this->render(TEMPLATE . 'content', array(
            														'list' => $this->list
            														));
    	   
    		$this->page = parent::output();
    		return $this->page;
    	}
    }