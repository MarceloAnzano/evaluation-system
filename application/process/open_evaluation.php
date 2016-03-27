<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Open_evaluation
{
	var $current_status = '';
	
	function get_current_status()
	{
		return $this->current_status;
	}
	
	function evaluation_control($con, $type)
	{
		// sanitize
		$type = mysqli_real_escape_string($con, $type);
		
		// get statement then get status
		$statement = $this->get_statement($con, $type);
		$status = $this->evaluation_status($con, $statement);
		
		// change status according to previous
		if ($status > 0)
		{
			$status = 1;
		}
		else $status = 0;
		
		$sql = "UPDATE results
				SET open=?
				WHERE ".$statement;
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'i', $status);
		mysqli_stmt_execute($stmt);
		
		
		// set current status
		if ($status == 0)
		{
			$this->current_status = $this->ajax_statement($type).'closed';
		}
		else $this->current_status = $this->ajax_statement($type).'open';
		
	}
	
	function update_status($con, $type)
	{
		// sanitize
		$type = mysqli_real_escape_string($con, $type);
		
		// get statement then get status
		$statement = $this->get_statement($con, $type);
		
		$exists = $this->evaluation_exists($con, $statement);
		if ($exists)
		{
			$status = $this->evaluation_status($con, $statement);
					
			// set current status
			// note status here is different from evaluation_control fx
			if ($status == 0)
			{
				$this->current_status = $this->ajax_statement($type).'open';
			}
			else $this->current_status = $this->ajax_statement($type).'closed';
		}
		else $this->current_status = $this->ajax_statement($type).'has not been created yet.';
	}
	
	/** PRIVATE FUNCTION **/
	
	private function get_statement($con, $type)
	{
		$statement = '';
	
		switch ($type)
		{
			case 1:
				$statement = "semester='1'";
				break;
			case 2:
				$statement = "semester='2'";
				break;
			default:
				exit ('Invalid input');
		}
		
		return $statement;
	}
	
	private function evaluation_status($con, $statement)
	{
		$sql = "SELECT open
				FROM results
				WHERE open='0' AND ".$statement;
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		return $numrows;
	}
	
	private function ajax_statement($type)
	{
		$statement = '';
	
		switch ($type)
		{
			case 1:
				$statement = "1st Semester Evaluation: ";
				break;
			case 2:
				$statement = "2nd Semester Evaluation: ";
				break;
			default:
				exit ('Invalid input');
		}
		
		return $statement;
	}
	
	private function evaluation_exists($con, $statement)
	{
		$sql = "SELECT open
				FROM results
				WHERE ".$statement;
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		
		if ($numrows > 0) return TRUE;
		else return FALSE;
	}
}

/* End of File */
