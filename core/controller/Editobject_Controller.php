<?php
    defined('GOLD') or exit('Access denied');
    //вывод списка фирм определенной рубрики с кратким описанием для админки
    
    class Editobject_Controller extends Base_Client {
    	
    	protected $list_short_objects;
      private $option = 'view';
    	protected $one_object;
      private $id;
    	
    	protected function input($param) {
    		parent::input();
         
         if (isset($param['option'])) {
            $this->option = $param['option'];
         }
    		if ($this->option == 'view') {
       		if(isset($param['id'])) {
       			$this->id = $this->clear_int($param['id']);
       		   $this->list_short_objects = $this->ob_m->get_opis_object($this->id);
       		}
         }
         if ($this->option == 'edit') {            
       		if(isset($param['id'])) {
       			$this->id = $this->clear_int($param['id']);
       		   $this->one_object = $this->ob_m->get_one_object($this->id);
            }
               
            if (isset($_POST['edit_object'])) {
              $id = $_POST['id'];
              
              $title = $_POST['title'];              
              $rubriki_id = $_POST['id_rubrika'];              
              $adres = $_POST['adres'];              
              $tel = $_POST['tel'];              
              $email = $_POST['email'];              
              $website = $_POST['website'];
              $opis = $_POST['shot_opis'];
              $text = $_POST['full_opis'];
              $description = $opis;
              $keywords = $_POST['keywords'];
                            
              $_POST['coordinat'] = $this->get_coordinats($_POST['adres']);
              
              $lat = $_POST['coordinat'][0];
              $lng = $_POST['coordinat'][1];
              
/*              echo $id . "<br />" . $title . "<br />" . $rubriki_id . "<br />" . $adres . "<br />" . $tel . "<br />" .
                   $email . "<br />" . $website . "<br />" . $opis . "<br />" . $text . "<br />" .
                   $description . "<br />" . $keywords . "<br />" . $lat . "<br />" . $lng;
              exit();   
*/              
              $res = $this->ob_m->edit_object($id, $title, $rubriki_id, $adres, $tel, $email, $website, 
                                             $opis, $text, $description, $keywords, $lat, $lng);
           
   				if(!empty($res)) {
   					$_SESSION['message'] = "Объект успешно обновлен<br />";
   				}
   				else {
   					$_SESSION['message'] = "Ошибка обновления объекта<br />";
   				}
               $this->mes = $_SESSION['message'];
   				header("Location:" . SITE_URL . 'admin');
   				exit();
            }          
            if (isset($_POST['delete_object'])) {
              $id = $_POST['id'];
              $res = $this->ob_m->delete_object($id);
           
   				if(!empty($res)) {
   					$_SESSION['message'] = "Объект успешно удален<br />";
   				}
   				else {
   					$_SESSION['message'] = "Ошибка удаления объекта<br />";
   				}
               $this->mes = $_SESSION['message'];
   				header("Location:" . SITE_URL . 'admin');
   				exit();
            }
         }
		 if (isset($_SESSION['message'])) {
		     $this->mes = $_SESSION['message'];
		}
    	}    	
    	protected function output() {
    	 
         //$this->print_arr($this->list_short_objects);
         //exit;
           
            $this->content = $this->render(TEMPLATE . 'edit_object_page', array(
            														'option' => $this->option,
            														'one' => $this->one_object,
																    'list' => $this->list_short_objects,
																    'mes' => $this->mes
            														));
    	   
    		$this->page = parent::output();
         unset($_SESSION['message']);
    		return $this->page;
    	}
    }