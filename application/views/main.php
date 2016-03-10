<?php // because i don't like working with javascript :(
	$entries = $data;
	
	if ($entries != NULL) 
	{
		foreach ($entries as &$entry)
		{
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
				
			
			$link_text = 'Evaluate for '.$entry['year'].' '.$semester;
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
					$link_text = 'Score for '.$entry['year'].' '.$semester;
					$link = '/app/score/'.$entry['userid'].'/'.$entry['semester'];
				}
				$closed = '';
			}
			
			echo "<br><br>";
			
			if ($entry['type'] == 'self')
			{
				echo "<a href=".$link.">".$link_text." Self evaluation</a> ".$closed;
			}
			else echo "<a href=".$link.">".$link_text.$entry['full_name']."</a> ".$closed;
		}
	}
	
	// archived results
	$archives = $data2;
	if ($archives != NULL) 
	{
		foreach ($archives as &$archive)
		{
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
			$date = substr($archive['year'], 0, strlen($archive['year']) / 2).' '.substr($archive['year'], strlen($archive['year']) / 2);
			
			$link_text = 'Archived '.$date.' '.$semester;
			echo "<br><br>";
			if ($archive['type'] == 'self')
			{
				echo "<a href=".$link.">".$link_text." Self evaluation</a> ";
			}
			else echo "<a href=".$link.">".$link_text.' '.$archive['full_name']."</a> ";
		}
	}
