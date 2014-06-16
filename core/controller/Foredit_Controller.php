<?php
    defined('GOLD') or exit('Access denied');
    //вывод списка фирм определенной рубрики с кратким описанием для админки
    
    class Foredit_Controller extends Base_Client {    	
    	protected $list;
    	
    	protected function input() {
    		parent::input();
    		    		
    		$this->list = $this->ob_m->get_list_navigator();
    	}
    	
    	protected function output() {
    	   
    //     $this->print_arr($this->list);
    //     exit;
           
            $this->content = $this->render(TEMPLATE . 'content_admin', array(
            														'list' => $this->list
            														));
    		$this->page = parent::output();
    		return $this->page;
    	}
    }