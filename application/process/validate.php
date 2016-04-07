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
		if(count($message) > 0)
		{
			$this->errorMessages($message);
		}
		else
		{
			$sql = "SELECT  hashid, uname, password, utype, supervisor, timeout, login_times 
					FROM users 
					WHERE logid COLLATE latin1_general_cs LIKE '$logid' AND activation=1 
					AND is_deleted=0 AND (timeout < NOW() - INTERVAL 10 MINUTE OR timeout IS NULL)";
			$query = mysqli_query($con, $sql);
			$numrows = mysqli_num_rows($query);
			
			if($numrows > 0)
			{
				$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

				// include the bycrpt file if user login attempt was valid
				include BASEPATH.'libraries/bcrypt.php';
				$cryptograph = new Bcrypt();
				
				if ($cryptograph->verify($password, $row['password']))
				{
					$_SESSION['userid'] = $row['hashid'];
					$_SESSION['logid'] = $logid;
					$_SESSION['uname'] = $row['uname'];
					$_SESSION['utype'] = $row['utype'];
					$_SESSION['supervisor'] = $row['supervisor'];
					
					// reset incorrect login entries
					$sql = "UPDATE users
							SET login_times= 0, timeout = NULL 
							WHERE logid COLLATE latin1_general_cs LIKE '$logid'";
					mysqli_query($con, $sql);
					
					// log the login by the user
					$sql = "INSERT INTO admin_log
							(userId, event_type) 
							VALUES ('".$row['hashid']."', 'User logged in')";
					mysqli_query($con, $sql);
					echo 'correct';
					exit();
					
					// TO SEE THE ADMIN_LOG 
					// SELECT event_date, users.uname, event_type FROM admin_log JOIN users ON userId=hashid
				}
				else
				{
					
					if ($row['login_times'] >= 7)
					{
						// set the timeout time if incorrect logins exceed the limit
						$sql = "UPDATE users
								SET timeout=NOW()
								WHERE logid COLLATE latin1_general_cs LIKE '$logid'";
						mysqli_query($con, $sql);
						$message[] = ucwords('Too many login attempts, account is disabled for 10 minutes.');
						$sql = "INSERT INTO admin_log
							(userId, event_type) 
							VALUES ('".$row['hashid']."', 'User account was disabled')";
						mysqli_query($con, $sql);
						$this->errorMessages($message);
					}
					else
					{
						// increment the number of incorrect logins
						$message[] = ucwords('Password is incorrect.');
						$sql = "UPDATE users
								SET login_times=login_times+1
								WHERE logid COLLATE latin1_general_cs LIKE '$logid'";
						mysqli_query($con, $sql);
						$this->errorMessages($message);
					}
				}
			}
			else
			{
				$message[] = ucwords('Incorrect username or account was disabled.');
				$this->errorMessages($message);
			}
		}
	}
	
	function errorMessages($message)
	{
		$countError = count($message);
		for($i = 0; $i < $countError; $i++)
			echo '<br/>'.ucwords($message[$i]);
	}
}
	
/* End of File */
