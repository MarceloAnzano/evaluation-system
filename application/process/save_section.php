<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Save_section
{
	function save_section_entry($con)
	{
		// no post request so exit
		if ( ! isset($_POST['section']) OR empty($_POST['section'])
			OR ! isset($_POST['subjects']) OR empty($_POST['subjects'])
			OR ! isset($_POST['teachers']) OR empty($_POST['teachers'])
			OR ! isset($_POST['setting']) OR empty($_POST['setting']))
		{
			exit('Invalid input');
		}
		
		// collect post variables
		$section = strtolower(mysqli_real_escape_string($con, $_POST['section']));
		
		// for write-protection
		$section = explode(' ', $section);
		$grade_level = $section[0].' '.$section[1];
		$section_entry = $section[2].' '.$section[3];
		
		$setting = array();
		foreach ($_POST['setting'] as $per)
		{
			$setting[] = mysqli_real_escape_string($con, $per);
		}
		
		// check if the section's subjects have been uploaded already
		$sql = "SELECT * 
				FROM subjects
				WHERE gradelevel='$grade_level' AND section='$section_entry' AND year='".$setting[0].$setting[1]."' AND semester='".$setting[2]."';";
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);

		if ($numrows > 0)
		{
			exit ('Subjects for that class has already been set!');
		}
		
		$subjects = array();
		foreach ($_POST['subjects'] as $subject)
		{
			$subjects[] = strtolower(mysqli_real_escape_string($con, $subject));
		}
		
		$teachers = array();
		foreach ($_POST['teachers'] as $teacher)
		{
			$teachers[] = mysqli_real_escape_string($con, $teacher);
		}
		
		/** ADD IF NOT EXISTS **/
		
		if ($subjects[0] != '')
		{
			$sql = "INSERT INTO subjects
					(year, semester, gradelevel, section, subject, teacherId)
					VALUES ('".$setting[0].$setting[1]."','".$setting[2]."','".$grade_level."','".$section_entry."','".$subjects[0]."','".$teachers[0]."')";
		}
		for ($a = 1; $a < 10; $a++)
		{
			if ($subjects[$a] != '')
			{
				$sql .= ", ('".$setting[0].$setting[1]."','".$setting[2]."','".$grade_level."','".$section_entry."','".$subjects[$a]."','".$teachers[$a]."')";
			}
		}
		$query = mysqli_query($con, $sql);
	}
}

/* End of File */
