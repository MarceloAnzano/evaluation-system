<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// NOTE THIS DOESN'T ACCOUNT FOR SEMESTERS YET


class Calculate
{
	// initialize 
	var $tc_percentage = 0;
	var $ea_percentage = 0;
	var $ap_percentage = 0;
	
	var $tc_satl_per = 0;
	var $tc_cc_per = 0;
	var $tc_api_per = 0;
	var $tc_principal_per = 0;
	var $tc_self_per = 0;
	
	var $ea_satl_per = 0;
	var $ea_ll_per = 0;
	var $ea_api_per = 0;
	var $ea_principal_per = 0;
	var $ea_self_per = 0;
	
	var $ap_satl_per = 0;
	var $ap_ll_per = 0;
	var $ap_api_per = 0;
	var $ap_principal_per = 0;
	var $ap_self_per = 0;
	
	var $inst_faculty = 0;
	var $inst_student = 0;
	
	// i know these queries can be condensed into one query...
	function display_subordinate_ratings($con, $id, $position, $year, $semester)
	{
		// get target user's id
		$year = mysqli_real_escape_string($con, $year);
		$semester = mysqli_real_escape_string($con, $semester);
		
		$sql = "SELECT DISTINCT year, semester 
				FROM final_ratings 
				WHERE year='$year' AND semester='$semester' LIMIT 2";
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		if ($numrows > 0)
		{
			$table = 'final_ratings';
		}
		else $table ='final_ratings_archive';
		
		switch ($position)
		{
			case 'satl':
				$sql = "SELECT users.uname, rating, tc, ea, ap, student
						FROM ".$table."
						LEFT JOIN users ON ".$table.".teacherId=users.hashid
						WHERE users.subject= ( SELECT subject FROM users WHERE hashid='".$id."' ) AND year='$year' AND semester='$semester'";
				$query = mysqli_query($con, $sql);
				return $this->prepare_data_for_json($query);
			case 'll':
				$sql = "SELECT users.uname, rating, tc, ea, ap, student
						FROM ".$table."
						LEFT JOIN users ON ".$table.".teacherId=users.hashid
						WHERE users.level=( SELECT level FROM users WHERE hashid='".$id."' ) AND year='$year' AND semester='$semester'";
				$query = mysqli_query($con, $sql);
				return $this->prepare_data_for_json($query);
			case 'cc':
				$sql = "SELECT users.uname, rating, tc, ea, ap, student
						FROM ".$table."
						LEFT JOIN users ON ".$table.".teacherId=users.hashid
						WHERE users.cluster=( SELECT cluster FROM users WHERE hashid='".$id."' ) AND year='$year' AND semester='$semester'";
				$query = mysqli_query($con, $sql);
				return $this->prepare_data_for_json($query);
			case 'api':
			case 'principal':
				$sql = "SELECT users.uname, rating, tc, ea, ap, student
						FROM ".$table."
						LEFT JOIN users ON ".$table.".teacherId=users.hashid
						WHERE year='$year' AND semester='$semester'";
				$query = mysqli_query($con, $sql);
				return $this->prepare_data_for_json($query);
			default:
				exit ('Invalid session');
		}
	}
	
	private function prepare_data_for_json($query)
	{
		$results = array();
		while ($row = mysqli_fetch_array($query))
		{	
			$results[] = array(
				'name' => ucwords($row[0]),
				'rating' => $row[1],
				'tc' => $row[2],
				'ea' => $row[3],
				'ap' => $row[4],
				'student' => $row[5],
			);
			$rating = $row[1];
			if ($row[1] == NULL)
				$rating = 'No rating available yet';
		}
		
		$data = array(
			'results' => $results
		);
		
		return $data;
	}
	
	function get_final_rating($con)
	{
		$per = $this->get_category_percentages($con);
		
		// collect all persons evaluated
		$sql = "SELECT DISTINCT to_evaluate, year, semester
				FROM results";
		$query = mysqli_query($con, $sql);
		
		$faculty = array();
		while ($row = mysqli_fetch_array($query))
		{
			$faculty[] = $row;
		}
		
		foreach ($faculty as &$teacher)
		{
			// get the ratings from each division
			// get only non-supervisory faculty
			$self = $this->get_self_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$subject_area = $this->get_subject_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$cluster = $this->get_cluster_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$level = $this->get_level_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$principal = $this->get_principal_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$students = $this->get_student_rating($con, $teacher[0], $teacher[1]);
			
			//~ echo 'self<br>';
			//~ var_dump($self);
			//~ echo '<br>subject area<br>';
			//~ var_dump($subject_area);
			//~ echo '<br>cluster<br>';
			//~ var_dump($cluster);
			//~ echo '<br>level<br>';
			//~ var_dump($level);
			//~ echo '<br>principal<br>';
			//~ var_dump($principal);
			//~ echo '<br>students<br>';
			//~ var_dump($students);
			//~ exit();
			$identity = $this->who_is($con, $teacher[0]);
			$rating = 0;
			$tc = 0;
			$ea = 0;
			$ap = 0;
			$partial = 0;
			switch ($identity[0])
			{
				case 'api':
				case 'principal':
					$rating = ($self[0] * $this->tc_percentage) + ($self[1] * $this->ea_percentage) + ($self[2] * $this->ap_percentage);
					break;
				case 'none':
					$tc = ($subject_area[0] * $this->tc_satl_per) + ($cluster[0] * $this->tc_cc_per) + ($principal[0][0] * $this->tc_api_per )
						+ ($principal[1][0] * $this->tc_principal_per) + ($self[0] * $this->tc_self_per);
						
					$ea = ($subject_area[1] * $this->ea_satl_per) + ($level[1] * $this->ea_ll_per) + ($principal[0][1] * $this->ea_api_per )
						+ ($principal[1][1] * $this->ea_principal_per) + ($self[1] * $this->ea_self_per);
					
					$ap = ($subject_area[2] * $this->ap_satl_per) + ($level[2] * $this->ap_ll_per) + ($principal[0][2] * $this->ap_api_per )
						+ ($principal[1][2] * $this->ap_principal_per) + ($self[2] * $this->ap_self_per);
					
					$rating = ($tc * $this->tc_percentage) + ($ea * $this->ea_percentage) + ($ap * $this->ap_percentage);
					
					
					if (count($students) > 0)
					{
						foreach ($students as $student)
						{
							$partial += $student;
							
						}
						
						$partial = $partial / count($students);
						$rating = ($rating * $this->inst_faculty) + ($partial * $this->inst_student);
					}
					break;
				default:
					break;
			}
			$this->update_final_rating($con, $rating, $tc, $ea, $ap, $partial, $teacher[0], $teacher[1], $teacher[2]);
		}
	}
	
	private function update_final_rating($con, $rating, $tc, $ea, $ap, $partial, $id, $year, $semester)
	{
		$sql = "UPDATE final_ratings
				SET rating=?, tc=?, ea=?, ap=?, student=?
				WHERE teacherId=? AND year=? AND semester=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'dddddsdd', $rating, $tc, $ea, $ap, $partial, $id, $year, $semester);
		mysqli_stmt_execute($stmt);
	}
	
	private function get_self_rating($con, $id, $year, $semester)
	{
		$sql = "SELECT tc, ea, ap
				FROM results
				WHERE to_evaluate='$id' AND evtype='self' AND year='$year' AND semester='$semester'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		return $row;
	}
	
	private function get_subject_rating($con, $id, $year, $semester)
	{
		$sql = "SELECT tc, ea, ap
				FROM results
				WHERE to_evaluate='$id' AND evtype='satl-teacher' AND year='$year' AND semester='$semester'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		return $row;	
	}
	
	private function get_cluster_rating($con, $id, $year, $semester)
	{
		$sql = "SELECT tc, ea, ap
				FROM results
				WHERE to_evaluate='$id' AND evtype='cc-teacher' AND year='$year' AND semester='$semester'";
		$query = mysqli_query($con, $sql);	
		$row = mysqli_fetch_array($query);
		return $row;
	}
	
	private function get_principal_rating($con, $id, $year, $semester)
	{
		$sql = "SELECT tc, ea, ap
				FROM results
				WHERE to_evaluate='$id' AND evtype IN ('api-teacher', 'principal-teacher') AND year='$year' AND semester='$semester' 
				ORDER BY evtype";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		return $row;
	}
	
	private function get_level_rating($con, $id, $year, $semester)
	{
		$sql = "SELECT tc, ea, ap
				FROM results
				WHERE to_evaluate='$id' AND evtype='ll-teacher' AND year='$year' AND semester='$semester'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		return $row;
	}
	
	private function get_student_rating($con, $id, $year)
	{
		$sql = "SELECT student
				FROM results
				WHERE to_evaluate='$id' AND evtype='student-teacher' AND year='$year'";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		return $row;
	}
	
	private function who_is($con, $id)
	{
		$sql = "SELECT supervisor
				FROM users
				WHERE hashid='$id' AND supervisor = 'none' AND is_deleted = 0";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		return $row;
	}
	
	private function get_category_percentages($con)
	{
		$sql = "SELECT item, percent
				FROM percentages";
		$query = mysqli_query($con, $sql);
		$per = array();
		
		while ($row = mysqli_fetch_array($query))
		{
			switch ($row[0])
			{
				case 'tc':
					$this->tc_percentage = $row[1] / 100;
					break;
				case 'ea':
					$this->ea_percentage = $row[1] / 100;
					break;
				case 'ap':
					$this->ap_percentage = $row[1] / 100;
					break;
				case 'tc-satl':
					$this->tc_satl_per = $row[1] / 100;
					break;
				case 'tc-cc':
					$this->tc_cc_per = $row[1] / 100;
					break;
				case 'tc-api':
					$this->tc_api_per = $row[1] / 100;
					break;
				case 'tc-principal':
					$this->tc_principal_per = $row[1] / 100;
					break;
				case 'tc-self':
					$this->tc_self_per = $row[1] / 100;
					break;
				case 'ea-satl':
					$this->ea_satl_per = $row[1] / 100;
					break;
				case 'ea-ll':
					$this->ea_ll_per = $row[1] / 100;
					break;
				case 'ea-api':
					$this->ea_api_per = $row[1] / 100;
					break;
				case 'ea-principal':
					$this->ea_principal_per = $row[1] / 100;
					break;
				case 'ea-self':
					$this->ea_self_per = $row[1] / 100;
					break;
					
					
					
				case 'ap-satl':
					$this->ap_satl_per = $row[1] / 100;
					break;
				case 'ap-api':
					$this->ap_api_per = $row[1] / 100;
					break;
				case 'ap-ll':
					$this->ap_ll_per = $row[1] / 100;
					break;
				case 'ap-principal':
					$this->ap_principal_per = $row[1] / 100;
					break;
				case 'ap-self':
					$this->ap_self_per = $row[1] / 100;
					break;
					
				case 'inst-faculty':
					$this->inst_faculty = $row[1] / 100;
					break;
				case 'inst-student':
					$this->inst_student = $row[1] / 100;
					break;
				default:
					break;
			}
		}
	}
}

/* End of File */
