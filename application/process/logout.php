<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// self explanatory
	session_unset();
	session_destroy();
	$page = $_SERVER['PHP_SELF'];
	header('location:'. base_url);
/* End of File */
