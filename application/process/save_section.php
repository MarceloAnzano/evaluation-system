<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Save_section
{
	function save_section_entry($con)
	{
		// no post request so exit
		if ( ! isset($_POST['createSubjects']) OR empty($_POST['createSubjects'])
			OR ! isset($_POST['createAssignTeachers']) OR empty($_POST['createAssignTeachers'])
			OR ! isset($_POST['createSectionGradelevel']) OR empty($_POST['createSectionGradelevel'])
			OR ! isset($_POST['createSectionSection']) OR empty($_POST['createSectionSection']))
		{
			exit('Invalid input');
		}
		
		// collect post variables
		$grade_level = strtolower(mysqli_real_escape_string($con, $_POST['createSectionGradelevel']));
		$section_entry = strtolower(mysqli_real_escape_string($con, $_POST['createSectionSection']));
		
		// check if the section's subjects have been uploaded already
		$is_uploaded = FALSE;
		$sql = "SELECT id 
				FROM subjects
				WHERE gradelevel='$grade_level' AND section='$section_entry'";
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		
		$ids = array();
		if ($numrows > 0)
		{
			$is_uploaded = TRUE;
			while ($row = mysqli_fetch_array($query))
			{
				$ids[] = $row;
			}
			echo ('Section\'s subjects have been set. Changing settings... ');
		}
		
		// get subjects
		$subjects = array();
		foreach ($_POST['createSubjects'] as $subject)
		{
			$subjects[] = strtolower(mysqli_real_escape_string($con, $subject));
		}
		
		// get teachers
		$teachers = array();
		foreach ($_POST['createAssignTeachers'] as $teacher)
		{
			$teachers[] = mysqli_real_escape_string($con, $teacher);
		}
		
		// get rid of the previous entries
		if ($is_uploaded)
		{
			foreach ($ids as $id)
			{
				$sql = "DELETE FROM subjects
						WHERE id='".$id[0]."'";
				$query = mysqli_query($con, $sql);
			}
		}
		
		// set new entries
		if ($subjects[0] != '')
		{
			$sql = "INSERT INTO subjects
					(gradelevel, section, subject, teacherId)
					VALUES ('".$grade_level."','".$section_entry."','".$subjects[0]."','".$teachers[0]."')";
		}
		
		// repeat queries
		for ($a = 1; $a < 15; $a++)
		{
			if ($subjects[$a] != '')
			{
				$sql .= ", ('".$grade_level."','".$section_entry."','".$subjects[$a]."','".$teachers[$a]."')";
			}
		}
		$query = mysqli_query($con, $sql);
		
		exit ('Section Saved!');
	}
}

/* End of File */
