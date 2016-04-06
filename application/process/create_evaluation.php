<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_evaluation
{
	// initialize
	var $messages = array();
	var $setting = array();
	
	function message_to_admin()
	{
		foreach ($this->messages as $message)
			$message = $message.'<br>';
		return $this->messages;
	}
	
	function get_year_and_sem($con)
	{
		// get post variables
		foreach ($_POST['setting'] as $per)
		{
			$this->setting[] = mysqli_real_escape_string($con, $per);
		}
	}
	
	function check_for_duplicates($con)
	{
		$statement = NULL;
		$year = $this->setting[0];
		$semester = $this->setting[1];
		$sql = "SELECT *
				FROM results
				WHERE semester='$semester' LIMIT 1";
		
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		
		if ($numrows > 0) exit ('You have already created evaluations for this semester!');
		
		// check archives if existing
		$sql = "SELECT *
				FROM results_archive
				WHERE year='$year' AND semester='$semester' LIMIT 1";
		
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		
		if ($numrows > 0) exit ('This evaluation has already been archived!');
	}
	
	
	function check_if_same_year($con)
	{
		$statement = NULL;
		$year = $this->setting[0];
		$sql = "SELECT id
				FROM results
				WHERE year='$year' LIMIT 1";
		
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		
		// if table has any entry
		if(isset($row['id']))
		{
			$numrows = mysqli_num_rows($query);
			
			// if no match with the year
			if ($numrows == 0) exit ('You may only create evaluations for the same year!');
		}
		
	}
	
	// main creation method
	function create_evaluation_entries($con, $person_to_add = NULL)
	{
		$this->get_year_and_sem($con);
		$this->check_for_duplicates($con);
		$this->check_if_same_year($con);
		$this->create_self_evaluation($con);
		$this->create_principal_evaluation($con);
		$this->create_supervisor_to_staff($con);
		$this->create_student_to_teacher($con);
		$this->create_ratings_container($con);
	}
	
	/** PRIVATE FUNCTIONS **/
	// method for creating student evaluation of faculty
	private function create_student_to_teacher($con)
	{
		// select all students
		$this->get_year_and_sem($con);
		$sql = "SELECT hashid, gradelevel, section
				FROM users
				WHERE utype='student' AND supervisor NOT IN ('principal','api') AND is_deleted=0 ";
		$query_students = mysqli_query($con, $sql);
		
		$students = array();
		while ($row = mysqli_fetch_array($query_students))
		{
			$students[] = $row;
		}
		
		foreach ($students as $student)
		{
			$sql = "SELECT teacherId
					FROM subjects
					WHERE gradelevel='".$student[1]."' AND section='".$student[2]."';";
			$query_teachers = mysqli_query($con, $sql);

			if (mysqli_num_rows($query_teachers) == 0) continue;
			
			$sql = "INSERT INTO results
					(year, semester, evaluator, to_evaluate, evtype)
					VALUES ('".$this->setting[0]."','".$this->setting[1]."','";
				
			$a = 0;
			while ($row = mysqli_fetch_array($query_teachers))
			{
				if ($a == 0)
				{
					$sql .= $student[0]."','".$row[0]."','student-teacher')";
					$a++;
					continue;
				}
				$sql .= ", ('".$this->setting[0]."','".$this->setting[1]."','".$student[0]."','".$row[0]."','student-teacher')";
			}
			
			$query = mysqli_query($con, $sql);
		}
		$this->messages[] = 'Student to teacher evaluations have been created.<br>';
	}
	
	private function create_self_evaluation($con)
	{
		// select all faculty
		$sql = "SELECT hashid
				FROM users
				WHERE utype='faculty' AND is_deleted=0";
		$query = mysqli_query($con, $sql);
		
		// start new insert query		
		$sql = "INSERT INTO results
				(year, semester, evaluator, to_evaluate, evtype)
				VALUES ('".$this->setting[0]."','".$this->setting[1]."','";
		
		// set rest of sql query
		$a = 0;
		while ($row = mysqli_fetch_array($query))
		{
			if ($a == 0)
			{
				$sql .= $row[0]."','".$row[0]."','self')";
				$a++;
				continue;
			}
			$sql .= ", ('".$this->setting[0]."','".$this->setting[1]."','".$row[0]."','".$row[0]."','self')";
		}
		$query = mysqli_query($con, $sql);
		$this->messages[] = 'Self evaluations have been created.<br>';
	}
	
	private function create_principal_evaluation($con)
	{
		// get all non-principal faculty
		$sql = "SELECT hashid
				FROM users
				WHERE utype='faculty' AND is_deleted=0";
		$query_subordinates = mysqli_query($con, $sql);
		
		// select API and principal
		$sql = "SELECT hashid, supervisor
				FROM users
				WHERE utype='faculty' AND supervisor IN ('principal','api') AND is_deleted=0";
		$query_principals = mysqli_query($con, $sql);
		
		$principals = array();
		while ($row = mysqli_fetch_array($query_principals))
		{
			$principals[] = $row;
		}
		
		// start new insert query
		$sql = "INSERT INTO results
				(year, semester, evaluator, to_evaluate, evtype)
				VALUES ('".$this->setting[0]."','".$this->setting[1]."','";
		$a = 0;
		while ($row = mysqli_fetch_array($query_subordinates))
		{
			if ($a == 0)
			{
				$sql .= $principals[0][0]."','".$row[0]."','".$principals[0][1]."-teacher')";
				$sql .= ", ('".$this->setting[0]."','".$this->setting[1]."','".$principals[1][0]."','".$row[0]."','".$principals[1][1]."-teacher')";
				$a++;
				continue;
			}
			$sql .= ", ('".$this->setting[0]."','".$this->setting[1]."','".$principals[0][0]."','".$row[0]."','".$principals[0][1]."-teacher')";
			$sql .= ", ('".$this->setting[0]."','".$this->setting[1]."','".$principals[1][0]."','".$row[0]."','".$principals[1][1]."-teacher')";
		}
		
		$query = mysqli_query($con, $sql);
		$this->messages[] = 'API and Principal evaluations have been created.<br>';
	}
	
	private function create_supervisor_to_staff($con)
	{
		$this->subject_area($con);
		$this->cluster($con);
		$this->level($con);
	}
	
	
	private function subject_area($con)
	{
		// get SATLs
		$sql = "SELECT hashid, subject
				FROM users
				WHERE utype='faculty' AND supervisor='satl' AND is_deleted=0";
		$query_satl = mysqli_query($con, $sql);
		
		if (mysqli_num_rows($query_satl) == 0)
		{
			echo 'No SATLs found!';
			return;
		}
		
		$satl = array();
		while ($row = mysqli_fetch_array($query_satl))
		{
			$satl[] = $row;
		}
		
		foreach ($satl as $subject)
		{
			// get all non-principal faculty
			$sql = "SELECT hashid, subject
					FROM users
					WHERE utype='faculty' AND subject='".$subject[1]."' AND hashid !='".$subject[0]."' AND supervisor NOT IN ('principal','api','satl') AND is_deleted=0";
			$query_staff = mysqli_query($con, $sql);
			
			// in case SATL has no staff in record
			if (mysqli_num_rows($query_staff) == 0) continue;
			
			$sql = "INSERT INTO results
					(year, semester, evaluator, to_evaluate, evtype)
					VALUES ('".$this->setting[0]."','".$this->setting[1]."','";
				
			$a = 0;
			while ($row = mysqli_fetch_array($query_staff))
			{
				if ($a == 0)
				{
					$sql .= $subject[0]."','".$row[0]."','satl-teacher')";
					$a++;
					continue;
				}
				$sql .= ", ('".$this->setting[0]."','".$this->setting[1]."','".$subject[0]."','".$row[0]."','satl-teacher')";
			}
			$query = mysqli_query($con, $sql);
		}
		$this->messages[] = 'Subject area evaluations have been created.<br>';
	}
	
	private function cluster($con)
	{
		// get CCs
		$sql = "SELECT hashid, cluster
				FROM users
				WHERE utype='faculty' AND supervisor='cc' AND is_deleted=0 ";
		$query_coordinator = mysqli_query($con, $sql);
		
		$coordinators = array();
		while ($row = mysqli_fetch_array($query_coordinator))
		{
			$coordinators[] = $row;
		}

		foreach ($coordinators as $coordinator)
		{
			// get all non-principal faculty
			$sql = "SELECT hashid
					FROM users
					WHERE cluster='".$coordinator[1]."' AND hashid != '".$coordinator[0]."' AND supervisor NOT IN ('principal','api','satl') AND is_deleted=0";
			
			$query_staff = mysqli_query($con, $sql);
			
			// in case CC has no staff on record
			if (mysqli_num_rows($query_staff) == 0) continue;
			
			$sql = "INSERT INTO results
					(year, semester, evaluator, to_evaluate, evtype)
					VALUES ('".$this->setting[0]."','".$this->setting[1]."','";
				
			$a = 0;
			while ($row = mysqli_fetch_array($query_staff))
			{
				if ($a == 0)
				{
					$sql .= $coordinator[0]."','".$row[0]."','cc-teacher')";
					$a++;
					continue;
				}
				$sql .= ", ('".$this->setting[0]."','".$this->setting[1]."','".$coordinator[0]."','".$row[0]."','cc-teacher')";
			}
			$query = mysqli_query($con, $sql);
		}
		$this->messages[] = 'Cluster evaluations have been created.<br>';
	}
	
	private function level($con)
	{
		// get LLs
		$sql = "SELECT hashid, level
				FROM users
				WHERE utype='faculty' AND supervisor='ll' AND is_deleted=0";
		$query_leader = mysqli_query($con, $sql);
		
		$level_leaders = array();
		while ($row = mysqli_fetch_array($query_leader))
		{
			$level_leaders[] = $row;
		}
		
		
		foreach ($level_leaders as $level_leader)
		{			
			// get all non-principal faculty
			$sql = "SELECT hashid
					FROM users
					WHERE level='".$level_leader[1]."' AND hashid != '".$level_leader[0]."' AND supervisor NOT IN ('principal','api','satl') AND is_deleted=0";
			$query_staff = mysqli_query($con, $sql);
			
			// in case CC has no staff on record; should never happen
			if (mysqli_num_rows($query_staff) == 0) continue;
			
			$sql = "INSERT INTO results
					(year, semester, evaluator, to_evaluate, evtype)
					VALUES ('".$this->setting[0]."','".$this->setting[1]."','";
				
			$a = 0;
			while ($row = mysqli_fetch_array($query_staff))
			{
				if ($a == 0)
				{
					$sql .= $level_leader[0]."','".$row[0]."','ll-teacher')";
					$a++;
					continue;
				}
				$sql .= ", ('".$this->setting[0]."','".$this->setting[1]."','".$level_leader[0]."','".$row[0]."','ll-teacher')";
			}
			$query = mysqli_query($con, $sql);
		}
		$this->messages[] = 'Level evaluations have been created.<br>';
	}
	
	private function create_ratings_container($con)
	{
		// in theory duplicate ratings entries are impossible
		$year = $this->setting[0];
		$semester = $this->setting[1];
		if ($this->check_for_ratings_duplicates($con, $year, $semester)) exit ();
		
		$sql = "SELECT DISTINCT to_evaluate
				FROM results
				WHERE year='".$year."' AND semester='".$semester."'";
		$query = mysqli_query($con, $sql);
		
		$sql = "INSERT INTO final_ratings
					(year, semester, teacherId)
					VALUES ('".$this->setting[0]."','".$this->setting[1]."','";
				
		$a = 0;
		while ($row = mysqli_fetch_array($query))
		{
			if ($a == 0)
			{
				$sql .= $row[0]."')";
				$a++;
				continue;
			}
			$sql .= ", ('".$this->setting[0]."','".$this->setting[1]."','".$row[0]."')";
		}
		$query = mysqli_query($con, $sql);
		$this->messages[] = 'Rating containers have been created.<br>';
	}
	
	private function check_for_ratings_duplicates($con, $year, $semester)
	{
		$sql = "SELECT *
				FROM final_ratings
				WHERE year='".$year."' AND semester='".$semester."'";
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		
		if ($numrows > 0) return TRUE;
		else return FALSE;
	}
}

/* End of file */
