<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * The main controller. Any PHP or HTML files referenced here
	 * and consequently any files referenced in the required or included files
	 * are accessed from the index.php's location
	 * 
	 * This allows the distribution of sessions and database connections in one neat file.
	 * It mostly calls the views and other functionality from the php files in the
	 * application folder (BASEPATH).
	 * **/
	 
	// usually it's the common file that gets called but it works here.
	require_once BASEPATH.'include/common.php';
	
class App extends Common
{
	var $target_id = '';
	
	// displays the main page
	function index()
	{
		if ($this->logged_as_admin())
		{
			header('Location: '.base_url.'admin');
		}
		
		if($this->check_user_login())
		{
			$data = $this->get_list_of_evaluation();
			$data2 = $this->get_list_of_archived();
			$this->this_view('views/main.php', $data, $data2);
		}
		else $this->this_view('views/login.php');
	}
	
	// display the principal page
	function principal()
	{
		if ($this->logged_as_principal())
		{
			$this->this_view('views/principal_index.php');
		}
		else exit ('Access Denied');
	}
	
	// display the register password page
	function register()
	{
		if( ! $this->check_user_login())
		{
			$this->this_view('views/register.php');
		}
		else header('Location: '.base_url.'app/index');
	}
	
	// display the user settings page
	function user_settings()
	{
		if($this->check_user_login())
		{
			$this->this_view('views/user_settings.php');
		}
		else header('Location: '.base_url);
	}
	
	// displays the evaluation form
	function evaluation($id, $semester)
	{
		if (empty($id) OR $semester == '') exit ('Error code 404');
		if($this->check_user_login())
		{
			$data = $this->questions($id);
			//$this->this_view('views/evaluation.php', $data, $id, $semester);
			$details = $this->get_user_details($id);
 			$this->this_view('views/evaluation.php', $data, $details, $semester);
		}
		else header('Location: '.base_url);
	}
	
	// displays past scores for current evaluation period
	function score($id)
	{
		if($this->check_user_login())
		{
			$this->target_id = $id;
			$this->this_view('views/past_rating.php');
		}
		else header('Location: '.base_url);
	}
	
	function archive($id, $year, $semester)
	{
		if($this->check_user_login())
		{
			$data = $this->get_archived_ratings($id, $year, $semester);
			$this->this_view('views/past_rating.php', $data);
		}
		else header('Location: '.base_url);
	}
	
	// displays the evaluation entries from the archive [OPTIONAL]
	function archive_list($id, $year, $semester)
	{
		if($this->check_user_login())
		{
			echo 'WIP';
			//~ $this->get_list_of_archived($id);
			//~ $this->this_view('views/main.php');
		}
		else header('Location: '.base_url);
	}
	
	// displays the ratings page that only supervisors and 
	function view_ratings()
	{
		// only supervisors and principals and administrators can see this
		if ($this->allow_supervisors() OR $this->logged_as_admin())
		{
			$this->this_view('views/view_ratings.php');
			//~ $this->display_ratings();
		}
		else exit ('Access Denied');
	}
	
	function success()
	{
		if($this->check_user_login())
		{
			$this->this_view('views/success.php');
		}
		else header('Location: '.base_url);
	}
	
	/** FUNCTIONALITY **/
	
	function auth()
	{
		include_once BASEPATH.'process/validate.php';
		$validation = new Validate();
		$validation->validate_credentials($this->get_connection());
	}
	
	function regpass()
	{
		include_once BASEPATH.'process/register_pass.php';
		$register = new Register_pass();
		$register->register_password($this->get_connection());
	}
	
	function change_pass()
	{
		include_once BASEPATH.'process/change_pass.php';
		$change = new Change_pass();
		$change->change_password($this->get_connection(), $this->get_session_info('logid'));
	}
	
	function get_list_of_evaluation()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/evaluation_entries.php';
		$entries = new Evaluation_entries();
			
		$list = $entries->get_persons_to_evaluate($this->get_connection(), $this->get_session_info('userid'));
		return $list;
	}
	
	function get_list_of_archived()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/evaluation_archive.php';
		$entries = new Evaluation_archive();
			
		$list = $entries->get_archived_evaluation($this->get_connection(), $this->get_session_info('userid'));
		return $list;
	}
	
	function questions()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/question.php';
		$questions = new Question();
		return $questions->display_questions($this->get_connection(),$this->get_session_info('utype'));
		
	}
	
	function post_result()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/record_result.php';
		$record = new Record_result();
		$record->compute_score($this->get_connection(), $this->get_session_info('utype'), $this->get_session_info('userid'));
		
		header ('Location: '.base_url);
	}
	
	function get_past_ratings($id, $year, $semester)
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/evaluation_entries.php';
		$entries = new Evaluation_entries();
			
		$list = $entries->get_rating_for_person($this->get_connection(), $this->get_session_info('userid'), $this->get_session_info('utype'), $id, $year, $semester);
		//~ header('Content-Type: application/json');
		//~ echo json_encode($list);
		//~ return;
		return $list;
	}
	
	function get_archived_ratings($id, $year, $semester)
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/evaluation_archive.php';
		$entries = new Evaluation_archive();
		$list = $entries->get_rating_for_person($this->get_connection(), $this->get_session_info('userid'), $this->get_session_info('utype'), $id, $year, $semester);
		//~ header('Content-Type: application/json');
		//~ echo json_encode($list);
		//~ return;
		return $list;
	}
	
	function calculate_ratings()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/calculate.php';
		$calculate = new Calculate();
		$calculate->get_final_rating($this->get_connection());
	}
	
	function display_ratings()
	{
		if ( ! $this->allow_supervisors()) exit ('Access Denied');
		
		include BASEPATH.'process/calculate.php';
		$calculate = new Calculate();
		$data = $calculate->display_subordinate_ratings($this->get_connection(), $this->get_session_info('userid'), $this->get_session_info('supervisor'));
		
		header('Content-Type: application/json');
		echo json_encode($data);
		return;
	}
	
	// get photos for each user with this function
	function get_photo($id)
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include_once BASEPATH.'process/file_upload_parser.php';
		$photo = new File_upload_parser();
		return $photo->get_image_reference($this->get_connection(), $id);
	}
		
 	function get_user_details($id)
 	{
 		if ( ! $this->check_user_login()) exit ('Not logged in');
 		
 		include BASEPATH.'process/users_and_sections.php';
 		$details = new Users_and_sections();
 		return $details->get_user_info($this->get_connection(), $id);
 	}
 
	// logout user
	function logout()
	{
		if($this->check_user_login())
		{
			include BASEPATH.'process/logout.php';
		}
		else exit ('Error 404');
	}	
}
	

/* End of File */
