<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Save_user
{
	var $uname = '';
	var $logid = '';
	var $password = '';
	
	function save_user_entry($con)
	{
		if ( ! isset($_POST['uname']) OR empty($_POST['uname']) 
		OR ! isset($_POST['logid']) OR empty($_POST['logid'])
		OR ! isset($_POST['password']) OR empty($_POST['password'])
		OR ! isset($_POST['usertype']) OR empty($_POST['usertype']))
		{
			exit('Invalid input');
		}
		
		require_once BASEPATH.'libraries/bcrypt.php';
		
		// get post values
		$crypt = new Bcrypt();
		$this->uname = mysqli_real_escape_string($con, $_POST['uname']);
		$this->uname = trim($this->uname);
		$this->logid = mysqli_real_escape_string($con, $_POST['logid']);
		$this->logid = trim($this->logid);
		
		// sees if logid is too short
		if (strlen($this->logid) < 4) exit('Login ID is too short'); 
		
		$this->check_for_duplicates($con);
		
		// hash password
		$this->password = mysqli_real_escape_string($con, $_POST['password']);
		
		// reject password if too short
		if (strlen($this->password) < 3) exit('Password is too short'); 
		$this->password = $crypt->hash($this->password);
		
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
				exit ('Invalid Input');
		}
	}
	
	function check_for_duplicates($con)
	{
		$sql = "SELECT *
				FROM users
				WHERE logid='$this->logid';";
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		
		if ($numrows > 0)
		{
			echo "Duplicate Login ID  Detected";
			exit();
		}
	}
	
	function create_hash_id($con)
	{
		$sql = "SELECT users.id
				FROM users
				WHERE logid='".$this->logid."';";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_row($query);
		
		$hashid = hash('sha256',$row[0].openssl_random_pseudo_bytes(16));
		$sql = "UPDATE users
				SET users.hashid='".$hashid."' 
				WHERE logid='".$this->logid."';";
				
		$query = mysqli_query($con, $sql);
	}
	
	function save_student_item($con, $gradelevel, $section)
	{
		// record into db
		$sql = "INSERT INTO users 
				(logid, uname, password, utype, gradelevel, section) 
				VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ssssss', $this->logid, $this->uname, $this->password, $usertype, $gradelevel, $section);
		
		$usertype = 'student';
		
		mysqli_stmt_execute($stmt);
		
		$this->create_hash_id($con);
		echo 'correct';
		
	}
	
	function save_faculty_item($con, $subject, $level = NULL, $cluster = NULL, $position = 'none')
	{
		// record into db
		$sql = "INSERT INTO users 
				(logid, uname, password, utype, subject, level, cluster, supervisor) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ssssssss', $this->logid, $this->uname, $this->password, $usertype, $subject, $level, $cluster, $position);
		
		$usertype = 'faculty';
		
		mysqli_stmt_execute($stmt);
		
		$this->create_hash_id($con);
		echo 'correct';
	}
	
	function save_admin_item($con)
	{
		$sql = "INSERT INTO users 
				(logid, uname, password, utype) 
				VALUES (?, ?, ?, ?)";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ssss', $this->logid, $this->uname, $this->password, $usertype);
		
		$usertype = 'admin';
		
		mysqli_stmt_execute($stmt);
		
		$this->create_hash_id($con);
		echo 'correct';
	}
	
	function drop_if_missing($input, $message)
	{
		if ($input == '' OR empty($input)) exit ($message);
	}
}
/* End of File */
