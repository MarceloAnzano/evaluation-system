<main>
	<div class="container">
		<div class="subNav line-height">
			<span class="brand-logo" style="text-transform: none !important;">List of Teachers</span>
		</div>
		<div class="row">
<?php // because i don't like working with javascript :(
	$perpage = 0;
	$pages = 1;
	$entries = $data;
	$cardNum = 0;
	if ($entries != NULL) 
	{
		foreach ($entries as &$entry)
		{
			if($cardNum > 3) $cardNum = 0;
			if($perpage > 7) $perpage = 0;
			// prepare for display
			if ($entry['semester'] == 1)
			{
				$semester = '1st Semester';
			}
			elseif ($entry['semester'] == 2)
			{
				$semester = '2nd Semester';
			}
			else $semester = '';
				
			
			$link_text = 'Evaluate for '.$entry['year'].'<br>'.$semester;
			$closed = '[Closed]';
			$link = '';
			if ($entry['open'])
			{
				if ($entry['is_answered'] == 'no')
				{
					$link = '/app/evaluation/'.$entry['userid'].'/'.$entry['semester'];
				}
				else
				{
					$link_text = 'Score for '.$entry['year'].'<br>'.$semester;
					$link = '/app/score/'.$entry['userid'].'/'.$entry['semester'];
				}
				$closed = '';
			}
			
			if($perpage == 0) echo '<div class="section page-'.$pages.' ">';
			if($cardNum == 0) echo '<div class="row">';
			echo '
				<div class="col l3 m6 s8 offset-s2" id="teacher1">';
			if ($closed == '')
				echo "

					<div class='card waves-effect hoverable' id='eval-card'>
					<a class=' card-content' href=".$link.">";
			else
				echo "
					<div class='card disabledCard'>
					<a class='card-content' href=".$link.">";
					
			// echo "
			// 	<div class='row' style='margin-bottom: 0px !important'>
			// 		<div class='col m4 avatar'>
			// 			<img src='.\static\images\avatar-01.svg'>
			// 		</div>
			// 		<div class='col m8'>";
			echo "
				<div class='row'>
					<div class='col s4 m4'>
						<div class='imgholder1x1'>
							<img src=".$this->get_photo($entry['userid']).">
						</div>
					</div>
					<div class='col s8 m8'>";
			if ($entry['type'] == 'self')
				echo "
						<h6 class='flow-text name'>Self Evaluation</h6>";
			else
				echo "
						<h6 class='flow-text name'>".$entry['full_name']."</h6>";
			echo "
						<p class='bodyText flow-text'>".$link_text."</p>
					</div>
				</div>
				</a>
				</div>
			</div>";
			if($perpage == 7){echo '</div>'; $pages++;}
			if($cardNum == 3) echo '</div>';
			$cardNum++;
			$perpage++;
			// if ($entry['type'] == 'self')
			// {
			// 	echo "<a href=".$link.">".$link_text." Self evaluation</a> ".$closed;
			// }
			// else echo "<a href=".$link.">".$link_text.$entry['full_name']."</a> ".$closed;
		}
	}
	
	// archived results
	$archives = $data2;
	if ($archives != NULL) 
	{
		foreach ($archives as &$archive)
		{
			if($cardNum > 3) $cardNum = 0;
			if($perpage > 7) $perpage = 0;
			if ($archive['semester'] == 1)
			{
				$semester = '1st Semester';
			}
			elseif ($archive['semester'] == 2)
			{
				$semester = '2nd Semester';
			}
			else $semester = '';
			
			$link = '/app/archive/'.$archive['userid'].'/'.$archive['year'].'/'.$archive['semester'];
			$date = substr($archive['year'], 0, strlen($archive['year']) / 2).'-'.substr($archive['year'], strlen($archive['year']) / 2);
			
			$link_text = 'Archived '.$date.'<br>'.$semester;
			// if ($archive['type'] == 'self')
			// {
			// 	echo "<a href=".$link.">".$link_text." Self evaluation</a> ";
			// }
			// else echo "<a href=".$link.">".$link_text.' '.$archive['full_name']."</a> ";

			if($cardNum == 0) echo '<div class="row">';
			if($perpage == 0) echo '<div class="section page-'.$pages.' ">';
			echo '
				<div class="col l3 m6 s8 offset-s2" id="teacher1">';
			echo "
				<div class='card waves-effect disabledCard'>
					<a class='card-content' href=".$link.">";
			echo "
				<div class='row'>
					<div class='col s4 m4'>
						<div class='imgholder1x1'>
							<img src=".$this->get_photo($archive['userid']).">
						</div>
					</div>
					<div class='col s8 m8'>";
			if ($archive['type'] == 'self')
				echo "
						<h6 class='flow-text name'>Self Evaluation</h6>";
			else
				echo "
						<h6 class='flow-text name'>".$archive['full_name']."</h6>";
			echo "
						<p class='bodyText flow-text'>".$link_text."</p>
					</div>
				</div>
				</a>
				</div>
			</div>";
			if($perpage == 7){echo '</div>'; $pages++;}
			if($cardNum == 3)echo '</div>';
			$cardNum++;
			$perpage++;
		}
	}
	if($perpage > 7) $perpage = 0;
	if($perpage > 0) echo '</div>';
	if($cardNum > 3) $cardNum = 0;
	if($cardNum > 0) echo '</div>';
?>
		</div>
		<div class="row">
			<center>
			<ul class="pagination">
			<?php
				if($pages > 1) echo '<li class="disabled" id="prev-page"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
				else echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
				for($k = 1; $k < $pages; $k++){  
					if($k == 1) echo '<li class="waves-effect page-nav first-page" id="pagebutton'.$k.'"><a href="#!">'.$k.'</a></li>';
					elseif ($k == $pages-1) echo '<li class="waves-effect page-nav last-page" id="pagebutton'.$k.'"><a href="#!">'.$k.'</a></li>';
					else echo '<li class="waves-effect page-nav" id="pagebutton'.$k.'"><a href="#!">'.$k.'</a></li>';
				}
				if($pages > 1) echo '<li class="waves-effect" id="next-page"><a href="#!"><i class="material-icons">chevron_right</i></a></li>';
				else echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>';
		  	?>
		  	</ul>
		  	</center>
		</div>
	</div>

</main>
