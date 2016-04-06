<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// self explanatory
	session_unset();
	session_destroy();
	header('location:'. base_url);
/* End of File */
