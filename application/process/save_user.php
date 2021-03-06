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
		$cryptograph = new Bcrypt();
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
		$this->password = $cryptograph->hash($this->password);
		
		$usertype = strtolower(mysqli_real_escape_string($con, $_POST['usertype']));
		
		$position = 'none';
		if (isset($_POST['position']))
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
					case 'apsd':
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
	
	function save_batch_user_entries($con, $file_path, $type)
	{
		$assoc_array = array();
		$fields = array();
		$i = 0;
		
		// for format checking
		switch ($type)
		{
			case 'faculty':
				$check_headers = array('full name','position','level','cluster','subject' );
				$password = $this->create_random_password('ijafaculty');
				break;
			case 'student':
				$check_headers = array('student id', 'full name','grade level','section' );
				$password = $this->create_random_password('default');
				break;
			default:
				exit ('Invalid Input');
		}
		
		if (($handle = fopen($file_path, "r")) !== FALSE)
		{
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
			{
				// fill in the header array
				if (empty($fields))
				{
					$data = array_map('strtolower', $data);
					foreach ($check_headers as $header)
					{
						if ( ! in_array($header, $data)) exit ('CSV format incorrect! '.$header.' was not found.');
					}
					$fields = $data;
					continue;
				}
				
				foreach ($data as $k=>$value)
				{
					$assoc_array[$i][strtolower($fields[$k])] = $value;
				}
				$i++;
			}
			fclose($handle);
		}
		
		$temp_id = 0;
		$id_array = array();
		foreach ($assoc_array as $user)
		{	
			$sql = "INSERT INTO users
				(hashid, logid, uname, password, utype, subject, gradelevel, section, level, cluster, supervisor) 
				VALUES ";
			if ($type == 'student')
			{	
				$logid = strtolower(preg_replace('#[^a-zA-Z0-9]#', '', $user['student id']));
				$uname = trim($user['full name']);
				$gradelevel = $user['grade level'];
				$section = strtolower($user['section']);
				$sql .= "('$temp_id', '$logid', '$uname', '$password', 'student', 'none', '$gradelevel', '$section', 'none', 'none', 'none')";
			}
			elseif ($type == 'faculty')
			{	
				// put some code here to abbreviate first names for login ID
				// should work for format example: "LAST, FIRST1 FIRST2 SUFFIX MIDDLE"
				$logid = strtolower(preg_replace('#[^a-zA-Z0-9]#', '', $user['full name']));
				$number = 1;
				while ($this->check_for_duplicates_batch($con, $logid, $number) && $number < 200)
				{
					$number++;
				}
				
				if ($number != 1)
				{
					$logid .= $number;
				}
				
				$uname = trim($user['full name']);
				if ($user['position'] == '' OR $user['position'] == 'none')
				{ 
					$sql .= "('$temp_id', '$logid', '$uname', '$password', 'faculty', 'none', 'none', 'none', 'none', 'none', 'none')";
				}
				else
				{
					$subject = $cluster = $level = 'none';
					$position = strtolower($user['position']);
					if ($user['subject'] != '')
					{
						$subject = strtolower($user['subject']);
					}
					if ($user['cluster'] != '')
					{
						$cluster = strtolower($user['cluster']);
					}
					if ($user['level'] != '')
					{
						$level = strtolower($user['level']);
					}
					$sql .= "('$temp_id', '$logid', '$uname', '$password', 'faculty', '$subject', 'none', 'none', '$level', '$cluster', '$position')";
				}
			}
			mysqli_query($con, $sql);
			$this->create_hash_id($con, mysqli_insert_id($con));
			$temp_id++;
		}
	}
	
	private function create_random_password($phrase)
	{
		include BASEPATH.'libraries/bcrypt.php';
		$cryptograph = new Bcrypt();
		return $cryptograph->hash($phrase);
	}
	
	private function check_for_duplicates($con)
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
	
	private function check_for_duplicates_batch($con, $logid, $number)
	{
		if ($number == 1 )
		{
			$sql = "SELECT *
					FROM users
					WHERE logid COLLATE latin1_general_cs LIKE '$logid' OR logid COLLATE latin1_general_cs LIKE '$logid$number' ;";
		}
		else 
		{
			$sql = "SELECT *
					FROM users
					WHERE logid COLLATE latin1_general_cs LIKE '$logid$number' ;";
		}
		
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		
		if ($numrows > 0)
		{
			return true;
		}
		else return false;
	}
	
	private function create_hash_id($con, $id, $number_of_entries = 1)
	{	
		for ($a = 0; $a < $number_of_entries; $a++)
		{
			$hashid = hash('sha256', $id.openssl_random_pseudo_bytes(16));
			$sql = "UPDATE users
					SET users.hashid='".$hashid."' 
					WHERE users.id='$id';";
					
			$query = mysqli_query($con, $sql);
			var_dump($sql);
			$id++;
		}
	}
	
	private function save_student_item($con, $gradelevel, $section)
	{
		// record into db
		$sql = "INSERT INTO users 
				(logid, uname, password, utype, gradelevel, section, supervisor) 
				VALUES (?, ?, ?, ?, ?, ?, 'none')";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ssssss', $this->logid, $this->uname, $this->password, $usertype, $gradelevel, $section);
		
		$usertype = 'student';
		
		mysqli_stmt_execute($stmt);
		
		$this->create_hash_id($con, mysqli_insert_id($con));
		echo 'correct';
		
	}
	
	private function save_faculty_item($con, $subject, $level = NULL, $cluster = NULL, $position = 'none')
	{
		// record into db
		$sql = "INSERT INTO users 
				(logid, uname, password, utype, subject, level, cluster, supervisor) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ssssssss', $this->logid, $this->uname, $this->password, $usertype, $subject, $level, $cluster, $position);
		
		$usertype = 'faculty';
		
		mysqli_stmt_execute($stmt);
		
		$this->create_hash_id($con, mysqli_insert_id($con));
		echo 'correct';
	}
	
	private function save_admin_item($con)
	{
		$sql = "INSERT INTO users 
				(logid, uname, password, utype, supervisor) 
				VALUES (?, ?, ?, ?, 'none')";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ssss', $this->logid, $this->uname, $this->password, $usertype);
		
		$usertype = 'admin';
		
		mysqli_stmt_execute($stmt);
		
		$this->create_hash_id($con, mysqli_insert_id($con));
		echo 'correct';
	}
	
	private function drop_if_missing($input, $message)
	{
		if ($input == '' OR empty($input)) exit ($message);
	}
}
/* End of File */
