<?php
   defined('GOLD') or exit('Access denied');
   
   class Login_Controller extends Base_Client {
   	   	
      protected $ob_us;
      protected $mes = '';
	
	protected function input($param = array()) {
		parent::input();
		$this->ob_us = Model_User::get_instance();
		
		if(isset($param['logout'])) {
			$logout = $this->clear_int($param['logout']);
			
			if($logout) {
				$res = $this->ob_us->logout();
				if($res) {
					header("Location:" . SITE_URL);
					exit();
				}
			}
		}
            
		$time_clean = time() - (3600 * 24 * FEALT);   //для удаления записей неудачной авторизации
		$this->ob_us->clean_fealtures($time_clean);
		
		$ip_u = $_SERVER['REMOTE_ADDR'];  //определение ip компьютера
		$fealtures = $this->ob_us->get_fealtures($ip_u); //количество попыток входа в админскую часть сайта
      
		if($this->is_post()) {
		    if($fealtures < 3) {
				$id;
				$name = $this->clear_str($_POST['name']);
				$password = $this->clear_str($_POST['password']);
				try{
					$id = $this->ob_us->get_user($name, $password);  //вытаскиваем id из бд 
					$this->ob_us->check_id_user($id);  //проверяется id на существование
               $this->ob_us->set();   //устанавливаем куки
                  
					header("Location:" . SITE_URL . "admin");
   				exit();
            }
            catch(Exception $e) {
					if($fealtures == NULL) {
						$this->ob_us->insert_fealt($ip_u);
                  $this->ob_us->check_id_user($id);
					}
					elseif($fealtures > 0) {
						$this->ob_us->update_fealt($ip_u, $fealtures);
					}
				}
         }
      }
      if (isset($_SESSION['auth'])) {
         $this->mes = $_SESSION['auth'];
      }
 	}
   	
   	protected function output() {
   		
   		$this->content = $this->render(TEMPLATE . 'login', array(
   																'error' => $this->mes
                                                   ));   		
   		$this->page = parent::output();
   		return $this->page;
   	}
   }