<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_user_data
{
	var $uname = '';
	var $logid = '';
	var $password = '';
	var $target_id = '';
	var $edit_acct = FALSE;
	
	function does_user_exist($con, $id)
	{
		$id = mysqli_real_escape_string($con, $id);
		$sql = "SELECT * 
				FROM users
				WHERE hashid = ? AND utype != 'admin' AND is_deleted = 0";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$query = mysqli_stmt_get_result($stmt);
		
		$numrows = mysqli_num_rows($query);
		if ($numrows > 0)
			return true;
	}
	
	function edit_user_method($con)
	{
		if ( ! isset($_POST['uname']) OR empty($_POST['uname']) 
		OR ! isset($_POST['targetid']) OR empty($_POST['targetid'])
		OR ! isset($_POST['usertype']) OR empty($_POST['usertype']))
		{
			exit('Invalid input');
		}
		// get target user's id
		$this->target_id = mysqli_real_escape_string($con, $_POST['targetid']);
		
		// get post values
		$this->uname = mysqli_real_escape_string($con, $_POST['uname']);
		$this->uname = trim($this->uname);
		
		// set password to the user's current if password textbox was left null
		if ( ! empty($_POST['password']))
		{
			require_once BASEPATH.'libraries/bcrypt.php';
			$crypt = new Bcrypt();
			
			// hash password after this
			$this->password = mysqli_real_escape_string($con, $_POST['password']);
				
			// reject password if too short
			if (strlen($this->password) < 3) exit('Password is too short'); 
			$this->password = $crypt->hash($this->password);
		}
		
		$usertype = strtolower(mysqli_real_escape_string($con, $_POST['usertype']));
		
		$position = strtolower(mysqli_real_escape_string($con, $_POST['position']));
		
		// set sql query based on user types
		switch ($usertype)
		{
			case 'student':
				$section = strtolower(mysqli_real_escape_string($con, $_POST['section']));
				$gradelevel = strtolower(mysqli_real_escape_string($con, $_POST['gradelevel']));
				$this->drop_if_missing($gradelevel, 'Please provide the student\'s grade level');
				$this->drop_if_missing($section, 'Please provide the student\'s section');
				$this->save_student_item($con, $gradelevel, $section);
				break;
			case 'faculty':
				$subject = strtolower(mysqli_real_escape_string($con, $_POST['sat']));
				$level = strtolower(mysqli_real_escape_string($con, $_POST['level']));
				$cluster = strtolower(mysqli_real_escape_string($con, $_POST['cluster']));
				
				if ($position != 'none')
				{
					$this->drop_if_missing($subject, 'Please provide the subject area');
					$this->drop_if_missing($level, 'Please provide the assigned level');
					$this->drop_if_missing($cluster, 'Please provide the assigned cluster');
				}
					
				switch ($position)
				{
					case 'none':
						$this->save_faculty_item($con, $subject, $level, $cluster);
						break;
					case 'api':
					case 'principal':
					case 'cc':
					case 'll':
					case 'satl':
						$this->save_faculty_item($con, $subject, $level, $cluster, $position);
						break;
					default:
						exit ('Invalid input');
				}
				
				break;
			case 'admin':
				$this->save_admin_item($con);
				break;
			default:
				exit ('Invalid input');
		}
	}
	
	function edit_account_method($con, $usertype)
	{
		if (! isset($_POST['targetid']) OR empty($_POST['targetid']))
		{
			exit('Invalid input');
		}
		
		// get target user's id
		$this->target_id = mysqli_real_escape_string($con, $_POST['targetid']);
		
		// get post values
		switch ($usertype)
		{
			case 'student':
			case 'faculty':
				$this->uname = mysqli_real_escape_string($con, $_POST['uname']);
				$this->uname = trim($this->uname);
				break;
			case 'admin':
				$this->uname = mysqli_real_escape_string($con, $_POST['uname']);
				$this->uname = trim($this->uname);
				break;
			default:
				exit ('Invalid Input');
		}
		
		// to activate the reset session variable method
		$this->edit_acct = TRUE;
		
		$position = 'none';
		if (isset($position) && empty($position))
		{
			$position = strtolower(mysqli_real_escape_string($con, $_POST['position']));
		}		
		// set sql query based on user types
		switch ($usertype)
		{
			case 'student':
				$section = strtolower(mysqli_real_escape_string($con, $_POST['section']));
				$gradelevel = strtolower(mysqli_real_escape_string($con, $_POST['gradelevel']));
				$this->drop_if_missing($gradelevel, 'Please provide the student\'s grade level');
				$this->drop_if_missing($section, 'Please provide the student\'s section');
				$this->save_student_item($con, $gradelevel, $section);
				break;
			case 'faculty':
				$subject = strtolower(mysqli_real_escape_string($con, $_POST['sat']));
				$level = strtolower(mysqli_real_escape_string($con, $_POST['level']));
				$cluster = strtolower(mysqli_real_escape_string($con, $_POST['cluster']));
				
				if ($position != 'none')
				{
					$this->drop_if_missing($subject, 'Please provide the subject area');
					$this->drop_if_missing($level, 'Please provide the assigned level');
					$this->drop_if_missing($cluster, 'Please provide the assigned cluster');
				}
					
				switch ($position)
				{
					case 'none':
						$this->save_faculty_item($con, $subject, $level, $cluster);
						break;
					case 'api':
					case 'principal':
					case 'cc':
					case 'll':
					case 'satl':
						$this->save_faculty_item($con, $subject, $level, $cluster, $position);
						break;
					default:
						exit ('Invalid input1111');
				}
				
				break;
			case 'admin':
				$this->save_admin_item($con);
				break;
			default:
				exit ('Invalid input');
		}
	}
	
	private function save_student_item($con, $gradelevel, $section)
	{
		if ($this->password == '')
		{
			$sql = "UPDATE users
					SET uname=?, utype='student', gradelevel=?, section=?
					WHERE hashid=?";
			$stmt = mysqli_prepare($con, $sql);
			mysqli_stmt_bind_param($stmt, 'ssss', $this->uname, $gradelevel, $section, $this->target_id);
		}
		else
		{
			$sql = "UPDATE users
					SET uname=?, password=?, utype='student', gradelevel=?, section=?
					WHERE hashid=?";
			$stmt = mysqli_prepare($con, $sql);
			mysqli_stmt_bind_param($stmt, 'sssss', $this->uname, $this->password, $gradelevel, $section, $this->target_id);
		}
				
		// record into db
		mysqli_stmt_execute($stmt);
		
		echo 'correct';
		
	}
	
	private function save_faculty_item($con, $subject, $level, $cluster, $position = 'none')
	{
		if ($this->password == '')
		{
			$sql = "UPDATE users 
					SET uname=?, utype='faculty', subject=?, level=?, cluster=?, supervisor=?
					WHERE hashid=?";
			$stmt = mysqli_prepare($con, $sql);
			mysqli_stmt_bind_param($stmt, 'ssssss', $this->uname, $subject, $level, $cluster, $position, $this->target_id);
		}
		else
		{
			$sql = "UPDATE users 
					SET uname=?, password=?, utype='faculty', subject=?, level=?, cluster=?, supervisor=?
					WHERE hashid=?";
			$stmt = mysqli_prepare($con, $sql);
			mysqli_stmt_bind_param($stmt, 'sssssss', $this->uname, $this->password, $subject, $level, $cluster, $position, $this->target_id);
		}
		
		// record into db
		mysqli_stmt_execute($stmt);
		
		if ($this->edit_acct)
		{
			$this->reset_user_session($position);
		}
		echo 'correct';
	}
	
	private function save_admin_item($con)
	{
		if ($this->password == '')
		{
			$sql = "UPDATE users 
					SET uname=?, utype='admin'
					WHERE hashid=?";
			$stmt = mysqli_prepare($con, $sql);
			mysqli_stmt_bind_param($stmt, 'ss', $this->uname, $this->target_id);
		}
		else
		{
			$sql = "UPDATE users 
					SET uname=?, password=?, utype='admin'
					WHERE hashid=?";
			$stmt = mysqli_prepare($con, $sql);
			mysqli_stmt_bind_param($stmt, 'sss', $this->uname, $this->password, $this->target_id);
		}		
		
		// record into db		
		mysqli_stmt_execute($stmt);
		
		if ($this->edit_acct)
		{
			$this->reset_user_session($position = 'none');
		}
		echo 'correct';
	}
	
	private function reset_user_session($position = 'none')
	{
		$_SESSION['uname'] = $this->uname;
		$_SESSION['supervisor'] = $position;
	}
	
	private function drop_if_missing($input, $message)
	{
		if ($input == '' OR empty($input)) exit ($message);
	}
}
/* End of File */
