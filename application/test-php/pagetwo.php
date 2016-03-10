<?php
include_once('checklogin.php');
if(!$log_login_status){
	header('location:login.php');
} else {
	if ($_SESSION['utype'] !== 'admin') {
		echo "Unauthorized!";
		exit();
	}
}

if(isset($_GET['up'])) {
	if ($_GET['up'] == 2){
		/////////  FIX FOR TEACHER USER ID
		//~ $sql="SELECT users.id, subj, subjteacher FROM users JOIN sections ON sections.section=users.section WHERE utype='student'";
		$sql="SELECT users.id, subj, subjteacher FROM users JOIN sections ON sections.section=users.section";
		$query=mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);
		$student=array();
		if ($numrows == 0){
			echo "No students around";
			exit();
		} else {
			//put all students in an array
			while ($row = mysqli_fetch_row($query)) {
				$student[]=$row;
			}
			$count=count($student);
			for ($a=0; $a < $count; $a++) {
				$sql="INSERT INTO student_results (year, studentkey, subj, subjteacher) VALUES (1516, '".$student[$a][0]."', '".$student[$a][1]."','".$student[$a][2]."')";
				$query=mysqli_query($con, $sql);
			}
		}
		mysqli_close($con);
		header('location:adminpage.php');
	}
	$sql="SELECT users.id, utype, dept FROM users WHERE utype='faculty' OR utype='head'";
	$query=mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($query);
	$faculty=array();
	if ($numrows == 0){
		echo "No faculty around";
		exit();
	} else {
		//put all faculty and heads into array
		while ($row = mysqli_fetch_row($query)) {
			$faculty[]=$row;
		}
		$count=count($faculty);
		//NOTE THIS WORKS IF THE FIRST ENTRY IS NOT A DEPT HEAD
		//makes every row
		$sql="INSERT INTO faculty_results (year, evtype, evaluator, toevaluate) VALUES (1516, 'self', '".$faculty[0][0]."','".$faculty[0][0]."')";
		for ($i = 1; $i < $count; $i++){
			//~ if ($faculty[$i][1] == 'faculty'){
				$sql.=", (1516, 'self', '".$faculty[$i][0]."','".$faculty[$i][0]."')";
			/*} else*/ if ($faculty[$i][1] == 'head') {
				for ($j = 0; $j < $count; $j++){
					if ($faculty[$i][2] == $faculty[$j][2] and $i != $j) {
						$sql.=", (1516, 'subtohead', '".$faculty[$j][0]."','".$faculty[$i][0]."')";
						$sql.=", (1516, 'headtosub', '".$faculty[$i][0]."','".$faculty[$j][0]."')";
					}
				}
			}
		}
		//~ $sql="SELECT users.id FROM users WHERE utype=''";
		$query=mysqli_query($con, $sql);
	}
	mysqli_close($con);
	header('location:adminpage.php');
}

////// WARNING THIS CODE WILL TRUNCATE FACULTY_RESULTS TABLE

if(isset($_GET['create'])) {
	if ($_GET['create'] == 'new'){
		$sql="TRUNCATE TABLE faculty_results; TRUNCATE student_results";
		mysqli_multi_query($con, $sql);
		while (mysqli_next_result($con)) {;}
		mysqli_close($con);
		header('location:adminpage.php');
	} else if ($_GET['create'] == 'archive') {
		$date = date("y")-1 . date("y");
		$sql="CREATE TABLE IF NOT EXISTS faculty_results$date LIKE faculty_results; INSERT faculty_results$date SELECT * FROM faculty_results;
		CREATE TABLE IF NOT EXISTS student_results$date LIKE student_results; INSERT student_results$date SELECT * FROM student_results;
		";
		mysqli_multi_query($con, $sql);
		while (mysqli_next_result($con)) {;}
		mysqli_close($con);
		header('location:adminpage.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Administrator's Page</title>
</head>
<body>
	<a href="logout.php">Logout</a>
	Do administrative tasks here:<br><br>
	
	[TEMPORARY] For opening the faculty evaluation here are the following steps:
	<br>1. Archive the evaluation
	<br>2. Clear all current results
	<br>3. Open the evaluation
	<br><a href="?up=1">Open Faculty Evaluation</a>
	(creates new entries in the database for upcoming evaluation)
	<br><br>
	<a href="?up=2">Create Student-Teacher Evaluation</a>
	(creates new entries in the database for upcoming evaluation)
	<br><br>
	<a href="?create=new">Clear All Current Results</a>
	Creates fresh evaluation entries if older one was archived
	<br><br>
	<a href="?create=archive">Archive Evaluation</a>
	Archives the results of last year (faculty test)
	<br><br>
	<a href="importcsv.php">Import Files</a>
</body>
</html>
