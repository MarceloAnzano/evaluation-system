<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question
{
	function display_questions($con, $type)
	{
		$results = array();
		if ($type == 'faculty')
		{
			$title[] = 'teaching_competencies';
			$results[] = $this->get_questions($con, 'teaching_competencies');
			
			$title[] = 'efficiency_and_attitude';
			$results[] = $this->get_questions($con, 'efficiency_and_attitude');
			
			$title[] = 'attendance_and_punctuality';
			$results[] = $this->get_questions($con, 'attendance_and_punctuality');
		}
		else 
		{
			$title[] = 'student_questionnaire';
			$results[]= $this->get_questions($con, 'student_questionnaire');
		}
		
		$data = array(
			'title' => $title,
			'questions' => $results
		);
		
		return $data;
	}
	
	private function get_questions($con, $question) 
	{
		$sql = "SELECT percent, content FROM ".$question;
		$query = mysqli_query($con, $sql);
		
		$items = array();
		
		while ($row = mysqli_fetch_array($query))
		{
			$items[] = $row;
		}
		
		return $items;
	}
}

/* End of file */
