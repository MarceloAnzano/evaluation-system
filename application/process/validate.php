<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validate
{
	function validate_credentials($con)
	{
		$message = array();
		$countError = 0;

		// perform checks on username and password
		if(isset($_POST['logid']) && ! empty($_POST['logid']))
		{
			$logid = mysqli_real_escape_string($con, $_POST['logid']);
		} 
		else $message[] = "Please enter username";

		if(isset($_POST['password']) && ! empty($_POST['password']))
		{
			$password = $_POST['password'];
		} 
		else $message[] = "Please enter password";
		
		// catch errors and report to front
		$countError = count($message);
		
		if($countError > 0)
		{
			$this->errorMessages($message, $countError);
		}
		else
		{
			$sql = "SELECT hashid, uname, password, utype, supervisor 
					FROM users 
					WHERE logid='$logid' AND activation=1 AND is_deleted=0";
			$query = mysqli_query($con, $sql);
			$check_user = mysqli_num_rows($query);
			
			if($check_user > 0)
			{
				include BASEPATH.'libraries/bcrypt.php';
				$crypt = new Bcrypt();
				while ($row = mysqli_fetch_row($query))
				{
					if ($crypt->verify($password, $row[2]))
					{
						$_SESSION['userid'] = $row[0];
						$_SESSION['logid'] = $logid;
						$_SESSION['uname'] = $row[1];
						$_SESSION['password'] = $row[2];
						$_SESSION['utype'] = $row[3];
						$_SESSION['supervisor'] = $row[4];
						echo 'correct';
						exit();
					}
					else
					{
						$message[] = ucwords('Password is incorrect.');
						$this->errorMessages($message, $countError + 1);
					}
				}
			}
			else
			{
				$message[] = ucwords('Incorrect username or password is not set.');
				$this->errorMessages($message, $countError + 1);
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
