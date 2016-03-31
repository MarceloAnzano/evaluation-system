<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_upload_parser
{
	var $upload_path = '';
	var $folder = '';
	var $file_name = '';
	var $userkey = '';
	
	function image_upload()
	{
		// standard file input sanitation
		try
		{
			// check if undefined or multiple or corruption attacj
			// If this request falls under any of them, treat it invalid.
			if ( ! isset($_FILES['facultyPhoto']['error']) OR is_array($_FILES['facultyPhoto']['error']))
			{
				throw new RuntimeException('Invalid parameters.');
			}

			// check $_FILES['upfile']['error'] value.
			switch ($_FILES['facultyPhoto']['error'])
			{
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					throw new RuntimeException('No file sent.');
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new RuntimeException('Exceeded filesize limit.');
				default:
					throw new RuntimeException('Unknown errors.');
			}

			// check filesize here. allows only 100kB and below
			if ($_FILES['facultyPhoto']['size'] > 100000) 
			{
				throw new RuntimeException('Exceeded filesize limit.');
			}

			// check MIME type.
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			if (FALSE === $ext = array_search($finfo->file($_FILES['facultyPhoto']['tmp_name']),
					array(
						'jpg' => 'image/jpeg',
						'png' => 'image/png'
					),
					TRUE
				)) 
			{
				throw new RuntimeException('Invalid file format.');
			}
			
			// initialize upload path
			$this->folder = 'images';
			$this->upload_path = '';
			
			if (realpath($this->upload_path) !== FALSE)
			{
				$this->upload_path = realpath($this->upload_path).'/';
			}
			
			$this->upload_path = rtrim($this->upload_path, '/').'/';
			$this->folder = rtrim($this->folder, '/').'/';
			
			// set filename
			$file_count = 1;
			if (is_dir($this->upload_path.$this->folder))
			{
				if ($dir_folder = opendir($this->upload_path.$this->folder))
				{
					while (($file = readdir($dir_folder)) !== false)
					{
						if (stripos($file, 'profilepic'.$file_count) !== FALSE)
						{
							$file_count++;
						}
					}
					closedir($dir_folder);
				}
			}
			$path = $_FILES['facultyPhoto']['name'];
			$extension = pathinfo($path, PATHINFO_EXTENSION);
			$this->file_name = 'profilepic'.$file_count.'.'.$extension;

			// move file from temporary location to desired path
			if (move_uploaded_file($_FILES['facultyPhoto']['tmp_name'], $this->upload_path.$this->folder.$this->file_name)) 
			{
				return TRUE;
			}
			else throw new RuntimeException('Failed to move uploaded file.');
			
		}
		catch (RuntimeException $e)
		{
			echo $e->getMessage();
			return FALSE;
		}
	}
	
	function is_valid_userid($con)
	{
		// see if there is a user ID
		if ( ! isset($_POST['userPhotoId']) OR empty($_POST['userPhotoId'])) exit ('Invalid ID Given');
		$this->userkey = mysqli_real_escape_string($con, $_POST['userPhotoId']);
		
		$sql = "SELECT id
				FROM users 
				WHERE hashid=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 's', $this->userkey);
		
		mysqli_stmt_execute($stmt);
		$query = mysqli_stmt_get_result($stmt);
		
		$numrows = mysqli_num_rows($query);
		if ($numrows > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function store_image_reference($con)
	{
		$sql = "SELECT id
				FROM img_uploads 
				WHERE userId=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 's', $this->userkey);
		
		mysqli_stmt_execute($stmt);
		$query = mysqli_stmt_get_result($stmt);
		
		$numrows = mysqli_num_rows($query);
		
		// update if already exists or create new entry otherwise
		if ($numrows > 0)
		{
			$sql = "UPDATE img_uploads 
					SET img_reference=?
					WHERE userId=?";
		}
		else
		{
			$sql = "INSERT INTO img_uploads 
					(img_reference, userId) VALUES (?, ?)";
		}
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ss', $img_reference, $this->userkey);
		
		$img_reference = $this->folder.$this->file_name;
		
		mysqli_stmt_execute($stmt);
	}
	
	function get_image_reference($con, $id, $no_photo_ref)
	{
		$sql = "SELECT img_reference
				FROM img_uploads
				WHERE userId=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		
		mysqli_stmt_execute($stmt);
		$query = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($query);
		$numrows = mysqli_num_rows($query);
		if ($numrows == 0)
		{
			return $no_photo_ref;
		}
		else return base_url.$row[0];
	}
	
	function csv_upload()
	{		
		// standard file input sanitation
		try
		{
			// check if undefined or multiple or corruption attacj
			// If this request falls under any of them, treat it invalid.
			if ( ! isset($_FILES['questionFile']['error']) OR is_array($_FILES['questionFile']['error']))
			{
				throw new RuntimeException('Invalid parameters.');
			}

			// check $_FILES['name']['error'] value.
			switch ($_FILES['questionFile']['error'])
			{
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					throw new RuntimeException('No file sent.');
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new RuntimeException('Exceeded filesize limit.');
				default:
					throw new RuntimeException('Unknown errors.');
			}

			// check filesize here. allows only 50kB and below
			if ($_FILES['questionFile']['size'] > 50000) 
			{
				throw new RuntimeException('Exceeded filesize limit.');
			}
			
			$csv_mimetypes = array(
				'text/csv',
				'text/plain',
				'application/csv',
				'text/comma-separated-values',
				'application/excel',
				'application/vnd.ms-excel',
				'application/vnd.msexcel',
				'text/anytext',
				'application/octet-stream',
				'application/txt',
			);
			
			
			// check MIME type.
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			if (FALSE === $ext = array_search($finfo->file($_FILES['questionFile']['tmp_name']), $csv_mimetypes, TRUE)) 
			{
				throw new RuntimeException('Invalid file format.');
			}
			
			
			// initialize upload path
			$this->folder = 'files';
			$this->upload_path = '';
			
			if (realpath($this->upload_path) !== FALSE)
			{
				$this->upload_path = realpath($this->upload_path).'/';
			}
			
			$this->upload_path = rtrim($this->upload_path, '/').'/';
			$this->folder = rtrim($this->folder, '/').'/';
			
			// move file from temporary location to desired path
			if (move_uploaded_file($_FILES['questionFile']['tmp_name'], $this->upload_path.$this->folder.$this->file_name.'.csv'))
			{
				return TRUE;
			}
			else throw new RuntimeException('Failed to move uploaded file.');
			
		}
		catch (RuntimeException $e)
		{
			echo $e->getMessage();
			return FALSE;
		}
	}
	
	function is_valid_questionnaire($con)
	{
		if ( ! isset($_POST['questionnaire']) OR empty($_POST['questionnaire'])) exit ('Invalid input.');
		
		$this->file_name = mysqli_real_escape_string($con, $_POST['questionnaire']);
		
		// not really a hack
		switch($this->file_name)
		{
			case 'student_questionnaire':
			case 'teaching_competencies':
			case 'efficiency_and_attitude':
			case 'attendance_and_punctuality':
				return TRUE;
			default:
				echo 'Invalid Questionnaire!';
				return FALSE;
		}
	}
	
	// return the filepath and the name of the table to be edited
	function csv_get_reference_path($con)
	{
		$csv_path = $this->folder.$this->file_name.'.csv';
		
		$data = array(
			'name' => $this->file_name,
			'path' => $csv_path
		);
		
		return $data;
	}
}

/* End of file */
