<?php
    defined('GOLD') or exit('Access denied');
    
    class Search_Controller extends Base_Client {
    	
    	protected $str_what;
    	protected $str_where;
      protected $what_array;
      protected $where_array;
      protected $res_search;
    	
    	protected function input() {
    		parent::input();
    		
          if($this->is_post()) {
   		   if (!empty($_POST['what'])) {
   		      $this->str_what = $this->clear_str($_POST['what']);
               $this->what_array = $this->ob_m->search_text($this->str_what);
            }
            if (!empty($_POST['where'])) {
   			   $this->str_where = $this->clear_str($_POST['where']);
               $this->where_array = $this->ob_m->search_adres($this->str_where);
            }
   		}
         $this->res_search = array($this->what_array, $this->where_array);
    		$this->title .= " | Поиск";
    		
    	}
    	
    	protected function output() {
    	   
         //$this->print_arr($_POST);
         //$this->print_arr($this->res_search);
         //exit;
           
            $this->content = $this->render(TEMPLATE . 'search', array(
            														'list' => $this->res_search,
																	'what' => $this->str_what,
																	'where' => $this->str_where
            														));
    	   
    		$this->page = parent::output();
    		return $this->page;
    	}
    }