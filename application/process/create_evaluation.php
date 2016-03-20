<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_evaluation
{
	// initialize
	var $messages = array();
	var $setting = array();
	
	function message_to_admin()
	{
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
	
	function check_for_duplicates($con, $evtype = '')
	{
		$statement = NULL;
		$year = $this->setting[0].$this->setting[1];
		$semester = $this->setting[2];
		switch ($evtype)
		{
			case 'student':
				$statement = " AND evtype='student-teacher'";
				break;
			case 'faculty':
				$statement = " AND evtype != 'student-teacher'";
				break;
			default:
				exit ('Invalid');
		}
		$sql = "SELECT *
				FROM results
				WHERE year='".$year."' AND semester='".$semester."'".$statement.";";
		
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		
		if ($numrows > 0) exit ('You have already created evaluations for this semester!');
	}
	
	// main creation method
	function create_evaluation_entries($con, $evtype = NULL)
	{
		$this->get_year_and_sem($con);
		$this->check_for_duplicates($con, $evtype);
		$this->create_self_evaluation($con);
		$this->create_principal_evaluation($con);
		$this->create_supervisor_and_staff($con);
		$this->create_ratings_container($con);
	}
	
	// main method for creating student evaluation of faculty
	function create_student_teacher($con)
	{
		// select all students
		$this->get_year_and_sem($con);
		$this->check_for_duplicates($con, 'student');
		$sql = "SELECT hashid, gradelevel, section
				FROM users
				WHERE utype='student';";
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
					VALUES ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','";
				
			$a = 0;
			while ($row = mysqli_fetch_array($query_teachers))
			{
				if ($a == 0)
				{
					$sql .= $student[0]."','".$row[0]."','student-teacher')";
					$a++;
					continue;
				}
				$sql .= ", ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','".$student[0]."','".$row[0]."','student-teacher')";
			}
			
			$query = mysqli_query($con, $sql);
		}
		$this->messages[] = 'Student to teacher evaluations have been created.';
		
		// create rating container
		//~ $this->create_ratings_container($con);
	}
	
	private function create_self_evaluation($con)
	{
		// select all faculty
		$sql = "SELECT hashid
				FROM users
				WHERE utype='faculty';";
		$query = mysqli_query($con, $sql);
		
		// start new insert query		
		$sql = "INSERT INTO results
				(year, semester, evaluator, to_evaluate, evtype)
				VALUES ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','";
		
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
			$sql .= ", ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','".$row[0]."','".$row[0]."','self')";
		}
		$query = mysqli_query($con, $sql);
		$this->messages[] = 'Self evaluations have been created.';
	}
	
	private function create_principal_evaluation($con)
	{
		// get all non-principal faculty
		$sql = "SELECT hashid
				FROM users
				WHERE utype='faculty' AND supervisor NOT IN ('principal','api');";
		$query_subordinates = mysqli_query($con, $sql);
		
		// select API and principal
		$sql = "SELECT hashid, supervisor
				FROM users
				WHERE utype='faculty' AND supervisor IN ('principal','api');";
		$query_principals = mysqli_query($con, $sql);
		
		$principals = array();
		while ($row = mysqli_fetch_array($query_principals))
		{
			$principals[] = $row;
		}
		
		// start new insert query
		$sql = "INSERT INTO results
				(year, semester, evaluator, to_evaluate, evtype)
				VALUES ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','";
		$a = 0;
		while ($row = mysqli_fetch_array($query_subordinates))
		{
			if ($a == 0)
			{
				$sql .= $principals[0][0]."','".$row[0]."','".$principals[0][1]."-teacher')";
				$sql .= ", ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','".$principals[1][0]."','".$row[0]."','".$principals[1][1]."-teacher')";
				$a++;
				continue;
			}
			$sql .= ", ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','".$principals[0][0]."','".$row[0]."','".$principals[0][1]."-teacher')";
			$sql .= ", ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','".$principals[1][0]."','".$row[0]."','".$principals[1][1]."-teacher')";
		}
		
		$query = mysqli_query($con, $sql);
		$this->messages[] = 'API and Principal evaluations have been created.';
	}
	
	private function create_supervisor_and_staff($con)
	{
		$this->subject_area($con);
		$this->cluster($con);
		$this->level($con);
	}
	
	/** PRIVATE FUNCTIONS **/
	private function subject_area($con)
	{
		// get SATLs
		$sql = "SELECT hashid, subject
				FROM users
				WHERE utype='faculty' AND supervisor='satl';";
		$query_satl = mysqli_query($con, $sql);
		
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
					WHERE utype='faculty' AND subject='".$subject[1]."' AND hashid !='".$subject[0]."' AND supervisor NOT IN ('principal','api','satl')";
			$query_staff = mysqli_query($con, $sql);
			
			// in case SATL has no staff in record
			if (mysqli_num_rows($query_staff) == 0) continue;
			
			$sql = "INSERT INTO results
					(year, semester, evaluator, to_evaluate, evtype)
					VALUES ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','";
				
			$a = 0;
			while ($row = mysqli_fetch_array($query_staff))
			{
				if ($a == 0)
				{
					$sql .= $subject[0]."','".$row[0]."','satl-teacher')";
					$a++;
					continue;
				}
				$sql .= ", ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','".$subject[0]."','".$row[0]."','satl-teacher')";
			}
			$query = mysqli_query($con, $sql);
		}
		$this->messages[] = 'Subject area evaluations have been created.';
	}
	
	private function cluster($con)
	{
		// get CCs
		$sql = "SELECT hashid, cluster
				FROM users
				WHERE utype='faculty' AND supervisor='cc' ";
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
					WHERE cluster='".$coordinator[1]."' AND hashid != '".$coordinator[0]."' AND supervisor NOT IN ('principal','api','satl')";
			
			$query_staff = mysqli_query($con, $sql);
			
			// in case CC has no staff on record
			if (mysqli_num_rows($query_staff) == 0) continue;
			
			$sql = "INSERT INTO results
					(year, semester, evaluator, to_evaluate, evtype)
					VALUES ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','";
				
			$a = 0;
			while ($row = mysqli_fetch_array($query_staff))
			{
				if ($a == 0)
				{
					$sql .= $coordinator[0]."','".$row[0]."','cc-teacher')";
					$a++;
					continue;
				}
				$sql .= ", ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','".$coordinator[0]."','".$row[0]."','cc-teacher')";
			}
			$query = mysqli_query($con, $sql);
		}
		$this->messages[] = 'Cluster evaluations have been created.';
	}
	
	private function level($con)
	{
		// get LLs
		$sql = "SELECT hashid, level
				FROM users
				WHERE utype='faculty' AND supervisor='ll';";
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
					WHERE level='".$level_leader[1]."' AND hashid != '".$level_leader[0]."' AND supervisor NOT IN ('principal','api','satl')";
			$query_staff = mysqli_query($con, $sql);
			
			// in case CC has no staff on record; should never happen
			if (mysqli_num_rows($query_staff) == 0) continue;
			
			$sql = "INSERT INTO results
					(year, semester, evaluator, to_evaluate, evtype)
					VALUES ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','";
				
			$a = 0;
			while ($row = mysqli_fetch_array($query_staff))
			{
				if ($a == 0)
				{
					$sql .= $level_leader[0]."','".$row[0]."','ll-teacher')";
					$a++;
					continue;
				}
				$sql .= ", ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','".$level_leader[0]."','".$row[0]."','ll-teacher')";
			}
			$query = mysqli_query($con, $sql);
		}
		$this->messages[] = 'Level evaluations have been created.';
	}
	
	private function create_ratings_container($con)
	{
		$year = $this->setting[0].$this->setting[1];
		$semester = $this->setting[2];
		if ($this->check_for_ratings_duplicates($con, $year, $semester)) exit ();
		
		$sql = "SELECT DISTINCT to_evaluate
				FROM results
				WHERE year='".$year."' AND semester='".$semester."'";
		$query = mysqli_query($con, $sql);
		
		$sql = "INSERT INTO final_ratings
					(year, semester, teacherId)
					VALUES ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','";
				
		$a = 0;
		while ($row = mysqli_fetch_array($query))
		{
			if ($a == 0)
			{
				$sql .= $row[0]."')";
				$a++;
				continue;
			}
			$sql .= ", ('".$this->setting[0].$this->setting[1]."','".$this->setting[2]."','".$row[0]."')";
		}
		$query = mysqli_query($con, $sql);
		$this->messages[] = 'Rating containers have been created.';
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
