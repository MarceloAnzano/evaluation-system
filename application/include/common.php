<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	require BASEPATH.'include/checklogin.php';

class Common
{
	function this_view($view, $data = NULL, $data2 = NULL, $data3 = NULL, $data4 = NULL, $data5 = NULL)
	{
		include BASEPATH.'views/templates/header.php';
		include BASEPATH.$view;
		include BASEPATH.'views/templates/footer.php';
	}
	
	// checks the login status of the user via checklogin.php
	function check_user_login()
	{
		$check = new Check_login();
		$check->check_user_session($this->get_connection());
		return $check->get_status();
	}
	
	function logged_as_admin()
	{
		$check = new Check_login();
		if ($this->check_user_login() && $check->is_user_admin())
		{
			return TRUE;
		}
		else return FALSE;
	}
	
	function logged_as_principal()
	{
		$check = new Check_login();
		if ($this->check_user_login() && $check->is_user_principal())
		{
			return TRUE;
		}
		else return FALSE;
	}
	
	function allow_supervisors()
	{
		if ($this->check_user_login() AND $_SESSION['supervisor'] != 'none')
		{
			return TRUE;
		}
		else return FALSE;
	}
	
	function get_connection()
	{
		include BASEPATH.'include/connect.php';
		return $con;
	}
	
	function get_session_info($info)
	{
		if ($this->check_user_login() && $info != 'password')
		{
			return $_SESSION[$info];
		}
		else return NULL;
	}
}

/* End of File */
