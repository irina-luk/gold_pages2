<?php
   defined('GOLD') or exit('Access denied');
   
   class Model_User {
   	
   	protected $ins_driver_u;
   	protected $user_id;   	
	   private $created;
   	
   	static $instance;
   	static $cookie_name = 'USERNAME';
   	
   	static function get_instance() {
   		if(self::$instance instanceof self) {
   			return self::$instance;
   		}
   		return self::$instance = new self;
   	}
   	
   	private function __construct() {
   		$this->ins_driver_u = Model_Driver::get_instance();
   	}
      
   	public function get_user($name, $password) {
   	  $password = md5($password);
        
   	   $query = "SELECT id FROM users WHERE login = '$name' AND password = '$password'";
         
   		$result = $this->ins_driver_u->select($query);
//				echo "from Model_User after result<br />";
         $result = $result->fetch_assoc(); 
//            print_r($result);
   		if($result == NULL || $result == FALSE) {
   			throw new AuthException('Пользователь с такими данными не найден');
   			return;
   		}
         return $result['id'];					
   	}
   	public function get_fealtures($ip) {   		//получение неудачных попыток авторизации из бд
   		$result = $this->ins_driver_u->select("SELECT fealtures FROM fealtures WHERE ip = '$ip'");
   		if(count($result) == 0) {
   			return NULL;
   		}
   		$result = $result->fetch_assoc(); 
         return $result['fealtures'];										
   	}
   	public function insert_fealt($ip) {   //запись в бд первой неудачной попытки авторизации
         $time = time();
         //echo "time = " . $time; exit();
   		$this->ins_driver_u->insert("INSERT INTO fealtures (fealtures, ip, time) VALUE ('1','$ip','$time')");
   	}
   	public function update_fealt($ip, $fealtures) {
   		$fealtures++;
         $time = time();
   		$this->ins_driver_u->update("UPDATE fealtures SET fealtures = '$fealtures', time = '$time'
   									        WHERE ip = '$ip'");
   	}
   	public function clean_fealtures($time) {
   		$this->ins_driver_u->delete("DELETE FROM fealtures WHERE time <= '$time'");
   	}
   	public function check_id_user($id = FALSE) {
   		if($id) {
   			return $this->user_id = $id;
   		}
   		else {
   			if(array_key_exists(self::$cookie_name, $_COOKIE)) {   //есть ли куки для юзера
               //разбиваем куки по переменным 
         		list($this->user_id, $this->created) = explode($this->glue, $_COOKIE[self::$cookie_name]);
         		true;
   			}
   			else {
   				throw new AuthException('Доступ запрещен');
   			}
   		}
   	}
      public function set() {
   		if($this->user_id) {
   			$arr = array($this->user_id, time());
            $cookie_text = implode($this->glue, $arr);  //'1|1234568'
      		if($cookie_text) {
      			setcookie(self::$cookie_name, $cookie_text, 0, SITE_URL);
      			return TRUE;
      		}
   		}
   		else {
   			throw new AuthException("Не найден идентификатор пользователя");
   		}
      }
	   public function validate_cookie() {
   		if(!$this->user_id || !$this->created) {
   			throw new AuthException("Не правильные данные. Доступ запрещен");
   		}
   		if((time() - $this->created) > EXPIRATION) {
   			throw new AuthException("Закончилось время сессии");
   		}
   		if((time() - $this->created) > VARNING_TIME) {
   			$this->set();
   		}
  		return TRUE;
   	}
   	public function logout() {
   		setcookie(self::$cookie_name, "", (time() - 3600), SITE_URL);
   		return TRUE;
   	}
   }