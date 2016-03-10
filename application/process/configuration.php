<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuration_admin
{
	// edit questionnaire content and percentages
	function edit_questionnaire($con, $table_name, $file_path)
	{	
		// clear the target table
		$sql = "TRUNCATE $table_name";
		mysqli_query($con, $sql);
		
		// prepare stock sql statement
		$sql = "INSERT INTO $table_name 
				(percent, content) VALUES (?, ?)";
		
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ds', $percent, $content);
		
		// open and loop through rows
		if (($handle = fopen($file_path, "r")) !== FALSE)
		{
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
			{
				$percent = $data[0];	
				$content = $data[1];	
				mysqli_stmt_execute($stmt);
			}
		}	
	}
	
	function view_questionnaire($con, $table_name)
	{
		
	}
	
	function configure_rating_percentages($con)
	{
		// exit if no post variable
		if ( ! isset($_POST['percent']) && empty($_POST['percent']))
		{
			exit ('Invalid input');
		}
		
		// put into array
		foreach ($_POST['percent'] as &$per)
		{
			$percentages[] = preg_replace('#[^0-9.]*#', '',$per);
		}
		
		// array of names that match the table
		$items = array(
			'tc-satl',
			'tc-cc',
			'tc-api',
			'tc-principal',
			'tc-self',
			'ea-satl',
			'ea-ll',
			'ea-api',
			'ea-principal',
			'ea-self',
			'ap-satl',
			'ap-ll',
			'ap-api',
			'ap-principal',
			'ap-self',
			'tc',
			'ea',
			'ap',
			'inst-faculty',
			'inst-student'
		);
		$this->check_if_one_hundred_percent($percentages);
		
		$sql = "UPDATE bak
				SET percent=?
				WHERE item=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ds', $percent, $item);
		
		// iterate through each name
		$i = 0;
		foreach ($items as $item)
		{
			$percent = $percentages[$i];
			mysqli_stmt_execute($stmt);
			$i++;
		}
		echo 'correct';
	}
	
	function check_if_one_hundred_percent($percentages)
	{
		// based on the table
		if (($percentages[0] + $percentages[1] + $percentages[2] + $percentages[3] + $percentages[4]) != 100)
			exit ('Teaching Competencies percentages do not equal 100');
		if (($percentages[5] + $percentages[6] + $percentages[7] + $percentages[8] + $percentages[9]) != 100)
			exit ('Efficiency and Attitude percentages do not equal 100');
		if (($percentages[10] + $percentages[11] + $percentages[12] + $percentages[13] + $percentages[14]) != 100)
			exit ('Attendance and Punctuality percentages do not equal 100');
		if (($percentages[15] + $percentages[16] + $percentages[17]) != 100)
			exit ('Category percentages do not equal 100');
		if (($percentages[18] + $percentages[19]) != 100)
			exit ('Instrument percentages do not equal 100');
	}
	
	function get_percentages($con)
	{
		
	}
}

/* End of file */
