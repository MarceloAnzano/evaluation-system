<?php
//~ session_start();

function getQuestions($con,$question) {
	//~ include('../include/connect.php');
	
	$sql = "SELECT percent, content FROM ".$question;
	$query = mysqli_query($con, $sql);
	
	$person = mysqli_real_escape_string($con, $_GET['eval']);
	
	$num = 0;
	$percent = 0;
	$category = "";
	
	while ($row = mysqli_fetch_array($query)){
		if ($row[0] > 0){
			
			if ($row[1] != $category){
				
				if ($category != ""){
					echo "<input name='".$question."Num[]' type='hidden' value='".$num."'/>";
					echo "<input name='".$question."Per[]' type='hidden' value='".$count."'/>";
				}
				$count = $row[0];
				$category = $row[1];
				$num = 0;
				echo "<tr><td><b>$category</b></td></tr>";
				continue;
			}
		}
		$num++;
		echo "<tr><td>".$row[1]."</td>";
		echo "<td><input type='number' name='".$question."[]' min='0' max='4' step='0.5' value=4 required><br></td></tr>";
	}
	echo "<input name='".$question."Num[]' type='hidden' value='".$num."'/>";
	echo "<input name='".$question."Per[]' type='hidden' value='".$count."'/>";
	echo "<input name='person' type='hidden' value='".$person."'/>";
}
$saltword = array('verysalty', 'seasalt', 'rocksalt', 'shiorijapan', 'saltshaker');
$saltkey = array('!', '@', '#', '$', '%');
$key = rand(0,4);
echo hash('sha256', 'root'.$saltword[$key].$saltkey[$key]);


?>
