<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delete_evaluation
{
	function delete_evaluation_entries($con, $type)
	{
		// sanitize
		$type = mysqli_real_escape_string($con, $type);
		
		// get statement then get status
		$statement = $this->get_statement($con, $type);
		
		$sql = "DELETE FROM results
				WHERE ".$statement;
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_execute($stmt);
	}
	
	private function get_statement($con, $type)
	{
		$statement = '';
	
		switch ($type)
		{
			case 1:
				$statement = "semester='1' AND evtype != 'student-teacher';";
				break;
			case 2:
				$statement = "semester='2' AND evtype != 'student-teacher';";
				break;
			case 3:
				$statement = "evtype='student-teacher';";
				break;
			default:
				exit ('Invalid input');
		}
		
		return $statement;
	}
}	
/* End of file */
