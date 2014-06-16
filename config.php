<?php
    defined('GOLD') or die('Access denied');

    define('SITE_URL', '/gold_pages2/');    // домен
    
    define('MODEL', 'core/model/');    // модель
    
    define('CONTROLLER', 'core/controller/');    // контроллер
    
    define('FUN', 'fun/');    // функции
    
    define('VIEW', 'views/');    // вид
    
    define('TEMPLATE', VIEW . 'template/');    // активный шаблон
        
    define('HOST', 'localhost');    // сервер БД
    
    define('USER', 'root');    // пользователь
    
    define('PASS', 'toor');    // пароль
    
    define('DB', 'gold_pages');    // БД
    
    define('TITLE', 'Золотые страницы Харькова');    // название  - title
    
    define ('FEALT', 1); //для блокировки ip-адреса при авторизации - 1 день
                
    define("EXPIRATION", 1440); //разрешенное время для админа

    define("VARNING_TIME", 700); //для обновления кук
        
    /////////////////////////////////////

   $conf = array(
		'styles' => array(
               'css/style.css'
					),
		'scripts' => array(
                //     'js/jquery-1.7.2.min.js',
				//	 'js/jquery-ui-1.8.22.custom.min.js',
                     'js/jquery-1.11.0.min.js',
                     'js/jquery-ui-1.10.4.custom.min.js',
					 'js/jquery.cookie.js',
                'js/jquery.limit.js',
				'js/jquery.ui.accordion.js',
				     'js/function.js',
					 'js/script.js',
				//	 'js/tiny_mce/tiny_mce.js',
				//	 'js/tiny_script.js',
					),				
   );