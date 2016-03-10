<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Change_pass
{
	function change_password($con, $logid)
	{
		$message = array();

		if(isset($_POST['currpass']) && ! empty($_POST['currpass']))
		{
			$currpass = mysqli_real_escape_string($con, $_POST['currpass']);
		}
		else
		{ 
			$message[] = 'Please input your current password';
		}

		// check to see if the log id and current password are correct
		$sql = "SELECT password FROM users WHERE logid='$logid';";
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		if ($numrows == 0)
		{
			$message[] = 'Incorrect username';
		}
		else
		{
			include BASEPATH.'libraries/bcrypt.php';
			$crypt = new Bcrypt();
			$row = mysqli_fetch_row($query);
			if ( ! $crypt->verify($currpass, $row[0]))
			{
				$message[] = 'Incorrect password';
			}
		}
		
		// checks if the new passwords match
		if(isset($_POST['password']) && ! empty($_POST['password']))
		{	
			if(isset($_POST['repass']) && ! empty($_POST['repass']))
			{		
				if($_POST['password'] == $_POST['repass'])
				{
					$password = mysqli_real_escape_string($con, $_POST['password']);
				}
				else $message[] = 'Passwords do not match';
			}
			else $message[] = 'Please enter the password twice';
		}
		else $message[] = 'Please enter password';
		
		// dole out the error messages or set the new password; user is set to use the account
		$countError = count($message);
		if($countError > 0){
			
			$this->errorMessages($message, $countError);	
		} 
		else
		{
			$password = $crypt->hash($password);
			$sql = "UPDATE users SET password='".$password."' WHERE logid='$logid'";
			$query = mysqli_query($con, $sql);
			echo 'correct';
			if ( ! $query) {
				$message[] = 'Invalid query';
				$this->errorMessages($message, $countError);
			}
			else
			{
				// update session
				$_SESSION['password'] = $password;
			}
		}
	}

	function errorMessages($message, $countError)
	{
		for($i = 0; $i < $countError; $i++)
			echo '<br/>'.ucwords($message[$i]);
	}
}
/* End of File */

