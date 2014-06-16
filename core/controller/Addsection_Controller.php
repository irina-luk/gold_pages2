<?php
   defined('GOLD') or exit('Access denied');
   
   class Addsection_Controller extends Base_Admin {
      
      protected $list_navigator;
      protected $list_rubrik;
      protected $default_nav;
   	   	
   	protected function input($param = array()) {
   		parent::input();
                  
         $this->default_nav = 0;
         if (isset($param['id'])) {
            $this->default_nav = $this->clear_int($param['id']);
         }         
    		$this->list_navigator = $this->ob_m->get_list_section();
         $this->list_rubrik = $this->ob_m->get_list_rubrik($this->default_nav);
            
         if ($this->is_post()) {
            if (isset($_POST['add_secton'])) {
               $new_section = $this->clear_str($_POST['new_section']);
               $new_rubrika = $this->clear_str($_POST['new_rubrika']);
               if (!empty($new_section)) {
                  $res_section = $this->ob_m->add_section($new_section);
                  
      				if(!empty($res_section)) {
      					$_SESSION['message'] = "Раздел успешно добавлен<br />";
      				}
      				else {
      					$_SESSION['message'] = "Ошибка добавления раздела<br />";
      				}
               }
               if (!empty($new_rubrika)) {
                  if (isset($res_section)) {
                     $id_section = $res_section;
                  }
                  else {
                     $id_section = $_POST['old_section'];
                  }
                  $res_rubrika = $this->ob_m->add_rubrika($new_rubrika, $id_section);
                  //echo $new_rubrika . " - " . $id_section;
                  //exit();
                  
      				if($res_rubrika === TRUE) {
      					$_SESSION['message'] .= "Рубрика успешно добавлена";
      				}
      				else {
      					$_SESSION['message'] .= "Ошибка добавления рубрики";
      				}
               }
               
               //$this->print_arr($_POST); 
               //exit();
            }
				header("Location:" . SITE_URL . 'addsection');
				exit();
         }
		 if (isset($_SESSION['message'])) {
		     $this->mes = $_SESSION['message'];
		}
   	}
   	
   	protected function output() {
    	 
        // $this->print_arr($this->list_rubrik);
        // exit;
              		
   		$this->content = $this->render(TEMPLATE . 'add_section', array(
   																'list' => $this->list_navigator,
                                                   'rubriki' => $this->list_rubrik,
                                                   'default_nav' => $this->default_nav,
																    'mes' => $this->mes
            														));
    	   
    		$this->page = parent::output();
         unset($_SESSION['message']);
   		return $this->page;
   	}
   }