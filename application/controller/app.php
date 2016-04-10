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
	
	function show_stuff()
	{
		var_dump($_SESSION);
	}
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
			//$this->this_view('views/change_user_settings.php', $this->get_session_info('userid'), 'settings');
			$this->this_view('views/user_settings.php', $this->get_session_info('userid'), 'settings');
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

			$details = $this->get_user_details($id);
 			$this->this_view('views/evaluation.php', $data, $details, $semester);
		}
		else header('Location: '.base_url);
	}
	
	// displays past scores for current evaluation period
	function score($id, $semester)
	{
		if($this->check_user_login())
		{
			$data = $this->get_past_ratings($id, $semester);
			$data2 = $id;
			$data3 = $semester;
			$this->this_view('views/past_rating.php', $data, $data2, $data3);
		}
		else header('Location: '.base_url);
	}
	
	function archive($id, $year, $semester)
	{
		if($this->check_user_login())
		{
			$data = $this->get_archived_ratings($id, $year, $semester);
			$data2 = $id;
			$data3 = $semester;
			$data4 = $year;
			$this->this_view('views/past_rating.php', $data, $data2, $data3, $data4);
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
	
	function success($data)
	{
		if($this->check_user_login())
		{
			$this->this_view('views/success.php', $data);
		}
		else header('Location: '.base_url);
	}
	
	/** FUNCTIONALITY **/
	
	function auth()
	{
		include_once BASEPATH.'process/validate.php';
		$validation = new Validate();
		$validation->validate_credentials($this->link);
	}
	
	function regpass()
	{
		include_once BASEPATH.'process/register_pass.php';
		$register = new Register_pass();
		$register->register_password($this->link);
	}
	
	function change_pass()
	{
		include_once BASEPATH.'process/change_pass.php';
		$change = new Change_pass();
		$change->change_password($this->link, $this->get_session_info('logid'));
	}
	
	function get_list_of_evaluation()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/evaluation_entries.php';
		$entries = new Evaluation_entries();
			
		$list = $entries->get_persons_to_evaluate($this->link, $this->get_session_info('userid'));
		return $list;
	}
	
	function get_list_of_archived()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/evaluation_archive.php';
		$entries = new Evaluation_archive();
			
		$list = $entries->get_archived_evaluation($this->link, $this->get_session_info('userid'));
		return $list;
	}
	
	function questions()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/question.php';
		$questions = new Question();
		return $questions->display_questions($this->link,$this->get_session_info('utype'));
		
	}
	
	function post_result()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/record_result.php';
		$record = new Record_result();
		$record->compute_score($this->link, $this->get_session_info('utype'), $this->get_session_info('userid'));
		
		header ('Location: '.base_url);
	}
	
	function get_past_ratings($id, $semester)
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/evaluation_entries.php';
		$entries = new Evaluation_entries();
		
		$list = $entries->get_rating_for_person($this->link, $this->get_session_info('userid'), $this->get_session_info('utype'), $id, $semester);
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
		$list = $entries->get_rating_for_person($this->link, $this->get_session_info('userid'), $this->get_session_info('utype'), $id, $year, $semester);
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
		$calculate->get_final_rating($this->link);
	}
	
	function display_ratings($year, $semester)
	{
		if ( ! $this->allow_supervisors()) exit ('Access Denied');
		
		include BASEPATH.'process/calculate.php';
		$calculate = new Calculate();
		$data = $calculate->display_subordinate_ratings($this->link, $this->get_session_info('userid'), $this->get_session_info('supervisor'), $year, $semester);
		$data['status'] = 'OK';
		header('Content-Type: application/json');
		echo json_encode($data);
		return;
	}
	
	function display_quest_scores($year, $semester)
	{
		if ( ! $this->logged_as_principal('principal')) exit ('Access Denied!');
		
		include BASEPATH.'process/evaluation_entries.php';
		$entries = new Evaluation_entries();
		$data = $entries->get_all_quest_scores($this->link, $year, $semester);
		$data['status'] = 'OK';
		
		header('Content-Type: application/json');
		echo json_encode($data);
		return;
	}
	
	// get photos for each user with this function
	function get_photo($id)
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');

		// put link of standard photo
		$no_photo_ref = base_url.'/images/defaultavatar.jpg';
		
		include_once BASEPATH.'process/file_upload_parser.php';
		$photo = new File_upload_parser();
		return $photo->get_image_reference($this->link, $id, $no_photo_ref);
	}
	
	private function get_user_details($id)
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include_once BASEPATH.'process/users_and_sections.php';
		$details = new Users_and_sections();
		return $details->get_user_info($this->link, $id);
	}
	
	function user_settings_info($id)
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		if ($id == $this->get_session_info('userid'))
		{
			include_once BASEPATH.'process/users_and_sections.php';
			$details = new Users_and_sections();
			$data = $details->get_user_info($this->link, $id);
			$data['status'] = "OK";
			
			header('Content-Type: application/json');
			echo json_encode($data);
			return;
		}
		else exit ('Invalid input');
	}
	
	function print_ratings_report($year, $semester)
	{
		if ( ! $this->logged_as_principal()) exit ('Access Denied!');
		
		include BASEPATH.'process/calculate.php';
		$calculate = new Calculate();
		$data = $calculate->display_subordinate_ratings($this->link, $this->get_session_info('userid'), $this->get_session_info('supervisor'), $year, $semester);
		var_dump($data);
	}
	
	function edit_account()
	{
		if ( ! $this->check_user_login()) exit ('Not logged in');
		
		include BASEPATH.'process/edit_user_data.php';
		$user = new Edit_user_data();
		$user->edit_account_method($this->link, $this->get_session_info('utype'));
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
	

