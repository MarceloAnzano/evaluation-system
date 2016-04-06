<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Record_result
{
	var $person = '';
	var $semester = '';
	
	// main call
	function compute_score($con, $type, $user)
	{
		$this->person = mysqli_real_escape_string($con, $_POST['person']);
		$this->semester = mysqli_real_escape_string($con, $_POST['semester']);

		// check if the evaluation is open
		if ( ! $this->is_evaluation_open($con, $type)) exit ('Evaluations are not avaiable or open yet');
		
		// edit protection
		if ($this->is_complete($con, $type, $user)) exit ('Rating already saved!');
		
		if ($type == 'faculty')
		{
			$score[0] = $this->get_score($con, 'teaching_competencies');
			$score[1] = $this->get_score($con, 'efficiency_and_attitude');
			$score[2] = $this->get_score($con, 'attendance_and_punctuality');
		}
		else $score = $this->get_score($con, 'student_questionnaire');
		
		// store result in database
		$this->store_result($con, $score, $type, $user);
	}
	
	private function is_complete($con, $type, $user)
	{
		if ($type == 'faculty')
			$statement = 'AND tc IS NULL AND ea IS NULL AND ap IS NULL';
		else
			$statement = 'AND student IS NULL';
		$sql = "SELECT *
				FROM results
				WHERE evaluator='".$user."'AND to_evaluate='".$this->person."' ".$statement;
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		
		if ($numrows > 0)
		{
			return FALSE;
		}
		else return TRUE;
	}
	
	private function get_score($con, $question) 
	{
		if ( ! isset($_POST[$question.'Num']) OR empty($_POST[$question.'Num']) 
		OR ! isset($_POST[$question.'Per']) OR empty($_POST[$question.'Per'])
		OR ! isset($_POST[$question]) OR empty($_POST[$question]))
		{
			exit('Invalid input');
		}
		
		$questions = array();
		
		// sanitize user input
		$numquest = preg_replace('#[^0-9.]*#', '',$_POST[$question.'Num']);
		$percentage = preg_replace('#[^0-9.]*#', '',$_POST[$question.'Per']);
		
		// because real_escape doesn't work on arrays
		foreach ($_POST[$question] as $number)
		{
			if ($number >= 0 && $number <= 4)
				$questions[] = mysqli_real_escape_string($con, $number);
			else exit ('Invalid Input');
		}
		
		$num_index = count($numquest);
		$index = 0;
		$partial = 0;
		$total = 0;
		
		// iterate per subdivision of the category
		for ($a = 0; $a < $num_index; $a++)
		{
			// sum all entries
			for ($i = $index; $i < $index + $numquest[$a]; $i++)
			{
				if ($questions[$i] == null) {
					echo 'Invalid input detected';
					exit(1);
				}
				$partial += $questions[$i];
			}
			
			// 100 percent means the category is not subdivided e.g. apunctuality
			// gets the average and it's percentage of the whole
			if ($percentage[$a] != 100)
			{
				$total += ($partial / $numquest[$a]) * ($percentage[$a] / 100);
			}
			else $total += $partial;
				
			$index += $numquest[$a];
			$partial = 0;
		}
		
		// total for the category if not subdivided otherwise ignored
		if ($percentage[0] == 100)
		{
			$total = $total / count($questions);
		}
		
		return $total;
	}
	
	private function store_result($con, $score, $type, $user)
	{
		if ($type == 'faculty')
		{
			$statement = 'tc=?, ea=?, ap=?';
			$sql = "UPDATE results 
					SET ".$statement."
					WHERE evaluator=? AND to_evaluate=? AND semester=? AND open='1'";
			$stmt = mysqli_prepare($con, $sql);
			mysqli_stmt_bind_param($stmt, 'dddssi', $score[0], $score[1], $score[2], $user, $this->person, $this->semester);
		}
		elseif ($type == 'student')
		{
			$statement = 'student=?';
			$sql = "UPDATE results 
					SET ".$statement." 
					WHERE evaluator=? AND to_evaluate=? AND open='1'";
			$stmt = mysqli_prepare($con, $sql);
			mysqli_stmt_bind_param($stmt, 'dss', $score, $user, $this->person);
		}
		else exit ('Invalid session');
		
		mysqli_stmt_execute($stmt);
	}
	
	function is_evaluation_open($con, $type)
	{
		switch ($type)
		{
			case 'student':
				$sql = "SELECT *
						FROM results
						WHERE open=1 AND evtype='student-teacher'";
				break;
			case 'faculty':
				$sql = "SELECT *
						FROM results
						WHERE semester='".$this->semester."' AND open=1 AND evtype!='student-teacher'";
				break;
			default:
				exit('Cannot find entry');
		}
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		if ($numrows > 0)
		{
			return TRUE;
		}
		else return FALSE;
	}
}
/* End of file */
