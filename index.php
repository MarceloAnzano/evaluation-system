<?php
	/**
	 * This file needs to be accessed for anything else in the application to be accessed.
	 * After deciphering some of the workings of CodeIgniter, I came up with this
	 * rather weak imitation (or a shameless copy-paste of a code snippet) of how MVC is accomplished.
	 * 
	 * This index file sits at the top of the directory and calls on the functions in
	 * the application folder below. From here, the index.php file calls on the controller.php
	 * file in the application/controller folder.
	 * 
	 * Basically, the main job of this index file is to provide an extra layer of
	 * security to accessing other files in the directory in addition to the .htaccess file
	 * at the top application folder.
	 * **/
	 
	 
	//  DEVELOPMENT is the status of the project. Replace TRUE with FALSE 
	// 	to disable debugging and error reports.
	
	define('DEVELOPMENT', TRUE);
	
	/**
	 * ----------------------------------
	 * Configure these variables:
	 * >> $system_path is the 'application' folder where all the essential files are stored. 
	 * >> $base_url is the site that appears on the address bar.
	 * >> $base_controller is the primary controller.
	 * ----------------------------------
	 * **/
	 
	$system_path = 'application';
	
	$base_url = '';
	
	$base_controller = 'app';
	
	$static_path = 'static';
	
	/**
	 * ----------------------------------
	 * Do not modify the items below unless you are a professional or the main developer.
	 * Do so at the risk of the application's stability.
	 * ----------------------------------
	 * **/
	
	if ( ! DEVELOPMENT)
	{
		error_reporting(0);
	}
	else error_reporting(E_ALL);
	
	// --------------
	// system path
	if (realpath($system_path) !== FALSE)
	{
		$system_path = realpath($system_path).'/';
	}
	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/').'/';
	
	if ( ! is_dir($system_path))
	{
		exit("Your system folder path does not appear to be set correctly. 
				Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}
	
	// --------------
	// static path
	$static_path = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER["PHP_SELF"]).$static_path;
	
	// ensure there's a trailing slash
	$static_path = rtrim($static_path, '/').'/';
	
	// --------------
	// base url
	if ($base_url == '')
	{
		$base_url = 'http://'.$_SERVER['HTTP_HOST'];
	}
	// ensure there's a trailing slash
	$base_url = rtrim($base_url, '/').'/';
	
	// initialize the constants
	define('BASEPATH', str_replace("\\", "/", $system_path));
	
	define('STATICPATH', str_replace("\\", "/", $static_path));
	
	define('base_url', $base_url);
	
	/**
	 * ----------------------------------
	 * The routing file has two functions: a) to process urls sent to the
	 * index.php file to get the parameters and b) to call the corresponding
	 * controllers.
	 * ----------------------------------
	 * **/
	require_once BASEPATH.'include/router.php';
	
/* End of File */
