<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
	 * ----------------------------------
	 * The base controller is the default controller.
	 * If you wish to set more controllers, just add more
	 * requires and append the directory paths.
	 * ----------------------------------
	 * **/
	require_once BASEPATH.'controller/'.$base_controller.'.php';
	require_once BASEPATH.'controller/admin.php';
	
	
	// initialize the URL
	$request_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	// get the request from the URL
	$request_string = substr($request_url, strlen($base_url));
	/**
	 * ----------------------------------
	 * The first parameter after the root directory of the application
	 * is the name of the controller class. The second parameter is
	 * the function or method that will be called, it is mostly a view file
	 * or an form function such log ins.
	 * ----------------------------------
	 * **/
	 
	$url_params = explode('/', $request_string);
	$size = count($url_params);
	
	$controller_name = ucwords($base_controller);
	$function_name = 'index';
	
	switch ($size)
	{
		case 1:
			if ($url_params[0] != '')
				$controller_name = ucwords($url_params[0]);
			break;
		case 2:
			if ($url_params[1] != '')
			{
				$controller_name = ucwords($url_params[0]);
				$function_name = strtolower($url_params[1]);
			}
			if ($url_params[0] != '')
				$controller_name = ucwords($url_params[0]);
			break;
		case 3:
			if ($url_params[1] != '')	
			{
				$controller_name = ucwords($url_params[0]);
				$function_name = strtolower($url_params[1]);
			}
			if ($url_params[0] != '')
				$controller_name = ucwords($url_params[0]);
			$parameter1 = strtolower($url_params[2]);
			break;
		case 4:
			if ($url_params[1] != '')
			{
				$controller_name = ucwords($url_params[0]);
				$function_name = strtolower($url_params[1]);
			}
			if ($url_params[0] != '')
				$controller_name = ucwords($url_params[0]);
			$parameter1 = strtolower($url_params[2]);
			$parameter2 = strtolower($url_params[3]);
			break;
		case 5:
			if ($url_params[1] != '')
			{
				$controller_name = ucwords($url_params[0]);
				$function_name = strtolower($url_params[1]);
			}
			if ($url_params[0] != '')
				$controller_name = ucwords($url_params[0]);
			$parameter1 = strtolower($url_params[2]);
			$parameter2 = strtolower($url_params[3]);
			$parameter3 = strtolower($url_params[4]);
			break;
		default:
			if ($url_params[1] != '')
			{
				$controller_name = ucwords($url_params[0]);
				$function_name = strtolower($url_params[1]);
			}
			if ($url_params[0] != '')
				$controller_name = ucwords($url_params[0]);
			$parameter1 = strtolower($url_params[2]);
			$parameter2 = strtolower($url_params[3]);
			$parameter3 = strtolower($url_params[4]);
			for ($i = 4; $i < $size ; $i++)
				if ($url_params[$i] != '')
					exit('Error 404 Page does not exist');
			break;
	}
	
	
	if (class_exists($controller_name))
	{
		
		$controller = new $controller_name;
		if (method_exists($controller_name, $function_name))
		{
			if (isset($parameter1) && isset($parameter2) &&  isset($parameter3))
			{
				$controller->$function_name($parameter1, $parameter2, $parameter3);
			}
			elseif (isset($parameter1) && isset($parameter2))
			{
				$controller->$function_name($parameter1, $parameter2);
			}
			elseif (isset($parameter1))
			{
				$controller->$function_name($parameter1);
			}
			else $controller->$function_name();
		}
		else exit('Error 404 Page does not exist');
	}
	else exit('Error: Invalid URL');
	

/* End of File */
