<?php
   defined('GOLD') or exit('Access denied');
   
   class Admin_Controller extends Base_Admin {
      
      protected $list_navigator;
      protected $list_rubrik;
      protected $default_nav;
   	   	
   	protected function input($param = array()) {
   		parent::input();
                  
 /*        $this->default_nav = 1;
         if (isset($param['id'])) {
            $this->default_nav = $this->clear_int($param['id']);
         }         
    		$this->list_navigator = $this->ob_m->get_list_section();
         $this->list_rubrik = $this->ob_m->get_list_rubrik($this->default_nav);
 */           
   	}
   	
   	protected function output() {
    	 
        // $this->print_arr($this->list_rubrik);
        // exit;
              		
   		$this->content = $this->render(TEMPLATE . 'index_admin', array(
   													//			'list' => $this->list_navigator,
                                          //         'rubriki' => $this->list_rubrik,
                                          //         'default_nav' => $this->default_nav
                                                   ));   		
   		$this->page = parent::output();
   		return $this->page;
   	}
   }