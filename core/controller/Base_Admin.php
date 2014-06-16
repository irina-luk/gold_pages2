<?php
   defined('GOLD') or exit('Access denied');
   
   abstract class Base_Admin extends Base_Controller {   	
   	protected $ob_m; //объект модели
   	protected $ob_us;
	   protected $mes;
   	
   	protected $title;   	
   	protected $style;   	
   	protected $script;   	
   	protected $content; //полный шаблон
   	
   	protected $user = TRUE;   	
   	
   	protected function input() {   		
   		if($this->user == TRUE) {
   			$this->check_auth();
   		}   		
   		$this->title = TITLE;
   		         
   		foreach($this->styles as $style) {
   			$this->style[] = SITE_URL. TEMPLATE . $style;
   		}		
   		foreach($this->scripts as $script) {
   			$this->script[] = SITE_URL. TEMPLATE . $script;
   		}		
      
   		$this->ob_m = Model::get_instance();
   		$this->ob_us = Model_User::get_instance();   		
   	}   	
   	
   	protected function output() {   		
   		$header = $this->render(TEMPLATE . 'header', array(
   														'title' => $this->title,
   														'styles' => $this->style,
															'scripts' => $this->script,
   														));
   		
   		$footer = $this->render(TEMPLATE . 'footer');
   		
   		$page = $this->render(TEMPLATE . 'index', array(
   												'header' => $header,
   												'content' => $this->content,
   												'footer' => $footer
   												));
   		return $page;																				
   	}
   }