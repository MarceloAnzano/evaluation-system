<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	session_start();
	
class Check_login
{			
	var $login_status = FALSE;
	
	function get_status()
	{
		return $this->login_status;
	}
	
	function check_user_session($con)
	{
		if (isset($_SESSION['userid']) && isset($_SESSION['logid']) && isset($_SESSION['uname']) 
			&& isset($_SESSION['password']) && isset($_SESSION['utype']) && isset($_SESSION['supervisor']))
		{
			$userid = mysqli_real_escape_string($con, $_SESSION['userid']);
			$logid = preg_replace('#[^a-zA-Z0-9]#', '', $_SESSION['logid']);
			$password = mysqli_real_escape_string($con, $_SESSION['password']);
			$utype = preg_replace('#[^a-z]#', '', $_SESSION['utype']);
			$supervisor = preg_replace('#[^a-z]#', '', $_SESSION['supervisor']);
			
			// set user's login status after authentication
			$this->login_status = $this->auth_user($con, $userid, $logid, $password, $utype, $supervisor);
		}

	}
	
	function auth_user($con, $userid, $logid, $password, $utype, $supervisor)
	{	
		$sql = "SELECT * 
				FROM users 
				WHERE hashid COLLATE latin1_general_cs LIKE ? AND logid COLLATE latin1_general_cs LIKE ? 
				AND password=? AND utype=? AND supervisor=? AND activation=1 AND is_deleted=0";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'sssss', $userid, $logid, $password, $utype, $supervisor);	
			
		mysqli_stmt_execute($stmt);
		$query = mysqli_stmt_get_result($stmt);
		
		// if the number of rows returned is at least 1, the session matches
		$numrows = mysqli_num_rows($query);
		
		if ($numrows > 0)
			return true;
	}
	
	function is_user_admin()
	{
		if (preg_replace('#[^a-z]#', '', $_SESSION['utype']) == 'admin')
			return true;
	}
	
	function is_user_principal($type = 'both')
	{
		if ($type == 'both')
		{
			if (preg_replace('#[^a-z]#', '', $_SESSION['supervisor']) == 'principal' 
				OR preg_replace('#[^a-z]#', '', $_SESSION['supervisor']) == 'api')
				return true;
		}
		elseif ($type == 'principal')
		{
			if (preg_replace('#[^a-z]#', '', $_SESSION['supervisor']) == 'principal')
				return true;
		}
		else return false;
	}
}
/* End of File */
