<?php

	// TO DO:
	// add regex for server-side verification
	// add checks for completed evaluation
	// add protection against edits
	// make the postresult code
	// make the code for students and faculty separate
	// remember to uncomment below the broken line:

	// ---------------------------------------
	//~ error_reporting(0);
	
	include(BASEPATH.'/include/connect.php');

	//get all the scores for faculty evaluation
	$tcomp = get_score('teaching_competencies');
	$eatt = get_score('efficiency_and_attitude');
	$apunct = get_score('attendance_and_punctuality');
	//~ $apunct = get_score('st_evaluation');
	$person = mysqli_real_escape_string($con, $_POST['person']);
	echo $apunct;
	

function get_score($question) {
	$index = 0;
	$numquest = $_POST[$question.'Num'];
	$percentage = $_POST[$question.'Per'];
	$questions = $_POST[$question];

	$numIndex = count($numquest);
	$partial = 0;
	$total = 0;
	
	// iterate per subdivision of the category
	for ($a = 0; $a < $numIndex; $a++) {
		
		// sum all entries
		for ($i = $index; $i < $index + $numquest[$a]; $i++)
		{
			if ($questions[$i] == null) {
				echo 'Invalid input detected';
				exit(1);
			}
			$partial += $questions[$i];
		}
		// 100 percent means the category is not subdivided e.g. apunctuality
		// gets the average and it's percentage of the whole
		if ($percentage[$a] != 100)
			$total += ($partial / $numquest[$a]) * ($percentage[$a] / 100);
		else
			$total += $partial;
			
		$index += $numquest[$a];
		$partial = 0;
	}
	
	// totals only if the category is not subdivided
	if ($percentage[0] == 100)
		$total = $total / count($questions);
	return $total;
}


// CAN BE USED AS A TEMPLATE FOR THE REAL TALLY
// CAUSE I MADE A FUCKING WRONG ASSUMPTION LOL
function getTotalFacultyScore($con, $tcomp, $eatt, $apunct) {
	// get the configuration from db; hardcode for now since no table yet
	$sql = "SELECT * FROM users";
	$query = mysqli_query($con, $sql);
	//~ $row = mysqli_affected_rows($con);
	$tcomp_percent = 0.4;
	$eatt_percent = 0.3;
	$apunct_percent = 0.3;
	
	return ($tcomp *$tcomp_percent) + ($eatt * $eatt_percent) + ($apunct * $apunct_percent);
}


function uploadToDatabase($con){
	
}

?>
