<?php
    defined('GOLD') or die('Access denied');
       
    class Model {	
    	static $instance;    	
    	private $ins_driver;    	
    	
    	static function get_instance() {
    		if(self::$instance instanceof self) {
    			return self::$instance;
    		}
    		return self::$instance = new self;
    	}
    	
    	private function __construct() {    		
    		try {
    			$this->ins_driver = Model_Driver::get_instance();
    		}
    		catch(Exception $e) {
    			exit();
    		}
    	}
        /* ===Получение просто списка основных категорий для админки=== */
        public function get_list_section() {
            $query = "SELECT * FROM navigator ORDER BY `title_navigator`";
    		   $result = $this->ins_driver->select($query);            
            $section = array();
            while($row = $result->fetch_assoc()){
               $section[] = $row;
            }
            return $section;
         }
        /* ===Получение просто списка рубрик для админки=== */
        public function get_list_rubrik($id) {
            $query = "SELECT * FROM rubriki WHERE navigator_id = '$id'";
    		   $result = $this->ins_driver->select($query);            
            $rub = array();
            while($row = $result->fetch_assoc()){
               $rub[] = $row;
            }
            return $rub;
         }
            
        
        /* ===Получение списка основных категорий=== */
        public function get_list_navigator() {
            $query = "SELECT * FROM navigator as n 
                      LEFT JOIN rubriki as r ON n.id = r.navigator_id ORDER BY `title_navigator`";
            
            $navigator = array();
            $name = ''; // флаг имени 
                                            
    		$result = $this->ins_driver->select($query);    
        
        //print_r($result); exit();
        
            while($row = $result->fetch_assoc()){
                if($row['title_navigator'] != $name){ // если такого в массиве еще нет
                    $navigator[$row['id']][] = $row['title_navigator']; // добавляем в массив
                    $name = $row['title_navigator'];
                }
                if ($row['id_rubrika'] != null) {
                  $navigator[$row['id']]['sub'][$row['id_rubrika']] = $row['title_rubrika']; // заносим
                } 
            }
            return $navigator;
            
        }
        /* ====Получение описи объектов=== */
        public function get_opis_object($id){
            $query = "SELECT id, title, opis FROM objects WHERE rubriki_id = $id";
            $res = $this->ins_driver->select($query);
            
            $all_objects = array();
            while($row = $res->fetch_assoc()) {
               $all_objects[] = $row;
            }
            return $all_objects;
        }
                                    
        /* ====Получение одного конкретного объекта=== */
        public function get_one_object($id){
            $query = "SELECT * FROM objects WHERE id = $id";
            $res = $this->ins_driver->select($query);
            
            return $res->fetch_assoc();            
        }
        /*=== Добавление раздела ===*/
        public function add_section ($value) {
           $query = "INSERT INTO navigator (title_navigator) VALUE ('$value')";
            $res = $this->ins_driver->insert($query);
            return $res;
        }
        /*=== Добавление рубрики ===*/
        public function add_rubrika($new_rubrika, $id_section) {
           $query = "INSERT INTO rubriki (title_rubrika, navigator_id) VALUE ('$new_rubrika', '$id_section')";
            $res = $this->ins_driver->insert($query);
            return true;
        }
        /*=== Добавление объекта ===*/
        public function add_object($title, $rubriki_id, $adres, $tel, $email, $website, 
                                    $opis, $text, $description, $keywords, $lat, $lng) {
           $query = "INSERT INTO objects 
                     (title, rubriki_id, adres, tel, email, website, opis, text, description, keywords, lat, lng) 
                     VALUE ('$title', '$rubriki_id', '$adres', '$tel', '$email', '$website', 
                              '$opis', '$text', '$description', '$keywords', '$lat', '$lng')";
            $res = $this->ins_driver->insert($query);
            return true;
        }
        /*=== Редактировние объекта ===*/
        public function edit_object($id, $title, $rubriki_id, $adres, $tel, $email, $website, 
                                             $opis, $text, $description, $keywords, $lat, $lng) {
           $query = "UPDATE `objects` SET `title` = '$title', `rubriki_id` = '$rubriki_id', `adres` = '$adres',
                                          `tel` = '$tel', `email` = '$email', `website` = '$website',
                                          `opis` = '$opis', `text` = '$text', `description` = '$description',
                                          `keywords` = '$keywords',`lat` = '$lat', `lng` = '$lng' 
                     WHERE id = '$id'"; 
           $this->ins_driver->update($query);
           return true;
        }
        /*=== Удаление объекта ===*/
        public function delete_object ($id) {
           $query = "DELETE FROM `objects` WHERE id = '$id'";
           $this->ins_driver->delete($query);
           return true;
        }
        /*=== Поиск по адресу ===*/
        public function search_adres ($str) {
           $query = "SELECT id, title, opis FROM objects WHERE MATCH (adres) AGAINST ('$str')";
           $res = $this->ins_driver->select($query);
           return $res->fetch_assoc(); 
        }

        /*=== Поиск по тексту ===*/    
        public function search_text ($str) {
           $query = "SELECT id, title, opis FROM objects WHERE MATCH (text, keywords) AGAINST ('$str')";
           $res = $this->ins_driver->select($query);
           return $res->fetch_assoc(); 
        }
     }