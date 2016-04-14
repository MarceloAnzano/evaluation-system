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
	
	function display_subordinate_ratings($con, $id, $position, $year, $semester)
	{
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
				//~ $sql = "SELECT users.uname, rating, tc, ea, ap, student
						//~ FROM ".$table."
						//~ LEFT JOIN users ON ".$table.".teacherId=users.hashid
						//~ WHERE users.subject= ( SELECT subject FROM users WHERE hashid='".$id."' ) AND year='$year' AND semester='$semester'";
				$sql = "SELECT users.uname, rating, tc, ea, ap, student
						FROM ".$table."
						LEFT JOIN users ON ".$table.".teacherId=users.hashid
						WHERE users.hashid IN ( SELECT DISTINCT to_evaluate FROM results WHERE (evtype='satl-teacher' AND evaluator='".$id."')) AND year='$year' AND semester='$semester'";
				$query = mysqli_query($con, $sql);
				return $this->prepare_data_for_json($query);
			case 'll':
				//~ $sql = "SELECT users.uname, rating, tc, ea, ap, student
						//~ FROM ".$table."
						//~ LEFT JOIN users ON ".$table.".teacherId=users.hashid
						//~ WHERE users.level=( SELECT level FROM users WHERE hashid='".$id."' ) AND year='$year' AND semester='$semester'";
						$sql = "SELECT users.uname, rating, tc, ea, ap, student
						FROM ".$table."
						LEFT JOIN users ON ".$table.".teacherId=users.hashid
						WHERE users.hashid IN ( SELECT DISTINCT to_evaluate FROM results WHERE (evtype='ll-teacher' AND evaluator='".$id."')) AND year='$year' AND semester='$semester'";
				$query = mysqli_query($con, $sql);
				return $this->prepare_data_for_json($query);
			case 'cc':
				//~ $sql = "SELECT users.uname, rating, tc, ea, ap, student
						//~ FROM ".$table."
						//~ LEFT JOIN users ON ".$table.".teacherId=users.hashid
						//~ WHERE users.cluster=( SELECT cluster FROM users WHERE hashid='".$id."' ) AND year='$year' AND semester='$semester'";
				$sql = "SELECT users.uname, rating, tc, ea, ap, student
						FROM ".$table."
						LEFT JOIN users ON ".$table.".teacherId=users.hashid
						WHERE users.hashid IN ( SELECT DISTINCT to_evaluate FROM results WHERE (evtype='cc-teacher' AND evaluator='".$id."')) AND year='$year' AND semester='$semester'";
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
				'rating' => round($row[1], 2),
				'tc' => round($row[2], 2),
				'ea' => round($row[3], 2),
				'ap' => round($row[4], 2),
				'student' => round($row[5], 2)
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
		$sql = "SELECT DISTINCT to_evaluate, year, semester, supervisor
				FROM results
				LEFT JOIN users ON users.hashid=to_evaluate";
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
			$self_scores = $this->get_self_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$subject_area_scores = $this->get_subject_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$cluster_scores = $this->get_cluster_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$level_scores = $this->get_level_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$principal_scores = $this->get_principal_rating($con, $teacher[0], $teacher[1], $teacher[2]);
			$students_scores = $this->get_student_rating($con, $teacher[0], $teacher[1]);
			
			//~ $identity = $this->who_is($con, $teacher[0]);
			$identity = $teacher[2];
			
			// overall values 
			$rating = 0;
			$tc = 0;
			$ea = 0;
			$ap = 0;
			$partial = 0;
			
			// partial values
			$tc_subject_area = 0;
			$tc_cluster = 0;
			$ea_subject_area = 0;
			$ea_level = 0;
			$ap_subject_area = 0;
			$ap_level = 0;
			
			switch ($identity)
			{
				// count principal self ratings
				case 'api':
				case 'principal':
					$rating = ($self_scores[0] * $this->tc_percentage) + ($self_scores[1] * $this->ea_percentage) + ($self_scores[2] * $this->ap_percentage);
					break;
					
				// compute normal teacher ratings
				case 'none':
				case 'satl':
				case 'cc':
				case 'll':
					// get all subject area scores
					if (count($subject_area_scores) > 1)
					{
						foreach ($subject_area_scores as $sa)
						{
							$tc_subject_area += $sa[0];
							$ea_subject_area += $sa[1];
							$ap_subject_area += $sa[2];
						}
						$tc_subject_area = $tc_subject_area / count($subject_area_scores);
						$ea_subject_area = $ea_subject_area / count($subject_area_scores);
						$ap_subject_area = $ap_subject_area / count($subject_area_scores);
					}
					else
					{
						$tc_subject_area = $subject_area_scores[0];
						$ea_subject_area = $subject_area_scores[1];
						$ap_subject_area = $subject_area_scores[2];
					}
					
					// get all cluster scores
					if (count($cluster_scores) > 1)
					{
						foreach ($cluster_scores as $cl)
						{
							$tc_cluster += $cl[0];
						}
						$tc_cluster = $tc_cluster / count($cluster_scores);
					}
					else
					{
						$tc_cluster = $cluster_scores[0];
					}
					
					
					// get all level scores
					if (count($level_scores) > 1)
					{
						foreach ($level_scores as $lev)
						{
							$ea_level += $lev[1];
							$ap_level += $lev[2];
						}
						$ea_level = $ea_level / count($level_scores);
						$ap_level = $ap_level / count($level_scores);
					}
					else
					{
						$ea_level = $level_scores[1];
						$ap_level = $level_scores[2];
					}
					
					$tc = ($tc_subject_area * $this->tc_satl_per) + ($tc_cluster * $this->tc_cc_per) + ($principal[0][0] * $this->tc_api_per )
						+ ($principal[1][0] * $this->tc_principal_per) + ($self[0] * $this->tc_self_per);
						
					$ea = ($ea_subject_area * $this->ea_satl_per) + ($ea_level * $this->ea_ll_per) + ($principal[0][1] * $this->ea_api_per )
						+ ($principal[1][1] * $this->ea_principal_per) + ($self[1] * $this->ea_self_per);
					
					$ap = ($ap_subject_area * $this->ap_satl_per) + ($ap_level * $this->ap_ll_per) + ($principal[0][2] * $this->ap_api_per )
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
		return $row[0];
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
