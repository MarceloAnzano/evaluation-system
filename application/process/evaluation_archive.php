<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation_archive
{	
	/**
	 * ------------------------------------------
	 *  The function below will clear the records
	 *  > in table, results
	 * 	> in table, final_ratings
	 *  Bear this in mind
	 * ------------------------------------------
	 * **/
	
	function create_archive($con)
	{
		// inserts all rows into the archive
		$sql = "INSERT INTO results_archive
				SELECT *
				FROM results";
		$query = mysqli_query($con, $sql);
		
		// erases all (not truncate)
		$sql = "DELETE FROM results";
		$query = mysqli_query($con, $sql);
		
		// inserts all rows into the archive
		$sql = "INSERT INTO final_ratings_archive
				SELECT *
				FROM final_ratings";
		$query = mysqli_query($con, $sql);
		
		// remove all final ratings
		$sql = "DELETE FROm final_ratings";
		$query = mysqli_query($con, $sql);
	}
	
	function get_archived_evaluation($con, $userid)
	{
		$sql = "SELECT to_evaluate, users.uname, evtype, users.supervisor, year, semester
				FROM results_archive
				INNER JOIN users ON users.hashid =results_archive.to_evaluate
				WHERE evaluator='$userid';";
		$query = mysqli_query($con, $sql);
		
		$numrows = mysqli_num_rows($query);
		if ($numrows == 0)
		{
			return NULL;
		}
		$persons = array();
		$a = 0;
		while ($row = mysqli_fetch_array($query))
		{
			$persons[$a] = array(
				'userid' => $row[0],
				'full_name' => ucwords($row[1]),
				'type' => $row[2],
				'position' => $row[3],
				'year' => $row[4],
				'semester' => $row[5]
			);
			$a++;
		}
		
		return $persons;
	}
	
	function get_rating_for_person($con, $userid, $utype, $id, $year, $semester)
	{
		switch ($utype)
		{
			case 'student':
				$sql = "SELECT users.uname, student
						FROM results_archive
						INNER JOIN users ON users.hashid=results_archive.to_evaluate
						WHERE year=? AND evaluator=? AND to_evaluate=?";
				$stmt = mysqli_prepare($con, $sql);
				
				mysqli_stmt_bind_param($stmt, 'iss', $year, $userid, $id);	
					
				mysqli_stmt_execute($stmt);
				$query = mysqli_stmt_get_result($stmt);
				
				$row = mysqli_fetch_array($query);
				
				$rating['target'] = array(
					'name' => $row[0],
					'score' => 'Score : '.$row[1]
				);
				
				return $rating;
			
			case 'faculty':
				$sql = "SELECT users.uname, tc, ea, ap
						FROM results_archive
						INNER JOIN users ON users.hashid=results_archive.to_evaluate
						WHERE year=? AND semester=? AND evaluator=? AND to_evaluate=?";
				$stmt = mysqli_prepare($con, $sql);
				
				mysqli_stmt_bind_param($stmt, 'iiss', $year, $semester, $userid, $id);	
				
				mysqli_stmt_execute($stmt);
				$query = mysqli_stmt_get_result($stmt);
				
				$row = mysqli_fetch_array($query);
				
				if ($userid == $id)
					$name = 'Self Evaluation';
				else $name = ucwords($row[0]);
				$rating['target'] = array(
					'name' => $name,
					'tc' => 'Teaching Competencies: '.$row[1],
					'ea' => 'Efficiency and Attitude: '.$row[2],
					'ap' => 'Attendance and Punctuality: '.$row[3]
				);
				
				return $rating;
			default:
				exit ('Invalid session');
		}
	}
}
/* End of File */
