<?php

defined('GOLD') or exit('Access denied');

abstract class Base_Client extends Base_Controller {
	
	protected $ob_m;	
	protected $title;	
	protected $style;	
	protected $script;	
	protected $header;	
	protected $header_menu;	
	protected $content;	
	protected $left_bar;	
	protected $footer;
	protected $mes;
	
    protected $keywords, $discription;
	//protected $news;
		
	protected function input() {		
		$this->title = TITLE;
		
		foreach($this->styles as $style) {
			$this->style[] = SITE_URL. TEMPLATE . $style;
		}		
		foreach($this->scripts as $script) {
			$this->script[] = SITE_URL. TEMPLATE . $script;
		}		
        
		$this->ob_m = Model::get_instance();		//модель 
		//$this->menu = $this->ob_m->get_list_navigator();		
	}	
	protected function output() {
	   
       //$this->print_arr($this->menu);
       //exit;
       
		$this->header = $this->render(TEMPLATE . 'header', array(
															'styles' => $this->style,
															'scripts' => $this->script,
															'title' => $this->title,
                                          /*                  'menu' => $this->menu,
															'keywords' => $this->keywords,
															'discription' => $this->discription */ 								
															));	
/*		$this->left_bar = $this->render(TEMPLATE . 'leftbar',array(
														    
														));		*/
		$this->footer = $this->render(TEMPLATE .'footer', array(
													
													));  
		$page = $this->render(TEMPLATE .'index',	array(
											'header' => $this->header,
								//			'left_bar' => $this->left_bar,
											'content' => $this->content,
											'footer' => $this->footer   
											));
        return $page;									                            
	}	
}