<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// usually it's the common file that gets called but it works here.
	require_once BASEPATH.'include/common.php';

class Admin extends Common
{
	var $link = '';
	
	function index()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			//~ $this->this_view('views/admin_index.php');
			include BASEPATH.'views/admin_index.php';
		}
		else exit('Access Denied');
	}
	
	function manage($id)
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/edit_user_data.php';
			$user = new Edit_user_data();
			if ($user->does_user_exist($this->get_connection(), $id))
			{
				$this->this_view('views/change_user_settings.php', $id);
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
		
		//~ $type = mysqli_real_escape_string($this->get_connection(), $_POST['create-type']);
		
		include BASEPATH.'process/create_evaluation.php';
		$create = new Create_evaluation();
		$create->create_evaluation_entries($this->get_connection());
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
			$data = $get_list->get_faculty($this->get_connection());
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
			$data = $get_list->get_section_method($this->get_connection());
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
			$data = $get_list->get_subject_method($this->get_connection(), $gradelevel, $section);
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
		$save->save_user_entry($this->get_connection());
	}
	
	function edit_user()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/edit_user_data.php';
			$user = new Edit_user_data();
			$user->edit_user_method($this->get_connection());
		}
		else exit('Not authorized!');
	}
	
	function save_section()
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/save_section.php';
		$save = new Save_section();
		$save->save_section_entry($this->get_connection());
	}
	
	function open($type)
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/open_evaluation.php';
		$control = new Open_evaluation();
		$control->evaluation_control($this->get_connection(), $type);
		
		echo $control->get_current_status();
	}
	
	function delete_evaluation($type)
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/delete_evaluation.php';
		$control = new Delete_evaluation();
		$control->delete_evaluation_entries($this->get_connection(), $type);		
	}
	
	function evaluation_status()
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/open_evaluation.php';
		$control = new Open_evaluation();
		$status = array();
		
		$control->update_status($this->get_connection(), 1);
		$status[] = $control->get_current_status();
		$control->update_status($this->get_connection(), 2);
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
		$image->image_upload();
		$image->store_image_reference($this->get_connection());
		
		// cause not ajax (-_-)
		header('Location: '.base_url.'admin');
	}
	
	function search_for()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/users_and_sections.php';
			$get_list = new Users_and_sections();
			$data = $get_list->get_all_users($this->get_connection());
			$data['status'] = "OK";
			
			header('Content-Type: application/json');
			echo json_encode($data);
			return;
		}
		else exit('Not authorized!');
	}
	
	function dump_user_info($id)
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/users_and_sections.php';
			$get_list = new Users_and_sections();
			$data =  $get_list->get_user_info($this->get_connection(), $id);
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
		$archive->create_archive($this->get_connection());
	}
	
	function delete_user($id)
	{
		if ( ! $this->logged_as_admin()) exit('Not authorized!');
		
		include BASEPATH.'process/users_and_sections.php';
		$archive = new Users_and_sections();
		$archive->delete_user_method($this->get_connection(), $id);
		
		echo 'User deleted.';
	}
	
	function process_csv()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/file_upload_parser.php';
			$file = new File_upload_parser();
			if ($file->csv_upload())
			{
				include BASEPATH.'process/configuration.php';
				$question = new Configuration_admin();
				$data = $file->csv_get_reference_path($this->get_connection());
				$question->edit_questionnaire($this->get_connection(), $data['name'], $data['path']);
				
				// cause not ajax (-_-)
				header('Location: '.base_url.'admin');
			}
			else exit ('Invalid file. File was not uploaded.');
		}
		else exit('Not authorized!');
	}
	
	function edit_percentages()
	{
		if ($this->logged_as_admin() OR $this->logged_as_principal())
		{
			include BASEPATH.'process/configuration.php';
			$percent = new Configuration_admin();
			$percent->configure_rating_percentages($this->get_connection());
		}
		else exit('Not authorized!');
	}	
}
/* End of File */
