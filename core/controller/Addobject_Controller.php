<?php
   defined('GOLD') or exit('Access denied');
   
   class Addobject_Controller extends Base_Admin {
      
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
            if (isset($_POST['add_object'])) {
              // $new_section = $this->clear_str($_POST['new_section']);
              
              $title = $this->clear_str($_POST['title']);              
              $rubriki_id = $this->clear_int($_POST['id_rubrika']);              
              $adres = $this->clear_str($_POST['adres']);              
              $tel = $this->clear_str($_POST['tel']);              
              $email = $this->clear_str($_POST['email']);              
              $website = $this->clear_str($_POST['website']);
              $opis = $this->clear_str($_POST['shot_opis']);
              $text = $this->clear_str($_POST['full_opis']);
              $description = $opis;
              $keywords = $this->clear_str($_POST['keywords']);
                            
              $_POST['coordinat'] = $this->get_coordinats($_POST['adres']);
              
              $lat = $this->clear_str($_POST['coordinat'][0]);
              $lng = $this->clear_str($_POST['coordinat'][1]);
              
      /*        echo $title . " - " . $rubriki_id . " - " . $adres . " - " . $tel . " - " . $email . " - " .
                   $website . " - " . $opis . " - " . $text . " - " . $description . " - " . $keywords . " - " .
                   $lat . " - " . $lng;
                   exit();
      */        
              $res = $this->ob_m->add_object($title, $rubriki_id, $adres, $tel, $email, $website, 
                                             $opis, $text, $description, $keywords, $lat, $lng);
           
   				if(!empty($res)) {
   					$_SESSION['message'] = "Объект успешно добавлен<br />";
   				}
   				else {
   					$_SESSION['message'] = "Ошибка добавления объекта<br />";
   				}
            }
				header("Location:" . SITE_URL . 'addobject');
				exit();
         }
		 if (isset($_SESSION['message'])) {
		     $this->mes = $_SESSION['message'];
		}
   	}
   	
   	protected function output() {
    	 
        // $this->print_arr($this->list_rubrik);
        // exit;
              		
   		$this->content = $this->render(TEMPLATE . 'add_object', array(
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