<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_upload_parser
{
	var $upload_path = '';
	
	function image_upload()
	{
		// initialize upload path
		$this->upload_path = 'images';
		
		if (realpath($this->upload_path) !== FALSE)
		{
			$this->upload_path = realpath($this->upload_path).'/';
		}
		
		$this->upload_path = rtrim($this->upload_path, '/').'/';
		
		// move file from temporary location to desired path
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $this->upload_path.basename($_FILES['userfile']['name']))) 
		{
			return TRUE;
		}
		else return FALSE;
	}
	
	function store_image_reference($con)
	{
		$sql = "INSERT INTO img_uploads 
				(userId, img_reference) VALUES (?, ?)";
				
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ss', $userkey, $img_reference);
		
		$userkey = mysqli_real_escape_string($con, $_POST['user-photo-id']);
		$img_reference = base_url.'images/'.basename($_FILES['userfile']['name']);
		
		mysqli_stmt_execute($stmt);
	}
	
	function get_image_reference($con, $id)
	{
		$sql = "SELECT img_reference
				FROM img_uploads
				WHERE userId=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		
		mysqli_stmt_execute($stmt);
		$query = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($query);
		
		return $row[0];
	}
}

/* End of file */
