<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	require BASEPATH.'include/connect.php';

$logid = mysqli_real_escape_string($con, $_SESSION['logid']);
$utype = mysqli_real_escape_string($con, $_SESSION['utype']);
$userid = mysqli_real_escape_string($con, $_SESSION['userid']);
if ($utype == 'faculty' or $utype == 'head') {
	//note the increased index versus student_results
	$sql="SELECT faculty_results.id, evtype, toevaluate, tcompetencies, eattitude, apunctuality 
	FROM faculty_results JOIN users ON users.id=faculty_results.evaluator WHERE users.logid='$logid';";
}
else {
	$sql="SELECT student_results.id, subj, subjteacher, score FROM student_results 
	JOIN users ON users.id=student_results.studentkey WHERE users.logid='$logid';";
}
	
$query = mysqli_query($con, $sql);
$numrows = mysqli_num_rows($query);
if ($numrows == 0){
	echo "<br>Error:<br>Cannot retrieve evaluation";
	exit();
}
$temp=array();
$count=0;

while($row = mysqli_fetch_array($query)){
	$temp[]=$row;
}

$count=count($temp);
for ($i=0; $i < $count; $i++){
	if ($_SESSION['utype'] == 'student'){
		$name=urlencode($temp[$i][2]);
		if ($temp[$i][3] != NULL){
			echo "<br><br>
			<a href=score.php?sub=".$temp[$i][1]."&st=$name>
			Evaluation Score for ".ucwords($temp[$i][2])."<br>
			Subject: ".ucwords($temp[$i][1])."
			</a>";
		} else {
			echo "<br><br>
			<a href=evaluation/sub=".$temp[$i][1]."&st=$name>
			Evaluate ".ucwords($temp[$i][2], " ")."<br>
			Subject: ".ucwords($temp[$i][1], " ")."
			</a>";
		}
		continue;
	}
	if ($temp[$i][1] == 'self'){
		if ($temp[$i][3] != NULL){
			echo "<br><br>
			<a href=score.php?eval=self>
			Self Evaluation Score
			</a>";
		} else {
			echo "<br><br>
			<a href=evaluation/eval=self>
			Self Evaluation
			</a>";
		}
	} else {
		$sql="SELECT uname FROM users WHERE users.id='".$temp[$i][2]."'";
		$query=mysqli_query($con, $sql);
		$name=mysqli_fetch_row($query);
		$urlname[0]=urlencode($name[0]);
		$name[0]=ucwords($name[0]);
		if ($temp[$i][3] != NULL){
			echo "<br><a href=score.php?eval=$urlname[0]>
			Evaluation Score for $name[0]
			</a>";
		} else {
			echo "<br><a href=evaluation/?eval=$urlname[0]>
			Evaluate $name[0]
			</a>";
		}
	}
}
$date = date("y")-1 . date("y");
$sql="SELECT faculty_results$date.id, evtype, toevaluate, tcompetencies, eattitude, apunctuality FROM faculty_results$date JOIN users ON users.id=faculty_results$date.evaluator WHERE users.logid='$logid';";

$query = mysqli_query($con, $sql);
if (!$query){
	exit();
}
$numrows = mysqli_num_rows($query);
if ($numrows == 0){
	//~ echo "<br>Error:<br>Cannot retrieve evaluation";
	exit();
}
$temp=array();
$count=0;

while($row = mysqli_fetch_array($query)){
	$temp[]=$row;
}

$count=count($temp);
for ($i=0; $i < $count; $i++){
	if ($_SESSION['utype'] == 'student'){
		$name=urlencode($temp[$i][2]);
		echo "<br><br>
		<a href=score.php?sub=".$temp[$i][1]."&st=$name>
		Evaluation Score for ".ucwords($temp[$i][2])."<br>
		Subject: ".ucwords($temp[$i][1])."
		</a>";
		continue;
	}
	if ($temp[$i][1] == 'self'){
		echo "<br><br>
		<a href=score.php?eval=self>
		Self Evaluation Score
		</a>";
	} else {
		$sql="SELECT uname FROM users WHERE users.id='".$temp[$i][2]."'";
		$query=mysqli_query($con, $sql);
		$name=mysqli_fetch_row($query);
		$urlname[0]=urlencode($name[0]);
		$name[0]=ucwords($name[0]);
		echo "<br><a href=score.php?eval=$urlname[0]&year=1516&sem=1>
		Evaluation score for $name[0]
		</a>";
	}
}
?>
