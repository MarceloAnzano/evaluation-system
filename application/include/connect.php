<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// credentials and database name
	$mysql_db_hostname = "localhost";
	$mysql_db_user = "root";
	$mysql_db_password = "root";
	$mysql_db_database = "myapp";
	
	// create connection variable
	$con = mysqli_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password) or die("Could not connect database");
	
	// select the database to be used
	mysqli_select_db($con, $mysql_db_database) or die("Could not select database");

/* End of File */
