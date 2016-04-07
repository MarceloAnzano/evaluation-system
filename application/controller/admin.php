<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// usually it's the common file that gets called but it works here.
	require_once BASEPATH.'include/common.php';

class Admin extends Common
{	
	function index()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			$this->this_view('views/admin_index.php', $this->get_percentages());
		}
		else exit('Access Denied');
	}
	
	function manage($id)
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/edit_user_data.php';
			$user = new Edit_user_data();
			if ($user->does_user_exist($this->link, $id))
			{
				$this->this_view('views/change_user_settings.php', $id, 'manage');
			}
			else exit ('Invalid user!');
		}
		else exit('Access Denied');
	}
	
	/** FUNCTIONALITY **/
	
	// test method
	function create_evaluation()
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		//~ $type = mysqli_real_escape_string($this->link, $_POST['create-type']);
		
		include BASEPATH.'process/create_evaluation.php';
		$create = new Create_evaluation();
		$create->create_evaluation_entries($this->link);
		foreach ($create->messages as &$message)
		{
			echo $message;
		}
	}

	
	function get_faculty()
	{
		// different because principals can also access this
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/users_and_sections.php';
			$get_list = new Users_and_sections();
			$data = $get_list->get_faculty($this->link);
			$data['status'] = "OK";
			
			// convert data into json
			header('Content-Type: application/json');
			echo json_encode($data);
			return;
		}
		else exit('Not authorized!');
	}
	
	
	function get_sections()
	{
		// different because principals can also access this
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/users_and_sections.php';
			$get_list = new Users_and_sections();
			$data = $get_list->get_section_method($this->link);
			$data['status'] = "OK";
			
			// convert data into json
			header('Content-Type: application/json');
			echo json_encode($data);
			return;
		}
		else exit('Not authorized!');
	}
	
	function get_subjects($gradelevel, $section)
	{
		// different because principals can also access this
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/users_and_sections.php';
			$get_list = new Users_and_sections();
			$data = $get_list->get_subject_method($this->link, $gradelevel, $section);
			$data['status'] = 'OK';
			
			// convert data into json
			header('Content-Type: application/json');
			echo json_encode($data);
			return;
		}
		else exit('Not authorized!');
	}
	
	function save_user()
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/save_user.php';
		$save = new Save_user();
		$save->save_user_entry($this->link);
	}
	
	function batch_upload()
	{
		if ($this->logged_as_admin())
		{
			include BASEPATH.'process/file_upload_parser.php';
			$file = new File_upload_parser();
			if ($file->user_batch_upload())
			{
				include BASEPATH.'process/save_user.php';
				$save = new Save_user();
				$data = $file->csv_get_reference_path($this->link);
				$type = strtolower(mysqli_real_escape_string($this->link, $_POST['userBatchUploadType']));
				$save->save_batch_user_entries($this->link, $data['path'], $type);				
			}
			else exit(' Could not upload file');
		}
		else exit('Not authorized!');
	}	
	
	function save_section()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/save_section.php';
			$save = new Save_section();
			$save->save_section_entry($this->link);
		}
		else exit('Not authorized!');
	}
	
	function open($type)
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/open_evaluation.php';
		$control = new Open_evaluation();
		$control->evaluation_control($this->link, $type);
		
		echo $control->get_current_status();
	}
	
	function delete_evaluation($type)
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/delete_evaluation.php';
		$control = new Delete_evaluation();
		$control->delete_evaluation_entries($this->link, $type);		
	}
	
	function evaluation_status()
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/open_evaluation.php';
		$control = new Open_evaluation();
		$status = array();
		
		$control->update_status($this->link, 1);
		$status[] = $control->get_current_status();
		$control->update_status($this->link, 2);
		$status[] = $control->get_current_status();
		
		// convert data into json
		header('Content-Type: application/json');
		echo json_encode($status);
    	return;
	}
	
	function upload_photo()
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/file_upload_parser.php';
		$image = new File_upload_parser();
		if ($image->is_valid_userid($this->link))
		{
			if ($image->image_upload())
			{
				$image->store_image_reference($this->link);
			}
			else exit(' Could not upload file');
		}
		else exit('Invalid user ID');
		
		// cause not ajax (-_-)
		header('Location: '.base_url.'admin#upload-photo');
	}
	
	function search_for()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/users_and_sections.php';
			$get_list = new Users_and_sections();
			$data = $get_list->get_all_users($this->link, $this->get_session_info('userid'));
			$data['status'] = "OK";
			
			header('Content-Type: application/json');
			echo json_encode($data);
			return;
		}
		else exit('Not authorized!');
	}
	
	function edit_user()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/edit_user_data.php';
		$user = new Edit_user_data();
		$user->edit_user_method($this->link);
	}	
	
	function dump_user_info($id)
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/users_and_sections.php';
			$get_list = new Users_and_sections();
			$data =  $get_list->get_user_info($this->link, $id);
			$data['status'] = "OK";
			
			header('Content-Type: application/json');
			echo json_encode($data);
			return;
		}
		else exit('Not authorized!');
	}
	
	// if you select archive on evaluation administrator's page
	function archive_results()
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/evaluation_archive.php';
		$archive = new Evaluation_archive();
		$archive->create_archive($this->link);
	}
	
	function delete_user($id)
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/users_and_sections.php';
		$archive = new Users_and_sections();
		$archive->delete_user_method($this->link, $id);
		
		echo 'User deleted.';
	}
	
	function process_csv()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/file_upload_parser.php';
			$file = new File_upload_parser();
			if ($file->is_valid_questionnaire($this->link))
			{
				if ($file->csv_upload())
				{
					include BASEPATH.'process/configuration.php';
					$question = new Configuration_admin();
					$data = $file->csv_get_reference_path($this->link);
					$question->edit_questionnaire($this->link, $data['name'], $data['path']);
					
					// cause not ajax (-_-)
					header('Location: '.base_url.'admin#manage-questionnaire');
				}
				else exit(' Could not upload file');
			}
			else exit('Invalid Input');
		}
		else exit('Not authorized!');
	}
	
	function edit_percentages()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/configuration.php';
			$percent = new Configuration_admin();
			$percent->configure_rating_percentages($this->link);
		}
		else exit('Not authorized!');
	}
	
	
	function get_percentages()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/configuration.php';
			$percent = new Configuration_admin();
			$data = $percent->get_percentages($this->link);
			return $data;
		}
		else exit('Not authorized!');
	}
}
/* End of File */
