<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_and_sections
{
	
	function delete_user_method($con, $id)
	{
		// quick delete, no questions asked
		$sql = "DELETE FROM
				users
				WHERE hashid=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);		
		mysqli_stmt_execute($stmt);
	}
	
	function edit_section_method($con)
	{
		// move to another file
	}
	
	function get_user_info($con, $id)
	{
		$sql = "SELECT uname, logid, utype, gradelevel, section, subject, cluster, level, supervisor
				FROM users
				WHERE hashid='$id' LIMIT 1";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		if (strlen($row[7]) > 3)
		{
			$position = ucfirst($row[7]);
		}
		else $position = strtoupper($row[7]);
		
		$results['info'] = array(
				'name' => ucwords($row[0]),
				'logid' => $row[1],
				'type' => ucwords($row[2]),
				'gradelevel' => ucwords($row[3]),
				'section' => ucwords($row[4]),
				'subject' => ucwords($row[5]),
				'cluster' => $row[6],
				'level' => ucwords($row[7]),
				'position' => $position
		);
		
		return $results;
	}
	
	function get_all_users($con)
	{
		$search = strtolower(mysqli_real_escape_string($con, $_POST['search']));
		$modifier = strtolower(mysqli_real_escape_string($con, $_POST['modifier']));
		
		$statement = '';
		switch ($modifier)
		{
			case 'username':
				$statement = "AND uname='$search'";
				break;
			case 'section':
				$section = explode(' ', $search);
				$grade_level = $section[0].' '.$section[1];
				$section_entry = $section[2].' '.$section[3];
				$statement = "AND gradelevel='$grade_level' AND section='$section_entry'";
				break;
			case 'cluster':
				$statement = "AND cluster='$search'";
				break;
			case 'level':
				$statement = "AND level='$search'";
				break;
			case 'sat':
				$statement = "AND subject='$search'";
				break;
			case 'all':
				break;
			default:
				exit ('Invalid input');
		}
		
		$sql = "SELECT hashid, uname, gradelevel, section, subject, cluster, level, supervisor, utype
				FROM users
				WHERE utype != 'admin' ".$statement;
		
		$query = mysqli_query($con, $sql);
		$results = array();

		while ($row = mysqli_fetch_array($query))
		{
			if (strlen($row[7]) > 3)
				$position = ucfirst($row[7]);
			else $position = strtoupper($row[7]);
			
			$results[] = array(
				'id' => $row[0],
				'name' => ucwords($row[1]),
				'gradelevel' => $row[2],
				'section' => $row[3],
				'subject' => $row[4],
				'cluster' => $row[5],
				'level' => $row[6],
				'supervisor' => $position,
				'type' => $row[8]
			);
		}
		$data = array(
			'results' => $results
		);
		
		return $data;
	}
	
	function get_faculty($con)
	{
		$sql = "SELECT DISTINCT hashid, uname, subject
				FROM users
				WHERE utype='faculty';";
		$query = mysqli_query($con, $sql);
		
		$faculty = array();
		
		while ($row = mysqli_fetch_array($query))
		{
			$faculty[] = array(
				'id' => $row[0],
				'name' => ucwords($row[1]),
				'subject' => ucwords($row[2])
			);
		}
		$data = array(
			'faculty' => $faculty
		);
		
		return $data;
	}
}

/* End of file */