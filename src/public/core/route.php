<?php
class Route
{
	public static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
             $action_name = 'index';
			 $action_param='';
             $routes = explode('/', $_SERVER['REQUEST_URI']);

             // получаем имя контроллера
             if ( !empty($routes[1]) )
             {	
                 $controller_name = $routes[1];
             }
             
             // получаем имя экшена
             if ( !empty($routes[2]) )
             {
                 $action_name = $routes[2];
             }
			 // получаем имя экшена
			if ( !empty($routes[3]) )
				{
					$action_param = $routes[3];
				}
		
		// добавляем префиксы
		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;
		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include "application/models/".$model_file;
		}
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			Route::ErrorPage404();
		}
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		if(method_exists($controller, $action))
		{
			// очищаем параметры контроллера
			$action_param=preg_replace("/[^-._А-Яа-я\w]+$/ui",'', $action_param);
			// вызываем действие контроллера
			$controller->$action($action_param);
		}
		else
		{
		    Route::ErrorPage404();
		}
	}
	function ErrorPage404()	{
                        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
                         //header('HTTP/1.1 404 Not Found');
		//header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}
