<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_user_data
{
	var $uname = '';
	var $logid = '';
	var $password = '';
	var $target_id = '';
	
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
		if (empty($_POST['password']))
		{
			$this->set_password_statement($con);
		}
		else
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
				$this->drop_if_missing($section, 'Please provide the student\'s grade and section');
				$this->save_student_item($con, $section);
				break;
			case 'faculty':
				$subject = strtolower(mysqli_real_escape_string($con, $_POST['sat']));
				$level = strtolower(mysqli_real_escape_string($con, $_POST['level']));
				$cluster = strtolower(mysqli_real_escape_string($con, $_POST['cluster']));
				
				$this->drop_if_missing($subject, 'Please provide the subject area');
				$this->drop_if_missing($level, 'Please provide the assigned level');
				$this->drop_if_missing($cluster, 'Please provide the assigned cluster');
				
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
	
	private function save_student_item($con, $section)
	{
		// filtering bad input
		$section = explode(' ', $section);
		$grade_level = $section[0].' '.$section[1];
		$section_entry = $section[2].' '.$section[3];
		
		if ($section[0] != 'grade' && $section[0] != 'kinder') exit ('Invalid section');
		if ($section[2] != 'section') exit ('Invalid section');
		
		// record into db
		$sql = "UPDATE users
				SET uname=?, password=?, utype=?, gradelevel=?, section=?
				WHERE hashid=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ssssss', $this->uname, $this->password, $usertype, $grade_level, $section_entry, $this->target_id);
		
		$usertype = 'student';
		
		mysqli_stmt_execute($stmt);
		
		echo 'correct';
		
	}
	
	private function save_faculty_item($con, $subject, $level = NULL, $cluster = NULL, $position = 'none')
	{
		// record into db
		$sql = "UPDATE users 
				SET uname=?, password=?, utype=?, subject=?, level=?, cluster=?, supervisor=?
				WHERE hashid=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ssssssss', $this->uname, $this->password, $usertype, $subject, $level, $cluster, $position, $this->target_id);
		
		$usertype = 'faculty';
		
		mysqli_stmt_execute($stmt);
		
		echo 'correct';
	}
	
	private function save_admin_item($con)
	{
		$sql = "UPDATE users 
				SET uname=?, password=?, utype=? 
				WHERE hashid=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ssss', $this->uname, $this->password, $usertype, $this->target_id);
		
		$usertype = 'admin';
		
		mysqli_stmt_execute($stmt);
		
		echo 'correct';
	}
	
	private function drop_if_missing($input, $message)
	{
		if ($input == '' OR empty($input)) exit ($message);
	}
	
	private function set_password_statement($con)
	{
		$sql = "SELECT password
				FROM users 
				WHERE hashid=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 's', $this->target_id);		
		mysqli_stmt_execute($stmt);
		$query = mysqli_stmt_get_result($stmt);
			
		$row = mysqli_fetch_array($query);
		$this->password = $row[0];
	}
}
/* End of File */